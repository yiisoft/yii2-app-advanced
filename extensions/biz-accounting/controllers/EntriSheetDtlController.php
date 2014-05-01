<?php

namespace biz\accounting\controllers;

use Yii;
use biz\models\EntriSheetDtl;
use biz\models\EntriSheetDtlSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntriSheetDtlController implements the CRUD actions for EntriSheetDtl model.
 */
class EntriSheetDtlController extends Controller
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
     * Lists all EntriSheetDtl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntriSheetDtlSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single EntriSheetDtl model.
     * @param integer $id_esheet
     * @param integer $id_coa
     * @return mixed
     */
    public function actionView($id_esheet, $id_coa)
    {
        return $this->render('view', [
                'model' => $this->findModel($id_esheet, $id_coa),
        ]);
    }

    /**
     * Creates a new EntriSheetDtl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntriSheetDtl;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_esheet' => $model->id_esheet, 'id_coa' => $model->id_coa]);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EntriSheetDtl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_esheet
     * @param integer $id_coa
     * @return mixed
     */
    public function actionUpdate($id_esheet, $id_coa)
    {
        $model = $this->findModel($id_esheet, $id_coa);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_esheet' => $model->id_esheet, 'id_coa' => $model->id_coa]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EntriSheetDtl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_esheet
     * @param integer $id_coa
     * @return mixed
     */
    public function actionDelete($id_esheet, $id_coa)
    {
        $this->findModel($id_esheet, $id_coa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntriSheetDtl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_esheet
     * @param integer $id_coa
     * @return EntriSheetDtl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_esheet, $id_coa)
    {
        if (($model = EntriSheetDtl::findOne(['id_esheet' => $id_esheet, 'id_coa' => $id_coa])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
