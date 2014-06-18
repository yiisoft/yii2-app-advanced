<?php

namespace biz\tools;

use yii\base\UserException;
use biz\models\EntriSheet;
use biz\models\Coa;
use biz\models\GlHeader;
use biz\models\GlDetail;
use biz\models\InvoiceHdr;
use biz\models\InvoiceDtl;
use biz\models\AccPeriode;
use biz\models\ProductStock;
use biz\models\Cogs;
use biz\models\Price;
use biz\models\PriceCategory;
use biz\models\GlobalConfig;
use biz\models\Warehouse;
use biz\models\Branch;
use biz\models\ProductUom;
use biz\models\UserToBranch;
use yii\helpers\ArrayHelper;

/**
 * Description of Helper
 *
 * @author MDMunir
 */
class Helper
{

    /**
     * 
     * @param string $name Entri Sheet name
     * @param array $values 
     * @return array
     * @throws UserException
     */
    public static function entriSheetToGlMaps($name, $values)
    {
        $gl_dtls = [];
        $esheet = EntriSheet::findOne(['nm_esheet' => $name]);
        if ($esheet) {
            foreach ($esheet->entriSheetDtls as $eDtl) {
                $coa = $eDtl->id_coa;
                $nm = $eDtl->nm_esheet_dtl;

                $dc = $eDtl->idCoa->normal_balance == 'D' ? 1 : -1;

                if (isset($values[$nm])) {
                    $ammount = $dc * $values[$nm];
                } else {
                    throw new UserException("Required account $nm ");
                }
                $gl_dtls[] = [
                    'id_coa' => $coa,
                    'ammount' => $ammount
                ];
            }
        } else {
            throw new UserException("Entrysheet $name not found");
        }
        return $gl_dtls;
    }

    private static function getCoaChild(&$result, $parent, $prefix, $tab)
    {
        foreach (Coa::find()->where(['id_coa_parent' => $parent])->orderBy(['cd_account' => SORT_ASC])->all() as $row) {
            $result[$row['id_coa']] = $prefix . "[{$row['cd_account']}] {$row['nm_account']}";
            static::getCoaChild($result, $row['id_coa'], $prefix . $tab, $tab);
        }
    }

    public static function getGroupedCoaList($addSelf = false, $tab = 4)
    {
        $result = [];
        $tab = str_pad('', $tab);
        foreach (Coa::find()->where(['id_coa_parent' => null])->orderBy(['cd_account' => SORT_ASC])->all() as $row) {
            if ($addSelf) {
                $result[$row['nm_account']][$row['id_coa']] = "[{$row['cd_account']}] {$row['nm_account']}";
            } else {
                $result[$row['nm_account']] = [];
            }
            static::getCoaChild($result[$row['nm_account']], $row['id_coa'], $addSelf ? $tab : '', $tab);
        }
        return $result;
    }

    /**
     * @return array()
     */
    public static function getCoaType()
    {
        return [
            100000 => 'AKTIVA',
            200000 => 'KEWAJIBAN',
            300000 => 'MODAL',
            400000 => 'PENDAPATAN',
            500000 => 'HPP',
            600000 => 'BIAYA'
        ];
    }

    /**
     * @return array()
     */
    public static function getBalanceType()
    {
        return [
            'D' => 'DEBIT',
            'K' => 'KREDIT',
        ];
    }

    public static function getNormalBalanceOfType($coa_type)
    {
        $maps = [
            100000 => 'D',
            200000 => 'K',
            300000 => 'K',
            400000 => 'K',
            500000 => 'D',
            600000 => 'D'
        ];
        return $maps[(int) $coa_type];
    }

    /**
     * @return integer Current accounting periode
     */
    public static function getCurrentIdAccPeriode()
    {
        $acc = AccPeriode::findOne(['status' => AccPeriode::STATUS_OPEN]);
        if ($acc) {
            return $acc->id_periode;
        }
        throw new UserException('Periode tidak ditemukan');
    }

    /**
     * @return integer
     */
    public static function getAccountByName($name)
    {
        $coa = Coa::findOne(['lower(nm_account)' => strtolower($name)]);
        if ($coa) {
            return $coa->id_coa;
        }
        throw new UserException('Akun tidak ditemukan');
    }

    /**
     * @return integer
     */
    public static function getAccountByCode($code)
    {
        $coa = Coa::findOne(['lower(cd_account)' => strtolower($code)]);
        if ($coa) {
            return $coa->id_coa;
        }
        throw new UserException('Akun tidak ditemukan');
    }

    public static function createGL($hdr, $dtls = [])
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

        $active_periode = AccPeriode::getCurrentPeriode();
        $gl->id_periode = $active_periode['id_periode'];
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

