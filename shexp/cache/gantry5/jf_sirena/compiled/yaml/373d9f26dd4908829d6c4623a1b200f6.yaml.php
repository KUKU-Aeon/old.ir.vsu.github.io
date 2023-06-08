<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/jf_color_s_header.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Header Colors',
        'description' => 'Header colors for the theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#673AB7'
                ],
                'shadow' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Header Shadow',
                    'default' => 'rgba(0, 0, 0, 0.25)'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#ffffff'
                ]
            ]
        ]
    ]
];
