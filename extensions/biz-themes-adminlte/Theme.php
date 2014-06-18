<?php

namespace biz\adminlte;

/**
 * Description of AdminlteTheme
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class Theme extends \yii\base\Theme
{
    public $pathMap = [
        '@backend/views' => ['@biz/adminlte/views'],
        '@biz/sales/views' => ['@biz/adminlte/sales-views'],
    ];

}