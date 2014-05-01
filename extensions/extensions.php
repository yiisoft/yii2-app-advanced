<?php

Yii::setAlias('biz', __DIR__ . '/biz');
Yii::setAlias('biz/master', __DIR__ . '/biz-master');
Yii::setAlias('biz/inventory', __DIR__ . '/biz-inventory');
Yii::setAlias('biz/accounting', __DIR__ . '/biz-accounting');
Yii::setAlias('biz/purchase', __DIR__ . '/biz-purchase');
Yii::setAlias('biz/sales', __DIR__ . '/biz-sales');
Yii::setAlias('biz/gii', __DIR__ . '/biz-gii');

\yii\validators\Validator::$builtInValidators['doubleFilter'] = [
    'class' => 'yii\validators\FilterValidator',
    'filter' => function($val) {
    return empty($val) ? null : (double) $val;
}
];

\yii\validators\Validator::$builtInValidators['doubleFilter0'] = [
    'class' => 'yii\validators\FilterValidator',
    'filter' => function($val) {
    return empty($val) ? 0 : (double) $val;
}
];

\yii\validators\Validator::$builtInValidators['linkFilter'] = [
    'class' => 'yii\validators\FilterValidator',
    'filter' => function($val) {
    return empty($val) ? null : (int) $val;
}
];

\yii\validators\Validator::$builtInValidators['linkFilter0'] = [
    'class' => 'yii\validators\FilterValidator',
    'filter' => function($val) {
    return empty($val) ? 0 : (int) $val;
}
];
