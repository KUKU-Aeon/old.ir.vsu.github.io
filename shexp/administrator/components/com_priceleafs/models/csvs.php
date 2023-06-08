<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

//Класс модели в нём формируются запросы на публикацию, сортировку данных
class PriceleafsModelCsvs extends JModelList
{
var $_total = null;
var $_pagination = null;
function __construct()
	{
		parent::__construct();
		global $mainframe, $option;
 
	}
	
}