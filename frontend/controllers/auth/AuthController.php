<?php
namespace frontend\controllers\auth;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\forms\auth\LoginForm;
use core\entities\user\Identity;
use core\services\auth\AuthService;

class AuthController extends Controller
{
    public $layout = '@common/views/layouts/auth';
    private $authService;

    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $service;
        $this->viewPath = '@frontend/views/site/auth';
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', 'User is already authorized!');
            return $this->goHome();
        }

        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate()) {
            try {
                $user = $this->authService->auth($loginForm);
                Yii::$app->user->login(new Identity($user), $loginForm->rememberMe ? Yii::$app->params['user.rememberMeDuration'] : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'loginForm' => $loginForm,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
