<?php

namespace biz\tools;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of Hooks
 *
 * @author MDMunir
 */
class Hooks extends \biz\base\Hooks
{
    const E_PPREC_21 = 'ePPRec21';
    const E_PPREC_22 = 'ePPRec22';
    const E_PPREC_23 = 'ePPRec23';
    const E_ITISS_21 = 'eITIss21';
    const E_ITISS_22 = 'eITIss22';
    const E_ITISS_23 = 'eITIss23';
    const E_IRREC_21 = 'eIRRec21';
    const E_IRREC_22 = 'eIRRec22';
    const E_IRREC_23 = 'eIRRec23';
    const E_SSREL_21 = 'eSSRel21';
    const E_SSREL_22 = 'eSSRel22';
    const E_SSREL_23 = 'eSSRel23';
    const E_PPDEL_1 = 'ePPDel1';
    const E_PPUPD_1 = 'ePPUpd1';
    const E_PPREC_1 = 'ePPRec1';
    const E_ITUPD_1 = 'eITUpd1';
    const E_ITISS_1 = 'eITIss1';
    const E_ITDEL_1 = 'eITDel1';
    const E_IRUPD_1 = 'eIRUpd1';
    const E_SSREL_1 = 'eSSRel1';

    public $hooksNamespace = 'biz\tools\hooks';
    public $extras = [];

    public function behaviors()
    {
        $path = Yii::getAlias('@' . str_replace('\\', '/', $this->hooksNamespace));
        $result = [];
        foreach (scandir($path) as $file) {
            if ($file == '.' || $file == '..' || is_dir($path . '/' . $file)) {
                continue;
            }
            if (strcmp(substr($file, -4), '.php') === 0) {
                include $path . '/' . $file;
                $classname = trim($this->hooksNamespace, '\\') . '\\' . substr($file, 0, -4);
                if ($classname instanceof \yii\base\Behavior) {
                    $result[$classname] = $classname;
                }
            }
        }
        return ArrayHelper::merge($result, $this->extras);
    }
}