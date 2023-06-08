<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/custom.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Custom HTML',
        'description' => 'Display custom HTML block.',
        'type' => 'particle',
        'icon' => 'fa-code',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable the particle.',
                    'default' => true
                ],
                'html' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Custom HTML',
                    'description' => 'Enter custom HTML into here.',
                    'overridable' => false
                ],
                'twig' => [
                    'type' => 'input.checkbox',
                    'label' => 'Process Twig',
                    'description' => 'Enable Twig template processing in the content. Twig will be processed before shortcodes.'
                ],
                'filter' => [
                    'type' => 'input.checkbox',
                    'label' => 'Process shortcodes',
                    'description' => 'Enable shortcode processing / filtering in the content.'
                ]
            ]
        ]
    ]
];
