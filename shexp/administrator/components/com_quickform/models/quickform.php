<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.model');
jimport('joomla.filesystem.folder');

if( qfJVER>2.5){
	class QFmodel extends JmodelLegacy{}
}else{
	class QFmodel extends Jmodel{}
}

class QuickformModelQuickform extends QFmodel
{
	var $_id = null;
	var $_data = null;

	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid', array(0), '', 'array');
		$this->_id		= (int)$array[0];
		$this->_data	= null;
	}

	function getData()
	{
			if(empty($this->_data))
			{
					$query = "SELECT * FROM #__quickform WHERE id = ".(int)$this->_id;
					$this->_db->setQuery($query);
					$this->_data = $this->_db->loadObject();
			}

			if(!$this->_data)
			{
					$this->_data = $this->getTable();
					$this->_data->id = 0;
			}

			return $this->_data;
	}
	
	function checkin($cid)
	{
		if ($this->_id)
		{
			$row = & $this->getTable();
			if(! $row->checkin($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	function store()
	{
		$row =& $this->getTable('quickform');
		$data = JRequest::get('post');
		$data['settlement'] = JRequest::getVar( 'settlement', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$data['settlement']	= QuickFormHelper::coder($data['settlement']);
		
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

    function delete()
    {
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
        $row = $this->getTable();

        foreach($cids as $cid)
        {
            if(!$row->delete($cid))
            {
                $this->setError($row->_db->getErrorMsg());
                return false;
            }
        }

        return true;
    }



	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__quickform'
				. ' SET published = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'
				. ' AND ( checked_out = 0 OR ( checked_out = '.(int) $user->get('id').' ) )'
			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	function reorder($cid,$direction)
	{
		$row =& $this->getTable();
		if (!$row->load($this->_id)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->move( $direction)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}

	function saveorder($cid = array(), $order)
	{
		$row =& $this->getTable();
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}
		$row->reorder();
		return true;
	}
	
	function getMaxid()
	{
	  $this->_db->setQuery('SELECT max(id) FROM #__quickform');
	  return $this->_db->loadResult();
	}
	
	function batchAccess($value, $pks, $contexts)
	{
		$user = JFactory::getUser();
		$table = $this->getTable();

		foreach ($pks as $pk)
		{
			if ($user->authorise('core.edit', $contexts[$pk]))
			{
				$table->reset();
				$table->load($pk);
				$table->access = (int) $value;

				if (!$table->store())
				{
					$this->setError($table->getError());
					return false;
				}
			}
			else
			{
				$this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));
				return false;
			}
		}

		// Clean the cache
		$this->cleanCache();

		return true;
	}
	
}
