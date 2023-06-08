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



$config = array();

$view = JFactory::getApplication()->input->get('view',null);
$task = JFactory::getApplication()->input->get('task',null);

if(preg_match('/^front.*/', $task) || ($task===null && preg_match('/^front.*/', $view))){
    droptablesBase::initFrontComponent();
    //require_once JPATH_COMPONENT.'/helpers/category.php';
    //require_once JPATH_COMPONENT.'/helpers/query.php';
}else{
    droptablesBase::initComponent();
    if (!JFactory::getUser()->authorise('core.manage', 'com_droptables')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    }

    // Execute the task.
    $config['base_path'] = JPATH_COMPONENT_ADMINISTRATOR;
}
// Include dependancies
jimport('joomla.application.component.controller');


$controller	= JControllerLegacy::getInstance('Droptables',$config);
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();