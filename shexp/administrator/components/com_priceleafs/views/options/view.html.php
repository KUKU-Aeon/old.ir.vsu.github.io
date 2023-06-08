<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die('Restricted access');
 
// импорт joomla контроллера из библиотеки
jimport('joomla.application.component.view');
 
/**
 * Вид компонента
 */
class PriceleafViewOptions extends JView
{
	/**
	 * Метод дисплея. Тоесть передаём параметры из модели в вид что будем отображать
	 */
	function display($tpl = null) 
	{
		// Получаем данные из модели
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$state = $this->get('State');
 
		// Проверяем на наличие ошибок.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Назначение данных для просмотра
		$this->items = $items;
		$this->pagination = $pagination;
		$this->state = $state;
		
		// Устанавливаем панель инструментов
		$this->addToolBar();
 
		// Отобразить данные на дисплее.
		parent::display($tpl);
	}
	//Добавление панели инструментов. Эта панель отобразится в шаблоне.
	protected function addToolBar() 
	{
		$canDo = PriceleafHelper::getActions();
		JToolBarHelper::title(JText::_('COM_PRICELEAF'), 'priceleaf');
		JToolBarHelper::deleteList('', 'options.delete');
		JToolBarHelper::editList('option.edit');
		JToolBarHelper::addNew('option.add');
		JToolBarHelper::custom('options.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::custom('options.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
	}
	
}