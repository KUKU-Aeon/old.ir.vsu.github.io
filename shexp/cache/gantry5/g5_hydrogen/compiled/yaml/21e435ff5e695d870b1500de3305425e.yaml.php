<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/g5_hydrogen/layouts/3_column.yaml',
    'modified' => 1490269327,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/3-col.png'
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
                        'sidebar 20' => [
                            0 => 'position-sidebar'
                        ]
                    ],
                    1 => [
                        'main 60' => [
                            0 => 'position-breadcrumbs',
                            1 => 'system-messages',
                            2 => 'system-content'
                        ]
                    ],
                    2 => [
                        'aside 20' => [
                            0 => 'position-aside'
                        ]
                    ]
                ]
            ],
            '/footer/' => [
                0 => 'position-footer',
                1 => [
                    0 => 'copyright 40',
                    1 => 'spacer 30',
                    2 => 'branding 30'
                ]
            ],
            'offcanvas' => [
                0 => 'mobile-menu'
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
