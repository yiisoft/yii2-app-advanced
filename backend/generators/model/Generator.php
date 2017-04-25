<?php

namespace backend\generators\model;


class Generator extends \yii\gii\generators\model\Generator
{
    public $ns = 'common\models';
    public $generateLabelsFromComments = true;
    public $useTablePrefix = true;
    public $useSchemaName = true;
    public $generateQuery = true;
    public $queryNs = 'common\models\query';

    public $templates = [
        'default' => '@vendor/yiisoft/yii2-gii/generators/model/default'
    ];
}
