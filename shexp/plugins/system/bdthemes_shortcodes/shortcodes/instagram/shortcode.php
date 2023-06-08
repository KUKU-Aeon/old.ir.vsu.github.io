<?php

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_instagram extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    }   
    public static function instagram($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'user'          => 'https://instagram.com/google',
            'hash_tag'      => '',
            'client_id'     => '',
            'limit'         => '10',
            'link_type'     => 'popup',
            'column'        => 6,
            'medium'        => 3,
            'small'         => 2,
            'gap'           => 'yes',
            'scroll_reveal' => '',
            'class'         => ''
        ), $atts, 'instagram');


        $id = uniqid('suig');
        $css = array();
        $atts['gap'] = ($atts['gap'] == "yes") ? 'su-has-gap' : '';
        $link_type = 'su-link-type-'.$atts['link_type'];
        $classes = array('su-instagram', $atts['gap'], $link_type, su_ecssc($atts));

        $settings = array(
            'user'         => rtrim($atts['user'], '/'),
            'clientId'     => $atts['client_id'],
            'hashtag'      => ($atts['hash_tag']) ? explode(",",$atts['hash_tag']) : '',
            'tagScope'     => "global",
            'selectedTab'  => ($atts['hash_tag']) ? "h1" : "p",
            'displayMode'  => $atts['link_type'],
            'maxResults'   => $atts['limit'],
            'minItemWidth' => 300,
            'maxItemWidth' => 400
        );

        $js = '
            jQuery(document).ready(function($) {
                "use strict";
                $(".su-instagram").instamax(
                    '.json_encode($settings).'
                );
            });
        ';


        if ($atts['column'] != 6) {
            $css[] = '#'.$id.' .instamax-gallery-item { width: '. 100/intval($atts['column']) .'%;}';
        }

        if ($atts['medium'] != 3) {
            $css[] = '@media only screen and (min-width: 480px) and (max-width: 767px) {
                #'.$id.' .instamax-gallery-item { width: '. 100/intval($atts['medium']) .'%;}
            }';            
        }

        if ($atts['small'] != 2) {
            $css[] = '@media only screen and (max-width: 479px) {
                #'.$id.' .instamax-gallery-item { width: '. 100/intval($atts['small']) .'%;}
            }';
        }
   
        suAsset::addFile('css', 'instagram.css', __FUNCTION__);
        suAsset::addString('css', implode("\n", $css));

        suAsset::addFile('js', 'jquery.imagesloaded.js', __FUNCTION__);
        suAsset::addFile('js', 'jquery.instamax.js', __FUNCTION__);

        suAsset::addFile('css', 'magnific-popup.css');
        suAsset::addFile('js', 'magnific-popup.js');

        suAsset::addString('js', $js);
        
        return '<div id="'.$id.'"'.su_scroll_reveal($atts).' class="'.su_acssc($classes).'"></div>';
    }
}
