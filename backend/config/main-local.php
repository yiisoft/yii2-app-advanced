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
	],
];