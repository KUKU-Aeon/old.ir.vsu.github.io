<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/logo.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF - Logo',
        'description' => 'Display a logo.',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable logo particles.',
                    'default' => true
                ],
                'tabs' => [
                    'type' => 'container.tabs',
                    'fields' => [
                        'tab_global' => [
                            'label' => 'Global',
                            'fields' => [
                                'jf_logo_type' => [
                                    'type' => 'select.select',
                                    'label' => 'Logo Type',
                                    'placeholder' => 'Select...',
                                    'default' => 'canvas',
                                    'options' => [
                                        'image' => 'Simple Image',
                                        'canvas' => 'Canvas'
                                    ]
                                ],
                                'url' => [
                                    'type' => 'input.text',
                                    'label' => 'Logo URL',
                                    'description' => 'URL for logo. Leave empty to go to home page.'
                                ],
                                'text' => [
                                    'type' => 'input.text',
                                    'label' => 'Title Description',
                                    'description' => 'Input logo description text.'
                                ],
                                'html' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML',
                                    'description' => 'Enter custom HTML into here.'
                                ],
                                'css' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom CSS Style',
                                    'description' => 'Enter CSS styles into here.'
                                ],
                                'class' => [
                                    'type' => 'input.selectize',
                                    'label' => 'CSS Classes',
                                    'description' => 'Set a specific CSS class for custom styling.'
                                ]
                            ]
                        ],
                        'tab_canvas' => [
                            'label' => 'Canvas',
                            'fields' => [
                                'c_jf_special_id' => [
                                    'type' => 'input.text',
                                    'label' => 'Unique ID',
                                    'description' => 'It must be unique for per particle. For example, you want to have two \'Canvas Logos\', then give first header logo an unique id \'jf_canvas_logo_id_1\'and give to another Canvas logo a different id, for example - \'jf_canvas_logo_id_2\'',
                                    'default' => 'jf_canvas_logo_id_1'
                                ],
                                'c_scale' => [
                                    'type' => 'select.select',
                                    'label' => 'Scale Size',
                                    'description' => 'Canvas Logo Original Size is 240x240. By Default we use 60% scale size.',
                                    'placeholder' => 'Select...',
                                    'default' => 6,
                                    'options' => [
                                        1 => '10%',
                                        2 => '20%',
                                        3 => '30%',
                                        4 => '50%',
                                        5 => '50%',
                                        6 => '60%',
                                        7 => '70%',
                                        8 => '80%',
                                        9 => '90%',
                                        99 => '100%'
                                    ]
                                ],
                                'c_bublescolor' => [
                                    'type' => 'input.colorpicker',
                                    'label' => 'Bubles Color',
                                    'default' => '#ffffff'
                                ],
                                'c_icon_type' => [
                                    'type' => 'select.select',
                                    'label' => 'Inside Icon Type',
                                    'description' => 'Choose \'Icon Type\' inside Bubles (By Default we use simple Image)',
                                    'placeholder' => 'Select...',
                                    'default' => 'img',
                                    'options' => [
                                        'text' => 'Simple Text',
                                        'img' => 'Image Icon'
                                    ]
                                ],
                                'c_icon_text' => [
                                    'type' => 'input.text',
                                    'label' => 'Type - Simple Text',
                                    'description' => 'We advice you to use only 1 word',
                                    'default' => 'S'
                                ],
                                'c_icon_color' => [
                                    'type' => 'input.colorpicker',
                                    'label' => 'Type - Simple Text Color',
                                    'default' => '#ffffff'
                                ],
                                'c_icon_font' => [
                                    'type' => 'input.text',
                                    'label' => 'Type - Simple Text Font',
                                    'description' => 'We use Google \'Roboto\' Font',
                                    'default' => 'Roboto'
                                ],
                                'c_icon_image' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Type - Image Icon',
                                    'description' => 'We advice you to use 480x480 \'.PNG\' image (NOTE! - make sure you have choosed relevant option in \'Inside Icon Type\' parameters)'
                                ]
                            ]
                        ],
                        'tab_default' => [
                            'label' => 'Simple Image',
                            'fields' => [
                                'image' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Image Logo',
                                    'description' => 'Select desired logo image.'
                                ],
                                'image_width' => [
                                    'type' => 'input.text',
                                    'label' => 'Image size - Width',
                                    'description' => 'Type image Width size in pixels, for example \'146px\'. Leave it empty if you want it automatically to be defined (Image size will depend on outer HTML tag width size, it means image width size will be 100% of outer HTML tag).'
                                ],
                                'image_height' => [
                                    'type' => 'input.text',
                                    'label' => 'Image size - Height',
                                    'description' => 'Type image Height size in pixels, for example \'146px\'. Leave it empty if you want it automatically to be defined (Image size will depend on outer HTML tag width size, it means image width size will be 100% of outer HTML tag, and the Height size will be defined automatically).'
                                ],
                                'image_width_sticky' => [
                                    'type' => 'input.text',
                                    'label' => 'Image size - Width (Sticky Header)',
                                    'description' => 'Type image Width size in pixels when the \'Sticky Header Feature\' is Enabled, for example \'69px\'. Leave it empty if you want it automatically to be defined (Image size will depend on outer HTML tag width size, it means image width size will be 100% of outer HTML tag).'
                                ],
                                'image_height_sticky' => [
                                    'type' => 'input.text',
                                    'label' => 'Image size - Height (Sticky Header)',
                                    'description' => 'Type image Height size in pixels when the \'Sticky Header Feature\' is Enabled, for example \'69px\'. Leave it empty if you want it automatically to be defined (Image size will depend on outer HTML tag width size, it means image width size will be 100% of outer HTML tag, and the Height size will be defined automatically).'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
