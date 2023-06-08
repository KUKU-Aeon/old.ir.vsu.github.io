<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/accent.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Hydrogen theme',
        'type' => 'hidden',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 1',
                    'default' => '#439A86'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 2',
                    'default' => '#8F4DAE'
                ]
            ]
        ]
    ]
];
