<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/jf_cb_UC.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Community Builder Theme Styles',
        'description' => 'Community Builder Theme Styles',
        'type' => 'Community Builder Theme',
        'form' => [
            'fields' => [
                'accent_1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent',
                    'default' => '#673AB7',
                    'description' => 'Choose Main Accent Color (it contains all links, Menu Active Item color and so on...) | (Default is - \'#673AB7\')'
                ],
                'menu_bg_color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Menu Background',
                    'default' => '#673AB7',
                    'description' => 'Choose Menu Background Color | (Default is - \'#673AB7\')'
                ],
                'menu_text_color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Menu Text',
                    'default' => '#ffffff',
                    'description' => 'Choose Menu Text Color | (Default is - \'#ffffff\')'
                ],
                'menu_border_color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Active Menu Item Border',
                    'default' => '#ffffff',
                    'description' => 'Choose Active Menu Item Border Color | (Default is - \'#ffffff\')'
                ],
                'mobtool_bg' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Mobile Toolbar Background',
                    'default' => '#673AB7',
                    'description' => 'Choose Mobile Toolbar Background Color | (Default is - \'#673AB7\')'
                ],
                'mobtool_text' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Mobile Toolbar Text',
                    'default' => '#ffffff',
                    'description' => 'Choose Mobile Toolbar Text Color | (Default is - \'#ffffff\')'
                ],
                'mobtool_shadow' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Mobile Toolbar Shadow',
                    'default' => 'rgba(0, 0, 0, 0.25)',
                    'description' => 'Choose Mobile Toolbar Shadow Color | ( Default is - rgba(0, 0, 0, 0.25) )'
                ]
            ]
        ]
    ]
];
