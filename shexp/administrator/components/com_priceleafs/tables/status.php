<?php
//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

class TableStatus extends JTable
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