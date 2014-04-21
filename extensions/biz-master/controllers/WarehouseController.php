<?php

namespace biz\master\controllers;

use Yii;
use biz\master\models\Warehouse;
use biz\master\models\WarehouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
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
	 * Lists all Warehouse models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new WarehouseSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Warehouse model.
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
	 * Creates a new Warehouse model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Warehouse;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_warehouse]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Warehouse model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_warehouse]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Warehouse model.
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
	 * Finds the Warehouse model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Warehouse the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Warehouse::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	public function actionList($term=null,$id=null)
	{
		if ($term !== null) {
			$query = Warehouse::find();
			if (!empty($term)) {
				$query->orWhere(['like', 'cd_whse', $term]);
				$query->orWhere(['like', 'nm_whse', $term]);
			}

			$query->limit(20);
			$result = [];
			foreach ($query->asArray()->all() as $row) {
				$result[] = [
					'id' => $row['id_warehouse'],
					'value' => $row['id_warehouse'],
					'text' => "{$row['cd_whse']} - {$row['nm_whse']}",
					'label' => "{$row['cd_whse']} - {$row['nm_whse']}",
					'extra' => $row,
				];
			}
		} elseif ($id) {
			$supp = Warehouse::find($id);
			$result = ['id' => $id, 'text' => $supp ? "{$supp['cd_whse']} - {$supp['nm_whse']}" : 'No warehouse found'];
		} else {
			$result = ['id' => $id, 'text' => 'No warehouse found'];
		}
		return \yii\helpers\Json::encode($result);
	}
}
