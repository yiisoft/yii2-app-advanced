<?php

use yii\web\View;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;

/* @var $this View */
/* @var $content string */

?>
<?php $this->beginContent('@common/views/layouts/main.php') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <?= Alert::widget() ?>
    </div>

    <div class="d-flex justify-content-center">
        <div class="login-box align-self-center">
            <div class="login-logo">
                <h1 class="text-dark"><?= $this->title ?></h1>
            </div>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent() ?>
