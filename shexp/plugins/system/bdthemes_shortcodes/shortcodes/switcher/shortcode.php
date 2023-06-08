<?php

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_switcher extends Su_Shortcodes {

    static $switcher = array();
    static $switcher_item_count = 0;

    function __construct() {
        parent::__construct();
    }   

    public static function switcher($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'id'            => uniqid('swt'),
            'style'         => 1, 
            'active'        => 1,
            'position'      => 'top',
            'align'         => 'center',
            'animation'     => 'bounceLeft',
            'scroll_reveal' => '',
            'class'         => ''
        ), $atts, 'switcher');

        su_do_shortcode($content);

        $return = $panes = $css = $filter_item = array();

        if (is_array( self::$switcher)) {

            foreach (self::$switcher as $switcher_item) {

                $filter_data = su_title_class($switcher_item['title']);
                $filter_item[] = '<div data-filter=".'. $filter_data .'" class="cbp-filter-item ' . su_ecssc($switcher_item). '"><div class="cbp-filter-item-inner">' 
                    . su_scattr($switcher_item['icon']) .'<span class="su-swt-title">'. su_scattr($switcher_item['title']) . '</span></div></div>';
                $panes[] = '<div class="'. $filter_data .' cbp-item' . su_ecssc($switcher_item) . '">' . $switcher_item['content'] . '</div>';
            }

            $filters = '<div id="'. $atts['id'] . '_filter" class="su-swt-filter">' . implode('', $filter_item) .'</div>';
            

            if (is_int($atts['active']) && $atts['active'] > 0) {
                $active_tab = su_title_class(self::$switcher[$atts['active'] - 1]['title']);
            } else {
                $active_tab = su_title_class(self::$switcher[0]['title']);
            }

            $return[] = '<div id="'. $atts['id'] . '"'.su_scroll_reveal($atts).' data-animation="'.$atts['animation'].'" class="su-switcher  su-switch-position-'.$atts['position'].' su-switch-align-'.$atts['align'].' su-switcher-style-' . $atts['style'] . su_ecssc($atts) . '" data-active_tab=".' . $active_tab  . '" data-swtid="' . $atts['id'] . '">';

                $return[] = ($atts['position'] == 'top' or $atts['position'] == 'left') ? $filters : '';

                $return[] = '<div id="' . $atts['id'] . '_container" class="cbp cbp-l-grid-tabs">' . implode("\n", $panes) . '</div>';

                $return[] = ($atts['position'] == 'bottom' or $atts['position'] == 'right') ? $filters : '';

                $return[] = '<div class="su-clearfix"></div>';
            $return[] = '</div>';           
        }


        self::$switcher = array();
        self::$switcher_item_count = 0;

        suAsset::addFile('css', 'cubeportfolio.min.css');
        suAsset::addFile('js', 'cubeportfolio.min.js');

        suAsset::addFile('css', 'switcher.css', __FUNCTION__);
        suAsset::addFile('js', 'switcher.js', __FUNCTION__);

        return implode("\n", $return);
    }
}
