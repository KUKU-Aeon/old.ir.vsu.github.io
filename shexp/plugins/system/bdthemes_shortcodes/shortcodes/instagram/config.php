<?php 

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_instagram_config extends Su_Data {

    function __construct() {
        parent::__construct();
    }
    static function get_config() {

        return array(
            'name'  => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_instagram'),
            'desc' => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_INSTAGRAM_DESC'),
            'type'  => 'single',
            'group' => 'content other',
            'badge' => 'NEW',
            'icon' => 'instagram',
            'atts'  => array(
                'user' => array(
                    'default' => 'https://instagram.com/google',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_USER'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_USER_DESC'),
                    'child' => array(
                        'hash_tag' => array(
                            'default' => '',
                            'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_HASH_TAG'),
                            'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_HASH_TAG_DESC')
                        )                        
                    )
                ),
                'client_id' => array(
                    'default' => '',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CLIENT_ID'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CLIENT_ID_DESC')
                ),
                'limit' => array(
                    'type'    => 'slider',
                    'min'     => 1,
                    'max'     => 100,
                    'step'    => 1,
                    'default' => 20,
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ITEM_LIMIT'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ITEM_LIMIT_DESC')
                ),
                'column' => array(
                    'type'    => 'slider',
                    'min'     => 1,
                    'max'     => 10,
                    'step'    => 1,
                    'default' => 6,
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ITEM_COLUMN'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ITEM_COLUMN_DESC'),
                    'child'   => array(
                        'medium' => array(
                            'type'    => 'slider',
                            'min'     => 1,
                            'max'     => 8,
                            'step'    => 1,
                            'default' => 3,
                            'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_MEDIUM_DEVICE_ITEM'),
                            'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_MEDIUM_DEVICE_ITEM_DESC')
                        ),
                        'small' => array(
                            'type'    => 'slider',
                            'min'     => 1,
                            'max'     => 5,
                            'step'    => 1,
                            'default' => 2,
                            'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SMALL_DEVICE_ITEM'),
                            'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SMALL_DEVICE_ITEM_DESC')
                        )
                    )
                ),
                'link_type' => array(
                    'default' => 'popup',
                    'type'    => 'select',
                    'values'  => array(
                        'no'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_NO'),
                        'popup' => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_POPUP'),
                        'link'  => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_LINK')
                    ),
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_LINK_TYPE'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_LINK_TYPE_DESC')
                ),
                'gap' => array(
                    'type'    => 'bool',
                    'default' => 'yes',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_GAP'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_GAP_DESC')
                ),
                'scroll_reveal' => array(
                    'default' => '',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SCROLL_REVEAL'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SCROLL_REVEAL_DESC')
                ),
                'class' => array(
                    'default' => '',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CLASS'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CLASS_DESC')
                )
            )
        );
    }

}
