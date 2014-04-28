<?php 
Yii::setAlias('@mdm/test', __DIR__.'/test');
Yii::setAlias('@mdm/test/satu', __DIR__.'/test-satu');
Yii::setAlias('@mdm/test/dua', __DIR__.'/test-dua');
?>
<pre>
    <?php print_r(Yii::$aliases); ?>
______________________________________
<?php 
    echo '@mdm/test/satu/test = '.Yii::getAlias('@mdm/test/satu/test')."\n";
    echo '@mdm/test/satutest = '.Yii::getAlias('@mdm/test/satutest')."\n";
    echo '@mdm/test/satu/ok = '.Yii::getAlias('@mdm/test/ok')."\n";
    echo '@mdm/test/dua = '.Yii::getAlias('@mdm/test/dua')."\n";
    echo '@app/toolsgan = '.Yii::getAlias('@app/toolsgan')."\n";
    echo '@app/tools/gan = '.Yii::getAlias('@app/tools/gan')."\n";
?>
</pre>

