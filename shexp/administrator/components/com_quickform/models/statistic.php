<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

if( qfJVER>2.5){
	class QFmodel extends JmodelLegacy{}
}else{
	class QFmodel extends Jmodel{}
}

class QuickformModelStatistic extends QFmodel
{
	var $_id = null;
	var $_data = null;

	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid', array(0), '', 'array');
		$this->_id		= (int)$array[0];
	}

	function getData()
	{
			if(empty($this->_data))
			{
					$query = "SELECT * FROM #__quickform_ps WHERE id = ".(int)$this->_id;
					$this->_db->setQuery($query);
					$this->_data = $this->_db->loadObject();
			}
			return $this->_data;
	}
	
	function store()
	{
		$row =& $this->getTable('statistic');
		$data = JRequest::get('post');
		
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

}
