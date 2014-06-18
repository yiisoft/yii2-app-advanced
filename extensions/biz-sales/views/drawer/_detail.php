<?php

/* @var $this yii\web\View */
?>
<table id="list-pos" style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Time</th>
            <th>Jumlah Item</th>
            <th>Total Item</th>
            <th>Total Nilai</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<?php

$biz = [
    'id_drawer' => $id_drawer,
    'config' => [
        'pushUrl' => \yii\helpers\Url::toRoute(['pos/save-pos']),
        'delay' => 1000,
        'pushInterval' => 10000,
        'showInterval' => 10000
    ]
];
biz\tools\BizDataAsset::register($this, $biz);
biz\sales\components\DrawerAsset::register($this);
