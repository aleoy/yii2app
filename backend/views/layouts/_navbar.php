<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                // $menuItems[] = [
                //     'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                //     'url' => ['/site/logout'],
                //     'linkOptions' => ['data-method' => 'post']
                // ];
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Location',
                     'items' => [
                        '<li class="dropdown-header">Country</li>',
                        ['label' => 'Create', 'url' => Url::to(['/location/country/create'])],
                        ['label' => 'Search', 'url' => Url::to(['/location/country/index'])],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">City</li>',
                        ['label' => 'Create', 'url' => Url::to(['/location/city/create'])],
                        ['label' => 'Search', 'url' => Url::to(['/location/city/index'])],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">District</li>',
                        ['label' => 'Create', 'url' => Url::to(['/location/district/create'])],
                        ['label' => 'Search', 'url' => Url::to(['/location/district/index'])],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Neighborhood</li>',
                        ['label' => 'Create', 'url' => '#'],
                        ['label' => 'Search', 'url' => '#'],
                    ]],
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>