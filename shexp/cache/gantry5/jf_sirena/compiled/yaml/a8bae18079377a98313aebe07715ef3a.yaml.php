<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/mobile-menu.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'Mobile Menu',
        'description' => 'Renders the mobile menu container for the offcanvas section.',
        'icon' => 'fa-ellipsis-v',
        'enabled' => false,
        'type' => 'hidden',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable spacer.',
                    'default' => true
                ],
                '_note' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => '<p>This Particle is the container target where, on Mobile, the Menu will be injected.</p><p>Please note that this Particle <strong>must</strong> be unique in the Layout and positioned in the Offcanvas section. You will also need a Menu present in the Layout.</p>'
                ]
            ]
        ]
    ]
];
