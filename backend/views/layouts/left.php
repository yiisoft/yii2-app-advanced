<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username;?></p>

                <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                      ['label' => 'Menu', 'options' => ['class' => 'header']],


                    ['label' => 'Users', 'icon' => 'user', 'url' => ['/user']/*, 'visible' => Yii::$app->user->can('users')*/],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Access',
                        'icon' => 'gear',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Roles', 'icon' => 'file-code-o', 'url' => ['/permit/access/role']],
                            ['label' => 'Permissions', 'icon' => 'dashboard', 'url' => ['/permit/access/permission']],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
