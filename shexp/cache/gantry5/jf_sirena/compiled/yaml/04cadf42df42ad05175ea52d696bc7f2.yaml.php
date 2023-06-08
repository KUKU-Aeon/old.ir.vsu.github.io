<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/jf_color_base.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Base Styles',
        'description' => 'Base styles for the theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Background',
                    'default' => '#f5f5f5'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Color',
                    'default' => '#666666'
                ],
                'tag-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base HTML Tags Color',
                    'description' => 'Colors for HTML tags such as are - h1, h2, h3, h4, h5, h6, strong',
                    'default' => '#4d4d4d'
                ],
                'accent-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color',
                    'default' => '#673AB7'
                ],
                'body-font' => [
                    'type' => 'input.fonts',
                    'label' => 'Body Font',
                    'default' => 'family=Roboto:300,500,700,400'
                ]
            ]
        ]
    ]
];
