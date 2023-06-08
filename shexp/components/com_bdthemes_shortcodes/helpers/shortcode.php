<?php

/**
 * BDThemes Shortcodes Component
 * @package   Shortcode Ultimate Joomla 3.0
 * @subpackage  BDThemes Schortcodes
 * @copyright Copyright (C) 2011-2014 BDThemes Ltd. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @author BDThemes
 * @author url http://bdthemes.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

//define dmp function
if (function_exists("dmp") == false) {

 function dmp($str) {
  echo "<pre>";
  print_r($str);
  echo "</pre>";
 }

}

/* @package Unite Showbiz Slider for Joomla 1.7-3.1
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * include the unitejoomla library
 */
$currentFolder = dirname(__FILE__) . "/";

jimport('joomla.application.component.view');
jimport('joomla.application.component.controller');



$isJoomla3 = ShortCodeHelper::isJoomla3();

if ($isJoomla3) {
	class JMasterViewSU extends JViewLegacy {}
	class JControllerSU extends JControllerLegacy {}
} 
else {  //joomla 2.5
	class JMasterViewSU extends JView {}
	class JControllerSU extends JController {}
}


abstract class ShortCodeHelper {

 /**
  * get Joomla version
  */
 public static function isJoomla3() {

  if (defined("JVERSION")) {
   $version = JVERSION;
   $version = (int) $version;
   return($version == 3);
  }

  if (class_exists("JVersion")) {
   $jversion = new JVersion;
   $version = $jversion->getShortVersion();
   $version = (int) $version;
   return($version == 3);
  }

  return(!defined("DS"));
 }

}

?>