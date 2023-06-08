<?php
return [
    '@class' => 'Gantry\\Component\\Config\\CompiledConfig',
    'timestamp' => 1556792613,
    'checksum' => '3a67057876293d39e4527e71edaed721',
    'files' => [
        'templates/g5_hydrogen/custom/config/14' => [
            'index' => [
                'file' => 'templates/g5_hydrogen/custom/config/14/index.yaml',
                'modified' => 1556792571
            ],
            'layout' => [
                'file' => 'templates/g5_hydrogen/custom/config/14/layout.yaml',
                'modified' => 1556792571
            ],
            'styles' => [
                'file' => 'templates/g5_hydrogen/custom/config/14/styles.yaml',
                'modified' => 1490271894
            ]
        ],
        'templates/g5_hydrogen/custom/config/default' => [
            'index' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/index.yaml',
                'modified' => 1490367209
            ],
            'layout' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/layout.yaml',
                'modified' => 1490367209
            ],
            'page/assets' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/page/assets.yaml',
                'modified' => 1492501806
            ],
            'page/body' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/page/body.yaml',
                'modified' => 1492501806
            ],
            'page/head' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/page/head.yaml',
                'modified' => 1492501806
            ]
        ],
        'templates/g5_hydrogen/config/default' => [
            'particles/logo' => [
                'file' => 'templates/g5_hydrogen/config/default/particles/logo.yaml',
                'modified' => 1490269327
            ]
        ]
    ],
    'data' => [
        'particles' => [
            'sample' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true
            ],
            'branding' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true,
                'content' => 'Powered by <a href="http://www.gantry.org/" title="Gantry Framework" class="g-powered-by">Gantry Framework</a>',
                'css' => [
                    'class' => 'branding'
                ]
            ],
            'copyright' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true,
                'date' => [
                    'start' => 'now',
                    'end' => 'now'
                ]
            ],
            'custom' => [
                'caching' => [
                    'type' => 'config_matches',
                    'values' => [
                        'twig' => '0',
                        'filter' => '0'
                    ]
                ],
                'enabled' => true,
                'twig' => '0',
                'filter' => '0'
            ],
            'logo' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => '1',
                'link' => true,
                'url' => '',
                'image' => 'gantry-assets://images/gantry5-logo.png',
                'text' => 'Gantry 5',
                'class' => 'gantry-logo'
            ],
            'menu' => [
                'caching' => [
                    'type' => 'menu'
                ],
                'enabled' => true,
                'menu' => '',
                'base' => '/',
                'startLevel' => 1,
                'maxLevels' => 0,
                'renderTitles' => 0,
                'hoverExpand' => 1,
                'mobileTarget' => 0
            ],
            'mobile-menu' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true
            ],
            'social' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true,
                'css' => [
                    'class' => 'social'
                ],
                'target' => '_blank',
                'display' => 'both'
            ],
            'spacer' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true
            ],
            'totop' => [
                'caching' => [
                    'type' => 'static'
                ],
                'enabled' => true,
                'css' => [
                    'class' => 'totop'
                ]
            ],
            'analytics' => [
                'enabled' => true,
                'ua' => [
                    'anonym' => false,
                    'ssl' => false,
                    'debug' => false
                ]
            ],
            'assets' => [
                'enabled' => true,
                'priority' => 0,
                'in_footer' => false
            ],
            'content' => [
                'enabled' => true
            ],
            'contentarray' => [
                'enabled' => true,
                'article' => [
                    'filter' => [
                        'featured' => ''
                    ],
                    'limit' => [
                        'total' => 2,
                        'columns' => 2,
                        'start' => 0
                    ],
                    'sort' => [
                        'orderby' => 'publish_up',
                        'ordering' => 'ASC'
                    ],
                    'display' => [
                        'image' => [
                            'enabled' => 'intro'
                        ],
                        'text' => [
                            'type' => 'intro',
                            'limit' => '',
                            'formatting' => 'text'
                        ],
                        'title' => [
                            'enabled' => 'show'
                        ],
                        'date' => [
                            'enabled' => 'published',
                            'format' => 'l, F d, Y'
                        ],
                        'read_more' => [
                            'enabled' => 'show'
                        ],
                        'author' => [
                            'enabled' => 'show'
                        ],
                        'category' => [
                            'enabled' => 'link'
                        ],
                        'hits' => [
                            'enabled' => 'show'
                        ]
                    ]
                ]
            ],
            'date' => [
                'enabled' => true,
                'css' => [
                    'class' => 'date'
                ],
                'date' => [
                    'formats' => 'l, F d, Y'
                ]
            ],
            'frameworks' => [
                'enabled' => true,
                'jquery' => [
                    'enabled' => 0,
                    'ui_core' => 0,
                    'ui_sortable' => 0
                ],
                'bootstrap' => [
                    'enabled' => 0
                ],
                'mootools' => [
                    'enabled' => 0,
                    'more' => 0
                ]
            ],
            'lightcase' => [
                'enabled' => true
            ],
            'messages' => [
                'enabled' => true
            ],
            'module' => [
                'enabled' => true
            ],
            'position' => [
                'enabled' => true
            ]
        ],
        'page' => [
            'doctype' => 'html',
            'body' => [
                'class' => 'gantry',
                'attribs' => [
                    'class' => 'gantry',
                    'id' => '',
                    'extra' => [
                        
                    ]
                ],
                'layout' => [
                    'sections' => '0'
                ],
                'body_top' => '',
                'body_bottom' => ''
            ],
            'assets' => [
                'priority' => 0,
                'in_footer' => false,
                'favicon' => 'gantry-media://2017/NextendSider/24.03.2017-Logo_top_body/FacMezhdyOtnosh.jpg',
                'touchicon' => '',
                'css' => [
                    
                ],
                'javascript' => [
                    
                ]
            ],
            'head' => [
                'meta' => [
                    
                ],
                'head_bottom' => '',
                'atoms' => [
                    
                ]
            ]
        ],
        'styles' => [
            'accent' => [
                'color-1' => '#507299',
                'color-2' => '#54425c'
            ],
            'base' => [
                'background' => '#ffffff',
                'text-color' => '#666666',
                'body-font' => 'roboto, sans-serif',
                'heading-font' => 'roboto, sans-serif'
            ],
            'breakpoints' => [
                'large-desktop-container' => '75rem',
                'desktop-container' => '60rem',
                'tablet-container' => '48rem',
                'large-mobile-container' => '30rem',
                'mobile-menu-breakpoint' => '48rem'
            ],
            'feature' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'footer' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'header' => [
                'background' => '#ffffff',
                'text-color' => '#ffffff'
            ],
            'main' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'menu' => [
                'col-width' => '180px',
                'animation' => 'g-fade'
            ],
            'navigation' => [
                'background' => '#ffffff',
                'text-color' => '#ffffff',
                'overlay' => 'rgba(0, 0, 0, 0.4)'
            ],
            'offcanvas' => [
                'background' => '#354d59',
                'text-color' => '#ffffff',
                'width' => '17rem',
                'toggle-color' => '#ffffff',
                'toggle-visibility' => 1
            ],
            'showcase' => [
                'background' => '#354d59',
                'image' => '',
                'text-color' => '#ffffff'
            ],
            'subfeature' => [
                'background' => '#f0f0f0',
                'text-color' => '#666666'
            ],
            'preset' => 'preset1'
        ],
        'index' => [
            'name' => '14',
            'timestamp' => 1556792571,
            'version' => 7,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/3-col.png',
                'name' => '3_column',
                'timestamp' => 1490269327
            ],
            'positions' => [
                'footer' => 'Footer'
            ],
            'sections' => [
                'header' => 'Header',
                'navigation' => 'Navigation',
                'sidebar' => 'Sidebar',
                'aside' => 'Aside',
                'main' => 'Main',
                'footer' => 'Footer',
                'offcanvas' => 'Offcanvas'
            ],
            'particles' => [
                'module' => [
                    'position-module-9827' => 'LOgo_3_top',
                    'position-module-7987' => 'Menu hone en-ru',
                    'position-module-6278' => 'Stop_zindex',
                    'position-module-4844' => 'Module Instance',
                    'position-module-5086' => 'Новости к-2 Руская версия',
                    'position-module-3231' => 'News eng version K-2'
                ],
                'position' => [
                    'position-footer' => 'Footer'
                ],
                'copyright' => [
                    'copyright-2657' => 'Copyright'
                ],
                'custom' => [
                    'custom-7331' => 'Custom HTML'
                ],
                'mobile-menu' => [
                    'mobile-menu-3879' => 'Mobile-menu'
                ]
            ],
            'inherit' => [
                
            ]
        ],
        'layout' => [
            'version' => 2,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/3-col.png',
                'name' => '3_column',
                'timestamp' => 1490269327
            ],
            'layout' => [
                '/header/' => [
                    0 => [
                        0 => 'position-module-9827'
                    ],
                    1 => [
                        0 => 'position-module-7987'
                    ]
                ],
                '/navigation/' => [
                    0 => [
                        0 => 'position-module-6278'
                    ]
                ],
                '/container-main/' => [
                    0 => [
                        0 => [
                            'sidebar 16' => [
                                
                            ]
                        ],
                        1 => [
                            'main 58' => [
                                0 => [
                                    0 => 'position-module-4844'
                                ],
                                1 => [
                                    0 => 'position-module-5086'
                                ],
                                2 => [
                                    0 => 'position-module-3231'
                                ]
                            ]
                        ],
                        2 => [
                            'aside 26' => [
                                
                            ]
                        ]
                    ]
                ],
                '/footer/' => [
                    0 => [
                        0 => 'position-footer'
                    ],
                    1 => [
                        0 => 'copyright-2657 20',
                        1 => 'custom-7331 80'
                    ]
                ],
                'offcanvas' => [
                    0 => [
                        0 => 'mobile-menu-3879'
                    ]
                ]
            ],
            'structure' => [
                'header' => [
                    'attributes' => [
                        'boxed' => '2',
                        'class' => ''
                    ]
                ],
                'navigation' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'sidebar' => [
                    'type' => 'section',
                    'subtype' => 'aside',
                    'block' => [
                        'fixed' => 1
                    ]
                ],
                'aside' => [
                    'block' => [
                        'fixed' => 1
                    ]
                ],
                'container-main' => [
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'footer' => [
                    'attributes' => [
                        'boxed' => ''
                    ]
                ]
            ],
            'content' => [
                'position-module-9827' => [
                    'title' => 'LOgo_3_top',
                    'attributes' => [
                        'module_id' => '118',
                        'key' => 'logo_3_top'
                    ]
                ],
                'position-module-7987' => [
                    'title' => 'Menu hone en-ru',
                    'attributes' => [
                        'module_id' => '96',
                        'key' => 'menu-hone-en-ru'
                    ]
                ],
                'position-module-6278' => [
                    'title' => 'Stop_zindex',
                    'attributes' => [
                        'module_id' => '119',
                        'key' => 'stop_zindex'
                    ]
                ],
                'position-module-4844' => [
                    'title' => 'Module Instance',
                    'attributes' => [
                        'module_id' => '121'
                    ]
                ],
                'position-module-5086' => [
                    'title' => 'Новости к-2 Руская версия',
                    'attributes' => [
                        'enabled' => 0,
                        'module_id' => '113'
                    ]
                ],
                'position-module-3231' => [
                    'title' => 'News eng version K-2',
                    'attributes' => [
                        'enabled' => 0,
                        'module_id' => '114'
                    ]
                ],
                'position-footer' => [
                    'attributes' => [
                        'key' => 'footer'
                    ]
                ],
                'copyright-2657' => [
                    'attributes' => [
                        'date' => [
                            'start' => 'SHEXP 2016',
                            'end' => '2019'
                        ],
                        'owner' => ''
                    ]
                ],
                'custom-7331' => [
                    'title' => 'Custom HTML',
                    'attributes' => [
                        'html' => '<div>
<a> Education, Audiovisual and Culture Executive Agency
<br> Call for proposals EAC/A04/2015 - Jean Monnet Activities
<br><span style="color: #015175;"> Agreement n. 2016 - 2594/001-001
Project № 575018-EPP-1-2016-1-RU-EPPJMO-MODULE
<div>
<p>The European Commission support for the production of this publication does not constitute an endorsement of the contents which reflects the views only of the authors, and the Commission cannot be held responsible for any use which may be made of the information contained therein.</p>'
                    ]
                ]
            ]
        ]
    ]
];
