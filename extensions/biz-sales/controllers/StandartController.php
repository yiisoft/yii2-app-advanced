<?php

namespace biz\sales\controllers;

use Yii;
use biz\models\SalesHdr;
use biz\models\searchs\SalesHdr as SalesHdrSearch;
use biz\models\SalesDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \Exception;
use yii\base\UserException;
use biz\tools\Helper;
use biz\tools\Hooks;
use yii\db\Query;
use yii\web\Response;
use biz\base\Event;

/**
 * PosController implements the CRUD actions for SalesHdr model.
 */
class StandartController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'release' => ['post']
                ],
            ]
        ];
    }

    /**
     * Lists all SalesHdr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesHdrSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single SalesHdr model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SalesHdr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $payment_methods = [
            1 => 'Cash',
            2 => 'Bank',
        ];
        $model = new SalesHdr;
        $model->id_branch = Yii::$app->user->branch;
        $model->status = 1;
        $model->id_customer = 1;
        $model->sales_date = date('Y-m-d');
        list($details, $success) = $this->saveSales($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_sales]);
        }
        $model->setIsNewRecord(true);
        return $this->render('create', [
                'model' => $model,
                'details' => $details,
                'payment_methods' => $payment_methods,
                'masters' => $this->getDataMaster()
        ]);
    }

    /**
     * 
     * @param SalesHdr $model
     * @return array
     */
    protected function saveSales($model)
    {
        $post = Yii::$app->request->post();
        $details = $model->salesDtls;
        $success = false;

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $formName = (new SalesDtl)->formName();
                $postDetails = empty($post[$formName]) ? [] : $post[$formName];
                if ($postDetails === []) {
                    throw new Exception('Detail tidak boleh kosong');
                }
                $objs = [];
                foreach ($details as $detail) {
                    $objs[$detail->id_sales_dtl] = $detail;
                }
                if ($model->save()) {
                    $success = true;
                    $id_hdr = $model->id_sales;
                    $id_whse = $model->id_warehouse;
                    $details = [];
                    foreach ($postDetails as $dataDetail) {
                        $id_dtl = $dataDetail['id_sales_dtl'];
                        if (isset($objs[$id_dtl])) {
                            $detail = $objs[$id_dtl];
                            unset($objs[$id_dtl]);
                        } else {
                            $detail = new SalesDtl;
                        }

                        $detail->setAttributes($dataDetail);
                        $detail->id_sales = $id_hdr;
                        $detail->id_warehouse = $id_whse;
                        if ($detail->idCogs) {
                            $detail->cogs = $detail->idCogs->cogs;
                        } else {
                            $detail->cogs = 0;
                        }
                        if (!$detail->save()) {
                            $success = false;
                            $model->addError('', implode("\n", $detail->firstErrors));
                            break;
                        }

                        $details[] = $detail;
                    }
                    if ($success && count($objs) > 0) {
                        $success = SalesDtl::deleteAll(['id_sales_dtl' => array_keys($objs)]);
                    }
                }
                if ($success) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $exc) {
                $success = false;
                $model->addError('', $exc->getMessage());
                $transaction->rollBack();
            }
            if (!$success) {
                $details = [];
                foreach ($postDetails as $value) {
                    $detail = new SalesDtl();
                    $detail->setAttributes($value);
                    $details[] = $detail;
                }
            }
        }
        return [$details, $success];
    }

    public function actionRelease($id)
    {
        $model = $this->findModel($id);
        Yii::$app->trigger(Hooks::E_SSREL_1, new Event([$model]));
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->status = SalesHdr::STATUS_RELEASE;
            if (!$model->save()) {
                throw new UserException(implode("\n", $model->getFirstErrors()));
            }
            Yii::$app->trigger(Hooks::E_SSREL_21, new Event([$model]));
            foreach ($model->salesDtls as $detail) {
                Yii::$app->trigger(Hooks::E_SSREL_22, new Event([$model, $detail]));
            }
            Yii::$app->trigger(Hooks::E_SSREL_23, new Event([$model]));
            $transaction->commit();
        } catch (Exception $exc) {
            $transaction->rollBack();
            throw new UserException($exc->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function getDataMaster()
    {
        // price squence
        $squence = Helper::getConfigValue('SALES_PRICE', 'GROSIR_CATEGORY', 1);
        $price_standart = Helper::getConfigValue('SALES_PRICE', 'PRICE_STANDART', 1);
        $squences = [$squence];
        $query_squence = (new Query)->select('squence_price')->from('price_category');
        while (true) {
            $squence = $query_squence->where(['id_price_category' => $squence])->scalar();
            $squence = empty($squence) ? $price_standart : $squence;
            if (!in_array($squence, $squences)) {
                $squences[] = $squence;
            }
            if ($squence == $price_standart) {
                break;
            }
        }
        $query_price = (new Query)->select(['id_product', 'id_price_category', 'price'])
            ->from('price')
            ->where(['id_price_category' => $squences]);
        $prices = [];
        foreach ($query_price->all() as $row) {
            $prices[$row['id_product']][$row['id_price_category']] = $row['price'];
        }

        // master product
        $query_master = (new Query())
            ->select(['id' => 'p.id_product', 'cd' => 'p.cd_product', 'nm' => 'p.nm_product', 'u.id_uom', 'u.nm_uom', 'pu.isi'])
            ->from(['p' => 'product'])
            ->innerJoin(['pu' => 'product_uom'], 'pu.id_product=p.id_product')
            ->innerJoin(['u' => 'uom'], 'u.id_uom=pu.id_uom')
            ->orderBy(['p.id_product' => SORT_ASC, 'pu.isi' => SORT_ASC]);
        $result = [];
        foreach ($query_master->all() as $row) {
            $id = $row['id'];
            if (!isset($result[$id])) {
                $result[$id] = [
                    'id' => $row['id'],
                    'cd' => $row['cd'],
                    'text' => $row['nm'],
                    'id_uom' => $row['id_uom'],
                    'nm_uom' => $row['nm_uom'],
                    'price' => 0,
                ];
                foreach ($squences as $ct) {
                    if (isset($prices[$id][$ct])) {
                        $result[$id]['price'] = $prices[$id][$ct];
                        break;
                    }
                }
            }
            $result[$id]['uoms'][$row['id_uom']] = [
                'id' => $row['id_uom'],
                'nm' => $row['nm_uom'],
                'isi' => $row['isi']
            ];
        }

        // barcodes
        $barcodes = [];
        $query_barcode = (new Query())
            ->select(['barcode' => 'lower(barcode)', 'id' => 'id_product'])
            ->from('product_child')
            ->union((new Query())
            ->select(['lower(cd_product)', 'id_product'])
            ->from('product'));
        foreach ($query_barcode->all() as $row) {
            $barcodes[$row['barcode']] = $row['id'];
        }

        // customer
        $query_cust = (new Query)->select(['id' => 'id_customer', 'label' => 'nm_cust'])->from('customer');

        return [
            'product' => $result,
            'barcodes' => $barcodes,
            'cust' => $query_cust->all(),
        ];
    }

    /**
     * Updates an existing SalesHdr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $payment_methods = [
            1 => 'Cash',
            2 => 'Bank',
        ];

        list($details, $success) = $this->saveSales($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_sales]);
        }
        return $this->render('update', [
                'model' => $model,
                'details' => $details,
                'payment_methods' => $payment_methods,
                'masters' => $this->getDataMaster()
        ]);
    }

    /**
     * Deletes an existing SalesHdr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * 
     * @param string $action
     * @param SalesHdr $model
     * @return boolean Description
     */
    public function checkAccess($action, $model)
    {
        \Yii::$app->user->can($action);
        switch ($action) {
            case 'update':
                return $model->status == SalesHdr::STATUS_DRAFT;

            default:
                return true;
        }
    }

    /**
     * Finds the SalesHdr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesHdr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesHdr::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}