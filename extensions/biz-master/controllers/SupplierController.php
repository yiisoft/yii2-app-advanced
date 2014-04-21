<?php

namespace biz\master\controllers;

use Yii;
use biz\master\models\Supplier;
use biz\master\models\SupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
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
	 * Lists all Supplier models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SupplierSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
					'dataProvider' => $dataProvider,
					'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Supplier model.
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
	 * Creates a new Supplier model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Supplier;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_supplier]);
		} else {
			return $this->render('create', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Supplier model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_supplier]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Supplier model.
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
	 * Finds the Supplier model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Supplier the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Supplier::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionList($term = null, $id = null)
	{
		if ($term !== null) {
			$query = Supplier::find();
			if (!empty($term)) {
				$query->orWhere(['like', 'nm_supplier', $term]);
				$query->orWhere(['like', 'cd_supplier', $term]);
			}

			$query->limit(20);
			$result = [];
			foreach ($query->asArray()->all() as $row) {
				$result[] = [
					'id' => $row['id_supplier'],
					'value' => $row['id_supplier'],
					'text' => "{$row['cd_supplier']} - {$row['nm_supplier']}",
					'label' => "{$row['cd_supplier']} - {$row['nm_supplier']}",
					'extra' => $row,
				];
			}
		} elseif ($id) {
			$supp = Supplier::find($id);
			$result = ['id' => $id, 'text' => $supp ? "{$supp['cd_supplier']} - {$supp['nm_supplier']}" : 'No supplier found'];
		} else {
			$result = ['id' => $id, 'text' => 'No supplier found'];
		}
		return \yii\helpers\Json::encode($result);
	}

}
