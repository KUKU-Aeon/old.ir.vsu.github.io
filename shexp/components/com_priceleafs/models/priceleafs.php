<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->
<?php
/* 
Модель компонента. Здесь делается запрос в бд, 
и выбирается что нужно вытащить, все данные из
таблицы или только какието конкретные.
PriceleafModelPriceleaf
название файла модели после Model, при создании
ещё одной страницы создаётся опять новая модель
к примеру catid тогда class модели будет 
PriceleafModelCatid ну и соответственно другой запрос в другую
таблицу и другие переменные.
И на заметку что loadObjectlist это то как будут выводиться данные
в цикле или нет так как с loadResult вы не выведите цикл, он предназначен только
для одной строки.
*/

//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

//Название класса модели и название файла
class PriceleafsModelPriceleafs extends JModelLegacy
{

	protected $_context = 'com_priceleafs.priceleafs';

function getPriceleaf()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_razdel ORDER BY ordering';
	$db->setQuery($query);
	$row = $db->loadObjectlist();

return $row;	

	}
		
	
function getPriceleafcat()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_cat ORDER BY ordering';
	$db->setQuery($query);
	$raz_cat = $db->loadObjectlist();
return $raz_cat;	
	
	}
	
function getPriceleafnaimenowanie()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_na ORDER BY ordering';
	$db->setQuery($query);
	$raz_na = $db->loadObjectlist();
return $raz_na;	
	
	}
	
function getPriceleafvaluta()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_option ORDER BY ordering';
	$db->setQuery($query);
	$raz_valuta = $db->loadObjectlist();
return $raz_valuta;	
	
	}	

function getPriceleafvote()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_vote ORDER BY ordering';
	$db->setQuery($query);
	$raz_vote = $db->loadObjectlist();
return $raz_vote;	
	
	}	
	
}
?>