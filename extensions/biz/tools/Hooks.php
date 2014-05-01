<?php

namespace biz\tools;

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

    public function behaviors()
    {
        return[
            'biz\tools\hooks\UpdateStock',
            'biz\tools\hooks\UpdateCogs',
            'biz\tools\hooks\UpdatePrice',
            'biz\tools\hooks\CreateInvoice',
            'biz\tools\hooks\CreateGl',
            'biz\tools\hooks\CheckStatus',
        ];
    }
}