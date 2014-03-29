<?php

namespace backend\modules\sales\controllers;

use Yii;
use backend\modules\sales\models\SalesHdr;
use backend\modules\sales\models\SalesHdrSearch;
use backend\modules\sales\models\SalesDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use backend\components\AppCache;
use backend\modules\sales\models\LogCashier;

/**
 * PosController implements the CRUD actions for SalesHdr model.
 */
class PosController extends Controller
{

	const MANIFEST_NAME = 'pos.appcache';

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

		return $this->render('index', [
					'dataProvider' => $dataProvider,
					'searchModel' => $searchModel,
		]);
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
		$this->manifest = self::MANIFEST_NAME;
		$extra = [];
//		$this->getView()->attachBehavior('appcache', [
//			'class' => AppCache::className(),
//			'manifest_file' => self::MANIFEST_NAME,
//		]);
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
		$sql = "select p.id_product as id, p.cd_product as cd, p.nm_product as nm,
			u.id_uom, u.nm_uom, pu.isi,pc.price
			from product p
			join product_uom pu on(pu.id_product=p.id_product)
			join uom u on(u.id_uom=pu.id_uom)
			left join price pc on(pc.id_product=p.id_product)
			order by p.id_product,pu.isi";
		$result = [];
		foreach (\Yii::$app->db->createCommand($sql)->queryAll() as $row) {
			$id = $row['id'];
			if (!isset($result[$id])) {
				$result[$id] = [
					'id' => $row['id'],
					'cd' => $row['cd'],
					'text' => $row['nm'],
					'price' => 1000,
					'id_uom' => $row['id_uom'],
					'nm_uom' => $row['nm_uom'],
				];
			}
			$result[$id]['uoms'][$row['id_uom']] = [
				'id' => $row['id_uom'],
				'nm' => $row['nm_uom'],
				'isi' => $row['isi']
			];
		}
		return $this->renderPartial('process.js.php', ['product' => $result]);
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
		if ($id !== null && ($model = SalesHdr::find($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionUpdateManifest()
	{
		return AppCache::forceUpdateManifest(self::MANIFEST_NAME);
	}

}
