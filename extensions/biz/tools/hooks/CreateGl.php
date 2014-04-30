<?php

namespace biz\tools\hooks;

use biz\tools\Hooks;
use biz\tools\Helper;
use biz\models\GlHeader;
use biz\models\GlDetail;
use yii\base\UserException;

/**
 * Description of Gl
 *
 * @author MDMunir
 */
class CreateGl extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::E_PPREC_23 => 'purchaseReceiveEnd'
        ];
    }

    protected function createGL($hdr, $dtls = [])
    {
        $blc = 0.0;
        foreach ($dtls as $row) {
            $blc += $row['ammount'];
        }
        if ($blc != 0) {
            throw new UserException('GL Balance Failed');
        }

        $gl = new GlHeader();
        $gl->gl_date = $hdr['date'];
        $gl->id_reff = $hdr['id_reff'];
        $gl->type_reff = $hdr['type_reff'];
        $gl->gl_memo = $hdr['memo'];
        $gl->description = $hdr['description'];

        $gl->id_branch = $hdr['id_branch'];
        
        $active_periode = Helper::getCurrentIdAccPeriode();
        $gl->id_periode = $active_periode;
        $gl->status = 0;
        if (!$gl->save()) {
            throw new UserException(implode("\n", $gl->getFirstErrors()));
        }

        foreach ($dtls as $row) {
            $glDtl = new GlDetail();
            $glDtl->id_gl = $gl->id_gl;
            $glDtl->id_coa = $row['id_coa'];
            $glDtl->amount = $row['ammount'];
            if (!$glDtl->save()) {
                throw new UserException(implode("\n", $glDtl->getFirstErrors()));
            }
        }
    }
    /**
     * 
     * @param Event $event
     */
    public function purchaseReceiveEnd($event,$model)
    {
        // GL *************
        $glHdr = [
            'date' => date('Y-m-d'),
            'type_reff' => GlHeader::TYPE_PURCHASE,
            'memo' => null,
            'id_reff' => $model->id_purchase,
            'id_branch' => $model->id_branch,
            'description' => 'Pembelian barang kredit ' . $model->purchase_num,
        ];

        $dtls = [
            'PERSEDIAAN' => $model->purchase_value * (1 - $model->item_discount * 0.01),
            'HUTANG' => $model->purchase_value * (1 - $model->item_discount * 0.01),
        ];

        $glDtls = Helper::entriSheetToGlMaps('PEMBELIAN_KREDIT', $dtls);
        $this->createGL($glHdr, $glDtls);
    }
}