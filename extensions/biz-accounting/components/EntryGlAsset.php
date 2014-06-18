<?php
namespace biz\accounting\components;
/**
 * Description of EntryGlAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class EntryGlAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/accounting/assets';
    public $js = [
        'js/accounting.entrygl.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}