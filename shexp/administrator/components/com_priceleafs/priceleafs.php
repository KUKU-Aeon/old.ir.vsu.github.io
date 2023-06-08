<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
//Этот файл и есть точка входа в компонент

//Запрет прямого доступа к файлу/странице
defined('_JEXEC') or die;

//Проверка доступа к компоненту, авторизован пользователь или нет
if (!JFactory::getUser()->authorise('core.manage', 'com_priceleafs'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//Получить экземпляр контроллер с префиксо
$controller	= JControllerLegacy::getInstance('Priceleafs');

//Выполнение задачи task
$controller->execute(JFactory::getApplication()->input->get('task'));

//Редирект контроллера, если установленно контроллером
$controller->redirect();