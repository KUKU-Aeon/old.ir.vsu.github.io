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

//Register  base class
JLoader::register('DroptablesBase', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/droptablesBase.php');
$view= JFactory::getApplication()->input->get('view');
if(! in_array($view, array('foldertree','dbtable')) ) {
    droptablesBase::initComponent();
}else {
     //Load language from non default position
        droptablesBase::loadLanguage();

        // Register helper class
        JLoader::register('DroptablesHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/droptables.php');
        JLoader::register('DroptablesTablesHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/tables.php');
        // Register helper class
        JLoader::register('DroptablesComponentHelper', JPATH_ADMINISTRATOR . '/components/com_droptables/helpers/component.php');

}

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_droptables')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Droptables');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
