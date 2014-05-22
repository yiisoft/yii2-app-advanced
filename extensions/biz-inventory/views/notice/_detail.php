<div class="col-lg-9" style="padding-left: 0px;">
    <div class="panel panel-info">
        <table id="detail-grid" class="table table-striped">
            <?php

            /**
             * 
             * @param TransferDtl $model
             * @param integer $index
             * @return string
             */
            function renderRow($model, $index)
            {
                ob_start();
                ob_implicit_flush(false);
                ?>
                <tr>
                    
                </tr>
                <?php
                return trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            }
            ?>
        </table>
    </div>
</div>
