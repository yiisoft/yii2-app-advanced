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
class TransferController extends Controller
{

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'issue' => ['post'],
					'confirm' => ['post'],
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
	 * Creates a new TransferHdr model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new TransferHdr;
		$model->status = TransferHdr::STATUS_DRAFT;

		list($details, $success) = $this->saveTransfer($model);
		if ($success) {
			return $this->redirect(['view', 'id' => $model->id_transfer]);
		}
		return $this->render('create', [
					'model' => $model,
					'details' => $details,
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
		if ($model->status != TransferHdr::STATUS_DRAFT) {
			throw new \yii\base\UserException('tidak bisa diedit');
		}
		list($details, $success) = $this->saveTransfer($model);
		if ($success) {
			return $this->redirect(['view', 'id' => $model->id_transfer]);
		}
		return $this->render('update', [
					'model' => $model,
					'details' => $details,
		]);
	}

	/**
	 * 
	 * @param TransferHdr $model
	 * @return array
	 */
	protected function saveTransfer($model)
	{
		$post = Yii::$app->request->post();
		$details = $model->transferDtls;
		$success = false;

		if ($model->load($post)) {
			$transaction = Yii::$app->db->beginTransaction();
			$objs = [];
			foreach ($details as $detail) {
				$objs[$detail->id_transfer_dtl] = [false, $detail];
			}
			try {
				$success = $model->save();
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			$formName = (new TransferDtl)->formName();

			$id_hdr = $success ? $model->id_transfer : false;
			$details = [];
			if (!empty($post[$formName])) {
				foreach ($post[$formName] as $dataDetail) {
					$id_dtl = $dataDetail['id_transfer_dtl'];
					if ($id_dtl != '' && isset($objs[$id_dtl])) {
						$detail = $objs[$id_dtl][1];
						$objs[$id_dtl][0] = true;
					} else {
						$detail = new TransferDtl;
					}

					$detail->setAttributes($dataDetail);
					if ($id_hdr !== false) {
						$detail->id_transfer = $id_hdr;
						try {
							$success = $success && $detail->save();
						} catch (Exception $exc) {
							$detail->addError('', $exc->getMessage());
						}
					}
					$details[] = $detail;
				}
			} else {
				$success = false;
				$model->addError('', 'Detail tidak boleh kosong');
			}
			if ($success) {
				try {
					$deleted = [];
					foreach ($objs as $id_dtl => $value) {
						if ($value[0] == false) {
							$deleted[] = $id_dtl;
						}
					}
					if (count($deleted) > 0) {
						$success = TransferDtl::deleteAll(['id_transfer_dtl' => $deleted]);
					}
				} catch (Exception $exc) {
					$success = false;
					$model->addError('', $exc->getMessage());
				}
			}
			if ($success) {
				$transaction->commit();
			} else {
				$transaction->rollBack();
			}
		}
		return [$details, $success];
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

	public function actionIssue($id)
	{
		$model = $this->findModel($id);

		if ($model->status === TransferHdr::STATUS_DRAFT) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->status = TransferHdr::STATUS_ISSUE;
				if (!$model->save()) {
					throw new \yii\base\UserException(implode(",\n", $model->firstErrors));
				}
				$id_warehouse = $model->id_warehouse_source;
				$id_branch = $model->idWarehouseSource->id_branch;
				$sukses = true;
				foreach ($model->transferDtls as $detail) {
					if (!$sukses) {
						break;
					}
					ProductStock::UpdateStock([
						'id_warehouse' => $id_warehouse,
						'id_product' => $detail->id_product,
						'id_uom' => $detail->id_uom,
						'qty' => -$detail->transfer_qty_send,
							], [
						'app' => 'transfer',
						'id_ref' => $detail->id_transfer_dtl,
					]);
				}

				if ($sukses) {
					$transaction->commit();
				} else {
					$transaction->rollBack();
				}
			} catch (Exception $exc) {
				$transaction->rollBack();
				throw $exc;
			}
		}
		return $this->redirect(['index']);
	}

	public function actionConfirm($id, $confirm)
	{
		$model = $this->findModel($id);
		$model->status = $confirm;
		try {
			$transaction = Yii::$app->db->beginTransaction();
			$success = $model->save();
			if ($confirm === TransferHdr::STATUS_CONFIRM_APPROVE) {
				$id_warehouse = $model->id_warehouse_source;
				foreach ($model->transferDtls as $detail) {
					if (!$sukses) {
						break;
					}
					$qty = $detail->transfer_qty_send - $detail->transfer_qty_receive;
					if ($qty != 0) {
						ProductStock::UpdateStock([
							'id_warehouse' => $id_warehouse,
							'id_product' => $detail->id_product,
							'id_uom' => $detail->id_uom,
							'qty' => $qty,
								], [
							'app' => 'confirm-transfer',
							'id_ref' => $detail->id_transfer_dtl,
						]);
					}
				}
			}
			if ($success) {
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
		$sql = "select p.id_product as id, p.cd_product as cd, p.nm_product as nm,
			u.id_uom, u.nm_uom, pu.isi
			from product p
			join product_uom pu on(pu.id_product=p.id_product)
			join uom u on(u.id_uom=pu.id_uom)
			order by p.id_product,pu.isi";
		$product = [];
		foreach (\Yii::$app->db->createCommand($sql)->query() as $row) {
			$id = $row['id'];
			if (!isset($product[$id])) {
				$product[$id] = [
					'id' => $row['id'],
					'cd' => $row['cd'],
					'text' => $row['nm'],
					'id_uom' => $row['id_uom'],
					'nm_uom' => $row['nm_uom'],
				];
			}
			$product[$id]['uoms'][$row['id_uom']] = [
				'id' => $row['id_uom'],
				'nm' => $row['nm_uom'],
				'isi' => $row['isi']
			];
		}

		$sql = "select id_warehouse,id_product,qty_stock
			from product_stock";
		$ps = [];
		foreach (\Yii::$app->db->createCommand($sql)->queryAll() as $row) {
			$ps[$row['id_warehouse']][] = ['id' => $row['id_product'], 'qty' => $row['qty_stock']];
		}

		return $this->renderPartial('process.js.php', [
					'product' => $product,
					'ps' => $ps]);
	}

}
