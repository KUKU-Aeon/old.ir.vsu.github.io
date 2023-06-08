<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/blueprints/styles/jf_color_s_footer_bottom.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Footer-Bottom Colors',
        'description' => 'Footer-Bottom colors for the theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#673AB7'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => 'rgba(255, 255, 255, 0.50)'
                ],
                'link-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Link',
                    'default' => '#ffffff'
                ],
                'border-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Top Border',
                    'default' => 'rgba(255, 255, 255, 0.15)'
                ]
            ]
        ]
    ]
];
