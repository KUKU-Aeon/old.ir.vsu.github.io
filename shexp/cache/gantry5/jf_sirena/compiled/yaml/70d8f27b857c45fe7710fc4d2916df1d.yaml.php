<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/jf_color_menu.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Menu Styles',
        'description' => 'Menu styles for the theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'toplevel-default' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Toplevel Item - Default',
                    'default' => 'rgba(255, 255, 255, 0.5)'
                ],
                'toplevel-active' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Toplevel Item - Active',
                    'default' => '#ffffff'
                ],
                'dropdown-bg' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Dropdown Background',
                    'default' => '#ffffff'
                ],
                'dropdown-item' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Dropdown Item',
                    'default' => '#673AB7'
                ],
                'dropdown-active' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Dropdown Active Item Background',
                    'default' => 'rgba(0, 0, 0, 0.05)'
                ],
                'dropdown-border' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Dropdown Column Border',
                    'default' => 'rgba(0, 0, 0, 0.07)'
                ]
            ]
        ]
    ]
];
