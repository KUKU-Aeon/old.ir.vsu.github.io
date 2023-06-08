<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_gallery.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Gallery',
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
                                'style' => [
                                    'type' => 'select.select',
                                    'label' => 'Choose Gallery Style',
                                    'description' => 'Choose one of Gallery style',
                                    'placeholder' => 'Select...',
                                    'default' => 'style_1',
                                    'options' => [
                                        'style_1' => 'Style 1',
                                        'style_2' => 'Style 2'
                                    ]
                                ],
                                'image_lazyload' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Lazy Load',
                                    'description' => 'This option will lazy load image. NOTE! - make sure that you have enabled \'Images Lazy Load\' feature in \'JF Features\' Atom in \'Page Settings\'.',
                                    'default' => true
                                ],
                                'html_before' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML Before the "Content List"',
                                    'description' => 'Enter custom HTML into here.'
                                ],
                                'html_after' => [
                                    'type' => 'textarea.textarea',
                                    'label' => 'Custom HTML After the "Content List"',
                                    'description' => 'Enter custom HTML into here.'
                                ]
                            ]
                        ],
                        'tab_gall_1' => [
                            'label' => 'Gallery - Style 1',
                            'fields' => [
                                'gall_title' => [
                                    'type' => 'input.text',
                                    'label' => 'Gallery Style 1 - Title',
                                    'description' => 'Type Gallery Title'
                                ],
                                'gall_descr' => [
                                    'type' => 'input.text',
                                    'label' => 'Gallery Style 1 - Description',
                                    'description' => 'Type Gallery Description'
                                ],
                                'style_1_id' => [
                                    'type' => 'input.text',
                                    'label' => 'Gallery Style 1 - Special ID',
                                    'description' => 'Type Special Name for \'Gallery Style 1\', so if you will have multiple same galleries on one page, you must have different \'Special IDs\' for each \'Gallery Style 1\'',
                                    'default' => 'jf_p_gallery_style_1'
                                ],
                                'style_1_back_btn' => [
                                    'type' => 'input.text',
                                    'label' => 'Gallery Style 1 - Back Button Class',
                                    'description' => 'Type button CSS class, for example \'deep-purple\', we use it for giving a background color for button',
                                    'default' => 'yellow jf_waves_dark_20'
                                ],
                                'style_1' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Gallery Style 1',
                                    'value' => 'name',
                                    'ajax' => true,
                                    'fields' => [
                                        '.name' => [
                                            'type' => 'input.text',
                                            'label' => 'Name',
                                            'skip' => true
                                        ],
                                        '_info_gallery' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Gallery Options'
                                        ],
                                        '.gallery_group' => [
                                            'type' => 'input.text',
                                            'label' => 'Gallery Group Name',
                                            'description' => 'Type gallery group category (Items with same categories will be automatically grouped).'
                                        ],
                                        '_info' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'For using it make sure that you have enabled \'LightBoxes\' in Elements particle'
                                        ],
                                        '.linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'nolink' => 'No Link',
                                                'simple_link' => 'Simple Link',
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
                                            'description' => 'Type your icon URL (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        '_info_venobox' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-notice',
                                            'content' => 'VenoBox - Options'
                                        ],
                                        '.venobox_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
                                        ],
                                        '.venobox_author' => [
                                            'type' => 'input.text',
                                            'label' => 'Image Author Name',
                                            'description' => 'Type Image Author Name'
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content'
                                        ],
                                        '.image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.image_width' => [
                                            'type' => 'input.text',
                                            'label' => 'Image Width',
                                            'description' => 'Type image Width number (leave it empty if you dont want to use it)'
                                        ],
                                        '.image_height' => [
                                            'type' => 'input.text',
                                            'label' => 'Image Height',
                                            'description' => 'Type image text number (leave it empty if you dont want to use it)'
                                        ],
                                        '.image_name' => [
                                            'type' => 'input.text',
                                            'label' => 'Image Name',
                                            'description' => 'Type image name text.'
                                        ]
                                    ]
                                ],
                                'style_1_image_lazyload_src' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Style 1 - Lazy Load Blank Image',
                                    'description' => 'Choose blank image for Lazy Load. This image (small blank gif image) will be loaded before the \'Main Image\' will load. Make sure that blank image width and height equals to \'Main Image\' sizes.',
                                    'default' => 'gantry-media://jf/elements/lightboxes/thumb_blank.gif'
                                ]
                            ]
                        ],
                        'tab_gall_2' => [
                            'label' => 'Gallery - Style 2',
                            'fields' => [
                                'style_2' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Gallery Style 2',
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
                                                'tab_main' => [
                                                    'label' => 'Gallery Options',
                                                    'fields' => [
                                                        '.grid' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Choose Grid Width',
                                                            'description' => 'Choose Grid width, check \'Columns\' elements types to understand width sizes.',
                                                            'placeholder' => 'Select...',
                                                            'default' => 4,
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
                                                        '.type' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Thumb Animation Type',
                                                            'description' => 'Choose Thumb Animation Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'anim_1',
                                                            'options' => [
                                                                'anim_1' => 'Type 1',
                                                                'anim_2' => 'Type 2',
                                                                'anim_3' => 'Type 3',
                                                                'anim_4' => 'Type 4',
                                                                'anim_5' => 'Type 5',
                                                                'anim_6' => 'Type 6',
                                                                'anim_7' => 'Type 7',
                                                                'anim_8' => 'Type 8',
                                                                'anim_9' => 'Type 9'
                                                            ]
                                                        ],
                                                        '.linktype' => [
                                                            'type' => 'select.select',
                                                            'label' => 'LightBox Type',
                                                            'description' => 'Choose one of LightBox Type',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'photoswipe',
                                                            'options' => [
                                                                'photoswipe' => 'PhotoSwipe',
                                                                'venobox' => 'VenoBox'
                                                            ]
                                                        ],
                                                        '.title' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Album Title',
                                                            'description' => 'Type your album title'
                                                        ],
                                                        '.theme' => [
                                                            'type' => 'select.select',
                                                            'label' => 'Theme',
                                                            'description' => 'Choose Theme Style',
                                                            'placeholder' => 'Select...',
                                                            'default' => 'light',
                                                            'options' => [
                                                                'light' => 'Light',
                                                                'dark' => 'Dark'
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
                                                'tab_thumbs' => [
                                                    'label' => 'Thumbs',
                                                    'fields' => [
                                                        '.thumb_1' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 1',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_2' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 2',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_3' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 3',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_4' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 4',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_5' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 5',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_6' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 6',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_7' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 7',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_8' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 8',
                                                            'description' => 'Select desired image'
                                                        ],
                                                        '.thumb_9' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'Thumb Image 9',
                                                            'description' => 'Select desired image'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_1' => [
                                                    'label' => 'Popup - 1',
                                                    'fields' => [
                                                        '_info_items_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 1'
                                                        ],
                                                        '.image_1_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_1_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_1_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_1_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_1_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_1' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_1_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_1_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_2' => [
                                                    'label' => 'Popup - 2',
                                                    'fields' => [
                                                        '_info_items_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 2'
                                                        ],
                                                        '.image_2_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_2_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_2_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_2_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_2_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_2' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_2_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_2_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_3' => [
                                                    'label' => 'Popup - 3',
                                                    'fields' => [
                                                        '_info_items_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 3'
                                                        ],
                                                        '.image_3_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_3_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_3_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_3_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_3_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_3' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_3_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_3_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_4' => [
                                                    'label' => 'Popup - 4',
                                                    'fields' => [
                                                        '_info_items_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 4'
                                                        ],
                                                        '.image_4_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_4_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_4_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_4_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_4_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_4' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_4_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_4_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_5' => [
                                                    'label' => 'Popup - 5',
                                                    'fields' => [
                                                        '_info_items_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 5'
                                                        ],
                                                        '.image_5_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_5_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_5_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_5_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_5_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_5' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_5_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_5_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_6' => [
                                                    'label' => 'Popup - 6',
                                                    'fields' => [
                                                        '_info_items_6' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 6'
                                                        ],
                                                        '.image_6_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_6' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_6_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_6_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_6_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_6_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_6' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_6_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_6_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_7' => [
                                                    'label' => 'Popup - 7',
                                                    'fields' => [
                                                        '_info_items_7' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 7'
                                                        ],
                                                        '.image_7_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_7' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_7_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_7_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_7_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_7_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_7' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_7_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_7_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_8' => [
                                                    'label' => 'Popup - 8',
                                                    'fields' => [
                                                        '_info_items_8' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 8'
                                                        ],
                                                        '.image_8_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_8' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_8_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_8_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_8_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_8_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_8' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_8_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_8_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_9' => [
                                                    'label' => 'Popup - 9',
                                                    'fields' => [
                                                        '_info_items_9' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 9'
                                                        ],
                                                        '.image_9_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_9' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_9_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_9_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_9_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_9_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_9' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_9_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_9_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_10' => [
                                                    'label' => 'Popup - 10',
                                                    'fields' => [
                                                        '_info_items_10' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 10'
                                                        ],
                                                        '.image_10_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_10' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_10_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_10_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_10_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_10_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_10' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_10_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_10_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_11' => [
                                                    'label' => 'Popup - 11',
                                                    'fields' => [
                                                        '_info_items_11' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 11'
                                                        ],
                                                        '.image_11_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_11' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_11_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_11_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_11_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_11_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_11' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_11_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_11_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_12' => [
                                                    'label' => 'Popup - 12',
                                                    'fields' => [
                                                        '_info_items_12' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 12'
                                                        ],
                                                        '.image_12_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_12' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_12_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_12_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_12_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_12_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_12' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_12_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_12_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_13' => [
                                                    'label' => 'Popup - 13',
                                                    'fields' => [
                                                        '_info_items_13' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 13'
                                                        ],
                                                        '.image_13_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_13' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_13_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_13_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_13_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_13_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_13' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_13_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_13_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_14' => [
                                                    'label' => 'Popup - 14',
                                                    'fields' => [
                                                        '_info_items_14' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 14'
                                                        ],
                                                        '.image_14_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_14' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_14_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_14_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_14_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_14_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_14' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_14_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_14_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_15' => [
                                                    'label' => 'Popup - 15',
                                                    'fields' => [
                                                        '_info_items_15' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 15'
                                                        ],
                                                        '.image_15_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_15' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_15_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_15_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_15_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_15_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_15' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_15_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_15_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_16' => [
                                                    'label' => 'Popup - 16',
                                                    'fields' => [
                                                        '_info_items_16' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 16'
                                                        ],
                                                        '.image_16_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_16' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_16_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_16_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_16_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_16_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_16' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_16_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_16_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_17' => [
                                                    'label' => 'Popup - 17',
                                                    'fields' => [
                                                        '_info_items_17' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 17'
                                                        ],
                                                        '.image_17_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_17' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_17_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_17_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_17_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_17_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_17' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_17_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_17_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_18' => [
                                                    'label' => 'Popup - 18',
                                                    'fields' => [
                                                        '_info_items_18' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 18'
                                                        ],
                                                        '.image_18_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_18' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_18_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_18_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_18_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_18_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_18' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_18_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_18_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_19' => [
                                                    'label' => 'Popup - 19',
                                                    'fields' => [
                                                        '_info_items_19' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 19'
                                                        ],
                                                        '.image_19_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_19' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_19_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_19_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_19_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_19_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_19' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_19_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_19_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ],
                                                'tab_popup_20' => [
                                                    'label' => 'Popup - 20',
                                                    'fields' => [
                                                        '_info_items_20' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-info',
                                                            'content' => 'Gallery Popup Image 20'
                                                        ],
                                                        '.image_20_url' => [
                                                            'type' => 'input.imagepicker',
                                                            'label' => 'LightBox Image',
                                                            'description' => 'Select desired image.'
                                                        ],
                                                        '_info_photoswipe_20' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'PhotoSwipe - Options'
                                                        ],
                                                        '.image_20_photoswipe_image_width' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Width',
                                                            'description' => 'Type image width size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_20_photoswipe_image_height' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Height',
                                                            'description' => 'Type image height size, for example - 450',
                                                            'default' => '450'
                                                        ],
                                                        '.image_20_photoswipe_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ],
                                                        '.image_20_photoswipe_caption' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Photoswipe Caption',
                                                            'description' => 'Type Photoswipe Pupup Caption Text'
                                                        ],
                                                        '_info_venobox_20' => [
                                                            'type' => 'separator.note',
                                                            'class' => 'alert alert-notice',
                                                            'content' => 'VenoBox - Options'
                                                        ],
                                                        '.image_20_venobox_gallery' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Gallery ID',
                                                            'description' => 'Type image gallery \'ID\', for example \'carousel_gall_1\'. Similar items with this \'ID\' will show up in one Gallery.'
                                                        ],
                                                        '.image_20_venobox_author' => [
                                                            'type' => 'input.text',
                                                            'label' => 'Image Author Name',
                                                            'description' => 'Type Image Author Name'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'style_2_image_lazyload_src' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Style 2 - Lazy Load Blank Image',
                                    'description' => 'Choose blank image for Lazy Load. This image (small blank gif image) will be loaded before the \'Main Image\' will load. Make sure that blank image width and height equals to  \'Main Image\' sizes.',
                                    'default' => 'gantry-media://jf/particles/gallery/thumb_blank.gif'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
