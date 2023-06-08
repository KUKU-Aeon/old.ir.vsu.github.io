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
 * Класс помощи.
 */
class PriceleafsHelper
{
	/**
	 * Установка панели ссылок.
	 */
	public static function addSubmenu($vName = 'priceleafs')
	{
		JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_RAZDEL'), 'index.php?option=com_priceleafs&view=priceleafs', $vName == 'priceleafs');
		
		JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_CATS'), 'index.php?option=com_priceleafs&view=cats', $vName == 'cats');
		
			JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_MENU'), 'index.php?option=com_priceleafs&view=menus', $vName == 'menus');
			
			JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_ZAKAZ'), 'index.php?option=com_priceleafs&view=zakazs', $vName == 'zakazs');				
			
			JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_OPTION'), 'index.php?option=com_priceleafs&task=option.edit&id=1', $vName == 'option');
			
			JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_IMPORT'), 'index.php?option=com_priceleafs&view=csvs', $vName == 'csvs');
			
			JHtmlSidebar::addEntry(JText::_('COM_PRICELEAF_INFO'), 'index.php?option=com_priceleafs&view=infos', $vName == 'infos');			
		
	}
	
	/**
	 * Получение действий
	 */
	public static function getActions($messageId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($messageId)) {
			$assetName = 'com_priceleafs';
		}
		else {
			$assetName = 'com_priceleafs.message.'.(int) $messageId;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}
