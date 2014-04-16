<?php

namespace biz\master\controllers;

use Yii;
use biz\master\models\ProductUom;
use biz\master\models\ProductUomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * ProductUomController implements the CRUD actions for ProductUom model.
 */
class ProductUomController extends Controller
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
     * Lists all ProductUom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductUomSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single ProductUom model.
     * @param integer $id_product
     * @param integer $id_uom
     * @return mixed
     */
    public function actionView($id_product, $id_uom)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_product, $id_uom),
        ]);
    }

    /**
     * Creates a new ProductUom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductUom;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'id_uom' => $model->id_uom]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductUom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_product
     * @param integer $id_uom
     * @return mixed
     */
    public function actionUpdate($id_product, $id_uom)
    {
        $model = $this->findModel($id_product, $id_uom);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'id_uom' => $model->id_uom]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductUom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_product
     * @param integer $id_uom
     * @return mixed
     */
    public function actionDelete($id_product, $id_uom)
    {
        $this->findModel($id_product, $id_uom)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductUom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_product
     * @param integer $id_uom
     * @return ProductUom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_product, $id_uom)
    {
        if (($model = ProductUom::find(['id_product' => $id_product, 'id_uom' => $id_uom])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
