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
 
// Импорт типа поля списка
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * Поля формы класса для компонента
 */
class JFormFieldOption extends JFormFieldList
{
	/**
	 * Тип поля.
	 *
	 * Вернуть строку
	 */
	protected $type = 'Option';
 
	/**
	 * Метод, чтобы получить список опций для списка ввода.
	 *
	 * Вернуть массив.
	 */
	protected function getOptions() 
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__priceleaf_option');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();
		$options = array();
		if ($messages)
		{
			foreach($messages as $message) 
			{
				$options[] = JHtml::_('select.option', $message->id, $message->name);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}