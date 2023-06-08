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
jimport('joomla.application.component.controlleradmin');

/**
 * Класс контроллера
 */
class PriceleafControllerOptions extends JControllerAdmin
{
	/**
	 * Прокси для getModel
	 */
	public function getModel($name = 'Option', $prefix = 'PriceleafModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
