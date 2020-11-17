<?php

namespace core\services\helpers;

class TransactionManager
{
    public function wrap(callable $function): void
    {
        \Yii::$app->db->transaction($function);
    }
}
