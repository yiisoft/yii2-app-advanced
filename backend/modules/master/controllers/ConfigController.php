<?php

namespace backend\modules\master\controllers;

use Yii;
use backend\modules\master\models\GlobalConfig;
use backend\modules\master\models\GlobalConfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * ConfigController implements the CRUD actions for GlobalConfig model.
 */
class ConfigController extends Controller
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
     * Lists all GlobalConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GlobalConfigSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single GlobalConfig model.
     * @param string $config_group
     * @param string $config_name
     * @return mixed
     */
    public function actionView($config_group, $config_name)
    {
        return $this->render('view', [
            'model' => $this->findModel($config_group, $config_name),
        ]);
    }

    /**
     * Creates a new GlobalConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GlobalConfig;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'config_group' => $model->config_group, 'config_name' => $model->config_name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GlobalConfig model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $config_group
     * @param string $config_name
     * @return mixed
     */
    public function actionUpdate($config_group, $config_name)
    {
        $model = $this->findModel($config_group, $config_name);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'config_group' => $model->config_group, 'config_name' => $model->config_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GlobalConfig model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $config_group
     * @param string $config_name
     * @return mixed
     */
    public function actionDelete($config_group, $config_name)
    {
        $this->findModel($config_group, $config_name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GlobalConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $config_group
     * @param string $config_name
     * @return GlobalConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($config_group, $config_name)
    {
        if (($model = GlobalConfig::find(['config_group' => $config_group, 'config_name' => $config_name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
