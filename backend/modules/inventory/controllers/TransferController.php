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

	/**
	 * Creates a new PurchaseHdr model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new TransferHdr;
		$model->id_status = TransferHdr::STATUS_DRAFT;
		$model->id_branch = Yii::$app->user->identity->id_branch;

		list($details, $success) = $this->saveTransfer($model);
		if ($success) {
			return $this->redirect(['view', 'id' => $model->id_transfer_hdr]);
		}
		return $this->render('create', [
					'model' => $model,
					'detailProvider' => new ArrayDataProvider(['allModels' => $details]),
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
		if ($model->id_status != PurchaseHdr::STATUS_DRAFT) {
			throw new \yii\base\UserException('tidak bisa diedit');
		}
		list($details, $success) = $this->savePurchase($model);
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
	protected function saveTransfer($model)
	{
		$post = Yii::$app->request->post();
		$details = $model->transferDtls;
		$success = false;
		if ($model->load($post)) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				if (!$model->isNewRecord) {
					TransferDtl::deleteAll('id_purchase_hdr=:id', [':id' => $model->id_purchase_hdr]);
				}
				$success = $model->save();
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			$formName = (new TransferDtl)->formName();

			$id_hdr = $success ? $model->id_transfer_hdr : false;
			foreach ($post[$formName] as $dataDetail) {
				$detail = new TransferDtl;
				$detail->attributes = $dataDetail;
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
				$transaction->commit();
				//Yii::info(['method'=>__METHOD__,'info'=>'success'],'application_purchace');
			} else {
				$transaction->rollBack();
			}
		}
		if (count($details) == 0) {
			$details[] = new TransferDtl;
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
	
	
	public function actionProductOfWarehouse($whse=null, $term = '')
	{
		if ($whse === null) {
			return Json::encode([]);
		}
		$query = new Query;
		$query = $query->select(['ps.id_warehouse', 'p.*'])
				->from('product_stock ps')
				->innerJoin('product p', 'p.id_product=ps.id_product')
				->where([
					'ps.id_warehouse' => $whse,
					'ps.status_closing'=> ProductStock::STATUS_OPEN])
				->andWhere('ps.qty_stock > 0');

		if (!empty($term)) {
			$query->andWhere(['or',
				['like', 'p.cd_product', $term],
				['like', 'p.nm_product', $term]]);
		}

		$query->limit(20);
		$result = [];
		foreach ($query->all() as $row) {
			$result[] = [
				'id' => $row['id_product'],
				'value' => $row['id_product'],
				'label' => "{$row['cd_product']} - {$row['nm_product']}",
				'text' => "{$row['cd_product']} - {$row['nm_product']}",
				'extra' => $row,
			];
		}

		return Json::encode($result);
	}

	public function actionUomOfProduct($prod = null)
	{
		if ($prod === null) {
			return '';
		}
		$query = new Query;
		$query = $query->select(['u.*'])
				->distinct()
				->from('product_uom pu')
				->innerJoin('uom u', 'u.id_uom=pu.id_uom')
				->where(['pu.id_product' => $prod]);

		$result = [];
		foreach ($query->all() as $row) {
			$result[$row['id_uom']] = "{$row['cd_uom']} - {$row['nm_uom']}";
		}

		return \yii\helpers\Html::renderSelectOptions([], $result);
	}

}
