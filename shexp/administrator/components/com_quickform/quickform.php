<?php
/**
* @package		Joomla & QuickForm
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

$ver = new JVersion;
define('qfJVER', $ver->RELEASE);
require_once JPATH_COMPONENT.'/helpers/quickform.php';

if( qfJVER>2.9){
	$controller	= JControllerLegacy::getInstance('quickform');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	JHtml::_('behavior.framework');
}else{
	$controller = JController::getInstance('quickform');
	$controller->execute(JRequest::getCmd('task'));
}
$controller->redirect();
