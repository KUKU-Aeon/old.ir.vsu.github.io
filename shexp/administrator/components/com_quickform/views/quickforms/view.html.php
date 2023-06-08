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

class QuickformViewQuickforms extends QFView
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
		
		$this->addSubmenu();
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/quickform.php';

		$canDo	= QuickFormHelper::getActions($this->state->get('filter.category_id'));

		JToolBarHelper::title('QuickForm', 'weblinks.png');
		JToolBarHelper::addNew('create');
		
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('edit');
		}
		
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::publish('quickforms.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('quickforms.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::divider();
			JToolBarHelper::archiveList('quickforms.archive');
			JToolBarHelper::checkin('quickforms.checkin');
		}
		
		if ($this->state->get('filter.published') == -2) {
			JToolBarHelper::deleteList('', 'quickforms.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} 
		elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('quickforms.trash');
			JToolBarHelper::divider();
		}
		if( qfJVER>2.9){
			if ($canDo->get('core.edit'))
			{
				JHtml::_('bootstrap.modal', 'collapseModal');
				$title = JText::_('JTOOLBAR_BATCH');
				$dhtml = "<button data-toggle=\"modal\" data-target=\"#collapseModal\" class=\"btn btn-small\">
							<i class=\"icon-checkbox-partial\" title=\"$title\"></i>
							$title</button>";
				$bar = JToolBar::getInstance('toolbar');
				$bar->appendButton('Custom', $dhtml, 'batch');
			}
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_quickform','250','800');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help('help', true);
		
	}
	
	protected function addSubmenu()
	{
			JSubMenuHelper::addEntry(
				JText::_('QuickForm Manager'),
				'index.php?option=com_quickform',
				$active = true
			);
			JSubMenuHelper::addEntry(
				JText::_('Statistics'),
				'index.php?option=com_quickform&view=statistics'
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
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.published' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.access' => JText::_('JGRID_HEADING_ACCESS'),
			'a.hits' => JText::_('JGLOBAL_HITS'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
	
}
