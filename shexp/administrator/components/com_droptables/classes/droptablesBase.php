<?php

/**
 * Droptables
 * 
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package Droptables
 * @copyright Copyright (C) 2014 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2014 Damien Barrère (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */
// no direct access
defined('_JEXEC') or die;

class droptablesBase {

    /**
     * 
     */
    public static function initComponent() {
        //Load language from non default position
        self::loadLanguage();

        // Register helper class
        JLoader::register('DroptablesHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/droptables.php');
        JLoader::register('DroptablesTablesHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/tables.php');
        // Register helper class
        JLoader::register('DroptablesComponentHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/component.php');

        //Load scripts and stylesheets
        $document = JFactory::getDocument();
        $params = JComponentHelper::getParams('com_droptables');


        JHtml::_('jquery.framework');
        JHtml::_('jquery.ui', array('core', 'sortable') );
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.droppable.min.js');
        
        $app = JFactory::getApplication();
        if ($app->isSite()) {
            JHtml::_('bootstrap.loadCss');
            $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/css/frontstyle.css');
        }
        
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/css/style.css');
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/css/table-sprites.css');
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/css/jquery.handsontable.full.css');
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/codemirror/codemirror.css');
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/codemirror/3024-night.css');

        $document->addScript(JURI::root() . 'components/com_droptables/assets/ckeditor/ckeditor.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/ckeditor/adapters/jquery.js');
        
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/less.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.handsontable.full.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.textselect.min.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.nestable.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.leanModal.min.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/bootbox.min.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/codemirror/codemirror.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/codemirror/mode/css/css.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/chart.min.js');
        $document->addScript(JURI::root() . 'components/com_droptables/assets/js/droptables.js');
       
        //Only load these file if import-export excel feature is enabled
        if ($params->get('enable_import_excel',1) == '1') {
            $document->addScript(JURI::root() . 'components/com_droptables/assets/js/dropzone.min.js');
            $document->addScript(JURI::root() . 'components/com_droptables/assets/js/jquery.fileDownload.js');
        }
       
    }

    public static function initFrontComponent() {
        //Load language from non default position
        self::loadLanguage();

        // Register helper class
        JLoader::register('DroptablesHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/droptables.php');
        // Register helper class
        JLoader::register('DroptablesComponentHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/component.php');
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . 'components/com_droptables/assets/css/front.css');
    }

    /**
     * Search a param into the component config
     * @param string $path
     * @param type $default
     * @return param 
     */
    public static function getParam($path, $default = null) {
        $params = JComponentHelper::getParams('com_droptables');
        return $params->get($path, $default);
    }

    /**
     * Method to return the current joomla version
     * @param string $format
     * @return string version
     */
    public static function getJoomlaVersion($format = 'short') {
        $method = 'get' . ucfirst($format) . "Version";

        // Get the joomla version
        $instance = new JVersion();
        $version = call_user_func(array($instance, $method));

        return $version;
    }

    /**
     * Method to check if current joomla version is 3.X
     * @return boolean 
     */
    public static function isJoomla30() {
        if (version_compare(self::getJoomlaVersion(), '3.0') >= 0) {
            return true;
        }
        return false;
    }

    /**
     * Check if a component is installed and activated 
     * @param string $extension
     * @param string $type
     * @return boolean 
     */
    public static function isExtensionActivated($extension, $type = '') {
        $db = JFactory::getDbo();
        $query = 'SELECT extension_id FROM #__extensions WHERE element=' . $db->quote($extension);

        if ($type != '') {
            $query.=' AND type=' . $db->quote($type);
        }
        $query.=' AND enabled=1';
        $db->setQuery($query);
        if ($db->query()) {
            if ($db->getNumRows() > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Method to set config parameters
     * @param array $datas
     * @return boolean 
     */
    public static function setParams($datas) {
        return droptablesComponentHelper::setParams($datas);
    }

    /**
     * Load global file language
     */
    public static function loadLanguage() {
        $lang = JFactory::getLanguage();
        $lang->load('com_droptables', JPATH_ADMINISTRATOR . '/components/com_droptables', null, true);
        $lang->load('com_droptables.sys', JPATH_ADMINISTRATOR . '/components/com_droptables', null, true);
    }

    public static function loadValue($var, $value, $default = '') {
        if (is_object($var) && isset($var->$value)) {
            return $var->$value;
        } elseif (is_array($var) && isset($var[$value])) {
            return $var[$value];
        }
        return $default;
    }

    /**
     * Check on Joomunited website the latest version number of the component
     * @param string $extension
     * @return false or version number (string)
     */
    public static function getLastExtensionVersion($extension = null) {
        if ($extension === null) {
            $extension = JFactory::getApplication()->input->getString('option', '');
        }
        if (ini_get("allow_url_fopen") == 1) {
            $content = file_get_contents('http://www.joomunited.com/UPDATE-INFO/updates.json');
        } else {
            return false;
        }
        $json = json_decode($content);
        return $json->extensions->$extension->version;
    }

    public static function getExtensionVersion($extension = null, $type = '') {
        if ($extension === null) {
            $extension = JFactory::getApplication()->input->getString('option', '');
        }
        $db = JFactory::getDbo();
        $query = 'SELECT manifest_cache FROM #__extensions WHERE element=' . $db->quote($extension);

        if ($type != '') {
            $query.=' AND type=' . $db->quote($type);
        }
        $db->setQuery($query);
        if ($db->query()) {
            $manifest = $db->loadResult();
            $json = json_decode($manifest);
            if (property_exists($json, 'version')) {
                return $json->version;
            }
        }
        return false;
    }

}

?>
