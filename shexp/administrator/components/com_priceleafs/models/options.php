<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
/*Модель через неё идут запросы в базу, соответственно модель работает на запись и вытаскивание данных,
*/

// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * Класс модели
 */
class PriceleafModelOptions extends JModelList
{
//Конструктор
//Дополнительный ассоциативный массив параметров конфигурации.
public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'valuta', 'a.valuta',
				'ordering', 'a.ordering',
				'published', 'a.published'
			);
		}

		parent::__construct($config);
	}
	
//Метод для автоматического заполнения model state
//Примечание. Вызов GetState в этом методе приведет к рекурсии.
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// List state information.
		parent::populateState('a.valuta', 'asc');
	}

	/**
	 * Метод для создания запросов SQL для загрузки данных списка.
	 *
	 * Возвращение строк запроса из бд.
	 */
	 
		protected function getListQuery()
	{
		// Создаём новый объект запроса
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Выбираем нужные поля из таблицы
		$query->select(
			$this->getState(
				'list.select',
				'*'
			)
		);
		$query->from('`#__priceleaf_option` AS a');

		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		if ($orderCol == 'ordering' || $orderCol == 'category_title') {
			$orderCol = 'category_title '.$orderDirn.', ordering';
		}
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));

		return $query;
		
	}
}