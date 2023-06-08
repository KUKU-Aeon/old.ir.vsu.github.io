<?php 

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_youtube extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    } 

    public static function youtube($atts = null, $content = null) {
    
        $return = array();
        $atts = su_shortcode_atts(array(
            'url'           => false,
            'width'         => 600,
            'height'        => 400,
            'autoplay'      => 'no',
            'responsive'    => 'yes',
            'scroll_reveal' => '',
            'class'         => ''
                ), $atts, 'youtube');
        if (!$atts['url'])
            return alert_box(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_YOUTUBE_CU'), 'warning');
        $atts['url'] = su_scattr($atts['url']);
        $id = ( preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $atts['url'], $match) ) ? $match[1] : false;
       
        if (!$id)
        return alert_box(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_YOUTUBE_CI'), 'warning');
    
        // Prepare protocol
        $protocol = ( preg_match( '/^(https?:\\/\\/)/i', $atts['url'], $match ) ) ? $match[1] : "http://";
        
        $autoplay = ( $atts['autoplay'] === 'yes' ) ? '?autoplay=1' : '';

        $return[] = '<div'.su_scroll_reveal($atts).' class="su-youtube su-responsive-media-' . $atts['responsive'] . su_ecssc($atts) . '">';
        $return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="' . $protocol . 'www.youtube.com/embed/' . $id . $autoplay . '" allowfullscreen></iframe>';
        $return[] = '</div>';
        suAsset::addFile('css', 'youtube.css', __FUNCTION__);

        return implode('', $return);
    }
}
