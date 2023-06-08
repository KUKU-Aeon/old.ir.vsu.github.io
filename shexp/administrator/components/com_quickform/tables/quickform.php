<?php
/**
* @Copyright ((c) bigemot.ru
* @ http://bigemot.ru/
* @license    GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableQuickform extends JTable
{

	function __construct(& $db) {
		parent::__construct('#__quickform', 'id', $db);
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
		$date	= JFactory::getDate();
		if ($this->id) {
//			// Existing item
		} else {
			$this->date = $date->toSql();
			$this->ordering = $this->getNextOrder();
		}
		// Attempt to store the user data.
		return parent::store($updateNulls);
	}

	public function check()
	{

		// check for valid name
		if (trim($this->title) == '') {
			$this->setError(JText::_('Error. Title not found'));
			return false;
		}

		return true;
	}

	
}
