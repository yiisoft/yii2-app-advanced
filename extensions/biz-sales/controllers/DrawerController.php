<?php

namespace biz\sales\controllers;

use Yii;
use biz\sales\models\Cashdrawer;
use biz\sales\models\CashdrawerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * DrawerController implements the CRUD actions for Cashdrawer model.
 */
class DrawerController extends Controller
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
	 * Lists all Cashdrawer models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new CashdrawerSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
				'dataProvider' => $dataProvider,
				'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Cashdrawer model.
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
	 * Creates a new Cashdrawer model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Cashdrawer;
		$model->client_machine = Yii::$app->clientUniqueid;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_cashdrawer]);
		} else {
			return $this->render('create', [
					'model' => $model,
			]);
		}
	}

	public function actionOpen()
	{
		$model = Cashdrawer::find([
				'client_machine' => Yii::$app->clientUniqueid,
				'id_user' => Yii::$app->user->getId(),
				'status' => Cashdrawer::STATUS_OPEN,
		]);
		if ($model === null) {
			$model = new Cashdrawer([
				'client_machine' => Yii::$app->clientUniqueid,
				'id_user' => Yii::$app->user->getId(),
				'status' => Cashdrawer::STATUS_OPEN,
			]);
		}
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_cashdrawer]);
		} else {
			return $this->render('create', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Cashdrawer model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_cashdrawer]);
		} else {
			return $this->render('update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Cashdrawer model.
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
	 * Finds the Cashdrawer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Cashdrawer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Cashdrawer::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
