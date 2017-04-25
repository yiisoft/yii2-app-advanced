<?php


namespace backend\generators\crud;

use Yii;
use yii\db\BaseActiveRecord;


class Generator extends \yii\gii\generators\crud\Generator
{
    public $baseControllerClass = 'backend\controllers\Controller';
}
