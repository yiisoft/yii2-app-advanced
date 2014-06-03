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
                //    'create'
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
        $drawer_id = Yii::$app->session->get(Cashdrawer::SESSION_KEY);
        $cashDrawer = isset($drawer_id) ? Cashdrawer::findOne([
                'id_cashdrawer' => $drawer_id,
                'status' => Cashdrawer::STATUS_OPEN,
            ]) : null;

        if ($cashDrawer === null) {
            $query = Cashdrawer::find()->where([
                'id_user' => Yii::$app->user->id,
                'status' => Cashdrawer::STATUS_OPEN]
            );
            if ($query->count() == 1) {
                $cashDrawer = $query->one();
                Yii::$app->session->set(Cashdrawer::SESSION_KEY, $cashDrawer->id_cashdrawer);
            } else {
                $cashDrawer = new Cashdrawer([
                    'id_branch' => Yii::$app->clientIdBranch,
                    'cashier_no' => Yii::$app->clientCashierNo,
                ]);
            }
        }

        $payment_methods = [
            1 => 'Cash',
            2 => 'Bank',
        ];

        return $this->render('create', [
                'payment_methods' => $payment_methods,
                'cashDrawer' => $cashDrawer]);
    }

    public static function invalidatePos()
    {
        AppCache::invalidate('sales/pos/create');
    }

    public function actionOpenNewDrawer()
    {
        $app = Yii::$app;
        $model = new Cashdrawer();
        $transaction = $app->db->beginTransaction();
        try {
            if ($model->load($app->request->post()) && $model->save()) {
                $app->session->set(Cashdrawer::SESSION_KEY, $model->id_cashdrawer);
                $app->clientIdBranch = $model->id_branch;
                $app->clientCashierNo = $model->cashier_no;
                $result = [
                    'type' => 'S',
                    'drawer' => [
                        'cashier_no' => $model->cashier_no,
                        'id_branch' => $model->id_branch,
                        'nm_branch' => $model->idBranch->nm_branch,
                        'username' => $app->user->identity->username,
                        'open_time' => $model->open_time
                    ]
                ];

                $transaction->commit();
            } else {
                $result = [
                    'type' => 'E',
                    'msg' => implode("\n", $model->firstErrors)
                ];
                $transaction->rollBack();
            }
        } catch (\Exception $exc) {
            $result = [
                'type' => 'E',
                'msg' => $exc->getMessage(),
            ];
            $transaction->rollBack();
        }
        $app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionSelectDrawer($id)
    {
        $app = Yii::$app;
        $model = Cashdrawer::findOne($id);
        if ($model) {
            $app->session->set(Cashdrawer::SESSION_KEY, $model->id_cashdrawer);
            $app->clientIdBranch = $model->id_branch;
            $app->clientCashierNo = $model->cashier_no;
            $result = [
                'type' => 'S',
                'drawer' => [
                    'cashier_no' => $model->cashier_no,
                    'id_branch' => $model->id_branch,
                    'nm_branch' => $model->idBranch->nm_branch,
                    'username' => $app->user->identity->username,
                    'open_time' => $model->open_time
                ]
            ];
            AppCache::invalidate('sales/pos/create');
        } else {
            $result = [
                'type' => 'E',
                'msg' => 'not found'
            ];
        }
        $app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionSavePos()
    {
        $post = Yii::$app->request->post();
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $hdr = new SalesHdr;
            $hdr->id_warehouse = '';
            if ($hdr->load($post) && $hdr->save()) {
                $formName = (new SalesDtl)->formName();
                foreach ($post[$formName] as $detail) {
                    $dtl = new SalesDtl;
                    $dtl->load($detail, '');
                }
            }
            $transaction->commit();
        } catch (\Exception $exc) {
            $transaction->rollback();
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'type' => 'S'
        ];
    }

    public function actionJs()
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

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'application/javascript');
        return $this->renderPartial('process.js.php', [
                'product' => $result,
                'barcodes' => $barcodes
        ]);
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