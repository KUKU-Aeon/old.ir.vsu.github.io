<?php
/**
* @Copyright ((c) bigemot.ru
* @ http://bigemot.ru/
* @license    GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableStatistic extends JTable
{

	function __construct(& $db) {
		parent::__construct('#__quickform_ps', 'id', $db);
	}

	function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		return parent::bind($array, $ignore);
	}
	
	public function store($updateNulls = false)
	{
		
		return parent::store($updateNulls);
	}

	public function check()
	{

		return true;
	}

	
}
