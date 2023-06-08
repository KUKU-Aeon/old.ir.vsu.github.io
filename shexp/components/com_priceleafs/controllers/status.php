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
defined( '_JEXEC' ) or die( 'Restricted access' );

//Класс для отображения формы ControllerPriceleaf тут мы указываем модель которая будут обрабатывать запрос
//Этот файл пишет в бд наши данные
class PriceleafsControllerStatus extends JControllerForm
{

	function __construct()
	{
		parent::__construct();

//Функции кнопок добавить редактировать
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'publish'    , 	'publish' );
		$this->registerTask( 'unpublish'  , 	'publish' );
	}

//функция для сохранения
function delete()
	{
		$model = $this->getModel('status'); 

		if ($model->delete()) {	
		
			$msg = JText::_( 'COM_PRICELEAF_ZAKAZ_DEL' );
			//При корректном заполнении полей и отправки заказа очищаем корзину
				
			
		} else {
			$msg = JText::_( 'Error' );
		}

//путь
		$link = 'index.php?option=com_priceleafs&view=status';
		$this->setRedirect($link, $msg);
	}


}