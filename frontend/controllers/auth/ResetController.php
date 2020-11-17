<?php
namespace frontend\controllers\auth;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use frontend\forms\auth\ResetPasswordForm;
use frontend\forms\auth\PasswordResetRequestForm;
use core\services\auth\PasswordResetService;

class ResetController extends Controller
{
    public $layout = '@common/views/layouts/auth';
    private $service;

    public function __construct($id, $module, PasswordResetService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->viewPath = '@frontend/views/site/auth/reset';
    }

    public function actionRequest()
    {
        $requestForm = new PasswordResetRequestForm();
        if ($requestForm->load(Yii::$app->request->post()) && $requestForm->validate()) {
            try {
                $this->service->request($requestForm);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'requestForm' => $requestForm,
        ]);
    }

    /**
     * @param $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionConfirm($token)
    {
        try {
            $this->service->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved.');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->goHome();
        }

        return $this->render('confirm', [
            'model' => $form,
        ]);
    }
}
