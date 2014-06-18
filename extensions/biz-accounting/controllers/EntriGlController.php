<?php

namespace biz\accounting\controllers;

use Yii;
use biz\models\GlHeader;
use biz\models\searchs\GlHeader as GlHeaderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use biz\models\GlDetail;

/**
 * EntriGlController implements the CRUD actions for GlHeader model.
 */
class EntriGlController extends Controller
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
     * Lists all GlHeader models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GlHeaderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single GlHeader model.
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
     * Creates a new GlHeader model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GlHeader;

        list($details, $success) = $this->saveGl($model);
        if ($success) {
            return $this->redirect(['view', 'id' => $model->id_gl]);
        } else {
            $model->setIsNewRecord(true);
            return $this->render('create', [
                    'model' => $model,
                    'details' => $details,
            ]);
        }
    }

    /**
     * Updates an existing GlHeader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gl]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * 
     * @param GlHeader $model
     * @return array
     * @throws Exception
     */
    protected function saveGl($model)
    {
        $post = Yii::$app->request->post();
        $details = $model->glDetails;
        $success = false;

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $formName = (new GlDetail)->formName();
                $postDetails = empty($post[$formName]) ? [] : $post[$formName];
                if ($postDetails === []) {
                    throw new Exception('Detail tidak boleh kosong');
                }
                $objs = [];
                foreach ($details as $detail) {
                    $objs[$detail->id_gl_detail] = $detail;
                }
                if ($model->save()) {
                    $success = true;
                    $id_hdr = $model->id_transfer;
                    $details = [];
                    $amount = 0.0;
                    foreach ($postDetails as $dataDetail) {
                        $id_dtl = $dataDetail['id_gl_detail'];
                        if (isset($objs[$id_dtl])) {
                            $detail = $objs[$id_dtl];
                            unset($objs[$id_dtl]);
                        } else {
                            $detail = new GlDetail;
                        }

                        $detail->setAttributes($dataDetail);
                        $detail->id_gl = $id_hdr;
                        if (!$detail->save()) {
                            $success = false;
                            $model->addError('', implode("\n", $detail->firstErrors));
                            break;
                        }
                        $details[] = $detail;
                        $amount += $detail->amount;
                    }
                    if ($amount != 0.0) {
                        throw new Exception("Not balance");
                    }
                    if ($success && count($objs)) {
                        $success = GlDetail::deleteAll(['id_gl' => $id_hdr, 'id_gl_detail' => array_keys($objs)]);
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
                    $detail = new GlDetail();
                    $detail->setAttributes($value);
                    $details[] = $detail;
                }
            }
        }
        return [$details, $success];
    }

    /**
     * Deletes an existing GlHeader model.
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
     * Finds the GlHeader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GlHeader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GlHeader::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}