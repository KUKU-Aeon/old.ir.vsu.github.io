<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_p_carousel.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Particle - Carousels',
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
                            'label' => 'Carousel Options',
                            'fields' => [
                                'count_items' => [
                                    'type' => 'input.text',
                                    'label' => 'Items Amount',
                                    'description' => 'Type number of items you want to show on view',
                                    'default' => 4
                                ],
                                'autoplay_delay' => [
                                    'type' => 'input.text',
                                    'label' => 'AutoPlay Delay',
                                    'description' => 'Type AutoPlay Delay number in milliseconds',
                                    'default' => 3000
                                ],
                                'stophover' => [
                                    'type' => 'select.select',
                                    'label' => 'Stop On Hover?',
                                    'description' => 'Stop Autoplay on Hover?',
                                    'placeholder' => 'Select...',
                                    'default' => true,
                                    'options' => [
                                        1 => 'Yes',
                                        0 => 'No'
                                    ]
                                ],
                                'speed' => [
                                    'type' => 'input.text',
                                    'label' => 'Speed Delay',
                                    'description' => 'Type AutoPlay Delay number in milliseconds',
                                    'default' => 300
                                ],
                                'navigation' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Navigation',
                                    'description' => 'Enable/Disable arrow navigation',
                                    'default' => true
                                ],
                                'pagination' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Pagination',
                                    'description' => 'Enable/Disable Arrow Navigation',
                                    'default' => true
                                ],
                                'lazyload' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Lazyload',
                                    'description' => 'Enable/Disable Lazyload Images',
                                    'default' => true
                                ],
                                'image_lazyload_src' => [
                                    'type' => 'input.imagepicker',
                                    'label' => 'Lazy Load Blank Image',
                                    'description' => 'Choose blank image for Lazy Load. This image (small blank GIF image) will be loaded before the \'Main Image\' will load.',
                                    'default' => 'gantry-media://jf/blank.gif'
                                ],
                                'autoHeight' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Auto Height',
                                    'description' => 'Enable/Disable Auto Height Items',
                                    'default' => false
                                ],
                                'mouseDrag' => [
                                    'type' => 'enable.enable',
                                    'label' => 'MouseDrag',
                                    'description' => 'Enable/Disable MouseDrag',
                                    'default' => true
                                ],
                                'touchDrag' => [
                                    'type' => 'enable.enable',
                                    'label' => 'TouchDrag',
                                    'description' => 'Enable/Disable TouchDrag',
                                    'default' => true
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
                                    'default' => 'custom',
                                    'options' => [
                                        'custom' => 'Custom HTML',
                                        'style_1' => 'Style 1',
                                        'style_2' => 'Style 2',
                                        'style_3' => 'Style 3',
                                        'style_4' => 'Style 4',
                                        'style_5' => 'Style 5',
                                        'style_6' => 'Style 6',
                                        'style_7' => 'Style 7',
                                        'style_8' => 'Style 8'
                                    ]
                                ],
                                'custom' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Custom HTML',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.html' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'style_1' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 1',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_image_alt' => [
                                            'type' => 'input.text',
                                            'label' => 'Image ALT Text',
                                            'description' => 'Type content image ALT attribute text.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_descr' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Description HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_2' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 2',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_image_alt' => [
                                            'type' => 'input.text',
                                            'label' => 'Image ALT Text',
                                            'description' => 'Type content image ALT attribute text.'
                                        ],
                                        '.c_caption' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_3' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 3',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_image_alt' => [
                                            'type' => 'input.text',
                                            'label' => 'Image ALT Text',
                                            'description' => 'Type content image ALT attribute text.'
                                        ],
                                        '.c_caption_icon' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Icon HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_4' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 4',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_image_alt' => [
                                            'type' => 'input.text',
                                            'label' => 'Image ALT Text',
                                            'description' => 'Type content image ALT attribute text.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_descr' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Description HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_author' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Author HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_5' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 5',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_image_alt' => [
                                            'type' => 'input.text',
                                            'label' => 'Image ALT Text',
                                            'description' => 'Type content image ALT attribute text.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_descr' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Description HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_6' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 6',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0 10px'
                                        ],
                                        '.c_direc' => [
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
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_descr' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Description HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_cat' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Category HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_7' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 7',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.customclass' => [
                                            'type' => 'input.text',
                                            'label' => 'Custom Class',
                                            'description' => 'You can add custom CSS classes, for example color classes - \'deep-purple\' (For checking all available color classes, please check \'Elements\' pages).',
                                            'default' => 'deep-purple jf_waves_light_40'
                                        ],
                                        '_info_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Link Type'
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
                                                'photoswipe' => 'PhotoSwipe',
                                                'venobox' => 'VenoBox'
                                            ]
                                        ],
                                        '_info_simple_link' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: Simple - Options'
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
                                        '_info_photoswipe' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: PhotoSwipe - Options'
                                        ],
                                        '.photoswipe_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Image',
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                            'class' => 'alert alert-info',
                                            'content' => 'Link Type: VenoBox - Options'
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
                                            'description' => 'Select desired image (NOTE! - Make sure you have selected a relevant value in \'Item Link Type\' above option)'
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
                                        ],
                                        '_info_content' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Item Content Options'
                                        ],
                                        '.c_padding' => [
                                            'type' => 'input.text',
                                            'label' => 'Item CSS Padding',
                                            'description' => 'Type Custom CSS for regulate padding between items',
                                            'default' => 'padding:0 10px'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_caption_date' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Date HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_title' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_caption_cat' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Caption Category HTML',
                                            'description' => 'Enter custom HTML into here.'
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
                                'style_8' => [
                                    'type' => 'collection.list',
                                    'array' => true,
                                    'label' => 'Items - Style 8',
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
                                            'content' => 'For using it make sure that you have enabled \'Carousels\', \'LightBoxes\', \'Image Hovers\' and \'Hotspots\' in Elements particle'
                                        ],
                                        '.c_height' => [
                                            'type' => 'input.text',
                                            'label' => 'Item Height',
                                            'description' => 'Type Custom CSS Height for item',
                                            'default' => '600px'
                                        ],
                                        '.c_bgColor' => [
                                            'type' => 'input.colorpicker',
                                            'label' => 'Background Color',
                                            'description' => 'Background Color of particle.',
                                            'default' => '#eeeeee'
                                        ],
                                        '.c_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Background Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_layer' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Layer HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_layer_pos' => [
                                            'type' => 'input.text',
                                            'label' => 'Layer CSS Position',
                                            'description' => 'Type Custom CSS position for regulate a layer HTML on item view',
                                            'default' => 'top:20%;left:20%'
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
