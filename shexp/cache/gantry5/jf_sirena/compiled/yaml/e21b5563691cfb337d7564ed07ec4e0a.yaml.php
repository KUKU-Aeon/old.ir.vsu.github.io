<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/copyright.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Copyright',
        'description' => 'Display copyright information.',
        'type' => 'particle',
        'icon' => 'fa-copyright',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable the particle.',
                    'default' => true
                ],
                'date.start' => [
                    'type' => 'input.text',
                    'label' => 'Start Year',
                    'description' => 'Select the copyright start year.',
                    'default' => 'now'
                ],
                'date.end' => [
                    'type' => 'input.text',
                    'label' => 'End Year',
                    'description' => 'Select the copyright end year.',
                    'default' => 'now'
                ],
                'owner' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Copyright owner',
                    'description' => 'Add copyright owner name.'
                ]
            ]
        ]
    ]
];
