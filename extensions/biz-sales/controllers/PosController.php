<?php

namespace biz\sales\controllers;

use Yii;
use biz\models\SalesHdr;
use biz\models\SalesDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\clienttools\AppCache;
use biz\tools\Helper;
use yii\db\Query;
use yii\web\Response;
use biz\models\Cashdrawer;
use biz\models\Cogs;

/**
 * PosController implements the CRUD actions for SalesHdr model.
 */
class PosController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'save-pos' => ['post'],
                    'open-new-drawer' => ['post'],
                    'select-drawer' => ['post']
                ],
            ],
            [
                'class' => AppCache::className(),
                'actions' => [
//                    'create'
                ]
            ]
        ];
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

        return $this->render('create', [
                'payment_methods' => $payment_methods,
        ]);
    }

    public function actionMasters()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->getDataMaster();
    }

    public static function invalidatePos()
    {
        AppCache::invalidate('sales/pos/create');
    }

    public function actionOpenNewDrawer()
    {
        $app = Yii::$app;
        $app->response->format = Response::FORMAT_JSON;
        $model = new Cashdrawer();
        try {
            if ($model->load($app->request->post()) && $model->save()) {
                $app->clientIdBranch = $model->id_branch;
                $app->clientCashierNo = $model->cashier_no;
                return [
                    'type' => 'S',
                    'drawer' => [
                        'id_cashdrawer' => $model->id_cashdrawer,
                        'cashier_no' => $model->cashier_no,
                        'id_branch' => $model->id_branch,
                        'nm_branch' => $model->idBranch->nm_branch,
                        'username' => $app->user->identity->username,
                        'open_time' => $model->open_time
                    ]
                ];
            } else {
                return [
                    'type' => 'E',
                    'msg' => implode("\n", $model->firstErrors)
                ];
            }
        } catch (\Exception $exc) {
            return [
                'type' => 'E',
                'msg' => $exc->getMessage(),
            ];
        }
    }

    public function actionCheckDrawer()
    {
        $app = Yii::$app;
        $app->response->format = Response::FORMAT_JSON;
        $model = Cashdrawer::findOne([
                'id_user' => Yii::$app->user->id,
                'client_machine' => Yii::$app->clientId,
                'status' => Cashdrawer::STATUS_OPEN,
        ]);
        if ($model) {
            if ($model->create_date > date('Y-m-d 00:00:00')) {
                $app->clientIdBranch = $model->id_branch;
                $app->clientCashierNo = $model->cashier_no;
                return [
                    'type' => 'S',
                    'drawer' => [
                        'id_cashdrawer' => $model->id_cashdrawer,
                        'cashier_no' => $model->cashier_no,
                        'id_branch' => $model->id_branch,
                        'nm_branch' => $model->idBranch->nm_branch,
                        'username' => $app->user->identity->username,
                        'open_time' => $model->open_time
                    ]
                ];
            } else {
                return $this->redirect(['close-drawer']);
            }
        } else {
            return [
                'type' => 'E',
                'msg' => 'not found'
            ];
        }
    }

    public function actionCloseDrawer()
    {
        $model = Cashdrawer::findOne([
                'client_machine' => Yii::$app->clientId,
                'id_user' => Yii::$app->user->getId(),
                'status' => Cashdrawer::STATUS_OPEN,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = Cashdrawer::STATUS_CLOSE;
            if ($model->save()) {
                return $this->redirect(['drawer/index']);
            }
        }
        $model->status = Cashdrawer::STATUS_OPEN;
        return $this->render('close', ['model' => $model]);
    }

    public function actionSavePos()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $drawer = Cashdrawer::findOne(['id_cashdrawer' => $post['id_drawer']]);
            $hdr = new SalesHdr([
                'id_cashdrawer' => $post['id_drawer'],
                'id_branch' => $drawer->id_branch,
                'create_by' => $drawer->id_user,
            ]);
            $total = 0.0;
            $dtls = [];
            foreach ($post['detail'] as $detail) {
                $cogs = Cogs::findOne(['id_product' => $detail['id_product']]);
                $dtl = new SalesDtl([
                    'id_product' => $detail['id_product'],
                    'id_uom' => $detail['id_uom'],
                    'sales_price' => $detail['price'],
                    'sales_qty' => $detail['qty'],
                    'discount' => $detail['discon'],
                    'cogs' => $cogs ? $cogs->cogs : 0,
                ]);
                $total += $detail['qty'] * $detail['price'] * (1 - 0.01 * $detail['discon']);
                $dtls[] = $dtl;
            }

            $transaction->commit();
        } catch (\Exception $exc) {
            $transaction->rollback();
        }
        return [
            'type' => 'E'
        ];
    }

    public function actionTotalCash($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return[
            'type' => 'S',
            'total' => 100000
        ];
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

        return [
            'product' => $result,
            'barcodes' => $barcodes
        ];
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