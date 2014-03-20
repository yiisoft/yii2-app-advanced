<?php

namespace backend\modules\inventory\controllers;

use Yii;
use backend\modules\inventory\models\TransferHdr;
use backend\modules\inventory\models\TransferHdrSearch;
use backend\modules\inventory\models\TransferDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\data\ArrayDataProvider;
use backend\modules\master\models\ProductStock;
use yii\db\Query;
use yii\helpers\Json;

/**
 * ReceiveController implements the CRUD actions for TransferHdr model.
 */
class ReceiveController extends Controller
{

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'receive' => ['post']
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
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		$query = $dataProvider->query;

		$query->andWhere('id_status > 1');

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
	 * Updates an existing TransferHdr model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		if ($model->id_status != TransferHdr::STATUS_ISSUE && 
				$model->id_status != TransferHdr::STATUS_DRAFT_RECEIVE
				&& $model->id_status != TransferHdr::STATUS_CONFIRM_REJECT) {
			throw new \yii\base\UserException('tidak bisa diedit');
		}
		$model->id_status = TransferHdr::STATUS_DRAFT_RECEIVE;
		list($details, $success) = $this->saveReceive($model);
		if ($success) {
			return $this->redirect(['view', 'id' => $model->id_transfer_hdr]);
		}
		return $this->render('update', [
					'model' => $model,
					'detailProvider' => new ArrayDataProvider(['allModels' => $details]),
		]);
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
		$objs = $deleted = [];

		if ($model->load($post)) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				if (!$model->isNewRecord) {
					foreach ($details as $detail) {
						$id = $detail->id_transfer_dtl;
						$objs[$id] = $detail;
						$deleted[$id] = $id;
					}
				}
				$success = $model->save();
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			$formName = (new TransferDtl)->formName();

			$id_hdr = $success ? $model->id_transfer_hdr : false;
			foreach ($post[$formName] as $dataDetail) {
				if (!empty($dataDetail['id_transfer_dtl']) && isset($objs[$dataDetail['id_transfer_dtl']])) {
					$detail = $objs[$dataDetail['id_transfer_dtl']];
					unset($deleted[$detail->id_transfer_dtl]);
				} else {
					$detail = new TransferDtl;
				}
				$detail->load($dataDetail, '');
				if ($id_hdr !== false) {
					$detail->id_transfer_hdr = $model->id_transfer_hdr;
					try {
						$success = $detail->save() && $success;
					} catch (Exception $exc) {
						$detail->addError('', $exc->getMessage());
					}
				}
				$details[] = $detail;
			}
			if ($success) {
				try {
					$deleted = array_values($deleted);
					if (count($deleted) > 0) {
						$success = TransferDtl::deleteAll(['id_transfer_dtl' => $deleted]);
					}
				} catch (Exception $exc) {
					$success = false;
					$model->addError('', $exc->getMessage());
				}
				$transaction->commit();
			} else {
				$transaction->rollBack();
			}
		}
		if (count($details) == 0) {
			$details[] = new TransferDtl;
		}
		return [$details, $success];
	}

	public function actionReceive($id)
	{
		$model = $this->findModel($id);
		switch ($model->id_status) {
			case TransferHdr::STATUS_ISSUE:
			case TransferHdr::STATUS_DRAFT_RECEIVE:
				$confirm = true;
				foreach ($model->transferDtls as $detail) {
					if ($detail->transfer_qty_send != $detail->transfer_qty_receive) {
						$confirm = false;
						$model->id_status = TransferHdr::STATUS_CONFIRM;
						if (!$model->save()) {
							throw new \yii\base\UserException(implode(",\n", $model->firstErrors));
						}
					}
				}
				break;
			case TransferHdr::STATUS_CONFIRM_APPROVE:
				$confirm = true;
				break;
			default:
				$confirm = false;
				break;
		}
		if ($confirm) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->id_status = TransferHdr::STATUS_RECEIVE;
				if (!$model->save()) {
					throw new \yii\base\UserException(implode(",\n", $model->firstErrors));
				}
				$id_warehouse = $model->id_warehouse_dest;
				$id_branch = $model->idWarehouseDest->id_branch;
				$sukses = true;
				foreach ($model->transferDtls as $detail) {
					$sukses = $sukses && ProductStock::UpdateStock([
								'id_warehouse' => $id_warehouse,
								'id_product' => $detail->id_product,
								'id_branch' => $id_branch,
								'qty' => $detail->transfer_qty_receive,
								'id_uom' => $detail->id_uom,
									], false);
				}

				if ($sukses) {
					$transaction->commit();
				}
			} catch (Exception $exc) {
				$transaction->rollBack();
				throw $exc;
			}
		}
		return $this->redirect(['index']);
	}

	/**
	 * Deletes an existing TransferHdr model.
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

}
