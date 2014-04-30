<?php

namespace biz\inventory\controllers;

use Yii;
use biz\models\TransferHdr;
use biz\models\searchs\TransferHdr as TransferHdrSearch;
use biz\models\TransferDtl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \Exception;
use yii\base\UserException;
use biz\tools\Hooks;

/**
 * TransferController implements the CRUD actions for TransferHdr model.
 */
class TransferController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'issue' => ['post'],
                    'confirm' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TransferHdr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferHdrSearch;
        $params = Yii::$app->request->getQueryParams();
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TransferHdr model.
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
     * Creates a new TransferHdr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferHdr;
        $model->status = TransferHdr::STATUS_DRAFT;

        list($details, $success) = $this->saveTransfer($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_transfer]);
        }
        return $this->render('create', [
                'model' => $model,
                'details' => $details,
        ]);
    }

    /**
     * Updates an existing PurchaseHdr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->status != TransferHdr::STATUS_DRAFT) {
            throw new UserException('tidak bisa diedit');
        }
        Yii::$app->hooks->fire(Hooks::E_ITUPD,$model);
        list($details, $success) = $this->saveTransfer($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_transfer]);
        }
        return $this->render('update', [
                'model' => $model,
                'details' => $details,
        ]);
    }

    /**
     * 
     * @param TransferHdr $model
     * @return array
     */
    protected function saveTransfer($model)
    {
        $post = Yii::$app->request->post();
        $details = $model->transferDtls;
        $success = false;

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $formName = (new TransferDtl)->formName();
                $postDetails = empty($post[$formName]) ? [] : $post[$formName];
                if ($postDetails === []) {
                    throw new Exception('Detail tidak boleh kosong');
                }
                $objs = [];
                foreach ($details as $detail) {
                    $objs[$detail->id_product] = $detail;
                }
                if ($model->save()) {
                    $success = true;
                    $id_hdr = $model->id_transfer;
                    $details = [];
                    foreach ($postDetails as $dataDetail) {
                        $id_dtl = $dataDetail['id_product'];
                        if (isset($objs[$id_dtl])) {
                            $detail = $objs[$id_dtl];
                            unset($objs[$id_dtl]);
                        } else {
                            $detail = new TransferDtl;
                        }

                        $detail->setAttributes($dataDetail);
                        $detail->id_transfer = $id_hdr;
                        if (!$detail->save()) {
                            $success = false;
                            break;
                        }
                        $details[] = $detail;
                    }
                    if ($success && count($objs)) {
                        $success = TransferDtl::deleteAll(['id_transfer' => $id_hdr, 'id_product' => array_keys($objs)]);
                    }
                }
                if ($success) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $exc) {
                $model->addError('', $exc->getMessage());
                $transaction->rollBack();
                $success = false;
            }
            if (!$success) {
                $details = [];
                foreach ($postDetails as $value) {
                    $detail = new TransferDtl();
                    $detail->setAttributes($value);
                    $details[] = $detail;
                }
            }
        }
        return [$details, $success];
    }

    /**
     * Deletes an existing TransferHdr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionIssue($id)
    {
        $model = $this->findModel($id);

        if ($model->status === TransferHdr::STATUS_DRAFT) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->status = TransferHdr::STATUS_ISSUE;
                if (!$model->save()) {
                    throw new UserException(implode(",\n", $model->firstErrors));
                }
                Yii::$app->hooks->fire(Hooks::EVENT_TRANSFER_ISSUE_BEGIN, $model);
                foreach ($model->transferDtls as $detail) {
                    Yii::$app->hooks->fire(Hooks::EVENT_TRANSFER_ISSUE_BODY, $model, $detail);
                }
                Yii::$app->hooks->fire(Hooks::EVENT_TRANSFER_ISSUE_END, $model);
                $transaction->commit();
            } catch (Exception $exc) {
                $transaction->rollBack();
                throw new UserException($exc->getMessage());
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TransferHdr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferHdr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferHdr::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJs()
    {
        $sql = "select p.id_product as id, p.cd_product as cd, p.nm_product as nm,
			u.id_uom, u.nm_uom, pu.isi
			from product p
			join product_uom pu on(pu.id_product=p.id_product)
			join uom u on(u.id_uom=pu.id_uom)
			order by p.id_product,pu.isi";
        $product = [];
        foreach (Yii::$app->db->createCommand($sql)->query() as $row) {
            $id = $row['id'];
            if (!isset($product[$id])) {
                $product[$id] = [
                    'id' => $row['id'],
                    'cd' => $row['cd'],
                    'text' => $row['nm'],
                    'id_uom' => $row['id_uom'],
                    'nm_uom' => $row['nm_uom'],
                ];
            }
            $product[$id]['uoms'][$row['id_uom']] = [
                'id' => $row['id_uom'],
                'nm' => $row['nm_uom'],
                'isi' => $row['isi']
            ];
        }

        $sql = "select id_warehouse,id_product,qty_stock
			from product_stock";
        $ps = [];
        foreach (Yii::$app->db->createCommand($sql)->queryAll() as $row) {
            $ps[$row['id_warehouse']][] = ['id' => $row['id_product'], 'qty' => $row['qty_stock']];
        }

        return $this->renderPartial('process.js.php', [
                'product' => $product,
                'ps' => $ps]);
    }
}