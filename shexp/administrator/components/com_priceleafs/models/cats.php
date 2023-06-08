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
defined('_JEXEC') or die;
/**
 * Класс модели
 */
class PriceleafsModelCats extends JModelList
{
//Конструктор
//Дополнительный ассоциативный массив параметров конфигурации.
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name_cat', 'a.name_cat',
				'ordering', 'a.ordering',
				'raz_cat', 'a.raz_cat',
				'state', 'a.state'
			);
		}

		parent::__construct($config);
	}
	
//Метод для автоматического заполнения model state
//Примечание. Вызов GetState в этом методе приведет к рекурсии.
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');
		
		// Загрузите состояние фильтра.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		// Загрузка параметров
		$params = JComponentHelper::getParams('com_priceleafs');
		$this->setState('params', $params);

		parent::populateState('a.name_cat', 'asc');
	}
	
	
	//Фильтры	
		protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');
		return parent::getStoreId($id);
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
		$user	= JFactory::getUser();

		// Выбираем нужные поля из таблицы
		$query->select(
		$this->getState('list.select','a.id, a.raz_cat, a.name_cat, a.state, a.ordering')
		);
		
		
		$query->from($db->quoteName('#__priceleaf_cat').' AS a');

$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.name_cat LIKE '.$search.')');
			}
		}		
				
				
		// Фильтр по состоянию публикации
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = '.(int) $published);
		} elseif ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}
				
		
		// сортировка
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
			$orderCol = 'a.name_cat '.$orderDirn.', a.ordering';
		}
		$query->order($db->escape($orderCol.' '.$orderDirn));

		return $query;
	}
	
	//выборка данных из второй таблицы.

	public function getPriceleafraz()
	{
	//Подключение к бд joomla
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser();
	
		$query->select(
		$this->getState('list.select','a.id, a.name, a.text, a.state, a.ordering')
		);
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query->from($db->quoteName('#__priceleaf_razdel').' AS a');
	$db->setQuery($query);
	$raz_raz = $db->loadObjectlist();
return $raz_raz;	
	
	}
}