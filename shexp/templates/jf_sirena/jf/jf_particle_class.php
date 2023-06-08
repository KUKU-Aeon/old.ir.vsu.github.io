<?php
/**
* @version		JF_PDT_090
* @author		JoomForest http://www.joomforest.com
* @copyright	Copyright (C) 2011-2016 JoomForest.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Error Report
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);

JHtml::_('jquery.framework');

class jf_g5_theme {
	public function tmpl_id(){
		$app            = JFactory::getApplication();
		$joogetTemplateId  = $app->getTemplate('template')->id;
        return $joogetTemplateId;
    }
	public function tmpl_root(){
		$app        	= JFactory::getApplication();
		$base 			= JURI::base(true).'/templates/'.$app->getTemplate().'/';
        return $base;
    }
	public function joomla_root(){
		$jf_root 		= JURI::root(); /* URL */
        return $jf_root;
    }
	public function joomla_root_true(){
		$jf_root 		= JURI::root(true); /* DIRECTORY */
        return $jf_root;
    }
	public function menu_item_url($menuItemId){
		$url = JRoute::_('index.php?Itemid=' . $menuItemId);
        return $url;
    }
	public function joomla_base(){
		$jf_base 		= JURI::base(); /* URL */
        return $jf_base;
    }
	public function joomla_base_true(){
		$jf_base 		= JURI::base(true);
        return $jf_base;
    }
	public function joomla_current(){
		$jf_current 		= JURI::current();
        return $jf_current;
    }
}
$gantry['jf_g5_theme'] = new jf_g5_theme();

/* # TWIG
	<link rel="stylesheet" href="{{ gantry.jf_g5_theme.tmpl_root() }}custom/css-compiled/jf_zzzzzz.min_{{ gantry.jf_g5_theme.tmpl_id() }}.css"

	MAIN VARS
		{{ gantry.jf_g5_theme.tmpl_root() }}
		{{ gantry.jf_g5_theme.tmpl_id() }}

*/