<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->
<?php
/*
Вид это промежуточный этап между моделью и шаблоном.
Так как мы используем loadObjectlist то мы указываем 
одну функцию. Если будет другой вид скажем loadResult
то прийдётся указывать каждую функцию отдельно и в 
моделе для каждой строки которая нам нужна создавать 
новый запрос в бд а модель будет одна для всех 
$model = $this->getModel();.
*/

//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

class PriceleafsViewStatus extends JViewLegacy
{
function display ($tpl = null)
	{
		// Получаем данные из модели
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$state = $this->get('State');
 
		// Проверяем на наличие ошибок.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Назначение данных для просмотра
		$this->items = $items;
		$this->pagination = $pagination;
		$this->state = $state;
		
		// Устанавливаем панель инструментов
		//$this->addToolBar();
	
	$hello		=& $this->get('Data');
	$isNew		= ($hello->id < 1);
	
	$model = $this->getModel();
	$rows = $model->getPriceleaf();
	$this->assignRef('rows',$rows);
	
	$rows_na = $model->getPriceleafnaimenowanie();
	$this->assignRef('rows_na',$rows_na);
	
	$rows_op = $model->getPriceleafoption();
	$this->assignRef('rows_op',$rows_op);
	
	$this->assignRef('hello',		$hello);
	
parent::display($tp1);
	}


}

