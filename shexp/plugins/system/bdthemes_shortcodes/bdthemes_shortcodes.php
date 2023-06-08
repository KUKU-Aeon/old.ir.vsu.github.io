<?php

/**
 * BDThemes Shortcode Ultimate 
 *
 * @package     Shortcode Ultimate Joomla 3.0
 * @subpackage  BDThemes Schortcodes
 * @copyright Copyright (C) 2011-2014 BDThemes Ltd. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @author BDThemes
 * @author url http://bdthemes.com
 * Special thanks to Vladimir Anokhin who permit us to make this plugin like his shortcode ultimate wordpress plugin.
 */

// No direct access.
defined('_JEXEC') or die;

// Import Joomla core library
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.plugin.plugin');

define('BDT_SU_ROOT', dirname(__FILE__));
define('BDT_SU_CONFIG', dirname(__FILE__).DIRECTORY_SEPARATOR.'config');
define('BDT_SU_HELPER', BDT_SU_ROOT.DIRECTORY_SEPARATOR.'helper'.DIRECTORY_SEPARATOR);
define('BDT_SU_DATA', JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'bdthemes'.DIRECTORY_SEPARATOR);

define('BDT_SITE_URL', JUri::root());
define('BDT_SU_URI', BDT_SITE_URL.'plugins/system/bdthemes_shortcodes');
define('BDT_SU_IMG', BDT_SU_URI.'/images/');

require_once BDT_SU_ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'tools.php';
require_once BDT_SU_ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'wp_override.php';
require_once BDT_SU_ROOT.DIRECTORY_SEPARATOR.'helper'.DIRECTORY_SEPARATOR.'shortcodes.php';

$lang = JFactory::getLanguage(); 
$lang->load('plg_system_bdthemes_shortcodes', JPATH_ADMINISTRATOR);

class plgSystemBdthemes_Shortcodes extends JPlugin {

    var $document = NULL;
    var $baseurl = NULL;

  
    public function __construct(&$subject, $config) {
        parent::__construct($subject, $config);
        
        $tmpl_shortcode = ($this->params->get('tmpl_shortcode')) ? $this->params->get('tmpl_shortcode') : 'protostar';
        define('BDT_SU_CTMPL', $tmpl_shortcode);
    }

    public function onAfterRoute() {

        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        $current_tmpl = $app->getTemplate();
        JHtml::_('jquery.framework');
        
        $lang_dir = JPATH_SITE.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.BDT_SU_CTMPL.DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'plg_bdthemes_shortcodes';
        
        if (file_exists($lang_dir.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.'en-GB'.DIRECTORY_SEPARATOR.'en-GB.plg_system_bdthemes_shortcodes.ini')) {
            $lang = JFactory::getLanguage();
            $lang->load('plg_system_bdthemes_shortcodes', $lang_dir);
        }

        // Adding shortcodes on after route 
        require_once BDT_SU_ROOT.DIRECTORY_SEPARATOR.'helper'.DIRECTORY_SEPARATOR.'addshortcodes.php';    


        // Loading common css/js assets 
        $doc->addScript(BDT_SU_URI . '/js/shortcode-ultimate.js');
        $doc->addStyleSheet(BDT_SU_URI . '/css/shortcode-ultimate.css');

        // Font awesome loading by dynamic location as you need
        if ($app->isAdmin()) {
            if ($this->params->get('font-awesome-admin')=='local') {
                $doc->addStyleSheet( BDT_SU_URI . '/css/font-awesome.css');
            }
            elseif ($this->params->get('font-awesome-admin')=='cdn') {
                $doc->addStyleSheet('http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
            }
        }
        else {
            if ($this->params->get('font-awesome')=='local') {
                $doc->addStyleSheet( BDT_SU_URI . '/css/font-awesome.css');
            }
            elseif ($this->params->get('font-awesome')=='cdn') {
                $doc->addStyleSheet('http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
            }
        }
        

        // if found any shortcode.css in template directory.
        $csu_css = JPATH_THEMES.DIRECTORY_SEPARATOR.$current_tmpl.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'shortcodes.css';
        if (file_exists($csu_css)) {
            JFactory::getDocument()->addStyleSheet(JUri::root().'templates/'.$current_tmpl.'/css/shortcodes.css');
        } 

        //all shortcode register here
        register_shortcodes();
    }

    public function onContentPrepareForm($form, $data) {
        JForm::addFormPath(BDT_SU_ROOT.DIRECTORY_SEPARATOR.'params');
    }


    // Do BBCode replacements on the whole page
    public function onContentPrepare($content, &$article, &$params, $limitstart) {
        $article->text = su_wpautop($article->text);
        $article->text = su_shortcode_unautop($article->text);
        $article->text = su_do_shortcode($article->text);

        $lang = JFactory::getLanguage();
        if ($lang->isRTL()) {
            JFactory::getDocument()->addStyleSheet(BDT_SU_URI . '/css/rtl.css');
        }
    }
}