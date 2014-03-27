<?php
return [
	'preload' => [
		//'debug',
	],
	'modules' => [
		'debug' => 'yii\debug\Module',
		'gii' => 'yii\gii\Module',
		'master' => [
            'class' => 'backend\modules\master\Module',
        ],
		'inventory' => [
            'class' => 'backend\modules\inventory\Module',
        ],
		'accounting' => [
            'class' => 'backend\modules\accounting\Module',
        ], 
		'purchase' => [
            'class' => 'backend\modules\purchase\Module',
        ],
		 'sales' => [
            'class' => 'backend\modules\sales\Module',
        ],
	],
	'as access' => [
		'class'=>'mdm\admin\components\AccessControl',
		'allowActions'=>[
			'site/login',
			'site/error',
		]],
];