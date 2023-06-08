<?php

/**
 * BDThemes Shortcodes Component
 *
 * @package		Joomla
 * @subpackage	BDThemes Schortcodes Component
 * @copyright Copyright (C) 2011 BDThemes Ltd. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author BDThemes
 * @author url http://bdthemes.com
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class Bdthemes_shortcodesViewDownload extends JMasterViewSU {

    /**
     * the main disply function
     */
    public function display($tpl = null) {

        /*
         * download file
         */
        if (isset($_GET['id']) || isset($_POST['download'])) {
            require_once( BDT_SU_ROOT . DIRECTORY_SEPARATOR . 'shortcodes' . DIRECTORY_SEPARATOR . 'file_download' . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR . 'download.php');
        }
        exit;
    }

}
