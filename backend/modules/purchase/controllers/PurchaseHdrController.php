<?php

namespace backend\modules\purchase\controllers;

use Yii;
use backend\modules\purchase\models\PurchaseHdr;
use backend\modules\purchase\models\PurchaseHdrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use backend\modules\purchase\models\PurchaseDtl;
use yii\data\ArrayDataProvider;
use \Exception;
use yii\helpers\Json;
use yii\db\Query;
use backend\modules\master\models\ProductStock;
use yii\db\Expression;
use backend\modules\accounting\models\AccPeriode;

/**
 * PurchaseHdrController implements the CRUD actions for PurchaseHdr model.
 */
class PurchaseHdrController extends Controller
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
	 * Lists all PurchaseHdr models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new PurchaseHdrSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
					'dataProvider' => $dataProvider,
					'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single PurchaseHdr model.
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
	 * Creates a new PurchaseHdr model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{

		$model = new PurchaseHdr;
		$details = [];

		$post = Yii::$app->request->post();
		if ($model->load($post)) {
			$transaction = Yii::$app->db->beginTransaction();
			$success = false;

			try {
				$model->id_status = PurchaseHdr::STATUS_DRAFT;
				$model->id_branch = Yii::$app->user->identity->id_branch;
				$success = $model->save();
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			$formName = (new PurchaseDtl)->formName();

			$id_hdr = $success ? $model->id_purchase_hdr : false;
			foreach ($post[$formName] as $dataDetail) {
				$detail = new PurchaseDtl;
				$detail->attributes = $dataDetail;
				if ($id_hdr !== false) {
					$detail->id_purchase_hdr = $model->id_purchase_hdr;
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
				return $this->redirect(['update', 'id' => $model->id_purchase_hdr]);
			} else {
				$transaction->rollBack();
			}
		}
		if (count($details) == 0) {
			$details[] = new PurchaseDtl;
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
		$details = $model->purchaseDtls;

		$post = Yii::$app->request->post();
		if ($model->load($post)) {
			$transaction = Yii::$app->db->beginTransaction();
			$success = false;

			try {
				$model->id_status = PurchaseHdr::STATUS_DRAFT;
				$success = $model->save();
				$success = $success && PurchaseDtl::deleteAll('id_purchase_hdr=:id', [':id' => $model->id_purchase_hdr]);
				$details = [];
			} catch (Exception $exc) {
				$model->addError('', $exc->getMessage());
				$success = false;
			}

			$formName = (new PurchaseDtl)->formName();

			$id_hdr = $success ? $model->id_purchase_hdr : false;
			foreach ($post[$formName] as $dataDetail) {
				$detail = new PurchaseDtl;
				$detail->attributes = $dataDetail;
				if ($id_hdr !== false) {
					$detail->id_purchase_hdr = $model->id_purchase_hdr;
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
			} else {
				$transaction->rollBack();
			}
		}
		if (count($details) == 0) {
			$details[] = new PurchaseDtl;
		}
		return $this->render('update', [
					'model' => $model,
					'detailProvider' => new ArrayDataProvider(['allModels' => $details]),
		]);
	}

	/**
	 * Deletes an existing PurchaseHdr model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	public function actionRelease($id)
	{
		$model = $this->findModel($id);
		if ($model->id_status === PurchaseHdr::STATUS_DRAFT) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->id_status = PurchaseHdr::STATUS_RELEASE;
				if(!$model->save()){
					throw new \yii\base\UserException(implode(",\n", $model->firstErrors));
				}
				$id_warehouse = $model->id_warehouse;
				$id_branch = $model->idWarehouse->id_branch;
				$sukses = true;
				foreach ($model->purchaseDtls as $detail) {
					$sukses = $sukses && ProductStock::UpdateStock([
								'id_warehouse' => $id_warehouse,
								'id_product' => $detail->id_product,
								'id_branch' => $id_branch,
								'purch_qty' => $detail->purch_qty,
								'purch_price' => $detail->purch_price,
								'id_uom' => $detail->id_uom,
					]);
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
	 * Finds the PurchaseHdr model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PurchaseHdr the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if ($id !== null && ($model = PurchaseHdr::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionListOfSupplier($term = null, $id = null)
	{
		$query = new Query;
		$query->from('supplier');
		if ($id === null) {
			if (!empty($term)) {
				$query->orWhere(['like', 'nm_supplier', $term]);
				$query->orWhere(['like', 'cd_supplier', $term]);
			}

			$query->limit(20);
			$result = [];
			foreach ($query->all() as $row) {
				$result[] = [
					'id' => $row['id_supplier'],
					'value' => $row['id_supplier'],
					'text' => "{$row['cd_supplier']} - {$row['nm_supplier']}",
					'label' => "{$row['cd_supplier']} - {$row['nm_supplier']}",
					'extra' => $row,
				];
			}
		} else {
			$supp = $query->where(['id_supplier' => $id])->one();
			if ($supp) {
				$result = ['id' => $id, 'text' => $supp ? "{$supp['cd_supplier']} - {$supp['nm_supplier']}" : 'No supplier found'];
			} else {
				$result = ['id' => $id, 'text' => 'No supplier found'];
			}
		}
		return Json::encode($result);
	}

	public function actionListOfWarehouse($term = null, $id = null)
	{
		$query = new Query;
		$query->from('warehouse');
		if ($id === null) {
			if (!empty($term)) {
				$query->orWhere(['like', 'nm_whse', $term]);
				$query->orWhere(['like', 'cd_whse', $term]);
			}

			$query->limit(20);
			$result = [];
			foreach ($query->all() as $row) {
				$result[] = [
					'id' => $row['id_warehouse'],
					'value' => $row['id_warehouse'],
					'text' => "{$row['cd_whse']} - {$row['nm_whse']}",
					'label' => "{$row['cd_whse']} - {$row['nm_whse']}",
					'extra' => $row,
				];
			}
		} else {
			$whse = $query->where(['id_warehouse' => $id])->one();
			if ($whse) {
				$result = ['id' => $id, 'text' => $whse ? "{$whse['cd_whse']} - {$whse['nm_whse']}" : 'No warehouse found'];
			} else {
				$result = ['id' => $id, 'text' => 'No warehouse found'];
			}
		}
		return Json::encode($result);
	}

	public function actionProductOfSupplier($supp, $term = '')
	{
		if ($supp === null) {
			return Json::encode([]);
		}
		$query = new Query;
		$query = $query->select(['ps.id_supplier', 'p.*'])
				->from('product_supplier ps')
				->innerJoin('product p', 'p.id_product=ps.id_product')
				->where(['ps.id_supplier' => $supp]);

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
