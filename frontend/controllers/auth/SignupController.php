<?php
namespace frontend\controllers\auth;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\forms\auth\SignupForm;
use core\services\auth\SignUpService;

class SignupController extends Controller
{
    public $layout = '@common/views/layouts/auth';
    private $service;

    public function __construct($id, $module, SignUpService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->viewPath = '@frontend/views/site/auth/signup';
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionRequest()
    {
        $signupForm = new SignupForm();
        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            try {
                $this->service->signup($signupForm);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'signupForm' => $signupForm,
        ]);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function actionConfirm($token)
    {
        try {
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success', 'Your email is confirmed. Now you can log in.');
            return $this->redirect(['auth/auth/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->goHome();
    }
}
