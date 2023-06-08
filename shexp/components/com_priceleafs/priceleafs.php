
<?php 

defined('_JEXEC') or die;

//require_once JPATH_COMPONENT . '/helpers/route.php';

$controller = JControllerLegacy::getInstance('Priceleafs');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();