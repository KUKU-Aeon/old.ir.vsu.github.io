<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_bubbles_slider.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF - Bubbles Slider',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable to the particles.',
                    'default' => true
                ],
                'tabs' => [
                    'type' => 'container.tabs',
                    'fields' => [
                        'tab_global' => [
                            'label' => 'Global',
                            'fields' => [
                                'unique_id' => [
                                    'type' => 'input.text',
                                    'label' => 'Unique ID',
                                    'description' => 'Type unique ID. The ID must be unique (for example if you use this particle twice, then unique IDs must be different on each particle)',
                                    'default' => 'jf_bubbles_slider_1'
                                ],
                                'box_full_height' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Make 100% Height',
                                    'description' => 'Enable this option if you want the particle\'s height to be the window height size, or use custom value below in option',
                                    'default' => true
                                ],
                                'box_custom_height' => [
                                    'type' => 'input.text',
                                    'label' => 'Custom Height',
                                    'description' => 'Type particle\'s custom height CSS value, for example \'600px\'. NOTE! - This option will not work if you have enabled option \'Make 100% Height\'',
                                    'default' => '600px'
                                ],
                                'bg_bubles' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Background Bubbles',
                                    'default' => true
                                ],
                                'fireworks' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Background Fireworks',
                                    'default' => true
                                ],
                                'bg_options' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Box Background',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        'tabs' => [
                                            'type' => 'container.tabs',
                                            'fields' => [
                                                'tab_bg_global' => [
                                                    'label' => 'Global',
                                                    'fields' => [
                                                        '_info_bg_type' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Choose the "Background Type" - after choosing it don\'t forget to move to it\'s relevant tab section above.'
                                                        ],
                                                        '.bg_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Background Type',
                                                            'description' => 'Choose Background Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'color',
                                                            'options' => [
                                                                'color' => 'Type 1 - Backrgound Color',
                                                                'image' => 'Type 2 - Background Image',
                                                                'parallax_img' => 'Type 3 - Parallax Image',
                                                                'parallax_vid' => 'Type 4 - Parallax Video'
                                                            ]
                                                        ],
                                                        '.lazyload' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Lazy Load Images',
                                                            'description' => 'This option will lazy load background images. NOTE! - make sure that you have enabled \'Images Lazy Load\' feature in \'JF Features\' Atom in \'Page Settings\'.',
                                                            'default' => true
                                                        ],
                                                        '_info_parallax_global' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Parallax Global Options - For using it make sure that you have enabled \'Parallax Sections\' in \'JF Elements\' particle'
                                                        ],
                                                        '.maskColor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Mask Overlay Color',
                                                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                                                            'default' => '#000000'
                                                        ],
                                                        '.maskOpacity' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Mask Overlay Opacity',
                                                            'description' => 'Choose Mask Overlay Opacity (0 value will disable the \'Mask\')',
                                                            'placeholder' => 'Select...',
                                                            'default' => 10,
                                                            'options' => [
                                                                0 => '0%',
                                                                10 => '10%',
                                                                20 => '20%',
                                                                30 => '30%',
                                                                40 => '40%',
                                                                50 => '50%',
                                                                60 => '60%',
                                                                70 => '70%',
                                                                80 => '80%',
                                                                90 => '90%',
                                                                100 => '100%'
                                                            ]
                                                        ],
                                                        '.scrolling' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Content Scrolling',
                                                            'description' => 'Enable/Disable \'Content Scrolling\'',
                                                            'default' => true
                                                        ],
                                                        '.type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Choose Style',
                                                            'description' => 'Choose Parallax Type. If you are using it as header, then use \'Cover\' Option',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'default',
                                                            'options' => [
                                                                'default' => 'Default',
                                                                'cover' => 'Cover'
                                                            ]
                                                        ]
                                                    ]
                                                ],
                                                'tab_bg_type1' => [
                                                    'label' => 'Type 1 (Backrgound Color)',
                                                    'fields' => [
                                                        '.bgColor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Background Color',
                                                            'description' => 'Background Color of particle.',
                                                            'default' => '#eeeeee'
                                                        ]
                                                    ]
                                                ],
                                                'tab_bg_type2' => [
                                                    'label' => 'Type 2 (Background Image)',
                                                    'fields' => [
                                                        '.cover_src' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Cover Image',
                                                            'description' => 'Select desired image.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_bg_type3' => [
                                                    'label' => 'Type 3 (Parallax Image)',
                                                    'fields' => [
                                                        '_info_parallax_image' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Parallax Background Image Options - For using it make sure that you have enabled \'Parallax Sections\' in \'JF Elements\' particle'
                                                        ],
                                                        '.parallax_src' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Parallax BG Image',
                                                            'description' => 'Select desired image.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_bg_type4' => [
                                                    'label' => 'Type 4 (Parallax Video)',
                                                    'fields' => [
                                                        '_info_parallax_video' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Parallax Background Video Options - For using it make sure that you have enabled \'Parallax Sections\' in \'JF Elements\' particle'
                                                        ],
                                                        '.controls' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Video Controls',
                                                            'description' => 'Enable/Disable \'Video Control\' Buttons',
                                                            'default' => true
                                                        ],
                                                        '.loop' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Video Loop',
                                                            'description' => 'Enable/Disable \'Video Loop\'',
                                                            'default' => true
                                                        ],
                                                        '.muted' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Video Mute',
                                                            'description' => 'Enable/Disable \'Video Mute\'',
                                                            'default' => true
                                                        ],
                                                        '.video_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Background Video Type',
                                                            'description' => 'Choose Background Video Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'vimeo',
                                                            'options' => [
                                                                'vimeo' => 'Vimeo.com',
                                                                'youtube' => 'Youtube.com',
                                                                'self' => 'Self Hosted'
                                                            ]
                                                        ],
                                                        '_info_vimeo' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Vimeo.com Video Options'
                                                        ],
                                                        '.vimeo_id' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Vimeo Video ID',
                                                            'description' => 'Type Vimeo video ID, for example - \'62823990\''
                                                        ],
                                                        '_info_youtube' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Youtube.com Video Options'
                                                        ],
                                                        '.youtube_id' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Youtube Video ID',
                                                            'description' => 'Type Youtube video ID, for example - \'rrT6v5sOwJg\''
                                                        ],
                                                        '_info_self' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Self Hosted Video Options'
                                                        ],
                                                        '.url' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Self Hosted Video Folder URL',
                                                            'description' => 'Type your video destination folder URL, without domain name, for example like this - \'images/jf/elements/parallax/\'',
                                                            'default' => 'images/jf/videos/'
                                                        ],
                                                        '.vidname' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Self Hosted Video Name',
                                                            'description' => 'Type your video file name without \'.extension\' type, for example - \'dreamscapes\'',
                                                            'default' => 'dreamscapes'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'tab_bgslider' => [
                            'label' => 'Background Slider',
                            'fields' => [
                                'bgslider' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Slider',
                                    'description' => 'Enable Disable Background Slider',
                                    'default' => true
                                ],
                                'image_lazyload' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Lazyload',
                                    'description' => 'Enable/Disable Lazyload Images',
                                    'default' => true
                                ],
                                'bgslider_speed' => [
                                    'type' => 'input.text',
                                    'label' => 'Speed',
                                    'description' => 'Type Slider speed, for example \'2000\' which equals to 2 seconds',
                                    'default' => 2000
                                ],
                                'bgslider_timeout' => [
                                    'type' => 'input.text',
                                    'label' => 'Timeout',
                                    'description' => 'Type Slider timeout between slide images, for example \'6000\' which equals to 6 seconds',
                                    'default' => 6000
                                ],
                                'bgslider_items' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Slide Items',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        'item_img' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Slide Item Image',
                                            'description' => 'Select desired image.'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'tab_content' => [
                            'label' => 'Content',
                            'fields' => [
                                'html_before' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML Before the "Content List"',
                                    'description' => 'Enter custom HTML into here.'
                                ],
                                'textslider' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Text Slider',
                                    'description' => 'Enable Disable Text Slider',
                                    'default' => true
                                ],
                                'textslider_items' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Text Slider Items',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        'text_html' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Custom HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'html_after' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML After the "Content List"',
                                    'description' => 'Enter custom HTML into here.'
                                ],
                                'html_footer' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Footer Custom HTML (Logos)',
                                    'description' => 'Enter custom HTML into here.'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
