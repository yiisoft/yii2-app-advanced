<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\sales\models\Cashdrawer;
?>
<?php
Modal::begin([
	'id' => 'dlg-drawer',
]);
?>
<div class="cash-drawer-form">
	<div class="form-group field-cashdrawer-id_branch required">
		<label class="control-label" for="cashdrawer-id_branch">Id Branch</label>
		<select id="cashdrawer-id_branch" class="form-control" name="CashDrawer[id_branch]">
			<option value="1">Satu</option>
		</select>
	</div>
	<div class="form-group field-cashdrawer-no_cashier required">
		<label class="control-label" for="cashdrawer-no_cashier">No Cashier</label>
		<select id="cashdrawer-no_cashier" class="form-control" name="CashDrawer[no_cashier]">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="form-group field-cashdrawer-name_cashier">
		<label class="control-label" for="cashdrawer-name_cashier">Name Cashier</label>
		<input type="text" id="cashdrawer-name_cashier" class="form-control" name="CashDrawer[name_cashier]" readonly>
	</div>
	<div class="form-group field-cashdrawer-initial_cash required">
		<label class="control-label" for="cashdrawer-initial_cash">Initial Cash</label>
		<input type="text" id="cashdrawer-initial_cash" class="form-control" name="CashDrawer[initial_cash]">
	</div>

	<div class="form-group field-cashdrawer-create_date">
		<label class="control-label" for="cashdrawer-create_date">Create Date</label>
		<input type="text" id="cashdrawer-create_date" class="form-control" name="CashDrawer[create_date]" readonly>
	</div>
	<div class="form-group">
		<?= Html::a('Open New','',['class'=>'btn btn-success']); ?>
	</div>
</div>
<?php Modal::end(); ?>