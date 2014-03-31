<?php

namespace backend\modules\purchase\controllers;

use Yii;
use backend\modules\purchase\models\PurchaseHdr;
use backend\modules\purchase\models\PurchaseHdrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use backend\modules\purchase\models\PurchaseDtl;
use \Exception;
use backend\modules\inventory\models\ProductStock;
use backend\modules\master\models\Cogs;
use backend\modules\master\models\Price;

/**
 * PurchaseHdrController implements the CRUD actions for PurchaseHdr model.
 */
class PurchaseController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'receive' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PurchaseHdr models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PurchaseHdrSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single PurchaseHdr model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurchaseHdr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PurchaseHdr;
        $model->status = PurchaseHdr::STATUS_DRAFT;
        $model->id_branch = Yii::$app->user->identity->id_branch;

        list($details, $success) = $this->savePurchase($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_purchase]);
        }
        return $this->render('create', ['model' => $model, 'details' => $details]);
    }

    /**
     * Updates an existing PurchaseHdr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->status != PurchaseHdr::STATUS_DRAFT) {
            throw new \yii\base\UserException('tidak bisa diedit');
        }
        list($details, $success) = $this->savePurchase($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_purchase]);
        }
        return $this->render('update', ['model' => $model, 'details' => $details
        ]);
    }

    /**
     * 
     * @param PurchaseHdr $model
     * @return array
     */
    protected function savePurchase($model) {
        $post = Yii::$app->request->post();
        $details = $model->purchaseDtls;
        $success = false;

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            $objs = [];
            foreach ($details as $detail) {
                $objs[$detail->id_purchase_dtl] = [false, $detail];
            }
            if (empty($model->id_warehouse) && count($details)) {
                $model->id_warehouse = $details[0]->id_warehouse;
            }
            try {
                $success = $model->save();
            } catch (Exception $exc) {
                $model->addError('', $exc->getMessage());
                $success = false;
            }

            $formName = (new PurchaseDtl)->formName();
            $id_hdr = $success ? $model->id_purchase : false;
            $id_whse = $model->id_warehouse;
            $details = [];
            if (!empty($post[$formName])) {
                foreach ($post[$formName] as $dataDetail) {
                    $id_dtl = $dataDetail['id_purchase_dtl'];
                    if ($id_dtl != '' && isset($objs[$id_dtl])) {
                        $detail = $objs[$id_dtl][1];
                        $objs[$id_dtl][0] = true;
                    } else {
                        $detail = new PurchaseDtl;
                    }

                    $detail->setAttributes($dataDetail);
                    if ($id_hdr !== false) {
                        $detail->id_purchase = $id_hdr;
                        $detail->id_warehouse = $id_whse;
                        try {
                            $success = $success && $detail->save();
                        } catch (Exception $exc) {
                            $success = false;
                            $detail->addError('', $exc->getMessage());
                        }
                    }
                    $details[] = $detail;
                }
            } else {
                $success = false;
                $model->addError('', 'Detail tidak boleh kosong');
            }
            if ($success) {
                try {
                    $deleted = [];
                    foreach ($objs as $id_dtl => $value) {
                        if ($value[0] == false) {
                            $deleted[] = $id_dtl;
                        }
                    }
                    if (count($deleted) > 0) {
                        $success = PurchaseDtl::deleteAll(['id_purchase_dtl' => $deleted]);
                    }
                } catch (Exception $exc) {
                    $success = false;
                    $model->addError('', $exc->getMessage());
                }
            }
            if ($success) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        }
        return [$details, $success];
    }

    /**
     * Deletes an existing PurchaseHdr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionReceive($id) {
        $model = $this->findModel($id);
        if ($model->status === PurchaseHdr::STATUS_DRAFT) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->status = PurchaseHdr::STATUS_RECEIVE;
                if (!$model->save()) {
                    throw new \yii\base\UserException(implode(",\n", $model->firstErrors));
                }
                $id_warehouse = $model->id_warehouse;
                $id_branch = $model->id_branch;
                $sukses = true;
                foreach ($model->purchaseDtls as $detail) {
                    if (!$sukses) {
                        break;
                    }
                    $stock = ProductStock::UpdateStock([
                            'id_warehouse' => $detail->id_warehouse,
                            'id_product' => $detail->id_product,
                            'id_uom' => $detail->id_uom,
                            'qty' => $detail->purch_qty,
                            ], [
                            'mv_qty' => $detail->purch_qty,
                            'app' => 'purchase',
                            'id_ref' => $detail->id_purchase_dtl,
                    ]);

                    Cogs::UpdateCogs([
                        'id_product' => $detail->id_product,
                        'id_uom' => $stock['smallest_uom'],
                        'old_stock' => $stock['old_stock'],
                        'added_stock' => $stock['added_stock'],
                        'price' => $detail->purch_price / $stock['qty_per_uom'],
                        ], [
                        'app' => 'purchase',
                        'id_ref' => $detail->id_purchase_dtl,
                    ]);
					
					Price::UpdatePrice([
                        'id_product' => $detail->id_product,
                        'id_uom' => $stock['smallest_uom'],
                        'price' => $detail->selling_price / $stock['qty_per_uom'],
                        ], [
                        'app' => 'purchase',
                        'id_ref' => $detail->id_purchase_dtl,
                    ]);
                }

                if ($sukses) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $exc) {
                $transaction->rollBack();
                throw $exc;
            }
            return $this->redirect(['index']);
        } else {
            throw new \yii\base\UserException('Dokument tidak boleh direlese');
        }
    }

    /**
     * Finds the PurchaseHdr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseHdr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if ($id !== null && ($model = PurchaseHdr::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJs() {
        $sql = "select p.id_product as id, p.cd_product as cd, p.nm_product as nm,
			u.id_uom, u.nm_uom, pu.isi
			from product p
			join product_uom pu on(pu.id_product=p.id_product)
			join uom u on(u.id_uom=pu.id_uom)
			order by p.id_product,pu.isi";
        $product = [];
        foreach (\Yii::$app->db->createCommand($sql)->query() as $row) {
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

        $sql = "select id_supplier,id_product
			from product_supplier";
        $ps = [];
        foreach (\Yii::$app->db->createCommand($sql)->queryAll() as $row) {
            $ps[$row['id_supplier']][] = $row['id_product'];
        }

        $sql = "select id_supplier as id, nm_supplier as label from supplier";
        $supp = \Yii::$app->db->createCommand($sql)->queryAll();
        return $this->renderPartial('process.js.php', [
                'product' => $product,
                'ps' => $ps,
                'supp' => $supp]);
    }

}
