<?php
    /**
     * Created by PhpStorm.
     * User: PAVLO
     * Date: 08.08.2016
     * Time: 11:40
     */

    namespace frontend\controllers;

    use Yii;

    class Controller extends \yii\web\Controller
    {
        var $page_class = false;
        var $item_id = false;
    }

    //MessageSource::EVENT_MISSING_TRANSLATION
    // Создать языквую переменную, если она была найдена в тексте, но еще не была определена в массиве переменных
    /*
     \yii\base\Event::on(MessageSource::className(), MessageSource::EVENT_MISSING_TRANSLATION, function ($event) {

        $cur_lang = explode('-', $event->language)[0];
        $source_lang = $event->sender->sourceLanguage;
        if($source_lang != $cur_lang)
        {
            return;
        }

        $file_name = Yii::getAlias($event->sender->basePath).'/'.$source_lang.'/'.$event->category.'.php';
        if( !is_file($file_name) )
        {
            return;
        }
        $file = require($file_name);

        $file[$event->message] = $event->message;

        $t = "<?php \n    return [\n";
        foreach ($file as $k => $v)
        {
            $t.= "        '$k' => '$v', \n";
        }
        $t .= "\n    ];";

        file_put_contents($file_name, $t);

    });
    */

    if( !Yii::$app->request->isAjax )
    {
        \yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_BEGIN_PAGE, function ($event) {

            $jsSet = [
                'token'   => ['t' => Yii::$app->request->csrfToken, 'name' => Yii::$app->request->csrfParam],
                'guest'   => ((Yii::$app->user->isGuest) ? 'guest' : 'user'),
                'debug'   => ((YII_DEBUG) ? '1' : '0'),
                'task'    => Yii::$app->controller->id . '-' . Yii::$app->controller->action->id,
                'item_id' => Yii::$app->controller->item_id,
                // 'lang' => Lang::$current->url,
            ];

            Yii::$app->view->registerJs('lib.init(' . json_encode($jsSet, JSON_NUMERIC_CHECK) . ');', \yii\web\View::POS_END, 'init_lib');
        });

        \yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_END_BODY , function ($event) {
            echo \lo\modules\noty\Wrapper::widget([
                'layerClass' => 'lo\modules\noty\layers\Noty',
                'layerOptions'=>[
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
                    'killer'=> true,
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
    }