<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_testimonials.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Testimonials',
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
                        'tab_conf' => [
                            'label' => 'Configuration',
                            'fields' => [
                                'items' => [
                                    'type' => 'input.text',
                                    'label' => 'Items on View',
                                    'description' => 'Type how many items you want to show on view',
                                    'default' => 3
                                ],
                                'autoplay' => [
                                    'type' => 'input.text',
                                    'label' => 'AutoPay Delay',
                                    'description' => 'Type autoplay delay value in milliseconds, default is - 3000',
                                    'default' => 3000
                                ],
                                'stopOnHover' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Stop On Hover?',
                                    'description' => 'Stop Sliding while hovering on items?',
                                    'default' => false
                                ],
                                'speed' => [
                                    'type' => 'input.text',
                                    'label' => 'Slide Speed',
                                    'description' => 'Type slide speed value in milliseconds, default is - 300',
                                    'default' => 300
                                ],
                                'navigation' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Navigation Buttons',
                                    'description' => 'Enable/Disable Navigation Buttons',
                                    'default' => true
                                ],
                                'lazyload' => [
                                    'type' => 'enable.enable',
                                    'label' => 'LazyLoad Images',
                                    'description' => 'Enable/Disable LazyLoad Images',
                                    'default' => false
                                ],
                                'autoHeight' => [
                                    'type' => 'enable.enable',
                                    'label' => 'AutoHeight Items',
                                    'description' => 'Enable/Disable AutoHeight Items',
                                    'default' => false
                                ],
                                'mouseDrag' => [
                                    'type' => 'enable.enable',
                                    'label' => 'MouseDrag',
                                    'description' => 'Enable/Disable MouseDrag Function',
                                    'default' => true
                                ],
                                'touchDrag' => [
                                    'type' => 'enable.enable',
                                    'label' => 'TouchDrag',
                                    'description' => 'Enable/Disable TouchDrag Function',
                                    'default' => true
                                ]
                            ]
                        ],
                        'tab_style' => [
                            'label' => 'Style',
                            'fields' => [
                                'style' => [
                                    'type' => 'select.select',
                                    'label' => 'Choose Content Style',
                                    'description' => 'Choose one of Content style',
                                    'placeholder' => 'Select...',
                                    'default' => 'style_1',
                                    'options' => [
                                        'style_1' => 'Style 1',
                                        'style_2' => 'Style 2',
                                        'style_2_wh' => 'Style 2 + White',
                                        'style_2_sh' => 'Style 2 + Shadowdow',
                                        'style_2_wh_sh' => 'Style 2 + White + Shadowdow'
                                    ]
                                ],
                                'authorfloat' => [
                                    'type' => 'select.select',
                                    'label' => 'Author Direction',
                                    'description' => 'Choose one of Content Style',
                                    'placeholder' => 'Select...',
                                    'default' => 'center',
                                    'options' => [
                                        'center' => 'Centered',
                                        'left' => 'Left Float',
                                        'right' => 'Right Float'
                                    ]
                                ],
                                'foreground' => [
                                    'type' => 'select.select',
                                    'label' => 'ForeGround Style',
                                    'description' => 'It will change text color of content',
                                    'placeholder' => 'Select...',
                                    'default' => 'light',
                                    'options' => [
                                        'light' => 'Default - Light',
                                        'dark' => 'Dark'
                                    ]
                                ],
                                'quotesize' => [
                                    'type' => 'input.text',
                                    'label' => 'Quote Font-Size',
                                    'description' => 'Type Quote CSS Font-Size',
                                    'default' => '16px'
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
                                'carousel' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Quote Items',
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
                                            'content' => 'For using it make sure that you have enabled \'Testimonials\' in \'JF Elements\' particle'
                                        ],
                                        '.image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.image_width' => [
                                            'type' => 'input.text',
                                            'label' => 'Image Width',
                                            'description' => 'Type image width size, for example - 60',
                                            'default' => '60'
                                        ],
                                        '.author_name' => [
                                            'type' => 'input.text',
                                            'label' => 'Author Name',
                                            'description' => 'Type your Author\'s name',
                                            'default' => 'Jane Doe'
                                        ],
                                        '.author_pos' => [
                                            'type' => 'input.text',
                                            'label' => 'Author Position',
                                            'description' => 'Type your Author\'s position in your company',
                                            'default' => 'SEO, founder'
                                        ],
                                        '.quote_html' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Quote - HTML',
                                            'description' => 'Enter custom HTML for Quote'
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
