<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_features.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Features',
        'description' => 'Configure Template Features.',
        'type' => 'atom',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable Template Features.',
                    'default' => true
                ],
                'modernizr' => [
                    'type' => 'enable.enable',
                    'label' => 'Modernizr v3',
                    'description' => 'http://modernizr.com/ - it contains: cssanimations, csstransforms, csstransforms3d, csstransitions, touchevents, domprefixes, prefixed, prefixes, setclasses, shiv, testallprops, testprop, teststyles',
                    'default' => true
                ],
                'jQueryEasing' => [
                    'type' => 'enable.enable',
                    'label' => 'jQuery Easing',
                    'description' => 'It Contains \'jQuery Easing\' Feature',
                    'default' => true
                ],
                'jf_iewarning' => [
                    'type' => 'enable.enable',
                    'label' => 'IE Warning',
                    'description' => 'It Contains warning popup for IE browser under version 10',
                    'default' => true
                ],
                'jf_smoothScroll' => [
                    'type' => 'enable.enable',
                    'label' => 'Smooth Scroll',
                    'description' => 'It Contains \'Smooth Scrolling\' Feature',
                    'default' => true
                ],
                'jf_lazyload' => [
                    'type' => 'enable.enable',
                    'label' => 'Images Lazy Load',
                    'description' => 'It Contains \'Images Lazy Load\' Feature',
                    'default' => true
                ],
                'stickyHeader' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Sticky Header',
                    'value' => 'name',
                    'ajax' => true,
                    'deletion' => false,
                    'reorder' => false,
                    'add_new' => false,
                    'fields' => [
                        '.name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'skip' => true
                        ],
                        '.enable' => [
                            'type' => 'enable.enable',
                            'label' => 'Sticky Header',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '.slideup' => [
                            'type' => 'select.select',
                            'label' => 'Slide Up a Header on Scroll Down?',
                            'description' => 'Do you want to slide up a Header while scrolling down?',
                            'placeholder' => 'Select...',
                            'default' => true,
                            'options' => [
                                1 => 'Yes',
                                0 => 'No'
                            ]
                        ],
                        '_info_sticky_size' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Sticky Header Size in Heights'
                        ],
                        '.menu_padding' => [
                            'type' => 'input.text',
                            'label' => 'Menu Padding Height',
                            'description' => 'Type CSS Padding Size for \'Menu Items Text\' Height',
                            'default' => '1.4rem'
                        ],
                        '.logo_size' => [
                            'type' => 'input.text',
                            'label' => 'Logo Outer Height Size',
                            'description' => 'Type Logo Outer Height Size, it must be equal to itself \'Sticked Header\' Height',
                            'default' => '68px'
                        ],
                        '.logo_scale' => [
                            'type' => 'input.text',
                            'label' => 'Logo Canvas Scale Size',
                            'description' => 'Type the percent value of Small Logo. By default it is 28% of the original size, so input value will be 0.28',
                            'default' => 0.28000000000000003
                        ],
                        '_info_homepage' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Options For HomePage'
                        ],
                        '.homepage' => [
                            'type' => 'select.select',
                            'label' => 'Make Transparent and Remove Padding?',
                            'description' => 'Do you want header to make transparent when is on top and to remove padding?',
                            'placeholder' => 'Select...',
                            'default' => false,
                            'options' => [
                                'transparent' => 'Yes',
                                'gradient' => 'Yes, but make it as Dark Gradient',
                                0 => 'No'
                            ]
                        ]
                    ]
                ],
                'jf_preloader' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Preloader',
                    'description' => 'It Contains \'Preloader\' Feature',
                    'value' => 'name',
                    'ajax' => true,
                    'deletion' => false,
                    'reorder' => false,
                    'add_new' => false,
                    'fields' => [
                        '.name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'skip' => true
                        ],
                        '.enable' => [
                            'type' => 'enable.enable',
                            'label' => 'Preloader',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '.bgColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Background Color',
                            'description' => 'Choose Background Color of Preloader',
                            'default' => '#f5f5f5'
                        ],
                        '.progressColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Progress Bar Color',
                            'description' => 'Choose Progress Bar Color of Preloader',
                            'default' => '#673ab7'
                        ]
                    ]
                ],
                'jf_scrollTop' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Scroll Top',
                    'description' => 'It Contains \'ScrollTop\' Feature',
                    'value' => 'name',
                    'ajax' => true,
                    'deletion' => false,
                    'reorder' => false,
                    'add_new' => false,
                    'fields' => [
                        '.name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'skip' => true
                        ],
                        '.enable' => [
                            'type' => 'enable.enable',
                            'label' => 'Scroll Top',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '.class' => [
                            'type' => 'input.selectize',
                            'label' => 'CSS Classes',
                            'description' => 'CSS class name for the scroll button (for example, we use it for adding wave effects).',
                            'default' => 'jf_waves_dark_10'
                        ],
                        '.bgColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Background Color',
                            'description' => 'Choose Background Color for Preloader',
                            'default' => '#FFEB3B'
                        ],
                        '.iconColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Icon Color',
                            'description' => 'Choose Icon Color for Preloader',
                            'default' => '#222222'
                        ]
                    ]
                ],
                'jf_syntax' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Syntax Highlighter',
                    'value' => 'name',
                    'ajax' => true,
                    'deletion' => false,
                    'reorder' => false,
                    'add_new' => false,
                    'fields' => [
                        '.name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'skip' => true
                        ],
                        '.prism' => [
                            'type' => 'enable.enable',
                            'label' => 'Prism Syntax Highlighter',
                            'description' => 'It Contains \'Prism Syntax Highlighter\' Feature',
                            'default' => false
                        ],
                        '.typo_preview' => [
                            'type' => 'enable.enable',
                            'label' => 'Typography Preview',
                            'description' => 'It Contains \'Typography Preview\' Functions',
                            'default' => false
                        ]
                    ]
                ]
            ]
        ]
    ]
];
