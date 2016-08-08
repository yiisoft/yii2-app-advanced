<?php
    /**
     * Created by PhpStorm.
     * User: PAVLO
     * Date: 08.08.2016
     * Time: 11:40
     */

    namespace backend\controllers;

    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;

    class Controller extends \yii\web\Controller
    {
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
                        /*[
                            'allow' => true,
                            'roles' => ['admin'],
                        ],*/
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
    }