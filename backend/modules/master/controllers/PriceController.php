<?php

namespace backend\modules\master\controllers;

use Yii;
use backend\modules\master\models\Price;
use backend\modules\master\models\PriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
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
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Price model.
     * @param integer $id_product
     * @param integer $id_price_category
     * @return mixed
     */
    public function actionView($id_product, $id_price_category)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_product, $id_price_category),
        ]);
    }

    /**
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Price;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'id_price_category' => $model->id_price_category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Price model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_product
     * @param integer $id_price_category
     * @return mixed
     */
    public function actionUpdate($id_product, $id_price_category)
    {
        $model = $this->findModel($id_product, $id_price_category);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'id_price_category' => $model->id_price_category]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Price model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_product
     * @param integer $id_price_category
     * @return mixed
     */
    public function actionDelete($id_product, $id_price_category)
    {
        $this->findModel($id_product, $id_price_category)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_product
     * @param integer $id_price_category
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_product, $id_price_category)
    {
        if (($model = Price::find(['id_product' => $id_product, 'id_price_category' => $id_price_category])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
