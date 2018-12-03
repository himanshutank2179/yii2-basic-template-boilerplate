<aside class="main-sidebar">

    <section class="sidebar">

        <?php
        $current_user_roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        $role = array_keys($current_user_roles)[0];
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'DashBoard', 'icon' => 'dashboard', 'url' => ['/dashboard/index']],
                    [
                        'label' => 'Location',
                        'icon' => 'location',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Location Add',
                                'icon' => 'dashboard',
                                'url' => ['/location/create'],
                            ],
                            ['label' => 'Location Manage', 'icon' => 'dashboard', 'url' => ['/location/index']],
                        ],
                        'visible' => $role == 'Super Admin' ? true : false
                    ],
                    [
                        'label' => 'Number',
                        'icon' => 'digit',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Add Number', 'icon' => 'dashboard', 'url' => ['/ticket-values/create']],
                            ['label' => 'Manage Number', 'icon' => 'dashboard', 'url' => ['/ticket-values/index']],
                        ],
                        'visible' => $role == 'Super Admin' ? true : false
                    ],
                    ['label' => 'Users', 'url' => ['/users/index'], 'visible' => $role == 'Super Admin' ? true : false],
                    [
                        'label' => 'RBAC',
                        'icon' => '  fa-mail-forward (alias)',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Admin', 'icon' => '', 'url' => ['/admin']],
                            ['label' => 'Routes', 'icon' => '', 'url' => ['/admin/route']],
                            ['label' => 'Permissions', 'icon' => '', 'url' => ['/admin/permission']],
                            ['label' => 'Roles', 'icon' => '', 'url' => ['/admin/role']],
                            ['label' => 'Assignments', 'icon' => '', 'url' => ['/admin/assignment']],

                        ],
                        'visible' => $role == 'Super Admin' ? true : false
                    ],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>

    </section>

</aside>
