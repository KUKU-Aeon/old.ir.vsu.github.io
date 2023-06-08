<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_portfolio.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Portfolio',
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
                        'tab_options' => [
                            'label' => 'Portfolio Options',
                            'fields' => [
                                'filterbuttons' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Filter Buttons',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        '.catid' => [
                                            'type' => 'input.text',
                                            'label' => 'Category ID',
                                            'description' => 'Type unique category ID text in lowercase, for example - \'graphics\' (for shiwing All items, use category id - \'all\')'
                                        ],
                                        '.cattext' => [
                                            'type' => 'input.text',
                                            'label' => 'Category Button Text',
                                            'description' => 'Type Button Text'
                                        ],
                                        '.classes' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'jf_waves_dark_10'
                                        ],
                                        '.customcss' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom CSS',
                                            'description' => 'type, for example - \'color:#fff;background:#000\''
                                        ]
                                    ]
                                ],
                                'sort' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Sorting Buttons',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        '.enable' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Enable Sorting',
                                            'description' => 'Enable/Disable Sorting Function',
                                            'default' => true
                                        ],
                                        '.txt_default' => [
                                            'type' => 'input.text',
                                            'label' => 'Default - Text',
                                            'description' => 'Type Option name text',
                                            'default' => 'Default'
                                        ],
                                        '.txt_title' => [
                                            'type' => 'input.text',
                                            'label' => 'Title - Text',
                                            'description' => 'Type Option name text',
                                            'default' => 'Title'
                                        ],
                                        '.txt_date' => [
                                            'type' => 'input.text',
                                            'label' => 'Date Created - Text',
                                            'description' => 'Type Option name text',
                                            'default' => 'Date Created'
                                        ]
                                    ]
                                ],
                                'search' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Search Function',
                                    'description' => 'Enable/Disable Search Function',
                                    'default' => true
                                ],
                                'gridstyle' => [
                                    'type' => 'select.select',
                                    'label' => 'Grid Style',
                                    'description' => 'Choose one of Grid styles',
                                    'placeholder' => 'Select...',
                                    'default' => 'no_paddings',
                                    'options' => [
                                        'no_paddings' => 'No Padding',
                                        'paddings' => 'Padding'
                                    ]
                                ],
                                'foreground' => [
                                    'type' => 'select.select',
                                    'label' => 'ForeGround Style',
                                    'description' => 'It will change text color of portfolio buttons',
                                    'placeholder' => 'Select...',
                                    'default' => 'light',
                                    'options' => [
                                        'light' => 'Default - Light',
                                        'dark' => 'Dark'
                                    ]
                                ],
                                '_info_css3Filterbtns' => [
                                    'type' => 'separator.note',
                                    'class' => 'alert alert-note',
                                    'content' => 'CSS3 Animation for Block - make sure you have enabled it in "Elements Typography"'
                                ],
                                'css3_anim_name' => [
                                    'type' => 'input.text',
                                    'label' => 'Name',
                                    'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                                    'default' => NULL
                                ],
                                'css3_anim_type' => [
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
                                'css3_anim_delay' => [
                                    'type' => 'input.text',
                                    'label' => 'Delay',
                                    'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)'
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
                                'image_lazyload' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Lazy Load',
                                    'description' => 'This option will lazy load image. NOTE! - make sure that you have enabled \'Images Lazy Load\' feature in \'JF Features\' Atom in \'Page Settings\'.',
                                    'default' => true
                                ],
                                'image_lazyload_src' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Lazy Load Blank Image',
                                    'description' => 'Choose blank image for Lazy Load. This image (small blank gif image) will be loaded before the \'Main Image\' will load. Make sure that blank image width and height equals to \'Main Image\' sizes.',
                                    'default' => 'gantry-media://jf/particles/portfolio/thumb_blank_[600x540].gif'
                                ],
                                'items' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items',
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
                                                'tab_sub_global' => [
                                                    'label' => 'Global',
                                                    'fields' => [
                                                        '_info' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'For using it make sure that you have enabled \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                                        ],
                                                        '.style' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Choose Item Style',
                                                            'description' => 'Choose one of Item style',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'custom',
                                                            'options' => [
                                                                'custom' => 'Custom HTML',
                                                                'hovers_1' => 'Hover Style 1',
                                                                'hovers_2' => 'Hover Style 2',
                                                                'hovers_3' => 'Hover Style 3',
                                                                'hovers_4' => 'Hover Style 4',
                                                                'hovers_5' => 'Hover Style 5',
                                                                'hotspot_1' => 'Hotspot 1',
                                                                'hotspot_2' => 'Hotspot 2',
                                                                'hotspot_3' => 'Hotspot 3',
                                                                'hotspot_4' => 'Hotspot 4'
                                                            ]
                                                        ],
                                                        '.customclass' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Custom Class',
                                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                                            'default' => 'deep-purple jf_waves_light_40'
                                                        ],
                                                        '_info_portfolio' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Portfolio Options'
                                                        ],
                                                        '.col' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Item Width',
                                                            'description' => 'Choose one of widths',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'col-1-3',
                                                            'options' => [
                                                                'col-1-5' => '20%',
                                                                'col-1-4' => '25%',
                                                                'col-1-3' => '33%',
                                                                'col-1-2' => '50%',
                                                                'col-2-3' => '66%',
                                                                'col-1' => '100%'
                                                            ]
                                                        ],
                                                        '.shadow' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Grid Shadow',
                                                            'description' => 'Choose one of shadows',
                                                            'placeholder' => 'Select...',
                                                            'default' => false,
                                                            'options' => [
                                                                0 => 'NO Shadow',
                                                                'z-depth-1' => 'Shadow 10%',
                                                                'z-depth-2' => 'Shadow 20%',
                                                                'z-depth-3' => 'Shadow 30%',
                                                                'z-depth-4' => 'Shadow 40%'
                                                            ]
                                                        ],
                                                        '.date' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Date',
                                                            'description' => 'Type date (Leave it empty if you dont want to use it).'
                                                        ],
                                                        '.group' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Group Category',
                                                            'description' => 'Type group category texts, separate then with commas (Make sure you have already created this \'Category\' in Portfolio \'Filter Optons\')',
                                                            'default' => '"photography","3d"'
                                                        ],
                                                        '.itemname' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Item Name',
                                                            'description' => 'Type item name (It can be used in "Filter Search")'
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
                                                'tab_sub_link' => [
                                                    'label' => 'Link Options',
                                                    'fields' => [
                                                        '.linktype' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Link Type',
                                                            'description' => 'Choose one of Link Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'nolink',
                                                            'options' => [
                                                                'nolink' => 'No Link',
                                                                'simple_link' => 'Simple Link',
                                                                'current' => 'Current Page URL +/with Custom',
                                                                'menuid' => 'Menu Item ID',
                                                                'photoswipe' => 'PhotoSwipe',
                                                                'venobox' => 'VenoBox'
                                                            ]
                                                        ],
                                                        '_info_simple_link' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Simple Link - Options'
                                                        ],
                                                        '.simple_link_url' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Link URL',
                                                            'description' => 'Type URL'
                                                        ],
                                                        '.simple_link_target' => [
                                                            'type' => 'select.select',
                                                            'label' => 'LinkURL Target',
                                                            'description' => 'Choose URL Target',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'self',
                                                            'options' => [
                                                                'self' => 'Self',
                                                                'blank' => 'Blank'
                                                            ]
                                                        ],
                                                        '_info_current' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Current Page URL +/with Custom'
                                                        ],
                                                        '.current_url' => [
                                                            'type' => 'input.text',
                                                            'class' => 'alert alert-info',
                                                            'label' => 'Custom URL Addon for Current Page URL',
                                                            'description' => 'Type addon for \'Current Page URL\', for example \'?presets=deep-purple\' - this means that if you will be on any page, for example on \'www.yourdomain.com//features/contact\' page, it will give you the URL - \'www.yourdomain.com//features/contact?presets=deep-purple\'. So this option is a \'Custom URL Addon for Current Page URL\'.'
                                                        ],
                                                        '_info_menu_id' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'Menu Item ID - Options'
                                                        ],
                                                        '.menu_id' => [
                                                            'type' => 'input.text',
                                                            'class' => 'alert alert-info',
                                                            'label' => 'Menu Item ID',
                                                            'description' => 'Type menu item ID if you want to link it to your menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                                        ],
                                                        '_info_photoswipe' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.photoswipe_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Image',
                                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Link Type\' above option)'
                                                        ],
                                                        '.photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.venotype' => [
                                                            'type' => 'select.select',
                                                            'label' => 'VenoBox Type',
                                                            'description' => 'Choose one of VenoBox Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'custom',
                                                            'options' => [
                                                                'image' => 'Image',
                                                                'youtube' => 'Video - Youtube',
                                                                'vimeo' => 'Video - Vimeo'
                                                            ]
                                                        ],
                                                        '.venobox_video_url' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Video URL',
                                                            'description' => 'Type Video URL (Leave it empty if you dont use it)'
                                                        ],
                                                        '.venobox_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Image',
                                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Link Type\' above option)'
                                                        ],
                                                        '.venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_custom' => [
                                                    'label' => 'Custom HTML',
                                                    'fields' => [
                                                        '_info_style_custom' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Custom HTML (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.html' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hov_1' => [
                                                    'label' => 'Hover Style 1',
                                                    'fields' => [
                                                        '_info_style_hovers_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hover Style 1 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hovers_1_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hovers_1_image_alt' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image ALT Text',
                                                            'description' => 'Type content image ALT attribute text.'
                                                        ],
                                                        '.hovers_1_caption' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hov_2' => [
                                                    'label' => 'Hover Style 2',
                                                    'fields' => [
                                                        '_info_style_hovers_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hover Style 2 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hovers_2_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hovers_2_image_alt' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image ALT Text',
                                                            'description' => 'Type content image ALT attribute text.'
                                                        ],
                                                        '.hovers_2_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hovers_2_caption_descr' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Description HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hov_3' => [
                                                    'label' => 'Hover Style 3',
                                                    'fields' => [
                                                        '_info_style_hovers_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hover Style 3 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hovers_3_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hovers_3_image_alt' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image ALT Text',
                                                            'description' => 'Type content image ALT attribute text.'
                                                        ],
                                                        '.hovers_3_caption_icon' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Icon HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hovers_3_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hov_4' => [
                                                    'label' => 'Hover Style 4',
                                                    'fields' => [
                                                        '_info_style_hovers_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hover Style 4 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hovers_4_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hovers_4_image_alt' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image ALT Text',
                                                            'description' => 'Type content image ALT attribute text.'
                                                        ],
                                                        '.hovers_4_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hovers_4_caption_descr' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Description HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hovers_4_caption_author' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Author HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hov_5' => [
                                                    'label' => 'Hover Style 5',
                                                    'fields' => [
                                                        '_info_style_hovers_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hover Style 5 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hovers_5_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hovers_5_image_alt' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image ALT Text',
                                                            'description' => 'Type content image ALT attribute text.'
                                                        ],
                                                        '.hovers_5_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hovers_5_caption_descr' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Description HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hot_1' => [
                                                    'label' => 'Hotspot 1',
                                                    'fields' => [
                                                        '_info_style_hotspot_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hotspot 1 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hotspot_1_padding' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Item CSS Padding',
                                                            'description' => 'Type Custom CSS for regulate padding between items',
                                                            'default' => 'padding:0 10px'
                                                        ],
                                                        '.hotspot_1_direc' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Style Direction',
                                                            'description' => 'Choose one of Style Direction',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'left',
                                                            'options' => [
                                                                'left' => 'Left',
                                                                'right' => 'Right',
                                                                'top' => 'Top',
                                                                'bottom' => 'Bottom'
                                                            ]
                                                        ],
                                                        '.hotspot_1_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hotspot_1_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hotspot_1_caption_descr' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Description HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hotspot_1_caption_cat' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Category HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hot_2' => [
                                                    'label' => 'Hotspot 2',
                                                    'fields' => [
                                                        '_info_style_hotspot_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hotspot 2 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hotspot_2_padding' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Item CSS Padding',
                                                            'description' => 'Type Custom CSS for regulate padding between items',
                                                            'default' => 'padding:0 10px'
                                                        ],
                                                        '.hotspot_2_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Content Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hotspot_2_caption_date' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Date HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hotspot_2_caption_title' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Title HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ],
                                                        '.hotspot_2_caption_cat' => [
                                                            'type' => 'textarea.textarea',
                                                            'label' => 'Caption Category HTML',
                                                            'description' => 'Enter custom HTML into here.'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hot_3' => [
                                                    'label' => 'Hotspot 3',
                                                    'fields' => [
                                                        '_info_style_hotspot_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hotspot 3 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hotspot_3_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Background Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hotspot_3_bgcolor' => [
                                                            'type' => 'input.colorpicker',
                                                            'label' => 'Background Color',
                                                            'default' => 'rgba(37, 37, 37, 0.7)'
                                                        ],
                                                        '.hotspot_3_logoimage' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Logo Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hotspot_3_logowidth' => [
                                                            'type' => 'textarea.text',
                                                            'label' => 'Logo Width',
                                                            'description' => 'Enter Logo image number value',
                                                            'default' => '170'
                                                        ]
                                                    ]
                                                ],
                                                'tab_sub_hot_4' => [
                                                    'label' => 'Hotspot 4',
                                                    'fields' => [
                                                        '_info_style_hotspot_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Item Style - Hotspot 4 (For using it make sure you have choosed relative \'Item Style\' in \'Global\' tab)'
                                                        ],
                                                        '.hotspot_4_image' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Background Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '.hotspot_4_cat' => [
                                                            'type' => 'textarea.text',
                                                            'label' => 'Category Name',
                                                            'description' => 'Enter Category Name'
                                                        ],
                                                        '.hotspot_4_date' => [
                                                            'type' => 'textarea.text',
                                                            'label' => 'Date',
                                                            'description' => 'Enter Date Text'
                                                        ],
                                                        '.hotspot_4_title' => [
                                                            'type' => 'textarea.text',
                                                            'label' => 'Title Text',
                                                            'description' => 'Enter Title Text'
                                                        ],
                                                        '.hotspot_4_author' => [
                                                            'type' => 'textarea.text',
                                                            'label' => 'Author Name',
                                                            'description' => 'Enter Author Name'
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
