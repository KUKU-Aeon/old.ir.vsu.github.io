<!--
Priceleaf shop компонент интернет магазина.
Версия pro 2011.03.05
Автор Ваня
Copyright (C) 2011 joomla-umnik
Лицензия GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
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
class PriceleafsModelOformlenie extends JModelLegacy
{

	protected $_context = 'com_priceleafs.oformlenie';


//Пишем в базу данных полученные данные если они верны и отправляем на почту.
//Передавать мы всё будем через скрытые поля.
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the hello identifier
	 *
	 * @access	public
	 * @param	int Hello identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
Таблица в которую заносим данные.
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__priceleaf_zakaz'.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->post = null;
		}
		return $this->_data;
	}
	
	
	//Функция которая сохранит данные
	function store()

	{	
			$row =& $this->getTable();
			$data = JRequest::get( 'post' );
			
$data['zapisvbd']=JRequest::getVar( 'zapisvbd',NULL,NULL,NULL,JREQUEST_ALLOWHTML);
	
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		//Make sure the hello record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		
		return true; 
		
	}



//Выборка данных псевдонима сслыки
function getPriceleafmenu()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT * FROM #__menu';
$db->setQuery($query);
$raz_menu = $db->loadObjectlist();
return $raz_menu;	
}


function getOformlenie()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT * FROM #__priceleafshop_razdel ORDER BY ordering';
$db->setQuery($query);
$row = $db->loadObjectlist();
return $row;	
}
	
	
//Формируем ещё один запрос для вывода главной страницы
function getOformlenieglavnay()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT name FROM #__priceleafshop_razdel ORDER BY ordering';
$db->setQuery($query);
$row = $db->loadResult();
return $row;	
}	
	
	
function getOformlenieglavnayid()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT id FROM #__priceleafshop_razdel ORDER BY ordering';
$db->setQuery($query);
$row = $db->loadResult();
return $row;	
}	
	
	
function getOformleniecat()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleafshop_cat ORDER BY ordering';
	$db->setQuery($query);
	$raz_cat = $db->loadObjectlist();
return $raz_cat;	
	
	}
	
	function getOformleniecatid()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleafshop_cat ORDER BY ordering';
	$db->setQuery($query);
	$raz_cat = $db->loadResult();
return $raz_cat;	
	
	}

	
function getOformlenienaimenowanie()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT * FROM #__priceleafshop_na ORDER BY ordering';
$db->setQuery($query);
$raz_na = $db->loadObjectlist();
return $raz_na;	
}

	
function getOformlenievaluta()
{
//Подключение к бд joomla
$db = JFactory::getDBO();
	
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'SELECT * FROM #__priceleafshop_option ORDER BY ordering';
$db->setQuery($query);
$raz_valuta = $db->loadObjectlist();
return $raz_valuta;	
}
	
}
?>