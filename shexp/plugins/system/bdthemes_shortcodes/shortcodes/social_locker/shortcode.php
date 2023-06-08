<?php

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_social_locker extends Su_Shortcodes {

    function __construct() { parent::__construct(); }

    public static function social_locker($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'id'            => uniqid('suf'),
            'style'         => 'starter', //starter, secrets, dandyish, glass, flat
            'title'         => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SL_LOCKED'),
            'message'       => JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_SL_LOCKED_MSG'),
            'timer'         => 0,
            'close'         => 'no',
            'mobile'        => 'no',
            'demo_mode'     => 'no',
            'guest_only'    => 'no',
            'facebook'      => 'yes',
            'google_plus'   => 'yes',
            'twitter'       => 'yes',
            'overlap'       => 'full', // full, transparence, blurring
            'url'           => '',
            'scroll_reveal' => '',
            'class'         => ''
                ), $atts, 'social_locker');
  
        $return = array();
        $current_url = JURI::current();
        $active = 1;
        
        $button = array();
        if ($atts['facebook'] === 'yes')
            $button[] = 'facebook-like';
        if ($atts['google_plus'] === 'yes')
            $button[] = 'google-plus';
        if ($atts['twitter'] === 'yes')
            $button[] = 'twitter-tweet';

        if ($atts['guest_only'] === 'yes') {
            $guest = JFactory::getUser();
            $active = (!$guest->guest) ? 0 : 1;    
        }
        $settings = array(
            'url' => ($atts['url']) ? urlencode($atts['url']) : urlencode($current_url),
            'theme' => $atts['style'],
            'text' => array(
                    'header' => $atts['title'],
                    'message' => $atts['message']
                    ),
            'locker' => array(
                    'close' => ($atts['close'] === 'yes') ? true : false,
                    'timer' => $atts['timer'],
                    'mobile' => ($atts['mobile'] === 'yes') ? true : false
                ),
            'overlap' => array(
                    'mode' => $atts['overlap'],
                    'intensity'=> 5
                ),
            'buttons' => array(
                    'order' => $button
                    ),
            'demo' => ($atts['demo_mode'] === 'yes') ? true : false
        );

        $js = '
                jQuery(document).ready(function($) {
                    "use strict";
                    $("#'. $atts['id'] .'.su-social-lock").sociallocker(
                        '.json_encode($settings).'
                    );
                });
        ';

        if ( $active && !is_null( $content ) ) {
            $return[] = '<div id="'. $atts['id'] . '"'.su_scroll_reveal($atts).' class="su-social-lock '.su_ecssc($atts). '">';
            $return[] = su_do_shortcode($content);
            $return[] = '</div>';


            suAsset::addFile('css', 'sociallocker.min.css');
            suAsset::addFile('js', 'sociallocker.min.js');
            suAsset::addString('js', $js);
        }
        else {
            $return[] = su_do_shortcode($content);
        }

        return implode("\n", $return);
    }   
}
