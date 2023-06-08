<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/var/www/ir.vsu.ru/shexp/templates/jf_sirena/jf/particles/jf_panel_buttons.yaml',
    'modified' => 1490205216,
    'data' => [
        'name' => 'JF - Panel Buttons',
        'description' => 'Left/Right/Search Panel-Positions Buttons, used in "Header" section, It also has dropdown links list option',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable to the particles.',
                    'default' => true
                ],
                'jf_p_type' => [
                    'type' => 'select.select',
                    'label' => 'Left & Right Panel Type',
                    'description' => 'Choose Left & Right Panel types, Standard or SVG Animation',
                    'placeholder' => 'Select...',
                    'default' => 'panel_svg',
                    'options' => [
                        'panel' => 'Standard',
                        'panel_svg' => 'SVG'
                    ]
                ],
                'btns' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Buttons',
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
                                        '.jf_btn_type' => [
                                            'type' => 'select.select',
                                            'label' => 'Button Type',
                                            'description' => 'Choose one of the button type',
                                            'placeholder' => 'Select...',
                                            'default' => 'none',
                                            'options' => [
                                                'search_panel' => 'SearchPanel',
                                                'left_panel' => 'LeftPanel',
                                                'dropdown' => 'Dropdown',
                                                'top_panel' => 'TopPanel',
                                                'right_panel' => 'RightPanel',
                                                'overlay_panel' => 'OverlayPanel',
                                                'none' => 'Disable'
                                            ]
                                        ],
                                        '.jf_p_html_close' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Close Button Icon (HTML)',
                                            'description' => 'Type Icon HTML',
                                            'default' => '<i class="material-icons">close</i>'
                                        ],
                                        '.jf_p_html_open' => [
                                            'type' => 'textarea.textarea',
                                            'label' => 'Open Button Icon (HTML)',
                                            'description' => 'Type Icon HTML',
                                            'default' => '<i class="material-icons">search</i>'
                                        ]
                                    ]
                                ],
                                'tab_drop' => [
                                    'label' => 'Dropdown Panel Options',
                                    'fields' => [
                                        '_info_dr_' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'For using it make sure that you have enabled \'Dropdown\' type in \'Button Type\' options.'
                                        ],
                                        '_info_dr_list_1' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 1'
                                        ],
                                        '.dr_list_1_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_1_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_1_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_2' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 2'
                                        ],
                                        '.dr_list_2_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_2_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_2_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_3' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 3'
                                        ],
                                        '.dr_list_3_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_3_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_3_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_4' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 4'
                                        ],
                                        '.dr_list_4_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_4_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_4_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_5' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 5'
                                        ],
                                        '.dr_list_5_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_5_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_5_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_6' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 6'
                                        ],
                                        '.dr_list_6_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_6_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_6_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_7' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 7'
                                        ],
                                        '.dr_list_7_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_7_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_7_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_8' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 8'
                                        ],
                                        '.dr_list_8_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_8_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_8_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ],
                                        '_info_dr_list_9' => [
                                            'type' => 'separator.note',
                                            'class' => 'alert alert-info',
                                            'content' => 'Dropdown List Item - 9'
                                        ],
                                        '.dr_list_9_text' => [
                                            'type' => 'input.text',
                                            'label' => 'Text',
                                            'description' => 'Type Text. You can use HTML also'
                                        ],
                                        '.dr_list_9_link_url' => [
                                            'type' => 'input.text',
                                            'label' => 'Link URL',
                                            'description' => 'Type Link URL - Leave it empty if you dont want to have a link',
                                            'default' => NULL
                                        ],
                                        '.dr_list_9_link_target' => [
                                            'type' => 'select.select',
                                            'label' => 'Link Target',
                                            'placeholder' => 'Select...',
                                            'default' => 'blank',
                                            'options' => [
                                                'self' => 'Self',
                                                'blank' => 'Blank'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
