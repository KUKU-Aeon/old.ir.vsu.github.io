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
 * Класс таблицы
 */
class PriceleafsTableCsv extends JTable
{
	/**
	 * Конструктор
	 *
	 * Параметры объекта базы данных. Это то с чем мы будем работать.
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__priceleaf_cat', 'id', $db);
	}
}