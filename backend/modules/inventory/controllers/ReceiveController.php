<?php

namespace backend\modules\inventory\controllers;

use Yii;
use backend\modules\inventory\models\TransferHdr;
use backend\modules\inventory\models\TransferHdrSearch;
use backend\modules\inventory\models\TransferDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use backend\modules\inventory\models\ProductStock;
use \Exception;

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
		$params['TransferHdr']['id_branch'] = \Yii::$app->user->identity->id_branch;
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
		return $this->render('view', [
					'model' => $this->findModel($id),
		]);
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
			throw new \yii\base\UserException('tidak bisa diedit');
		}

		list($details, $success) = $this->saveReceive($model);
		if ($success) {
			return $this->redirect(['view', 'id' => $model->id_transfer]);
		}
		return $this->render('update', ['model' => $model,'details' => $details,]);
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
			$success = true;
			$transaction = Yii::$app->db->beginTransaction();
			$formName = (new TransferDtl)->formName();

			$qty_receive = [];
			foreach ($post[$formName] as $dataDetail) {
				$id_dtl = $dataDetail['id_transfer_dtl'];
				$qty_receive[$id_dtl] = $dataDetail['transfer_qty_receive'];
			}

			$selisih = false;
			foreach ($details as $detail) {
				$detail->transfer_qty_receive = $qty_receive[$detail->id_transfer_dtl];
				if ($detail->transfer_qty_receive != $detail->transfer_qty_send) {
					$selisih = true;
				}
				try {
					$success = $success && $detail->save();
				} catch (Exception $exc) {
					$detail->addError('', $exc->getMessage());
					$success = false;
				}
			}

			$model->status = $selisih ? TransferHdr::STATUS_CONFIRM : TransferHdr::STATUS_RECEIVE;
			try {
				$success = $success && $model->save();
				if ($success && $model->status == TransferHdr::STATUS_RECEIVE) {
					$success = $this->updateStock($model);
				}
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			if ($success) {
				$transaction->commit();
			} else {
				$transaction->rollBack();
			}
		}
		return [$details, $success];
	}

	public function actionReceiveConfirm($id)
	{
		$model = $this->findModel($id);
		$allowStatus = [TransferHdr::STATUS_CONFIRM_APPROVE];
		if (!in_array($model->status, $allowStatus)) {
			throw new \yii\base\UserException('tidak bisa diedit');
		}
		try {
			$transaction = \Yii::$app->db->beginTransaction();
			$model->status = TransferHdr::STATUS_RECEIVE;
			if ($model->save()) {
				$this->updateStock($model);
				$transaction->commit();
			} else {
				$transaction->rollBack();
			}
		} catch (Exception $exc) {
			$transaction->rollBack();
			throw $exc;
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
			ProductStock::UpdateStock([
				'id_warehouse' => $id_warehouse,
				'id_product' => $detail->id_product,
				'id_uom' => $detail->id_uom,
				'qty' => $detail->transfer_qty_receive,
					], [
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
		if ($id !== null && ($model = TransferHdr::find($id)) !== null) {
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
