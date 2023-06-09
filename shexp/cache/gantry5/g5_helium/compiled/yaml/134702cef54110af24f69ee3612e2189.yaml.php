<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/media/gantry5/engines/nucleus/admin/blueprints/layout/container.yaml',
    'modified' => 1490269957,
    'data' => [
        'name' => 'Container',
        'description' => 'Layout container.',
        'type' => 'container',
        'form' => [
            'fields' => [
                'boxed' => [
                    'type' => 'select.selectize',
                    'label' => 'Layout',
                    'description' => 'Select the Layout container behavior. \'Inherit\' refers to Page Settings.',
                    'isset' => true,
                    'selectize' => [
                        'allowEmptyOption' => true
                    ],
                    'options' => [
                        '' => 'Inherit from Page Settings',
                        0 => 'Fullwidth (Boxed Content)',
                        2 => 'Fullwidth (Flushed Content)',
                        1 => 'Boxed',
                        3 => 'Remove Container'
                    ]
                ],
                'class' => [
                    'type' => 'input.selectize',
                    'label' => 'CSS Classes',
                    'description' => 'Enter CSS class names.',
                    'default' => NULL
                ],
                'extra' => [
                    'type' => 'collection.keyvalue',
                    'label' => 'Tag Attributes',
                    'description' => 'Extra Tag attributes.',
                    'key_placeholder' => 'Key (data-*, style, ...)',
                    'value_placeholder' => 'Value',
                    'exclude' => [
                        0 => 'class'
                    ]
                ]
            ]
        ]
    ]
];
