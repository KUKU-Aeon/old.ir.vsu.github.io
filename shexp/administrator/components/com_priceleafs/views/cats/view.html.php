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
 * Вид компонента
 */
class PriceleafsViewCats extends JViewLegacy
{

	protected $items;

	protected $pagination;

	protected $state;
	/**
	 * Метод дисплея. Тоесть передаём параметры из модели в вид что будем отображать
	 */
	public function display($tpl = null)
	{
	
	$model = $this->getModel();
	//Получаем данные из модели
	$rows_raz = $model->getPriceleafraz();
	$this->assignRef('rows_raz',$rows_raz);
	
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		PriceleafsHelper::addSubmenu('cats');
		
	$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}
	
	
	
protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/priceleafs.php';

		$state	= $this->get('State');
		$canDo	= PriceleafsHelper::getActions($state->get('filter.category_id'));
		$user	= JFactory::getUser();
		// Получить экземпляр объекта панели инструментов
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_PRICELEAF'), 'priceleafs.png');
		if ($canDo->get('core.create')) {
			JToolbarHelper::addNew('cat.add');
		}
		if ($canDo->get('core.edit')) {
			JToolbarHelper::editList('cat.edit');
		}
		
			JToolbarHelper::publish('cats.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('cats.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		

			JToolbarHelper::deleteList('', 'cats.delete');



		JHtmlSidebar::setAction('index.php?option=com_priceleafs&view=cats');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
	}

	/**
	 * Возвращает массив полей таблицы можно сортировать
	 *
	 * Возвращение массива, содержащий имя поля для сортировки в качестве ключа и текст на дисплее в качестве значения
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.name_cat' => JText::_('JGLOBAL_TITLE'),
			'a.id' => JText::_('JGRID_HEADING_ID'),
			'a.raz_cat' => JText::_('JGLOBAL_TITLE'),
		);
	}
}	
