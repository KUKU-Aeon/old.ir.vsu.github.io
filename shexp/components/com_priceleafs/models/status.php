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
class PriceleafsModelStatus extends JModelLegacy
{

	protected $_context = 'com_priceleafs.status';
	
	
//Пишем в базу данных полученные данные если они верны и отправляем на почту.
//Передавать мы всё будем через скрытые поля.	
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}	
	
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	
	//Функция которая сохранит данные
function delete()
{
$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

$row =& $this->getTable();

if (count( $cids )) {
foreach($cids as $cid) {
if (!$row->delete( $cid )) {
$this->setError( $row->getErrorMsg() );
return false;
}
}
}
return true;
}	
	

function getPriceleaf()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_zakaz ORDER BY ordering';
	$db->setQuery($query);
	$row = $db->loadObjectlist();

return $row;	
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
	
	
function getPriceleafoption()
	{
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_option ORDER BY ordering';
	$db->setQuery($query);
	$raz_op = $db->loadObjectlist();
return $raz_op;	
	
	}	

			
}
?>