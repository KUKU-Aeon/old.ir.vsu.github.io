<!--
Priceleaf shop компонент интернет магазина.
Версия pro 2011.03.05
Автор Ваня
Copyright (C) 2011 joomla-umnik
Лицензия GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
Официальный сайт http://joomla-umnik.ru
-->
<?php
//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

class TableOformlenie extends JTable
{
	/**
	 * Конструктор
	 *
	 * Параметры объекта базы данных. Это то с чем мы будем работать.
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__priceleaf_zakaz', 'id', $db);
	}
}