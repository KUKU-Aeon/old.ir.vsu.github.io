<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_stat.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Statistics',
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
                                'style' => [
                                    'type' => 'select.select',
                                    'label' => 'Choose Content Style',
                                    'description' => 'Choose one of Content style',
                                    'placeholder' => 'Select...',
                                    'default' => 'style_1',
                                    'options' => [
                                        'style_1' => '1 - Counter',
                                        'style_2' => '2 - Progress Bar',
                                        'style_3' => '3 - Progress Pie',
                                        'style_4' => '4 - Charts',
                                        'style_5' => '5 - Graphs'
                                    ]
                                ],
                                'style_1' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Style 1 - Counter',
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
                                            'content' => 'For using it make sure that you have enabled \'Counters\' in \'JF Elements\' particle'
                                        ],
                                        '.grid' => [
                                            'type' => 'select.select',
                                            'label' => 'Choose Grid Width',
                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                            'placeholder' => 'Select...',
                                            'default' => 3,
                                            'options' => [
                                                1 => 1,
                                                2 => 2,
                                                3 => 3,
                                                4 => 4,
                                                5 => 5,
                                                6 => 6,
                                                7 => 7,
                                                8 => 8,
                                                9 => 9,
                                                10 => 10,
                                                11 => 11,
                                                12 => 12
                                            ]
                                        ],
                                        '.grid_last' => [
                                            'type' => 'select.select',
                                            'label' => 'Last Grid On line?',
                                            'description' => 'Is it the last grid box in Column Row?',
                                            'placeholder' => 'Select...',
                                            'default' => false,
                                            'options' => [
                                                0 => 'No',
                                                1 => 'Yes'
                                            ]
                                        ],
                                        '.icon_type' => [
                                            'type' => 'select.select',
                                            'label' => 'Icon',
                                            'description' => 'Choose Icon Type',
                                            'placeholder' => 'Select...',
                                            'default' => false,
                                            'options' => [
                                                'html' => 'HTML Font Icon',
                                                'image' => 'Image',
                                                0 => 'Disable'
                                            ]
                                        ],
                                        '.image_icon' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Icon Image',
                                            'description' => 'Select desired image. For using it make sure you have choosed \'Image\' option above in \'Icon Type\' parameter'
                                        ],
                                        '.html_icon' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML - Icon',
                                            'description' => 'Enter custom HTML into here.',
                                            'default' => '<i class="material-icons" style="font-size:44px">headset_mic</i>'
                                        ],
                                        '.counter_type' => [
                                            'type' => 'select.select',
                                            'label' => 'Counter Type',
                                            'description' => 'Choose Counter Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'default',
                                            'options' => [
                                                'default' => 'Default',
                                                'vertical' => 'Vertical'
                                            ]
                                        ],
                                        '.counter_weight' => [
                                            'type' => 'select.select',
                                            'label' => 'Counter Weight',
                                            'description' => 'Choose Counter Weight',
                                            'placeholder' => 'Select...',
                                            'default' => 300,
                                            'options' => [
                                                300 => 300,
                                                400 => 400,
                                                500 => 500,
                                                700 => 700
                                            ]
                                        ],
                                        '.counter_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'Counter Color',
                                            'description' => 'Counter Color of particle.',
                                            'default' => '#6639B6'
                                        ],
                                        '.counter_fontsize' => [
                                            'type' => 'input.text',
                                            'label' => 'Counter Font Size',
                                            'description' => 'Type CSS font size',
                                            'default' => '54px'
                                        ],
                                        '.counter_num' => [
                                            'type' => 'input.text',
                                            'label' => 'Counter Number',
                                            'description' => 'Type number',
                                            'default' => '1273'
                                        ],
                                        '.counter_sep' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Counter Separator',
                                            'description' => 'Enable/Disable Counter Separator',
                                            'placeholder' => 'Select...',
                                            'default' => true
                                        ],
                                        '.counter_sep_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'Counter Separator Color',
                                            'default' => '#6639B6'
                                        ],
                                        '.html_descr' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML Description',
                                            'description' => 'Enter custom HTML into here.',
                                            'default' => ''
                                        ],
                                        '.html_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'HTML Color',
                                            'default' => '#666666'
                                        ]
                                    ]
                                ],
                                'style_2' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Style 2 - Progress Bar',
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
                                            'content' => 'For using it make sure that you have enabled \'Progress Bar\' in \'JF Elements\' particle'
                                        ],
                                        '.grid' => [
                                            'type' => 'select.select',
                                            'label' => 'Choose Grid Width',
                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                            'placeholder' => 'Select...',
                                            'default' => 3,
                                            'options' => [
                                                1 => 1,
                                                2 => 2,
                                                3 => 3,
                                                4 => 4,
                                                5 => 5,
                                                6 => 6,
                                                7 => 7,
                                                8 => 8,
                                                9 => 9,
                                                10 => 10,
                                                11 => 11,
                                                12 => 12
                                            ]
                                        ],
                                        '.grid_last' => [
                                            'type' => 'select.select',
                                            'label' => 'Last Grid On line?',
                                            'description' => 'Is it the last grid box in Column Row?',
                                            'placeholder' => 'Select...',
                                            'default' => false,
                                            'options' => [
                                                0 => 'No',
                                                1 => 'Yes'
                                            ]
                                        ],
                                        '.textAl' => [
                                            'type' => 'select.select',
                                            'label' => 'Text Align',
                                            'description' => 'Choose Text Align Direction',
                                            'placeholder' => 'Select...',
                                            'default' => 'left',
                                            'options' => [
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right'
                                            ]
                                        ],
                                        '.css_style' => [
                                            'type' => 'input.text',
                                            'label' => 'CSS styles',
                                            'description' => 'Apply CSS styles for colum, for example - padding:20px'
                                        ],
                                        '.html_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML - Title',
                                            'description' => 'Enter custom HTML into here.',
                                            'default' => ''
                                        ],
                                        '.html_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'HTML Title Color',
                                            'default' => '#666666'
                                        ],
                                        '.bar_size' => [
                                            'type' => 'select.select',
                                            'label' => 'Bar Width Size',
                                            'description' => 'Choose Bar Width Size',
                                            'placeholder' => 'Select...',
                                            'default' => 'x2',
                                            'options' => [
                                                'x2' => 'x2',
                                                'x4' => 'x4',
                                                'x6' => 'x6',
                                                'x8' => 'x8',
                                                'x10' => 'x10'
                                            ]
                                        ],
                                        '.bar_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'Bar Color',
                                            'default' => '#6639B6'
                                        ],
                                        '.bar_load_from' => [
                                            'type' => 'input.text',
                                            'label' => 'Load From %',
                                            'description' => 'Type % value which will load a bar from x%',
                                            'default' => 0
                                        ],
                                        '.bar_load_to' => [
                                            'type' => 'input.text',
                                            'label' => 'Load To %',
                                            'description' => 'Type % value which will load a bar to x%',
                                            'default' => 85
                                        ],
                                        '.bar_loadspeed' => [
                                            'type' => 'input.text',
                                            'label' => 'Load Speed',
                                            'description' => 'Type load speed in milliseconds',
                                            'default' => 1100
                                        ]
                                    ]
                                ],
                                'style_3' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Style 3 - Progress Pies',
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
                                            'content' => 'For using it make sure that you have enabled \'Pies\' in \'JF Elements\' particle'
                                        ],
                                        '.grid' => [
                                            'type' => 'select.select',
                                            'label' => 'Choose Grid Width',
                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                            'placeholder' => 'Select...',
                                            'default' => 3,
                                            'options' => [
                                                1 => 1,
                                                2 => 2,
                                                3 => 3,
                                                4 => 4,
                                                5 => 5,
                                                6 => 6,
                                                7 => 7,
                                                8 => 8,
                                                9 => 9,
                                                10 => 10,
                                                11 => 11,
                                                12 => 12
                                            ]
                                        ],
                                        '.grid_last' => [
                                            'type' => 'select.select',
                                            'label' => 'Last Grid On line?',
                                            'description' => 'Is it the last grid box in Column Row?',
                                            'placeholder' => 'Select...',
                                            'default' => false,
                                            'options' => [
                                                0 => 'No',
                                                1 => 'Yes'
                                            ]
                                        ],
                                        '.textAl' => [
                                            'type' => 'select.select',
                                            'label' => 'Text Align',
                                            'description' => 'Choose Text Align Direction',
                                            'placeholder' => 'Select...',
                                            'default' => 'center',
                                            'options' => [
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right'
                                            ]
                                        ],
                                        '.bar_color' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'Circle Bar Color',
                                            'default' => '#6639B6'
                                        ],
                                        '.circle_size' => [
                                            'type' => 'input.text',
                                            'label' => 'Cicle Size',
                                            'description' => 'Type circle size in pixels, for example \'150\'',
                                            'default' => 150
                                        ],
                                        '.circle_percent' => [
                                            'type' => 'input.text',
                                            'label' => 'Cicle Fill %',
                                            'description' => 'Type circle fill percent number, for example \'85\' will fill to 85%',
                                            'default' => 85
                                        ],
                                        '.circle_bar_width' => [
                                            'type' => 'input.text',
                                            'label' => 'Cicle Bar Width',
                                            'description' => 'Type circle bar width number, for example \'2\' will be 2px size',
                                            'default' => 2
                                        ],
                                        '.bar_fillspeed' => [
                                            'type' => 'input.text',
                                            'label' => 'Fill Speed',
                                            'description' => 'Type fill speed in milliseconds',
                                            'default' => 2000
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-notice',
                                            'content' => 'Choose Content Type'
                                        ],
                                        '.content_type' => [
                                            'type' => 'select.select',
                                            'label' => 'Content Type',
                                            'description' => 'Choose Pie Content Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'html',
                                            'options' => [
                                                'html' => 'Custom HTML',
                                                'counter' => 'Counter'
                                            ]
                                        ],
                                        '_info_html' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Content Type: Custom HTML'
                                        ],
                                        '.html_content' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Pie HTML Content',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '_info_counter' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Content Type: Counter Options'
                                        ],
                                        '.counter_fontsize' => [
                                            'type' => 'input.text',
                                            'label' => 'Counter Font Size',
                                            'description' => 'Type CSS counter font size, default is - \'20px\'',
                                            'default' => '20px'
                                        ]
                                    ]
                                ],
                                'style_4' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Style 4 - Charts',
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
                                                'tab_sub_main' => [
                                                    'label' => 'Global',
                                                    'fields' => [
                                                        '_info' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'For using it make sure that you have enabled \'Pies\' in \'JF Elements\' particle'
                                                        ],
                                                        '.chart_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Chart Type',
                                                            'description' => 'Choose Chart Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'piedonut',
                                                            'options' => [
                                                                'piedonut' => 'Pie/Donut',
                                                                'bar' => 'Bar'
                                                            ]
                                                        ],
                                                        '.grid' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Choose Grid Width',
                                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                                            'placeholder' => 'Select...',
                                                            'default' => 3,
                                                            'options' => [
                                                                1 => 1,
                                                                2 => 2,
                                                                3 => 3,
                                                                4 => 4,
                                                                5 => 5,
                                                                6 => 6,
                                                                7 => 7,
                                                                8 => 8,
                                                                9 => 9,
                                                                10 => 10,
                                                                11 => 11,
                                                                12 => 12
                                                            ]
                                                        ],
                                                        '.grid_last' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Last Grid On line?',
                                                            'description' => 'Is it the last grid box in Column Row?',
                                                            'placeholder' => 'Select...',
                                                            'default' => false,
                                                            'options' => [
                                                                0 => 'No',
                                                                1 => 'Yes'
                                                            ]
                                                        ],
                                                        '.textAl' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Text Align',
                                                            'description' => 'Choose Text Align Direction',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'center',
                                                            'options' => [
                                                                'left' => 'Left',
                                                                'center' => 'Center',
                                                                'right' => 'Right'
                                                            ]
                                                        ],
                                                        '_info_css3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'CSS3 Animation for Block - make sure you have enabled it in "Elements Typography"'
                                                        ],
                                                        '.css3_anim_name' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Name',
                                                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                                                            'default' => NULL
                                                        ],
                                                        '.css3_anim_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Type',
                                                            'placeholder' => 'Select...',
                                                            'description' => 'choose when you want to run animation: onView, onClick or onHover',
                                                            'default' => 'onview',
                                                            'options' => [
                                                                'onview' => 'onView',
                                                                'onclick' => 'onClick',
                                                                'onhover' => 'onHover'
                                                            ]
                                                        ],
                                                        '.css3_anim_delay' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Delay',
                                                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_piedonut' => [
                                                    'label' => 'Pie/Donut',
                                                    'fields' => [
                                                        '_info_bar' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Pie/Donut Type Options'
                                                        ],
                                                        '.piedonut_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Content Type',
                                                            'description' => 'Choose Pie or Donut',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'piedonut',
                                                            'options' => [
                                                                'pie' => 'Pie',
                                                                'donut' => 'Donut'
                                                            ]
                                                        ],
                                                        '.chart_id' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Unique ID',
                                                            'description' => 'Type unique id for your chart',
                                                            'default' => 'my-chart-1'
                                                        ],
                                                        '.chart_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Chart Height',
                                                            'description' => 'Type Chart Height CSS number, for example \'200px\'',
                                                            'default' => '200px'
                                                        ],
                                                        '.chart_css' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Chart CSS Style',
                                                            'description' => 'Type CSS styles, for example to regulate margins - margin: 0 0 50px 0'
                                                        ],
                                                        '.chart_legend' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Legend',
                                                            'description' => 'Enable/Disable Legends',
                                                            'default' => true
                                                        ],
                                                        '.chart_strokewidth' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Stroke Width',
                                                            'description' => 'Type stroke width number, for example \'2\'',
                                                            'default' => 2
                                                        ],
                                                        '_info_piedonut_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 1'
                                                        ],
                                                        '.piedonut_set_1_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_1_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_1_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 2'
                                                        ],
                                                        '.piedonut_set_2_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_2_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_2_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 3'
                                                        ],
                                                        '.piedonut_set_3_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_3_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_3_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 4'
                                                        ],
                                                        '.piedonut_set_4_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_4_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_4_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 5'
                                                        ],
                                                        '.piedonut_set_5_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_5_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_5_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_6' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 6'
                                                        ],
                                                        '.piedonut_set_6_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_6_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_6_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_7' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 7'
                                                        ],
                                                        '.piedonut_set_7_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_7_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_7_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_8' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 8'
                                                        ],
                                                        '.piedonut_set_8_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_8_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_8_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_piedonut_9' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Pie/Donut Set 9'
                                                        ],
                                                        '.piedonut_set_9_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Value',
                                                            'description' => 'Type value - the cut from 100%, for example \'2\''
                                                        ],
                                                        '.piedonut_set_9_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.piedonut_set_9_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ]
                                                    ]
                                                ],
                                                'tab_misc' => [
                                                    'label' => 'Bar',
                                                    'fields' => [
                                                        '_info_bar' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Bar Type Options'
                                                        ],
                                                        '.bar_grid' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Grid',
                                                            'description' => 'Enable/Disable Grids',
                                                            'default' => true
                                                        ],
                                                        '.bar_grid_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Grid Color',
                                                            'default' => '#eeeeee'
                                                        ],
                                                        '.bar_xaxis' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'X-axis',
                                                            'description' => 'Enable/Disable X-axis',
                                                            'default' => true
                                                        ],
                                                        '.bar_xaxis_tickcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'X-axis Tick Color',
                                                            'default' => '#ffffff'
                                                        ],
                                                        '.bar_xaxis_fontcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'X-axis Font Color',
                                                            'default' => '#9f9f9f'
                                                        ],
                                                        '.bar_yaxis' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Y-axis',
                                                            'description' => 'Enable/Disable Y-axis',
                                                            'default' => true
                                                        ],
                                                        '.bar_yaxis_tickcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Y-axis Tick Color',
                                                            'default' => '#eeeeee'
                                                        ],
                                                        '.bar_yaxis_fontcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Y-axis Font Color',
                                                            'default' => '#9f9f9f'
                                                        ],
                                                        '_info_bar_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 1'
                                                        ],
                                                        '.bar_set_1_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_1_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_1_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_1_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 2'
                                                        ],
                                                        '.bar_set_2_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_2_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_2_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_2_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 3'
                                                        ],
                                                        '.bar_set_3_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_3_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_3_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_3_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 4'
                                                        ],
                                                        '.bar_set_4_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_4_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_4_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_4_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 5'
                                                        ],
                                                        '.bar_set_5_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_5_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_5_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_5_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_6' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 6'
                                                        ],
                                                        '.bar_set_6_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_6_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_6_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_6_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_7' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 7'
                                                        ],
                                                        '.bar_set_7_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_7_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_7_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_7_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_8' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 8'
                                                        ],
                                                        '.bar_set_8_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_8_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_8_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_8_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ],
                                                        '_info_bar_9' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Bar Set 9'
                                                        ],
                                                        '.bar_set_9_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [1,50], [2,80], [3,20], [4,90], [5,20], [6,50], [7,75]'
                                                        ],
                                                        '.bar_set_9_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.bar_set_9_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Width',
                                                            'description' => 'Type width value, for example \'0.08\'',
                                                            'default' => '0.08'
                                                        ],
                                                        '.bar_set_9_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#6639B6'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'style_5' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Style 5 - Graphs',
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
                                                'tab_sub2_global' => [
                                                    'label' => 'Global',
                                                    'fields' => [
                                                        '_info' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'For using it make sure that you have enabled \'Graphs\' in \'JF Elements\' particle'
                                                        ],
                                                        '.grid' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Choose Grid Width',
                                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                                            'placeholder' => 'Select...',
                                                            'default' => 3,
                                                            'options' => [
                                                                1 => 1,
                                                                2 => 2,
                                                                3 => 3,
                                                                4 => 4,
                                                                5 => 5,
                                                                6 => 6,
                                                                7 => 7,
                                                                8 => 8,
                                                                9 => 9,
                                                                10 => 10,
                                                                11 => 11,
                                                                12 => 12
                                                            ]
                                                        ],
                                                        '.grid_last' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Last Grid On line?',
                                                            'description' => 'Is it the last grid box in Column Row?',
                                                            'placeholder' => 'Select...',
                                                            'default' => false,
                                                            'options' => [
                                                                0 => 'No',
                                                                1 => 'Yes'
                                                            ]
                                                        ],
                                                        '.textAl' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Text Align',
                                                            'description' => 'Choose Text Align Direction',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'center',
                                                            'options' => [
                                                                'left' => 'Left',
                                                                'center' => 'Center',
                                                                'right' => 'Right'
                                                            ]
                                                        ],
                                                        '_info_css3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'CSS3 Animation for Block - make sure you have enabled it in "Elements Typography"'
                                                        ],
                                                        '.css3_anim_name' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Name',
                                                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                                                            'default' => NULL
                                                        ],
                                                        '.css3_anim_type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Type',
                                                            'placeholder' => 'Select...',
                                                            'description' => 'choose when you want to run animation: onView, onClick or onHover',
                                                            'default' => 'onview',
                                                            'options' => [
                                                                'onview' => 'onView',
                                                                'onclick' => 'onClick',
                                                                'onhover' => 'onHover'
                                                            ]
                                                        ],
                                                        '.css3_anim_delay' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Delay',
                                                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub2_options' => [
                                                    'label' => 'Graph Options',
                                                    'fields' => [
                                                        '.graph_id' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Unique ID',
                                                            'description' => 'Type unique id for your chart',
                                                            'default' => 'my-graph-1'
                                                        ],
                                                        '.graph_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Graph Height',
                                                            'description' => 'Type Graph Height CSS number, for example \'200px\'',
                                                            'default' => '300px'
                                                        ],
                                                        '.graph_css' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Graph CSS Style',
                                                            'description' => 'Type CSS styles, for example to regulate margins - margin: 0 0 50px 0'
                                                        ],
                                                        '.graph_legend' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Legend',
                                                            'description' => 'Enable/Disable Legends',
                                                            'default' => true
                                                        ],
                                                        '.graph_curved' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Curved',
                                                            'description' => 'Enable/Disable Curved borders',
                                                            'default' => true
                                                        ],
                                                        '.graph_grid' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Grids',
                                                            'description' => 'Enable/Disable Grids',
                                                            'default' => true
                                                        ],
                                                        '.graph_grid_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Grid Color',
                                                            'default' => '#eeeeee'
                                                        ],
                                                        '.graph_xaxis' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'X-axis',
                                                            'description' => 'Enable/Disable X-axis',
                                                            'default' => true
                                                        ],
                                                        '.graph_xaxis_max' => [
                                                            'type' => 'input.text',
                                                            'label' => 'X-axis max Value',
                                                            'description' => 'Type X coordinate max value, for example - 7',
                                                            'default' => 7
                                                        ],
                                                        '.graph_xaxis_tickcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'X-axis Tick Color',
                                                            'default' => '#eeeeee'
                                                        ],
                                                        '.graph_xaxis_fontcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'X-axis Font Color',
                                                            'default' => '#9f9f9f'
                                                        ],
                                                        '.graph_yaxis' => [
                                                            'type' => 'enable.enable',
                                                            'label' => 'Y-axis',
                                                            'description' => 'Enable/Disable Y-axis',
                                                            'default' => true
                                                        ],
                                                        '.graph_yaxis_max' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Y-axis max Value',
                                                            'description' => 'Type Y coordinate max value, for example - 100',
                                                            'default' => 100
                                                        ],
                                                        '.graph_yaxis_tickcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Y-axis Tick Color',
                                                            'default' => '#eeeeee'
                                                        ],
                                                        '.graph_yaxis_fontcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Y-axis Font Color',
                                                            'default' => '#9f9f9f'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub2_sets' => [
                                                    'label' => 'Graph Sets',
                                                    'fields' => [
                                                        '_info_graph_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Graph Set 1'
                                                        ],
                                                        '.graph_set_1_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [0,40], [1,40], [2,70], [3,50], [4,100], [5,10], [6,90], [7,85]'
                                                        ],
                                                        '.graph_set_1_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.graph_set_1_opacity' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Opacity',
                                                            'description' => 'Type CSS opacity value, for example - 0.98',
                                                            'default' => '0.98'
                                                        ],
                                                        '.graph_set_1_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#e3e3e3'
                                                        ],
                                                        '_info_graph_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Graph Set 2'
                                                        ],
                                                        '.graph_set_2_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [0,40], [1,40], [2,70], [3,50], [4,100], [5,10], [6,90], [7,85]'
                                                        ],
                                                        '.graph_set_2_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.graph_set_2_opacity' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Opacity',
                                                            'description' => 'Type CSS opacity value, for example - 0.98',
                                                            'default' => '0.98'
                                                        ],
                                                        '.graph_set_2_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#e3e3e3'
                                                        ],
                                                        '_info_graph_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Graph Set 3'
                                                        ],
                                                        '.graph_set_3_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [0,40], [1,40], [2,70], [3,50], [4,100], [5,10], [6,90], [7,85]'
                                                        ],
                                                        '.graph_set_3_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.graph_set_3_opacity' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Opacity',
                                                            'description' => 'Type CSS opacity value, for example - 0.98',
                                                            'default' => '0.98'
                                                        ],
                                                        '.graph_set_3_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#e3e3e3'
                                                        ],
                                                        '_info_graph_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Graph Set 4'
                                                        ],
                                                        '.graph_set_4_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [0,40], [1,40], [2,70], [3,50], [4,100], [5,10], [6,90], [7,85]'
                                                        ],
                                                        '.graph_set_4_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.graph_set_4_opacity' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Opacity',
                                                            'description' => 'Type CSS opacity value, for example - 0.98',
                                                            'default' => '0.98'
                                                        ],
                                                        '.graph_set_4_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#e3e3e3'
                                                        ],
                                                        '_info_graph_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Graph Set 5'
                                                        ],
                                                        '.graph_set_5_value' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Coordinates',
                                                            'description' => 'Type Coordinates, for example - [0,40], [1,40], [2,70], [3,50], [4,100], [5,10], [6,90], [7,85]'
                                                        ],
                                                        '.graph_set_5_label' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Label',
                                                            'description' => 'Type Name'
                                                        ],
                                                        '.graph_set_5_opacity' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Opacity',
                                                            'description' => 'Type CSS opacity value, for example - 0.98',
                                                            'default' => '0.98'
                                                        ],
                                                        '.graph_set_5_color' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Color',
                                                            'default' => '#e3e3e3'
                                                        ]
                                                    ]
                                                ]
                                            ]
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
