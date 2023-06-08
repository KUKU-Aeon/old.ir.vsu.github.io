<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_switcher.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF - Style Switcher',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable to the particles.',
                    'default' => true
                ],
                'html_before' => [
                    'type' => 'textarea.textarea',
                    'label' => 'HTML Content Before The Content List',
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
                        'tabs' => [
                            'type' => 'container.tabs',
                            'fields' => [
                                'tab_global' => [
                                    'label' => 'Global',
                                    'fields' => [
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
                                        '_info_options' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'SETUP Carousel Options'
                                        ],
                                        '.count_items' => [
                                            'type' => 'input.text',
                                            'label' => 'Items Amount',
                                            'description' => 'Type number of items you want to show on view',
                                            'default' => 3
                                        ],
                                        '.autoplay_delay' => [
                                            'type' => 'input.text',
                                            'label' => 'AutoPlay Delay',
                                            'description' => 'Type AutoPlay Delay number in milliseconds',
                                            'default' => 3000
                                        ],
                                        '.stophover' => [
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
                                        '.speed' => [
                                            'type' => 'input.text',
                                            'label' => 'Speed Delay',
                                            'description' => 'Type AutoPlay Delay number in milliseconds',
                                            'default' => 300
                                        ],
                                        '.navigation' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Navigation',
                                            'description' => 'Enable/Disable arrow navigation',
                                            'default' => true
                                        ],
                                        '.pagination' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Pagination',
                                            'description' => 'Enable/Disable Arrow Navigation',
                                            'default' => true
                                        ],
                                        '.lazyload' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Lazyload',
                                            'description' => 'Enable/Disable Lazyload Images',
                                            'default' => true
                                        ],
                                        '.image_lazyload_src' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Lazy Load Blank Image',
                                            'description' => 'Choose blank image for Lazy Load. This image (small blank GIF image) will be loaded before the \'Main Image\' will load.',
                                            'default' => 'gantry-media://jf/blank.gif'
                                        ],
                                        '.autoHeight' => [
                                            'type' => 'enable.enable',
                                            'label' => 'Auto Height',
                                            'description' => 'Enable/Disable Auto Height Items',
                                            'default' => false
                                        ],
                                        '.mouseDrag' => [
                                            'type' => 'enable.enable',
                                            'label' => 'MouseDrag',
                                            'description' => 'Enable/Disable MouseDrag',
                                            'default' => true
                                        ],
                                        '.touchDrag' => [
                                            'type' => 'enable.enable',
                                            'label' => 'TouchDrag',
                                            'description' => 'Enable/Disable TouchDrag',
                                            'default' => true
                                        ],
                                        '_info_custom_html' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-note',
                                            'content' => 'Custom HTML'
                                        ],
                                        '.html_content' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'HTML Content After Carousel',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_1' => [
                                    'label' => 'Item - 1',
                                    'fields' => [
                                        '.c_1_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_1_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_1_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_1_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_1_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_1_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_2' => [
                                    'label' => 'Item - 2',
                                    'fields' => [
                                        '.c_2_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_2_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_2_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_2_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_2_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_2_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_3' => [
                                    'label' => 'Item - 3',
                                    'fields' => [
                                        '.c_3_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_3_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_3_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_3_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_3_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_3_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_4' => [
                                    'label' => 'Item - 4',
                                    'fields' => [
                                        '.c_4_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_4_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_4_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_4_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_4_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_4_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_5' => [
                                    'label' => 'Item - 5',
                                    'fields' => [
                                        '.c_5_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_5_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_5_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_5_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_5_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_5_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_6' => [
                                    'label' => 'Item - 6',
                                    'fields' => [
                                        '.c_6_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_6_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_6_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_6_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_6_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_6_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_7' => [
                                    'label' => 'Item - 7',
                                    'fields' => [
                                        '.c_7_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_7_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_7_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_7_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_7_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_7_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_8' => [
                                    'label' => 'Item - 8',
                                    'fields' => [
                                        '.c_8_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_8_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_8_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_8_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_8_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_8_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_9' => [
                                    'label' => 'Item - 9',
                                    'fields' => [
                                        '.c_9_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_9_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_9_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_9_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_9_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_9_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ],
                                'tab_item_10' => [
                                    'label' => 'Item - 10',
                                    'fields' => [
                                        '.c_10_linktype' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Type',
                                            'description' => 'Choose one of Link Type',
                                            'placeholder' => 'Select...',
                                            'default' => 'custom',
                                            'options' => [
                                                'custom' => 'Custom',
                                                'current' => 'Current Page URL +/with Custom',
                                                'menuid' => 'Menu Item ID'
                                            ]
                                        ],
                                        '.c_10_url' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Custom URL',
                                            'description' => 'Type any URL. If yo want to use it as ADDON for \'Site\'s Current Page URL\', then enable \'Current Page URL +/with Custom\' option above'
                                        ],
                                        '.c_10_menu_id' => [
                                            'type' => 'input.text',
                                            'class' => 'alert alert-info',
                                            'label' => 'Menu Item ID',
                                            'description' => 'Type menu item ID if you want to link it to you menu items. \'Menu Item IDs\' you can find in Joomla Menu Manager'
                                        ],
                                        '.c_10_image' => [
                                            'type' => 'input.imagepicker',
                                            'label' => 'Content Image',
                                            'description' => 'Select desired image.'
                                        ],
                                        '.c_10_caption_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Caption Title HTML',
                                            'description' => 'Enter custom HTML into here.'
                                        ],
                                        '.c_10_descr_title' => [
                                            'type' => 'textarea.text',
                                            'label' => 'Description Title',
                                            'description' => 'Enter custom HTML into here.'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'html_after' => [
                    'type' => 'textarea.textarea',
                    'label' => 'HTML Content After The Content List',
                    'description' => 'Enter custom HTML into here.'
                ]
            ]
        ]
    ]
];
