<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12.04.2017
     * Time: 23:21
     */

    namespace backend\components;

    use Yii;

    class EventsHandler
    {
        function __construct()
        {
            if( !Yii::$app->request->isAjax )
            {
                \yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_BEGIN_PAGE, function ($event)
                {

                    try{

                        $jsSet = [
                            'token'   => ['t' => Yii::$app->request->csrfToken, 'name' => Yii::$app->request->csrfParam],
                            'guest'   => ((Yii::$app->user->isGuest) ? 'guest' : 'user'),
                            'debug'   => ((YII_DEBUG) ? '1' : '0'),
                            'task'    => Yii::$app->controller->id . '-' . Yii::$app->controller->action->id,
                            'item_id' => @Yii::$app->controller->item_id,
                            // 'lang' => Lang::$current->url,
                        ];
                    }
                    catch(\Exception $e){

                    }

                    Yii::$app->view->registerJs('lib.init(' . json_encode($jsSet, JSON_NUMERIC_CHECK) . ');',
                        \yii\web\View::POS_END, 'init_lib');
                });

                \yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_END_BODY, function ($event)
                {
                    echo \lo\modules\noty\Wrapper::widget([
                        'layerClass'   => 'lo\modules\noty\layers\Noty',
                        'layerOptions' => [
                            'registerAnimateCss' => true,
                            //'registerButtonsCss' => true
                        ],
                        // clientOptions
                        'options'      => [
                            'dismissQueue' => true,
                            'layout'       => 'topCenter',
                            'timeout'      => 4000,
                            'theme'        => 'relax',
                            'maxVisible'   => 5,
                            'force'        => true,
                            'killer'       => true,
                            'animation'    => [
                                'open'   => 'animated fadeInDown',
                                'close'  => 'animated fadeOutUp',
                                'easing' => 'easing', //'swing',
                                'speed'  => 300
                            ]
                        ],
                    ]);


                    // Тут можно добавить счетчики для гугла, яндекса
                });
            }
        }
    }