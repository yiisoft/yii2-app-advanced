<?php

namespace biz\inventory\controllers;

use Yii;
use biz\inventory\models\TransferHdr;
use biz\inventory\models\TransferHdrSearch;
use biz\inventory\models\TransferDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\UserException;
use \Exception;
use app\tools\Helper;
use app\tools\Hooks;

/**
 * TransferController implements the CRUD actions for TransferHdr model.
 */
class ReceiveController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'receive-confirm' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransferHdr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferHdrSearch;
        $params = Yii::$app->request->getQueryParams();
        $dataProvider = $searchModel->search($params);
        $dataProvider->query->andWhere('status > 1');

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TransferHdr model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Updates an existing PurchaseHdr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $allowStatus = [TransferHdr::STATUS_ISSUE, TransferHdr::STATUS_CONFIRM_REJECT];
        if (!in_array($model->status, $allowStatus)) {
            throw new UserException('tidak bisa diedit');
        }
        list($details, $success) = $this->saveReceive($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_transfer]);
        }
        return $this->render('update', ['model' => $model, 'details' => $details,]);
    }

    /**
     * 
     * @param TransferHdr $model
     * @return array
     */
    protected function saveReceive($model)
    {
        $post = Yii::$app->request->post();
        $details = $model->transferDtls;
        $success = false;

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $formName = (new TransferDtl)->formName();
                $postDetails = empty($post[$formName]) ? [] : $post[$formName];
                if ($postDetails === []) {
                    throw new Exception('Detail tidak boleh kosong');
                }
                $objs = [];
                foreach ($details as $detail) {
                    $objs[$detail->id_product] = $detail;
                }
                Yii::$app->hooks->fire(Hooks::EVENT_RECEIVE_RECEIVE_BEGIN, $model);
                if ($model->save()) {
                    $success = true;
                    $id_hdr = $model->id_transfer;
                    $details = [];
                    foreach ($postDetails as $dataDetail) {
                        $id_dtl = $dataDetail['id_product'];
                        if (isset($objs[$id_dtl])) {
                            $detail = $objs[$id_dtl];
                            unset($objs[$id_dtl]);
                        } else {
                            $detail = new TransferDtl;
                        }

                        $detail->setAttributes($dataDetail);
                        $detail->id_transfer = $id_hdr;
                        if (!$detail->save()) {
                            $success = false;
                            break;
                        }
                        Yii::$app->hooks->fire(Hooks::EVENT_RECEIVE_RECEIVE_BODY, $model, $detail);
                        $details[] = $detail;
                    }
                    if ($success) {
                        $deleted = array_keys($objs);
                        if (count($deleted) > 0) {
                            $success = TransferDtl::deleteAll(['id_transfer' => $id_hdr, 'id_product' => $deleted]);
                        }
                    }
                    Yii::$app->hooks->fire(Hooks::EVENT_RECEIVE_RECEIVE_END, $model);
                }
                if ($success) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $exc) {
                $model->addError('', $exc->getMessage());
                $transaction->rollBack();
                $success = false;
            }
            if (!$success) {
                $details = [];
                foreach ($postDetails as $value) {
                    $detail = new TransferDtl();
                    $detail->setAttributes($value);
                    $details[] = $detail;
                }
            }
        }
        return [$details, $success];
    }

    public function actionReceiveConfirm($id)
    {
        $model = $this->findModel($id);
        $allowStatus = [TransferHdr::STATUS_CONFIRM_APPROVE];
        if (!in_array($model->status, $allowStatus)) {
            throw new UserException('tidak bisa diedit');
        }
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $model->status = TransferHdr::STATUS_RECEIVE;
            if ($model->save()) {
                $this->updateStock($model);
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $exc) {
            $transaction->rollBack();
            throw new UserException($exc->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * 
     * @param TransferHdr $model
     */
    protected function updateStock($model)
    {
        $id_warehouse = $model->id_warehouse_dest;
        foreach ($model->transferDtls as $detail) {
            $smallest_uom = Helper::getSmallestProductUom($detail->id_product);
            $qty_per_uom = Helper::getQtyProductUom($detail->id_product, $detail->id_uom);
            Helper::updateStock([
                'id_warehouse' => $id_warehouse,
                'id_product' => $detail->id_product,
                'id_uom' => $smallest_uom,
                'qty' => $detail->transfer_qty_receive * $qty_per_uom,
                ], [
                'mv_qty' => $detail->transfer_qty_receive * $qty_per_uom,
                'app' => 'receive',
                'id_ref' => $detail->id_transfer_dtl,
            ]);
        }
        return true;
    }

    /**
     * Finds the TransferHdr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferHdr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferHdr::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJs()
    {
        return $this->renderPartial('process.js.php');
    }
}