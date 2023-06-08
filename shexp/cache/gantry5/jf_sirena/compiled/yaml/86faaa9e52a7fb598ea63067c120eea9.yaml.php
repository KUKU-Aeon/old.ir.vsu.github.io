<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_tabs.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Container Tabs',
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
                                'contentW' => [
                                    'type' => 'select.select',
                                    'label' => 'Box Width',
                                    'description' => 'Choose Width type, \'FULL 100%\' or \'Default Gantry\'',
                                    'placeholder' => 'Select...',
                                    'default' => 'default',
                                    'options' => [
                                        'full' => 'Full Width',
                                        'default' => 'Default Gantry'
                                    ]
                                ],
                                'padding' => [
                                    'type' => 'input.text',
                                    'label' => 'Box Height/Padding',
                                    'description' => 'Type CSS \'Top and Bottom\' padding value to regulate the height of particle',
                                    'default' => '150px 0'
                                ],
                                'textAl' => [
                                    'type' => 'select.select',
                                    'label' => 'Box Text Align',
                                    'description' => 'Choose Text Align Direction',
                                    'placeholder' => 'Select...',
                                    'default' => 'center',
                                    'options' => [
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right'
                                    ]
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
                        'tab_content' => [
                            'label' => 'Content',
                            'fields' => [
                                'html_before' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML Before the "Content List"',
                                    'description' => 'Enter custom HTML into here.'
                                ],
                                'colorclass' => [
                                    'type' => 'input.text',
                                    'label' => 'Color Class',
                                    'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                    'default' => 'deep-purple'
                                ],
                                'dark' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Dark Color Theme',
                                    'description' => 'It enables tab filled color theme',
                                    'default' => false
                                ],
                                'shadow' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Shadow Borders',
                                    'description' => 'It enables tab Shadow Borders',
                                    'default' => false
                                ],
                                'tabTextAl' => [
                                    'type' => 'select.select',
                                    'label' => 'Tab Text Align',
                                    'description' => 'Choose Tab Text Direction',
                                    'placeholder' => 'Select...',
                                    'default' => 'left',
                                    'options' => [
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right'
                                    ]
                                ],
                                'tabContTextAl' => [
                                    'type' => 'select.select',
                                    'label' => 'Tab Content Text Align',
                                    'description' => 'Choose Tab Content Text Direction',
                                    'placeholder' => 'Select...',
                                    'default' => 'left',
                                    'options' => [
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right'
                                    ]
                                ],
                                'items' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Tabs',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        '_info' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'For using it make sure that you have enabled \'Tabs\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Tab Class',
                                            'description' => 'You can add custom CSS classes, for example wave classes - \'jf_waves_dark_10\' (For checking all available waves classes, please check \'Elements\' pages).',
                                            'default' => 'jf_waves_dark_10'
                                        ],
                                        '.special_id' => [
                                            'type' => 'input.text',
                                            'label' => 'Unique ID',
                                            'description' => 'Type Unique Tab ID text (NOTE! - it must be unique for each Tab item)'
                                        ],
                                        '.tab_css' => [
                                            'type' => 'input.text',
                                            'label' => 'Tab CSS style',
                                            'description' => 'You can add custom CSS styles'
                                        ],
                                        '.tab_name' => [
                                            'type' => 'input.text',
                                            'label' => 'Tab Name',
                                            'description' => 'Type name of a tab'
                                        ],
                                        '.html_content' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML Content of Tab',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'html_after' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML After the "Content List"',
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
