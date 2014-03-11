<?php if (false): ?>
	<script type="text/javascript">
<?php endif; ?>
	
	$('#pos-form').on('submit', function() {
		var $form = $(this);
		yii.Product.add($form.serialize());

		var $grid = $form.find('div.input-grid');
		var settings = $grid.mdmInputGrid('data').settings;
		settings.counter = 0;
		$grid.find('tbody').html('');
		$grid.mdmInputGrid('newRow');
		$grid.find('tbody a[data-action="delete"]').hide();
		return false;
	});
<?php if (false): ?>
	</script>
<?php endif; ?>