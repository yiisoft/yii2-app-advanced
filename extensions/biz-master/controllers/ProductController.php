<?php

namespace biz\master\controllers;

use Yii;
use biz\master\models\Product;
use biz\master\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use biz\master\models\ProductUom;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    public function behaviors() {
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product;
        $dPost = Yii::$app->request->post();
        if ($model->load($dPost) && $model->save()) {
//            $pUom = new ProductUom;
//            $pUom->id_product = $model->id_product;
//            $pUom->id_uom = $dPost['productUoms']['id_uom'];
//            $pUom->isi = $dPost['productUoms']['isi'];
//            $pUom->save();
            return $this->redirect(['view', 'id' => $model->id_product]);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $dPost = Yii::$app->request->post();
        if ($model->load($dPost) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_product]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        try {
            $model->delete();
            return $this->redirect(['index']);
        } catch (\Exception $ex) {
            throw new \yii\base\UserException($model->nm_product . ' telah terpakai..');
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if ($id !== null && ($model = Product::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAutoProduct() {
//        $sqlItem = 'SELECT id_product as did, cd_product || \'; \' || nm_product as label FROM product '
//        . 'WHERE cd_product LIKE :dCode OR nm_product LIKE :dCode';
        $sqlItem = 'SELECT id_product as did, nm_product as label FROM product '
            . 'WHERE cd_product LIKE :dCode OR nm_product LIKE :dCode';
        $conn = \Yii::$app->db;
        $dCmd = $conn->createCommand($sqlItem); //$dQry->createCommand();
        $dGet = filter_input_array(INPUT_GET);
        $dCmd->bindValue(':dCode', '%' . $dGet['term'] . '%');
        $data = $dCmd->queryAll();
        return json_encode($data);
    }

}
