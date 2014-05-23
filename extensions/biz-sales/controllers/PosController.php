<?php

namespace biz\sales\controllers;

use Yii;
use biz\models\SalesHdr;
use biz\models\SalesHdrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\tools\AppCache;

/**
 * PosController implements the CRUD actions for SalesHdr model.
 */
class PosController extends Controller
{

	const MANIFEST_ID = 'sales-pos';

	public $manifest;

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'save-pos' => ['post']
				],
			],
		];
	}

	/**
	 * Lists all SalesHdr models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SalesHdrSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', ['dataProvider' => $dataProvider,'searchModel' => $searchModel]);
	}

	/**
	 * Displays a single SalesHdr model.
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
	 * Creates a new SalesHdr model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
//		\Yii::$app->cacheApp();
		$payment_methods = [
			1 => 'Cash',
			2 => 'Bank',
		];
		return $this->render('create', ['payment_methods' => $payment_methods]);
	}

	public function actionSavePos()
	{
		$post = \Yii::$app->request->post();
		try {
			$transaction = \Yii::$app->db->beginTransaction();
			$hdr = new SalesHdr;
			$hdr->id_warehouse = '';

			$trancaction->commit();
		} catch (\Exception $exc) {
			$transaction->rollback();
		}
	}

	public function actionJs()
	{
		$db = Yii::$app->db;

        // price squence
        $squence = Helper::getConfigValue('SALES_PRICE', 'GROSIR_CATEGORY', 1);
        $price_standart = Helper::getConfigValue('SALES_PRICE', 'PRICE_STANDART', 1);
        $squences = [$squence];
        $sql_squence = "select squence_price"
            . " from price_category"
            . " where id_price_category=:category";
        $cmd_squence = $db->createCommand($sql_squence);

        while (true) {
            $squence = $cmd_squence->bindValue(':category', $squence)->queryScalar();
            $squence = empty($squence) ? $price_standart : $squence;
            if (!in_array($squence, $squences)) {
                $squences[] = $squence;
            }
            if ($squence == $price_standart) {
                break;
            }
        }
        $query_price = (new \yii\db\Query)->select(['id_product', 'id_price_category', 'price'])
            ->from('price')
            ->where(['id_price_category' => $squences]);
        $prices = [];
        foreach ($query_price->all() as $row) {
            $prices[$row['id_product']][$row['id_price_category']] = $row['price'];
        }
        
        // master product
        $sql = "select p.id_product as id, p.cd_product as cd, p.nm_product as nm,
			u.id_uom, u.nm_uom, pu.isi
			from product p
			join product_uom pu on(pu.id_product=p.id_product)
			join uom u on(u.id_uom=pu.id_uom)
			order by p.id_product,pu.isi";
        $result = [];
        foreach ($db->createCommand($sql)->queryAll() as $row) {
            $id = $row['id'];
            if (!isset($result[$id])) {
                $result[$id] = [
                    'id' => $row['id'],
                    'cd' => $row['cd'],
                    'text' => $row['nm'],
                    'id_uom' => $row['id_uom'],
                    'nm_uom' => $row['nm_uom'],
                    'price' => 0,
                ];
                foreach ($squences as $ct) {
                    if(isset($prices[$id][$ct])){
                        $result[$id]['price'] = $prices[$id][$ct];
                        break;
                    }
                }
            }
            $result[$id]['uoms'][$row['id_uom']] = [
                'id' => $row['id_uom'],
                'nm' => $row['nm_uom'],
                'isi' => $row['isi']
            ];
        }
        
        // barcodes
        $barcodes = [];
        $sql_barcode = "select lower(barcode) as barcode,id_product as id"
            . " from product_child"
            . " union"
            . " select lower(cd_product), id_product"
            . " from product";
        foreach ($db->createCommand($sql_barcode)->queryAll() as $row) {
            $barcodes[$row['barcode']] = $row['id'];
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'application/javascript');
        return $this->renderPartial('process.js.php', [
                'product' => $result,
                'barcodes' => $barcodes
            ]);
	}

	/**
	 * Updates an existing SalesHdr model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_sales_hdr]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SalesHdr model.
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
	 * Finds the SalesHdr model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SalesHdr the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SalesHdr::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionUpdateManifest()
	{
		return AppCache::forceUpdateManifest(static::MANIFEST_ID);
	}

}
