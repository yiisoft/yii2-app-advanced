<?php

namespace biz\master\controllers;

use Yii;
use biz\models\UserToBranch;
use biz\models\searchs\UserToBranch as UserToBranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserToBranchController implements the CRUD actions for UserToBranch model.
 */
class UserToBranchController extends Controller
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
     * Lists all UserToBranch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserToBranchSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single UserToBranch model.
     * @param integer $id_branch
     * @param integer $id_user
     * @return mixed
     */
    public function actionView($id_branch, $id_user)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_branch, $id_user),
        ]);
    }

    /**
     * Creates a new UserToBranch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserToBranch;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_branch' => $model->id_branch, 'id_user' => $model->id_user]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserToBranch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_branch
     * @param integer $id_user
     * @return mixed
     */
    public function actionUpdate($id_branch, $id_user)
    {
        $model = $this->findModel($id_branch, $id_user);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_branch' => $model->id_branch, 'id_user' => $model->id_user]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserToBranch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_branch
     * @param integer $id_user
     * @return mixed
     */
    public function actionDelete($id_branch, $id_user)
    {
        $this->findModel($id_branch, $id_user)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserToBranch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_branch
     * @param integer $id_user
     * @return UserToBranch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_branch, $id_user)
    {
        if (($model = UserToBranch::findOne(['id_branch' => $id_branch, 'id_user' => $id_user])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
