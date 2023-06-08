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
 * Priceleaf Model
 */
class PriceleafsModelPriceleaf extends JModelAdmin
{
/**
	 * Returns возвращает ссылку на объект.
	 *
	 * @param	type	Тип таблицы для создания экземпляра
	 * @param	string	Префикс для имени класса таблицы.
	 * @param	array	Массив для модели.
	 * @return	JTable	Объекты базы данных
	 */
	 
	protected $text_prefix = 'COM_PRICELEAF';	 
	 
	 
//Возвращает ссылку на объект таблицы, при его создании.	 
	public function getTable($type = 'Priceleaf', $prefix = 'PriceleafsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Метод получения данных
	 *
	 * @param	array	$data		Данные для формы.
	 * @param	boolean	$loadData	Форма для того что бы загрузить свои данные(по умолчанию).
	 * @return	mixed	Вернуть данные в случае успешного завершения.
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		// Получить форму
		$form = $this->loadForm('com_priceleafs.priceleaf', 'priceleaf', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	
	//Метод, чтобы получить сценарии, которые должны быть включены в форму
	//public function getScript() 
	//{
	//	return 'administrator/components/com_priceleaf/models/forms/priceleaf.js';
	//}
	
	/**
	 * Метод, чтобы получить данные, которые должны быть выведены в форме.
	 *
	 * @return	mixed	Данные по форме.
	 */
	protected function loadFormData() 
	{
		// Проверка сессий для ранее введёных данных формы
		$data = JFactory::getApplication()->getUserState('com_priceleafs.edit.priceleaf.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
}