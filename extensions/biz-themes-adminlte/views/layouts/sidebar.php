<?php
use biz\adminlte\SideMenu;
?>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= $baseurl ?>/img/avatar3.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, Jane</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
<!--    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php
    echo SideMenu::widget(
            [
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['/site/index'], 'icon'=>'fa fa-dashboard'],
                    ['label' => 'Admin Manager', 'icon'=>'fa fa-wrench',
                        'items'=>[
                            ['label'=>'Users', 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Access Control', 'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Master', 'icon'=>'fa fa-gears',
                        'items'=>[
                            ['label'=>'Organizaion', 'url' => ['/master/orgn'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Branch', 'url' => ['/master/branch'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Warehouse', 'url' => ['/master/warehouse'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Product', 'url' => ['/master/product'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Customer', 'url' => ['/master/customer'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Supplier', 'url' => ['/master/supplier'],'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Purchase', 'icon'=>'fa fa-shopping-cart',
                        'items'=>[
                            ['label'=>'Purchase Order', 'url' => ['/purchase/purchase'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Product Pricing', 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Cogs Management', 'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Inventory', 'url' => ['/site/about'], 'icon'=>'fa fa-th-large',
                        'items'=>[
                            ['label'=>'Transfer', 'url' => ['/inventory/transfer'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Receipt', 'url' => ['/inventory/receive'],'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Transfer Notes', 'url' => ['/inventory/notice'], 'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Sales', 'url' => ['/site/about'], 'icon'=>'fa fa-barcode',
                        'items'=>[
                            ['label'=>'Retail', 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Grosir', 'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Accounting', 'url' => ['/site/about'], 'icon'=>'fa fa-money',
                        'items'=>[
                            ['label'=>'Periode', 'url' => ['/accounting/acc-periode'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'COA', 'url' => ['/accounting/coa'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Entry Sheet', 'url' => ['/accounting/entri-sheet'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'GL Entry', 'url' => ['/accounting/entri-gl'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Cash In', 'url' => ['/accounting/about'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Cash Out', 'url' => ['/accounting/about'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Bank In', 'url' => ['/accounting/about'], 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'Bank Out', 'url' => ['/accounting/about'], 'icon'=>'fa fa-angle-double-right'],
                        ]],
                    ['label' => 'Reports', 'url' => ['/site/about'], 'icon'=>'fa fa-files-o',
                        'items'=>[
                            ['label'=>'test', 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'test2', 'icon'=>'fa fa-angle-double-right'],
                            ['label'=>'test3', 'icon'=>'fa fa-angle-double-right'],
                        ]],
//                    \Yii::$app->user->isGuest ?
//                            ['label' => 'Login', 'url' => ['/site/login']] :
//                            ['label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
//                        'url' => ['/site/logout'],
//                        'linkOptions' => ['data-method' => 'post']],
                ],
    ]);
    ?>
    
    <!--    <ul class="sidebar-menu">
            <li class="active">
                <a href="index.html">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="badge pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="pages/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="badge pull-right bg-yellow">12</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                    <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                    <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                    <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                    <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                    <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                    <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                </ul>
            </li>
        </ul>-->
</section>
<!-- /.sidebar -->

