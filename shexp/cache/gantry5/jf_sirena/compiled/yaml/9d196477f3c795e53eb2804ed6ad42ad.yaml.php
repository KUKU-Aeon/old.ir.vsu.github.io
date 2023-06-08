<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_elements.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF Elements',
        'description' => 'Configure Template Elements.',
        'type' => 'atom',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable Template Elements.',
                    'default' => true
                ],
                '_info_typo' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Typography'
                ],
                'typo' => [
                    'type' => 'enable.enable',
                    'label' => 'Typography',
                    'description' => 'It Contains Typography Elements (Headings, Columns, Highlights ...)',
                    'default' => true
                ],
                '_info_common' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Common'
                ],
                'waves' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Waves Click Effect',
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
                            'label' => 'Waves',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '.duration' => [
                            'type' => 'input.text',
                            'label' => 'Duration',
                            'description' => 'How long Waves effect duration when it\'s clicked (in milliseconds)',
                            'default' => 500
                        ],
                        '.delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Delay showing Waves effect on touch and hide the effect if user scrolls (0 to disable delay) (in milliseconds)',
                            'default' => 200
                        ],
                        '.dark10' => [
                            'type' => 'input.text',
                            'label' => 'Dark 10%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark20' => [
                            'type' => 'input.text',
                            'label' => 'Dark 20% (Default)',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark30' => [
                            'type' => 'input.text',
                            'label' => 'Dark 30%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark40' => [
                            'type' => 'input.text',
                            'label' => 'Dark 40%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark50' => [
                            'type' => 'input.text',
                            'label' => 'Dark 50%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark60' => [
                            'type' => 'input.text',
                            'label' => 'Dark 60%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark70' => [
                            'type' => 'input.text',
                            'label' => 'Dark 70%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark80' => [
                            'type' => 'input.text',
                            'label' => 'Dark 80%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark90' => [
                            'type' => 'input.text',
                            'label' => 'Dark 90%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.dark100' => [
                            'type' => 'input.text',
                            'label' => 'Dark 100%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light10' => [
                            'type' => 'input.text',
                            'label' => 'Light 10%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light20' => [
                            'type' => 'input.text',
                            'label' => 'Light 20%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light30' => [
                            'type' => 'input.text',
                            'label' => 'Light 30%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light40' => [
                            'type' => 'input.text',
                            'label' => 'Light 40%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light50' => [
                            'type' => 'input.text',
                            'label' => 'Light 50%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light60' => [
                            'type' => 'input.text',
                            'label' => 'Light 60%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light70' => [
                            'type' => 'input.text',
                            'label' => 'Light 70%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light80' => [
                            'type' => 'input.text',
                            'label' => 'Light 80%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light90' => [
                            'type' => 'input.text',
                            'label' => 'Light 90%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.light100' => [
                            'type' => 'input.text',
                            'label' => 'Light 100%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark10' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 10%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark20' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 20%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark30' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 30%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark40' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 40%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark50' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 50%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark60' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 60%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark70' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 70%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark80' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 80%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark90' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 90%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowDark100' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Dark 100%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight10' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 10%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight20' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 20%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight30' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 30%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight40' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 40%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight50' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 50%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight60' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 60%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight70' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 70%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight80' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 80%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight90' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 90%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ],
                        '.shadowLight100' => [
                            'type' => 'input.text',
                            'label' => 'Shadow Light 100%',
                            'description' => 'Put HTML tag selectors, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)'
                        ]
                    ]
                ],
                'buttons' => [
                    'type' => 'enable.enable',
                    'label' => 'Buttons',
                    'description' => 'It Contains Button Elements',
                    'default' => true
                ],
                'tabs' => [
                    'type' => 'enable.enable',
                    'label' => 'Tabs',
                    'description' => 'It Contains Tabs Elements',
                    'default' => true
                ],
                'acc_toggl' => [
                    'type' => 'enable.enable',
                    'label' => 'Accordions & Toggles',
                    'description' => 'It Contains Accordions & Toggles Elements',
                    'default' => true
                ],
                'dropdowns' => [
                    'type' => 'enable.enable',
                    'label' => 'Dropdowns',
                    'description' => 'It Contains Dropdowns Elements',
                    'default' => true
                ],
                'dialogs' => [
                    'type' => 'enable.enable',
                    'label' => 'Dialogs',
                    'description' => 'It Contains Dialogs Elements',
                    'default' => true
                ],
                'pricing' => [
                    'type' => 'enable.enable',
                    'label' => 'Pricing Tables',
                    'description' => 'It Contains Pricing Tables Elements',
                    'default' => true
                ],
                'cards' => [
                    'type' => 'enable.enable',
                    'label' => 'Material Cards',
                    'description' => 'It Contains Material Cards Elements',
                    'default' => true
                ],
                'messages' => [
                    'type' => 'enable.enable',
                    'label' => 'Message Boxes',
                    'description' => 'It Contains Message Boxes Elements',
                    'default' => true
                ],
                'social_icons' => [
                    'type' => 'enable.enable',
                    'label' => 'Social Icons',
                    'description' => 'It Contains Social Icons Elements',
                    'default' => true
                ],
                'tooltips' => [
                    'type' => 'enable.enable',
                    'label' => 'Tooltips',
                    'description' => 'It Contains Tooltip Elements',
                    'default' => true
                ],
                'bs_buttons' => [
                    'type' => 'enable.enable',
                    'label' => 'Bootstrap - Buttons',
                    'description' => 'It Contains Bootstrap Buttons Elements',
                    'default' => true
                ],
                'bs_modals' => [
                    'type' => 'enable.enable',
                    'label' => 'Bootstrap - Modals',
                    'description' => 'It Contains Bootstrap Modal Elements',
                    'default' => true
                ],
                'bs_dropdowns' => [
                    'type' => 'enable.enable',
                    'label' => 'Bootstrap - Dropdowns',
                    'description' => 'It Contains Bootstrap Dropdown Elements',
                    'default' => true
                ],
                'bs_popovers' => [
                    'type' => 'enable.enable',
                    'label' => 'Bootstrap - Popovers',
                    'description' => 'It Contains Bootstrap Popover Elements',
                    'default' => true
                ],
                'bs_carousels' => [
                    'type' => 'enable.enable',
                    'label' => 'Bootstrap - Carousels',
                    'description' => 'It Contains Bootstrap Carousel Elements',
                    'default' => true
                ],
                '_info_interactive' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Interactive'
                ],
                'cssAnim' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'CSS3 Animations',
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
                            'label' => 'CSS3 Animations Feature',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '_info_all_anim' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'ALL Available CSS3 Animations - http://daneden.github.io/animate.css/ - (instead of this option we advice you to use "Custom Animations" option below, because using this \'All CSS3 Animations\' may slow your site)'
                        ],
                        '.all_anim' => [
                            'type' => 'enable.enable',
                            'label' => 'All CSS3 Animations',
                            'description' => 'Enable All CSS3 available Animations? (It loads heavy stylesheets)',
                            'placeholder' => 'Select...',
                            'default' => false
                        ],
                        '.all_anim_sheet' => [
                            'type' => 'input.text',
                            'label' => 'CDN Stylesheet',
                            'description' => 'Type the URL of CSS3 animate Stylesheet. It will be applied when \'All CSS3 Animations\' option is enabled above',
                            'default' => '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.0/animate.min.css'
                        ],
                        '_info_custom_anim' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Custom Animations - a lightweight, customly choosed, small amount of animations written in - "TEMPLATE/jf/elements/others/css3_anim/jf_css3_anim.min.scss"'
                        ],
                        '.custom_anim' => [
                            'type' => 'enable.enable',
                            'label' => 'Custom Animations',
                            'placeholder' => 'Select...',
                            'description' => 'It will load \'Custom Animation\' Styles (you have to manually edit \'TEMPLATE_NAME/jf/elements/others/css3_anim/jf_css3_anim.min.scss\' file)',
                            'default' => true
                        ],
                        '_info_css3_animate_1' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 1'
                        ],
                        '.css3_animate_1_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_1_type' => [
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
                        '.css3_animate_1_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_1_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_2' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 2'
                        ],
                        '.css3_animate_2_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_2_type' => [
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
                        '.css3_animate_2_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_2_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_3' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 3'
                        ],
                        '.css3_animate_3_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_3_type' => [
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
                        '.css3_animate_3_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_3_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_4' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 4'
                        ],
                        '.css3_animate_4_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_4_type' => [
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
                        '.css3_animate_4_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_4_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_5' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 5'
                        ],
                        '.css3_animate_5_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_5_type' => [
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
                        '.css3_animate_5_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_5_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_6' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 6'
                        ],
                        '.css3_animate_6_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_6_type' => [
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
                        '.css3_animate_6_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_6_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ],
                        '_info_css3_animate_7' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'CSS3 Animation - 7'
                        ],
                        '.css3_animate_7_name' => [
                            'type' => 'input.text',
                            'label' => 'Name',
                            'description' => 'Find CSS3 Animation Names List on - http://daneden.github.io/animate.css/',
                            'default' => NULL
                        ],
                        '.css3_animate_7_type' => [
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
                        '.css3_animate_7_delay' => [
                            'type' => 'input.text',
                            'label' => 'Delay',
                            'description' => 'Type the time when you want to run CSS3 animation, for example \'2\' = 2 Seconds (NOTE! Leave it empty if you dont want to use it)',
                            'default' => NULL
                        ],
                        '.css3_animate_7_tags' => [
                            'type' => 'textarea.textarea',
                            'label' => 'HTML Tags',
                            'description' => 'Type HTML Tags\' classes, separate them with commas (for example - .firstclass,.secondclass,.thirdclass)',
                            'default' => NULL
                        ]
                    ]
                ],
                'flip_boxes' => [
                    'type' => 'enable.enable',
                    'label' => 'Flip Boxes',
                    'description' => 'It Contains Flip Boxes Elements',
                    'default' => true
                ],
                'parallaxSections' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Parallax Sections',
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
                            'label' => 'Parallax Feature',
                            'placeholder' => 'Select...',
                            'default' => true
                        ],
                        '.videobg_self' => [
                            'type' => 'enable.enable',
                            'label' => 'Video BG - Self Hosted',
                            'description' => 'Self Hosted Video Background - For using it you must have \'.jpg\' image cover, \'.mp4\', \'.ogv\' and \'.webm\' video files',
                            'default' => true
                        ],
                        '.videobg_vimeo' => [
                            'type' => 'enable.enable',
                            'label' => 'Video BG - Vimeo',
                            'description' => 'Vimeo.com video background function.',
                            'default' => true
                        ],
                        '.videobg_youtube' => [
                            'type' => 'enable.enable',
                            'label' => 'Video BG - Youtube',
                            'description' => 'Youtube.com video background function.',
                            'default' => true
                        ],
                        '_info_custom_par' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'If you want to apply Parallax effect to Template\'s Any Elements (Sections, Positions ...), please use options below.'
                        ],
                        '_info_custom_par_1' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 1'
                        ],
                        '.custom_par_1_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example "#my-custom-tag-1" or multiple tags "#my-custom-tag-1,#my-custom-tag-2" (we use multiple tag for wrapping parallax to those tags).'
                        ],
                        '.custom_par_1_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_1_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_1_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_1_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_1_maskOpacity' => [
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
                        '_info_custom_par_2' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 2'
                        ],
                        '.custom_par_2_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_2_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_2_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_2_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_2_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_2_maskOpacity' => [
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
                        '_info_custom_par_3' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 3'
                        ],
                        '.custom_par_3_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_3_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_3_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_3_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_3_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_3_maskOpacity' => [
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
                        '_info_custom_par_4' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 4'
                        ],
                        '.custom_par_4_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_4_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_4_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_4_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_4_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_4_maskOpacity' => [
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
                        '_info_custom_par_5' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 5'
                        ],
                        '.custom_par_5_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_5_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_5_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_5_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_5_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_5_maskOpacity' => [
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
                        '_info_custom_par_6' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 6'
                        ],
                        '.custom_par_6_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_6_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_6_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_6_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_6_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_6_maskOpacity' => [
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
                        '_info_custom_par_7' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 7'
                        ],
                        '.custom_par_7_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_7_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_7_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_7_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_7_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_7_maskOpacity' => [
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
                        '_info_custom_par_8' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 8'
                        ],
                        '.custom_par_8_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_8_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_8_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_8_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_8_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_8_maskOpacity' => [
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
                        '_info_custom_par_9' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'Parallax HTML Tag Element 9'
                        ],
                        '.custom_par_9_id' => [
                            'type' => 'input.text',
                            'label' => 'HTML Tag(s)',
                            'description' => 'Type HTML tag(s) element(s), for example \'#my-custom-tag-1\' or multiple tags \'#my-custom-tag-1,#my-custom-tag-2\' (we use multiple tags for wrapping parallax to those tags)'
                        ],
                        '.custom_par_9_wrap' => [
                            'type' => 'enable.enable',
                            'label' => 'Wrap Parallax to tags?',
                            'description' => 'Do you want to combine multiple tags in one parallax section? (make sure that you have wrote/typed/put multiple tags above in the field)',
                            'default' => false
                        ],
                        '.custom_par_9_image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Choose Parallax Background Image'
                        ],
                        '.custom_par_9_type' => [
                            'type' => 'select.select',
                            'label' => 'Choose Style',
                            'description' => 'Choose Parallax Image Type.',
                            'placeholder' => 'Select...',
                            'default' => 'cover',
                            'options' => [
                                'cover' => 'Cover',
                                'contain' => 'Contain'
                            ]
                        ],
                        '.custom_par_9_maskColor' => [
                            'type' => 'input.colorpicker',
                            'label' => 'Mask Overlay Color',
                            'description' => 'Choose Mask Overlay Color which will cover the image/video. It is used for making image/video darker.',
                            'default' => '#000000'
                        ],
                        '.custom_par_9_maskOpacity' => [
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
                        ]
                    ]
                ],
                'lightboxes' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'LightBoxes',
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
                        '_info_photoswipe' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'PhotoSwipe LightBox - http://photoswipe.com/'
                        ],
                        '.enable_photoswipe' => [
                            'type' => 'enable.enable',
                            'label' => 'PhotoSwipe Feature',
                            'default' => true
                        ],
                        '.ps_caption' => [
                            'type' => 'enable.enable',
                            'label' => 'Captions',
                            'default' => true
                        ],
                        '.ps_fullscreen' => [
                            'type' => 'enable.enable',
                            'label' => 'Fullscreen',
                            'default' => true
                        ],
                        '.ps_zoom' => [
                            'type' => 'enable.enable',
                            'label' => 'Zoom',
                            'default' => true
                        ],
                        '.ps_share' => [
                            'type' => 'enable.enable',
                            'label' => 'Share',
                            'default' => true
                        ],
                        '.ps_counter' => [
                            'type' => 'enable.enable',
                            'label' => 'Counter',
                            'default' => true
                        ],
                        '.ps_arrow' => [
                            'type' => 'enable.enable',
                            'label' => 'Arrows',
                            'default' => true
                        ],
                        '.ps_preloader' => [
                            'type' => 'enable.enable',
                            'label' => 'Preloader',
                            'default' => true
                        ],
                        '_info_venobox' => [
                            'type' => 'separator.note',
                            'class' => 'alert alert-info',
                            'content' => 'VenoBox LightBox - http://lab.veno.it/venobox/'
                        ],
                        '.enable_venobox' => [
                            'type' => 'enable.enable',
                            'label' => 'VenoBox Feature',
                            'default' => true
                        ],
                        '.vb_numeration' => [
                            'type' => 'enable.enable',
                            'label' => 'Numeration',
                            'default' => true
                        ],
                        '.vb_infinite' => [
                            'type' => 'enable.enable',
                            'label' => 'Infinite Gallery',
                            'default' => true
                        ]
                    ]
                ],
                'img_hovers' => [
                    'type' => 'enable.enable',
                    'label' => 'Image Hover Styles',
                    'description' => 'It Contains Image Hover Style Elements',
                    'default' => true
                ],
                'hotspots' => [
                    'type' => 'enable.enable',
                    'label' => 'Image Hotspots',
                    'description' => 'It Contains Image Hotspots Elements',
                    'default' => true
                ],
                'carousels' => [
                    'type' => 'enable.enable',
                    'label' => 'Carousel Sliders',
                    'description' => 'It Contains Carousel Sliders Elements',
                    'default' => true
                ],
                'testimonials' => [
                    'type' => 'enable.enable',
                    'label' => 'Testimonials',
                    'description' => 'It Contains Testimonials Elements',
                    'default' => true
                ],
                '_info_infographics' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Infographics / Icons'
                ],
                'iconLists' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Icon Lists',
                    'description' => 'It Contains Icon Lists Elements',
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
                            'label' => 'Icons',
                            'description' => 'Target browser window when item is clicked.',
                            'default' => true
                        ],
                        '.url_1' => [
                            'type' => 'input.text',
                            'label' => 'CDN Stylesheet 1',
                            'description' => 'Put Stylesheet URL.',
                            'default' => '//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'
                        ],
                        '.url_2' => [
                            'type' => 'input.text',
                            'label' => 'CDN Stylesheet 2',
                            'description' => 'Put Stylesheet URL.',
                            'default' => NULL
                        ],
                        '.url_3' => [
                            'type' => 'input.text',
                            'label' => 'CDN Stylesheet 3',
                            'description' => 'Put Stylesheet URL.',
                            'default' => NULL
                        ]
                    ]
                ],
                'icon_boxes' => [
                    'type' => 'enable.enable',
                    'label' => 'Icon Boxes',
                    'description' => 'It Contains Icon Boxes Elements',
                    'default' => true
                ],
                'counters' => [
                    'type' => 'enable.enable',
                    'label' => 'Counters',
                    'description' => 'It Contains Counters Elements',
                    'default' => true
                ],
                'progress_bars' => [
                    'type' => 'enable.enable',
                    'label' => 'Progress Bars',
                    'description' => 'It Contains Progress Bars Elements',
                    'default' => true
                ],
                'process_steps' => [
                    'type' => 'enable.enable',
                    'label' => 'Process Steps',
                    'description' => 'It Contains Process Steps Elements',
                    'default' => true
                ],
                'pies_inf' => [
                    'type' => 'enable.enable',
                    'label' => 'Infographic Pies',
                    'description' => 'It Contains Infographic Pies Elements',
                    'default' => true
                ],
                'charts' => [
                    'type' => 'enable.enable',
                    'label' => 'Charts',
                    'description' => 'It Contains Charts Elements',
                    'default' => true
                ],
                'graphs' => [
                    'type' => 'enable.enable',
                    'label' => 'Line Graphs',
                    'description' => 'It Contains Line Graphs Elements',
                    'default' => true
                ]
            ]
        ]
    ]
];
