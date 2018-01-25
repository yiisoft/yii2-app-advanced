<?php

namespace backend\controllers;

use lo\modules\noty\layers\Noty;
use lo\modules\noty\Wrapper;
use Yii;
use yii\base\Event;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\i18n\MessageSource;
use yii\web\Controller as WebController;
use yii\web\View;

class Controller extends WebController
{
    var $page_class = false;
    var $item_id = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        if (Yii::$app->request->isAjax) {
            return;
        }

        Event::on(View::className(), View::EVENT_BEGIN_PAGE, function ($event) {

            $jsSet = [
                'token' => ['t' => Yii::$app->request->csrfToken, 'name' => Yii::$app->request->csrfParam],
                'guest' => ((Yii::$app->user->isGuest) ? 'guest' : 'user'),
                'debug' => ((YII_DEBUG) ? '1' : '0'),
                'task' => Yii::$app->controller->id . '-' . Yii::$app->controller->action->id,
                'item_id' => Yii::$app->controller->item_id,
                // 'lang' => Lang::$current->url,
            ];

            Yii::$app->view->registerJs('lib.init(' . json_encode($jsSet, JSON_NUMERIC_CHECK) . ');',
                View::POS_END, 'init_lib');
        });

        Event::on(View::className(), View::EVENT_END_BODY, function ($event) {

            echo Wrapper::widget([
                'layerClass' => Noty::className(),
                'layerOptions' => [
                    'registerAnimateCss' => true,
                    //'registerButtonsCss' => true
                ],
                // clientOptions
                'options' => [
                    'dismissQueue' => true,
                    'layout' => 'topCenter',
                    'timeout' => 4000,
                    'theme' => 'relax',
                    'maxVisible' => 5,
                    'force' => true,
                    'killer' => true,
                    'animation' => [
                        'open' => 'animated fadeInDown',
                        'close' => 'animated fadeOutUp',
                        'easing' => 'easing', //'swing',
                        'speed' => 300
                    ]
                ],
            ]);


            // Тут можно добавить счетчики для гугла, яндекса
        });

        //MessageSource::EVENT_MISSING_TRANSLATION
        // Создать языквую переменную, если она была найдена в тексте, но еще не была определена в массиве переменных
        Event::on(MessageSource::className(), MessageSource::EVENT_MISSING_TRANSLATION, function ($event) {
            $cur_lang = explode('-', $event->language)[0];
            $source_lang = $event->sender->sourceLanguage;

            if ($source_lang != $cur_lang) {
                return;
            }

            $file_name = Yii::getAlias($event->sender->basePath) . '/' . $source_lang . '/' . $event->category . '.php';

            if (!is_file($file_name)) {
                $fp = fopen($file_name, "w");
                $t = "<?php \n    return [\n";
                $t .= "\n    ];";
                fwrite($fp, $t);
                fclose($fp);
            }
            $file = require($file_name);
            $file[$event->message] = $event->message;

            $t = "<?php \n    return [\n";
            foreach ($file as $k => $v) {
                $t .= "        '$k' => '$v',\n";
            }
            $t .= "\n    ];";
            file_put_contents($file_name, $t);
        });
    }
}
