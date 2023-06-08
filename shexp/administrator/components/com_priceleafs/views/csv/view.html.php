<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Класс вида
 */
class PriceleafsViewCsv extends JViewLegacy
{
	protected $state;

	protected $item;

	protected $form;
	/**
	 * Отображение метода вида
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		PriceleafsHelper::addSubmenu('csvs');

		
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/priceleafs.php';

		$state	= $this->get('State');
		//$canDo	= PriceleafsHelper::getActions($state->get('filter.category_id'));
		$user	= JFactory::getUser();
		// Получить экземпляр объекта панели инструментов
		$bar = JToolBar::getInstance('toolbar');
	
		//JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= PriceleafsHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_PRICELEAF'), 'priceleafs.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_priceleafs', 'core.create')))))
		{
		//	JToolbarHelper::apply('option.apply');
			//JToolbarHelper::save('option.save');
		}

		//if (empty($this->item->id)) {
		//	JToolbarHelper::cancel('option.cancel');
		//}
		//else {
		//	JToolbarHelper::cancel('option.cancel', 'JTOOLBAR_CLOSE');
		//}
		
		

		JToolbarHelper::divider();
		//JToolbarHelper::help('COM_PRICELEAF_MENU_EDIT');
	}
}