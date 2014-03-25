<?php

namespace backend\modules\sales\controllers;

use Yii;
use backend\modules\sales\models\CashDrawer;
use backend\modules\sales\models\CashDrawerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\web\AccessControl;

/**
 * DrawerController implements the CRUD actions for CashDrawer model.
 */
class DrawerController extends Controller
{

	const COOKIE_NAME = 'open_cash_drawer';

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['open', 'close', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			]
		];
	}

	/**
	 * Lists all CashDrawer models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new CashDrawerSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
					'dataProvider' => $dataProvider,
					'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single CashDrawer model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
					'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new CashDrawer model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionOpen()
	{
		$user = Yii::$app->user;
		$id = Yii::$app->getRequest()->getCookies()->getValue(self::COOKIE_NAME);
		if ($id !== null) {
			$model = CashDrawer::find([
						'id_cash_drawer' => $id,
						'create_by' => $user->getId(),
						'id_status' => CashDrawer::STATUS_OPEN,
			]);
		}
		$model = isset($model) ? $model : new CashDrawer;
		$model->id_status = CashDrawer::STATUS_OPEN;
		$model->name_cashier = $user->identity->username;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$cookie = new \yii\web\Cookie([
				'name' => self::COOKIE_NAME,
				'value' => $model->id_cash_drawer,
			]);
			Yii::$app->getResponse()->getCookies()->add($cookie);
			return $this->render('open', [
						'model' => $model,
						'drawer' => [
							'id' => $model->id_cash_drawer,
							'no_kasir' => $model->no_cashier,
							'nama_kasir' => $model->name_cashier,
							'open_time' => $model->create_date,
						],
			]);
		} else {
			return $this->render('open', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing CashDrawer model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionClose()
	{
		$user = Yii::$app->user;
		$id = Yii::$app->getRequest()->getCookies()->getValue(self::COOKIE_NAME);
		$model = CashDrawer::find([
						'id_cash_drawer' => $id,
						'create_by' => $user->getId(),
						'id_status' => CashDrawer::STATUS_OPEN,
			]);
		
		if($model === null){
			throw new NotFoundHttpException('Open drawer not found');
		}
		$model->id_status = CashDrawer::STATUS_CLOSE;
		$model->name_cashier = $user->identity->username;
		$closed = false;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getResponse()->getCookies()->remove(self::COOKIE_NAME);
			$closed = true;
		}
		return $this->render('close', [
					'model' => $model,
			'closed'=>$closed
		]);
	}

	/**
	 * Deletes an existing CashDrawer model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the CashDrawer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return CashDrawer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if ($id !== null && ($model = CashDrawer::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