    public static function createInvoice($params)
    {
        $invoice = new InvoiceHdr();
        $invoice->id_vendor = $params['id_vendor'];
        $invoice->inv_date = $params['date'];
        $invoice->inv_value = $params['value'];
        $invoice->type = $params['type'];
        $invoice->due_date = date('Y-m-d', strtotime('+1 month'));
        $invoice->status = 0;
        if (!$invoice->save()) {
            throw new UserException(implode("\n", $invoice->getFirstErrors()));
        }

        $invDtl = new InvoiceDtl();
        $invDtl->id_invoice = $invoice->id_invoice;
        $invDtl->id_reff = $params['id_ref'];
        $invDtl->trans_value = $params['value'];
        if (!$invDtl->save()) {
            throw new UserException(implode("\n", $invDtl->getFirstErrors()));
        }
    }

    public static function getCurrentStock($id_whse, $id_product)
    {
        $stock = ProductStock::findOne(['id_warehouse' => $id_whse, 'id_product' => $id_product]);
        return $stock ? $stock->qty_stock : 0;
    }

    public static function getCurrentStockAll($id_product)
    {
        return ProductStock::find()->where(['id_product' => $id_product])->sum('qty_stock');
    }

    public static function updateStock($params, $logs = [])
    {
        $stock = ProductStock::findOne([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
        ]);
        if (!$stock) {
            $stock = new ProductStock();

            $stock->setAttributes([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
                'id_uom' => $params['id_uom'],
                'qty_stock' => 0,
            ]);
        }

        $stock->qty_stock = $stock->qty_stock + $params['qty'];
        if (!empty($logs) && $stock->canSetProperty('logParams')) {
            $stock->logParams = $logs;
        }
        if (!$stock->save()) {
            throw new UserException(implode(",\n", $stock->firstErrors));
        }

        return true;
    }

    public static function updateCogs($params, $logs = [])
    {
        $cogs = Cogs::findOne(['id_product' => $params['id_product']]);
        if (!$cogs) {
            $cogs = new Cogs();
            $cogs->setAttributes([
                'id_product' => $params['id_product'],
                'id_uom' => $params['id_uom'],
                'cogs' => 0.0
            ]);
        }
        $cogs->cogs = 1.0 * ($cogs->cogs * $params['old_stock'] + $params['price'] * $params['added_stock']) / ($params['old_stock'] + $params['added_stock']);
        if (!empty($logs) && $cogs->canSetProperty('logParams')) {
            $cogs->logParams = $logs;
        }
        if (!$cogs->save()) {
            throw new UserException(implode(",\n", $cogs->firstErrors));
        }
        return true;
    }

    private static function executePriceFormula($_formula_, $price)
    {
        if (empty($_formula_)) {
            return $price;
        }
        $_formula_ = preg_replace('/price/i', '$price', $_formula_);
        return empty($_formula_) ? $price : eval("return $_formula_;");
    }

    public static function updatePrice($params, $logs = [])
    {
        $categories = PriceCategory::find()->all();
        foreach ($categories as $category) {
            $price = Price::findOne([
                    'id_product' => $params['id_product'],
                    'id_price_category' => $category->id_price_category
            ]);

            if (!$price) {
                $price = new Price();
                $price->setAttributes([
                    'id_product' => $params['id_product'],
                    'id_price_category' => $category->id_price_category,
                    'id_uom' => $params['id_uom'],
                    'price' => 0
                ]);
            }

            if (!empty($logs) && $price->canSetProperty('logParams')) {
                $price->logParams = $logs;
            }
            $price->price = self::executePriceFormula($category->formula, $params['price']);
            if (!$price->save()) {
                throw new UserException(implode(",\n", $price->firstErrors));
            }
        }

        return true;
    }

    public static function getProductUomList($id_product)
    {
        $uoms = ProductUom::find()->with('idUom')->where(['id_product' => $id_product])->all();
        return ArrayHelper::map($uoms, 'id_uom', 'idUom.nm_uom');
    }

    /**
     * @return integer
     */
    public static function getSmallestProductUom($id_product)
    {
        $uom = ProductUom::findOne(['id_product' => $id_product, 'isi' => 1]);
        return $uom ? $uom->id_uom : false;
    }

    /**
     * @return integer
     */
    public static function getQtyProductUom($id_product, $id_uom)
    {
        $pu = ProductUom::findOne(['id_product' => $id_product, 'id_uom' => $id_uom]);
        return $pu ? $pu->isi : false;
    }

    public static function getConfigValue($group, $name, $default = null)
    {
        $model = GlobalConfig::findOne(['config_group' => $group, 'config_name' => $name]);
        return $model ? $model->config_value : $default;
    }

    public static function getWarehouseList($branch = false)
    {
        $query = Warehouse::find();
        if ($branch !== false) {
            $query->where(['id_branch' => $branch]);
        }
        return ArrayHelper::map($query->asArray()->all(), 'id_warehouse', 'nm_whse');
    }

    public static function getBranchList($id_user = null)
    {
        if ($id_user === null) {
            return ArrayHelper::map(Branch::find()->all(), 'id_branch', 'nm_branch');
        } else {
            $query = UserToBranch::find()->with('idBranch')->where(['user_id'=>$id_user]);
            return ArrayHelper::map($query->all(), 'id_branch', 'idBranch.nm_branch');
        }
    }
}