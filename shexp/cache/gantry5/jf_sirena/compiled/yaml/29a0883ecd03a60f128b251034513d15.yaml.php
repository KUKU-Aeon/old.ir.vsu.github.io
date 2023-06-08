<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/gantry/theme.yaml',
    'modified' => 1490205216,
    'data' => [
        'details' => [
            'name' => 'Sirena',
            'version' => '1.1',
            'icon' => 'paper-plane',
            'date' => '20.09.16',
            'author' => [
                'name' => 'JoomForest.com',
                'email' => 'support@joomforest.com',
                'link' => 'http://www.joomforest.com'
            ],
            'documentation' => [
                'link' => 'http://docs.gantry.org/gantry5'
            ],
            'support' => [
                'link' => 'https://gitter.im/gantry/gantry5'
            ],
            'copyright' => '(C) 2011 - 2016 JoomForest.com, All rights reserved.',
            'license' => 'GPLv2',
            'description' => 'Sirena Theme',
            'images' => [
                'thumbnail' => 'template_preview.png',
                'preview' => 'template_preview.png'
            ]
        ],
        'configuration' => [
            'gantry' => [
                'platform' => 'joomla',
                'engine' => 'nucleus'
            ],
            'theme' => [
                'parent' => 'jf_sirena',
                'base' => 'gantry-theme://common',
                'file' => 'gantry-theme://include/theme.php',
                'class' => '\\Gantry\\Framework\\Theme'
            ],
            'css' => [
                'compiler' => '\\Gantry\\Component\\Stylesheet\\ScssCompiler',
                'paths' => [
                    0 => 'gantry-theme://scss',
                    1 => 'gantry-engine://scss',
                    2 => 'gantry-theme://jf/assets/scss'
                ],
                'files' => [
                    0 => 'hydrogen',
                    1 => 'hydrogen-joomla',
                    2 => 'custom',
                    3 => 'jf_template'
                ],
                'persistent' => [
                    0 => 'hydrogen',
                    1 => 'jf_template'
                ],
                'overrides' => [
                    0 => 'hydrogen-joomla',
                    1 => 'custom'
                ]
            ],
            'block-variations' => [
                'Box Variations' => [
                    'box-white' => 'White',
                    'box-primary' => 'Primary',
                    'box-info' => 'Info',
                    'box-success' => 'Success',
                    'box-warning' => 'Warning',
                    'box-danger' => 'Danger',
                    'box-red' => 'Red',
                    'box-pink' => 'Pink',
                    'box-purple' => 'Purple',
                    'box-deep-purple' => 'Deep-Purple',
                    'box-indigo' => 'Indigo',
                    'box-blue' => 'Blue',
                    'box-light-blue' => 'Light-Blue',
                    'box-cyan' => 'Cyan',
                    'box-teal' => 'Teal',
                    'box-green' => 'Green',
                    'box-light-green' => 'Light-Green',
                    'box-lime' => 'Lime',
                    'box-yellow' => 'Yellow',
                    'box-amber' => 'Amber',
                    'box-orange' => 'Orange',
                    'box-deep-orange' => 'Deep-Orange',
                    'box-brown' => 'Brown',
                    'box-grey' => 'Grey',
                    'box-blue-grey' => 'Blue-Grey',
                    'box-dark-grey' => 'Dark-Grey',
                    'box-nobg' => 'No Background'
                ],
                'Effects' => [
                    'box-noshadow' => 'No Shadow',
                    'box-shadow-1' => 'Shadow 1',
                    'box-shadow-2' => 'Shadow 2',
                    'box-shadow-3' => 'Shadow 3',
                    'box-shadow-4' => 'Shadow 4',
                    'box-shadow-5' => 'Shadow 5',
                    'box-shadow-6' => 'Shadow 6'
                ],
                'Utility' => [
                    'box-align-left' => 'Align Left',
                    'box-align-center' => 'Align Center',
                    'box-align-right' => 'Align Right',
                    'box-no-padding' => 'No Padding',
                    'box-no-margin' => 'No Margin'
                ]
            ],
            'dependencies' => [
                'gantry' => '5.3.2'
            ]
        ],
        'admin' => [
            'styles' => [
                'core' => [
                    0 => 'jf_color_base',
                    1 => 'jf_color_menu'
                ],
                'section' => [
                    0 => 'jf_color_s_footer',
                    1 => 'jf_color_s_footer_bottom',
                    2 => 'jf_color_s_header',
                    3 => 'jf_color_s_main',
                    4 => 'jf_color_s_p_search'
                ],
                'configuration' => [
                    0 => 'breakpoints'
                ]
            ]
        ]
    ]
];
