<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.application.component.controlleradmin');

class QuickformControllerStatistics extends JControllerAdmin
{
	public function getModel($name = 'Statis', $prefix = 'QuickformModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
}
