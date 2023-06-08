<?php
/**
* @package		Joomla & QuickForm
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

if( qfJVER>2.9){
	class QFView extends JViewLegacy{}
}else{
	class QFView extends JView{}
}

class QuickformViewStatistics extends QFView
{
	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		require_once JPATH_COMPONENT.'/helpers/quickform.php';
		$app = JFactory::getApplication('administrator');
		$filter_st_status		= $app->getUserStateFromRequest( 'com_quickform'.'filter.st_status',			'filter_st_status',			0,				'int' );
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$this->st_status = QuickFormHelper::getStatus();
		$this->lists['st_status'] = JHTML::_('select.genericlist', $this->st_status, 'filter.st_status', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $filter_st_status );
		
		
		$this->addSubmenu();
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{

		$canDo	= QuickFormHelper::getActions($this->state->get(true));

		JToolBarHelper::title('QuickForm', 'weblinks.png');
		
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::publish('statistics.publish', 'JTOOLBAR_PUBLISH', true);
//			JToolBarHelper::unpublish('statistics.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::divider();
			JToolBarHelper::archiveList('statistics.archive');
			JToolBarHelper::checkin('statistics.checkin');
		}
		
		if ($this->state->get('filter.published') == -2) {
			JToolBarHelper::deleteList('', 'statistics.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} 
		elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('statistics.trash');
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_quickform','250','800');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help('');
	}
	
	protected function addSubmenu()
	{
		JSubMenuHelper::addEntry(
			JText::_('QuickForm Manager'),
			'index.php?option=com_quickform'
		);
		JSubMenuHelper::addEntry(
			JText::_('Statistics'),
			'index.php?option=com_quickform&view=statistics',
			$active = true
		);
		if( qfJVER>2.9){
			JSubMenuHelper::addEntry(
				JText::_('JOPTIONS'),
				'index.php?option=com_config&view=component&component=com_quickform'
			);
		}
	}
	
	protected function getSortFields()
	{
		return array(
//			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.st_status' => JText::_('JSTATUS'),
			'a.st_title' => JText::_('JGLOBAL_TITLE'),
			'a.st_price' => JText::_('Price'),
			'a.st_user' => JText::_('User'),
			'a.st_ip' => JText::_('IP'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
	
}
