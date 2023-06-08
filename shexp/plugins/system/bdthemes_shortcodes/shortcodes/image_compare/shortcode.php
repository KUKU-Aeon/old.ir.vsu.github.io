<?php 

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_image_compare extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    }

    public static function image_compare($atts = null, $content = null) {
        $atts = su_shortcode_atts(array(
            'before_image'  => '',
            'after_image'   => '',
            'orientation'   => '',
            'before_text'   => 'Original',
            'after_text'    => 'Modified',
            'scroll_reveal' => '',
            'class'         => ''
        ), $atts, 'image_compare');

        // Unique Id 
        $id = uniqid("suic");

        if (image_media($atts['before_image']) && image_media($atts['after_image'])) {

            $orientation = ($atts['orientation'] == 'vertical') ? ', orientation: "vertical"': '';

            $css[] = '#'.$id.' .twentytwenty-before-label:before {content: "'. $atts['before_text'] .'"}';
            $css[] = '#'.$id.' .twentytwenty-after-label:before {content: "'. $atts['after_text'] .'"}';


            // OUtput Structure in  here
            $return = '
            <div id="'.$id.'"'.su_scroll_reveal($atts).' class="twentytwenty-container '.su_ecssc($atts).'">
                <img src="'.image_media($atts['before_image']).'" alt="'.$atts['before_text'].'">
                <img src="'.image_media($atts['after_image']).'" alt="'.$atts['before_text'].'">
            </div>';


           $js = '
            jQuery(window).load(function(){
              jQuery("#'.$id.'").twentytwenty({default_offset_pct: 0.7'.$orientation.'});

            });';

            suAsset::addString('css', implode("\n", $css));

            // Css Adding in Head
            suAsset::addFile('css', 'image_compare.css', __FUNCTION__);

            // JavaScipt additon in Head
            suAsset::addFile('js', 'jquery.event.move.js', __FUNCTION__);
            suAsset::addFile('js', 'jquery.twentytwenty.js', __FUNCTION__);
            suAsset::addString('js', $js);

        } 
        else {
            return alert_box(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_IMAGE_COMPARE_INF'), 'warning');
        }

        return $return;
    }
}
