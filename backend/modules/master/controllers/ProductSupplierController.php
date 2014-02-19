<?php

namespace backend\modules\master\controllers;

use Yii;
use backend\modules\master\models\ProductSupplier;
use backend\modules\master\models\ProductSupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * ProductSupplierController implements the CRUD actions for ProductSupplier model.
 */
class ProductSupplierController extends Controller
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
	 * Lists all ProductSupplier models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ProductSupplierSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single ProductSupplier model.
	 * @param integer $id_product
	 * @param integer $id_supplier
	 * @return mixed
	 */
	public function actionView($id_product, $id_supplier)
	{
		return $this->render('view', [
			'model' => $this->findModel($id_product, $id_supplier),
		]);
	}

	/**
	 * Creates a new ProductSupplier model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new ProductSupplier;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id_product' => $model->id_product, 'id_supplier' => $model->id_supplier]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing ProductSupplier model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id_product
	 * @param integer $id_supplier
	 * @return mixed
	 */
	public function actionUpdate($id_product, $id_supplier)
	{
		$model = $this->findModel($id_product, $id_supplier);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id_product' => $model->id_product, 'id_supplier' => $model->id_supplier]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing ProductSupplier model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id_product
	 * @param integer $id_supplier
	 * @return mixed
	 */
	public function actionDelete($id_product, $id_supplier)
	{
		$this->findModel($id_product, $id_supplier)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the ProductSupplier model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id_product
	 * @param integer $id_supplier
	 * @return ProductSupplier the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id_product, $id_supplier)
	{
		if (($model = ProductSupplier::find(['id_product' => $id_product, 'id_supplier' => $id_supplier])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
