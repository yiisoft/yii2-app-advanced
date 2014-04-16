<?php

namespace biz\inventory\controllers;

use Yii;
use biz\inventory\models\ProductStock;
use biz\inventory\models\ProductStockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * ProductStockController implements the CRUD actions for ProductStock model.
 */
class ProductStockController extends Controller
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
     * Lists all ProductStock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductStockSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single ProductStock model.
     * @param integer $id_warehouse
     * @param integer $id_product
     * @return mixed
     */
    public function actionView($id_warehouse, $id_product)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_warehouse, $id_product),
        ]);
    }

    /**
     * Creates a new ProductStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductStock;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_warehouse' => $model->id_warehouse, 'id_product' => $model->id_product]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductStock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_warehouse
     * @param integer $id_product
     * @return mixed
     */
    public function actionUpdate($id_warehouse, $id_product)
    {
        $model = $this->findModel($id_warehouse, $id_product);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_warehouse' => $model->id_warehouse, 'id_product' => $model->id_product]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductStock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_warehouse
     * @param integer $id_product
     * @return mixed
     */
    public function actionDelete($id_warehouse, $id_product)
    {
        $this->findModel($id_warehouse, $id_product)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductStock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_warehouse
     * @param integer $id_product
     * @return ProductStock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_warehouse, $id_product)
    {
        if (($model = ProductStock::find(['id_warehouse' => $id_warehouse, 'id_product' => $id_product])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
