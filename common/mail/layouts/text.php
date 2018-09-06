<?php
/** @var \yii\web\View $this view component instance */
/** @var string $content main view render result */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
