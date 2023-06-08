<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class QuickformModelStatis extends JModelAdmin
{
	
	public function getTable($type = 'Statistic', $prefix = 'Table', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
			return false;
	}

}
