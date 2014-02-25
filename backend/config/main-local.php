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
		'purchase' => [
            'class' => 'backend\modules\purchase\Module',
        ],
		'accounting' => [
            'class' => 'backend\modules\accounting\Module',
        ],
	],
];