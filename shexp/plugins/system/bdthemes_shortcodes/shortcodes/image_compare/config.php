<?php 

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_image_compare_config extends Su_Data {

    function __construct() {
        parent::__construct();
    }
    static function get_config() {

        return array(
            'name'     => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IMAGE_COMPARE'),
            'desc'     => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IMAGE_COMPARE_DESC'),
            'type'     => 'single',
            'group'    => 'extra content',
            'icon'     => 'image',
            'atts' => array( 
                'before_image' => array(
                    'type'    => 'upload',
                    'default' => '',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_BEFORE_IMAGE'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_BEFORE_IMAGE_DESC')
                ), 
                'after_image' => array(
                    'type'    => 'upload',
                    'default' => '',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_AFTER_IMAGE'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_AFTER_IMAGE_DESC')
                ), 
                'before_text' => array(
                    'default' => 'Original',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_BEFORE_TEXT'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_BEFORE_TEXT_DESC')
                ), 
                'after_text' => array(
                    'default' => 'Modified',
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_AFTER_TEXT'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_AFTER_TEXT_DESC')
                ), 
                'orientation' => array(
                    'type'   => 'select',
                    'values' => array(
                        'horizontal' => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_HORIZONTAL'),
                        'vertical' => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IC_VERTICAL')
                    ),
                    'default' => 1,
                    'name'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ORIENTATION'),
                    'desc'    => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_ORIENTATION_DESC')
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
