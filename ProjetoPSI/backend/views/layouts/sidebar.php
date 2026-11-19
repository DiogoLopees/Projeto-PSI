<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                       ['label' => 'Utilizadores', 'url' => ['user/index'], 'icon' => 'home'],
                    [
                        'label' => 'Páginas Iniciais',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Página Ativa', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Página Inativa', 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Link Simples', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">Novo</span>'],
                    ['label' => 'FORNECIDO PELO YII2', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'EXEMPLO MULTINÍVEL', 'header' => true],
                    ['label' => 'Nível 1'],
                    [
                        'label' => 'Nível 1',
                        'items' => [
                            ['label' => 'Nível 2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Nível 2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Nível 3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Nível 3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Nível 3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Nível 2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Nível 1'],
                    ['label' => 'ETIQUETAS', 'header' => true],
                    ['label' => 'Importante', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Aviso', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informativo', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>