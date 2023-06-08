<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/g5_hydrogen/layouts/3_column_-_right.yaml',
    'modified' => 1490269327,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/3-col-right.png'
        ],
        'layout' => [
            '/header/' => [
                0 => [
                    0 => 'logo 30',
                    1 => 'position-header 70'
                ]
            ],
            '/navigation/' => [
                0 => 'menu'
            ],
            '/container-main/' => [
                0 => [
                    0 => [
                        'main 60' => [
                            0 => 'position-breadcrumbs',
                            1 => 'system-messages',
                            2 => 'pagecontent'
                        ]
                    ],
                    1 => [
                        'aside 20' => [
                            0 => 'position-aside'
                        ]
                    ],
                    2 => [
                        'sidebar 20' => [
                            0 => 'position-sidebar'
                        ]
                    ]
                ]
            ],
            '/footer/' => [
                0 => 'position-footer',
                1 => [
                    0 => 'particle-copyright 40',
                    1 => 'spacer 30',
                    2 => 'particle-branding 30'
                ]
            ],
            'offcanvas' => [
                0 => 'particle-mobile-menu'
            ]
        ],
        'structure' => [
            'sidebar' => [
                'subtype' => 'aside',
                'block' => [
                    'fixed' => 1
                ]
            ],
            'aside' => [
                'block' => [
                    'fixed' => 1
                ]
            ]
        ]
    ]
];
