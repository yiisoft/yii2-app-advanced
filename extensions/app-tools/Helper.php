<?php

namespace app\tools;

use Yii;
use yii\base\UserException;
use biz\accounting\models\EntriSheet;
use biz\accounting\models\Coa;
use biz\accounting\models\GlHeader;
use biz\accounting\models\GlDetail;
use biz\accounting\models\InvoiceHdr;
use biz\accounting\models\InvoiceDtl;
use biz\inventory\models\ProductStock;
use biz\master\models\Cogs;
use biz\master\models\Price;
use biz\master\models\PriceCategory;
use biz\master\models\GlobalConfig;
use biz\master\models\Warehouse;
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
    public static function EntriSheetToGlMaps($name, $values)
    {
        $gl_dtls = [];
        $esheet = EntriSheet::findOne(['nm_esheet' => $name]);
        if ($esheet) {
            foreach ($esheet->entriSheetDtl as $eDtl) {
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
        $gl->id_periode = 1;
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

    public static function currentStock($id_whse, $id_product)
    {
        $stock = ProductStock::findOne([
                'id_warehouse' => $id_whse,
                'id_product' => $id_product,
        ]);
        return $stock ? $stock->qty_stock : 0;
    }

    public static function currentStockAll($id_product)
    {
        $sql = 'select sum(qty_stock) from product_stock where id_product = :id_product';
        $stock = Yii::$app->db->createCommand($sql, [':id_product' => $id_product])->queryScalar();
        return $stock ? $stock : 0;
    }

    public static function UpdateStock($params, $logs = [])
    {
        $result = [];
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

    public static function UpdateCogs($params, $logs = [])
    {
        $cogs = Cogs::findOne(['id_product' => $params['id_product'],]);

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

    public static function UpdatePrice($params, $logs = [])
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

    public static function ListProductUoms($product_id)
    {
        $sql = 'select u.id_uom,u.nm_uom
                from uom u
                join product_uom pu on(pu.id_uom=u.id_uom)
                where pu.id_product=:id_product';
        $result = [];
        foreach (Yii::$app->db->createCommand($sql, [':id_product' => $product_id])->queryAll() as $row) {
            $result[$row['id_uom']] = $row['nm_uom'];
        }
        return $result;
    }

    /**
     * @return integer
     */
    public static function getSmallestProductUom($product_id)
    {
        $sql = 'select pu.id_uom
            from product_uom pu
            where pu.id_product=:id
            order by pu.isi ASC';
        return Yii::$app->db->createCommand($sql, [':id' => $product_id])->queryScalar();
    }

    /**
     * @return integer
     */
    public static function getQtyProductUom($id_product, $id_uom)
    {
        $sql = 'select pu.isi
            from product_uom pu
            where pu.id_product=:id_product and pu.id_uom=:id_uom';
        return Yii::$app->db->createCommand($sql, [
                ':id_product' => $id_product,
                ':id_uom' => $id_uom]
            )->queryScalar();
    }
	
	public static function getConfigValue($group,$name,$default=null)
	{
		$model = GlobalConfig::findOne(['config_group' => $group, 'config_name' => $name]);
		if($model){
			return $model->config_value;
		}
		return $default;
	}
    
    public static function getWarehouseList($branch=false)
    {
        $query = Warehouse::find();
		if($branch !== false){
			$query->andWhere(['id_branch'=>  $branch]);
		}
        return ArrayHelper::map($query->all(), 'id_warehouse', 'nm_whse');
    }
}