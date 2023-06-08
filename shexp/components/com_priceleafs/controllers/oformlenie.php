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
class PriceleafsControllerOformlenie extends JControllerForm
{

 function getAjaxData()
{
    echo  'login: ' .$_REQUEST['login'] . '; password: ' . $_REQUEST['password'];
    exit;
}

	function __construct()
	{
		parent::__construct();

//Функции кнопок добавить редактировать
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'publish'    , 	'publish' );
		$this->registerTask( 'unpublish'  , 	'publish' );
	}

//функция для сохранения
	function save()
	{
		$model = $this->getModel('oformlenie'); 

		if ($model->store($post)) {
			
		//Проверка на вывод печати заказа!
		if($_POST["pechat_duble"]==1){
		$print = '<div id="result" style="display:none;"><table><tr><td>'.$_POST["zapisvbd"].'<br><img src="'.$_POST["pechat"].'"></td></tr></table></div><input type=submit onclick=Load() value="'.JText::_( 'COM_PRICELEAF_PRINT_ZAKAZ' ).'"><br><br>';}
		else {$print ='';}
		
	
$replase = str_replace( $_POST["money_payment_simbol"], "", $_POST["money_payment"]); 	
	
   //Выводим форму оплаты если таковая необходима
  if($_POST["payment_state"]==1){ $payment = '
  <form method="post" action="https://merchant.w1.ru/checkout/default.aspx" accept-charset="UTF-8">
  <input type="hidden" name="WMI_MERCHANT_ID"    value="'.$_POST["merchant_id"].'"/>
  <input type="hidden" name="WMI_PAYMENT_AMOUNT" value="'.$replase.'"/>
  <input type="hidden" name="WMI_CURRENCY_ID"    value="'.$_POST["currency_id"].'"/>
  <input type="hidden" name="WMI_DESCRIPTION"    value="'.$_POST["description"].'"/>
  <input type="hidden" name="WMI_SUCCESS_URL"    value="'.$_POST["success_url"].'"/>
  <input type="hidden" name="WMI_FAIL_URL"       value="'.$_POST["fail_url"].'"/>
  '.JText::_( 'COM_PRICELEAF_PAYMENT_CENA' ).' '.$_POST["money_payment"].' '.$_POST["money_payment_valuta"].'
  <input type="submit" value="'.JText::_( 'COM_PRICELEAF_PAYMENT' ).'"/>
  </form>';}
  else {$payment = '';}
		

		$msg = $print.$payment;
		
			
		} else {
			$msg = JText::_( 'Error' );
		}

//путь
		$link = $_POST["adress_link"];
		$this->setRedirect($link, $msg);
	}


}