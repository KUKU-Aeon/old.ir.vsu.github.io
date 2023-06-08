<?php

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_gmap extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    }
    public static function gmap($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'width'         => 600,
            'height'        => 400,
            'responsive'    => 'yes',
            'address'       => '',
            'scroll_reveal' => '',
            'class'         => ''
        ), $atts, 'gmap');
        suAsset::addFile('css', 'gmap.css', __FUNCTION__);

        // Prepare protocol
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https://" : "http://";

        return '<div'.su_scroll_reveal($atts).' class="su-gmap su-responsive-media-' . $atts['responsive'] . su_ecssc($atts) . '"><iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="' . $protocol . 'maps.google.com/maps?q=' . urlencode(su_scattr($atts['address'])) . '&amp;output=embed"></iframe></div>';
    }

}
