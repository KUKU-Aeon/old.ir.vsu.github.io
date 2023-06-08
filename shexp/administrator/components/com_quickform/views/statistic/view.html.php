<?php
/**
* @package		Joomla
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

class QuickformViewStatistic extends QFView
{
	protected $item;

	function display($tpl = null)
	{
		$this->item		= $this->get('Data');
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		require_once JPATH_COMPONENT.'/helpers/quickform.php';
		$st_status = QuickFormHelper::getStatus();
		$this->lists['st_status'] = JHTML::_('select.genericlist', $st_status, 'st_status', 'class="inputbox" size="1" ', 'value', 'text', $this->item->st_status );
		
		$this->addSubmenu();
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JToolBarHelper::title('QuickForm', 'weblinks.png');
		
		JToolBarHelper::divider();
		JToolBarHelper::apply('st_apply');
		JToolBarHelper::save('st_save');
		JToolBarHelper::divider();
		JToolBarHelper::cancel('st_cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::divider();
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
			'index.php?option=com_quickform&view=statistics'
		);
	}

}

?>