<?php

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_lightbox extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    }
    public static function lightbox($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'src'           => false,
            'type'          => 'iframe',
            'class'         => ''
        ), $atts, 'lightbox');

        if (!$atts['src']) {
            return alert_box(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_LIGHTBOX_CORRECT_SOURCE'), 'warning');
        }
        // elseif (@$_REQUEST["action"] == 'su_generator_preview') {
        //     return alert_box(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_NOT_WORK_IN_GENERATOR'), 'warning');
        // }

        suAsset::addFile('css', 'magnific-popup.css');
        suAsset::addFile('js', 'magnific-popup.js');
        suAsset::addFile('js', 'lightbox.js', __FUNCTION__);

        $lightbox_src = ($atts['type'] != 'inline') ? image_media(su_scattr($atts['src'])) : su_scattr($atts['src']);

        return '<div class="su-lightbox' . su_ecssc($atts) . '" data-mfp-src="' . $lightbox_src . '" data-mfp-type="' . $atts['type'] . '">' . su_do_shortcode($content) . '</div>';
    }
}
