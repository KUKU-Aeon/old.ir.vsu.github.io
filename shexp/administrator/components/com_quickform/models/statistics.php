<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.modellist');

class QuickformModelStatistics extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'st_user', 'a.st_user',
				'st_date', 'a.st_date',
				'st_ip', 'a.st_ip',
				'st_title', 'a.st_title',
				'st_cur', 'a.st_cur',
				'published', 'a.published',
				'access', 'a.access', 'access_level',
				'st_status', 'a.st_status',
				'st_price', 'a.st_price',
			);
		}

		parent::__construct($config);
	}
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$st_status = $this->getUserStateFromRequest($this->context.'.filter.st_status', 'filter_st_status', null, 'int');
		$this->setState('filter.st_status', $st_status);

		$state = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '', 'string');
		$this->setState('filter.published', $state);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_quickform');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.id', 'asc');
	}
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.st_status');
		$id.= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser();

		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from($db->quoteName('#__quickform_ps').' AS a');


//		$query->select('uc.name AS editor');
//		$query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');

//		$query->select('ag.title AS access_level');
//		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = a.access');

		if (($st_status = $this->getState('filter.st_status'))!=-1) {
			$query->where('a.st_status = '.(int) $st_status);
		}

		// Implement View Level Access
		if (!$user->authorise('core.admin'))
		{
			$groups	= implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN ('.$groups.')');
		}

		// Filter by published state
		$state = $this->getState('filter.published');
		if (is_numeric($state)) {
			$query->where('a.published = '.(int) $state);
		} elseif ($state === '') {
			$query->where('(a.published IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('a.st_desk LIKE '.$search);
			}
		}

		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->escape($orderCol.' '.$orderDirn));

		return $query;
	}

}
