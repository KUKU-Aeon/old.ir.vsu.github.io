<?php

defined('_JEXEC') or die;

class PriceleafsController extends JControllerLegacy
{

function display ()
  {
parent::display();
  }
  
  
  
  
  
  
//Первая функция которая увеличивает рейтинг  
  function getAjaxDataone()
{ 	
	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные. После чего сделаем проверку на то голосовал ли уже пользователь или нет.
	$query = 'SELECT * FROM #__priceleaf_vote';
	$db->setQuery($query);
	//Вытаскиваем данные в массив
	$raz_cat = $db->loadObjectlist();
	
	
	//Теперь проверяем совпадает ли ip адрес и id записи	
	foreach ($raz_cat as $raz_valuta ){
	//Если совпадает то ничего не записываем и игнорируем действия пользователя
	if ($_REQUEST['vote_ip']==$raz_valuta->ip and $_REQUEST['vote_id_one']==$raz_valuta->id_tovar) 
	{
	//Если ip уже есть в базе
	$ip_user = 0;
	//Прерываем цикл если такая запись уже есть
	break;
	}
	else { 	
	//Записываем новый ip в базу данных
	$ip_user = 1;
	}

	}
	
	//Если пользователь не голосовал то пишем данные
	if ($ip_user==true) { 

	//Обновляем данные увеличивая голос на 1
	$query = 'UPDATE #__priceleaf_na SET plus=plus+1 WHERE id="'.$_REQUEST['vote_id_one'].'"';
	$db->setQuery($query);	
	$db->query();
	
	
	//И записываем ip адрес пользователя и id товара за который он проголосовал
	$query = 'INSERT INTO #__priceleaf_vote (`ip`, `id_tovar`) VALUES ("'.$_REQUEST['vote_ip'].'", "'.$_REQUEST['vote_id_one'].'") ';
	$db->setQuery($query);	
	$db->query();

}


	//А теперь сделаем запрос и обновим содержимое поля.
	$query = 'SELECT * FROM #__priceleaf_na';
	$db->setQuery($query);
	//Вытаскиваем данные в массив
	$raz_na = $db->loadObjectlist();
	
	
	//Теперь проверяем совпадает ли ip адрес	
	foreach ($raz_na as $raz_vote ){
	if ($raz_vote->id==$_REQUEST['vote_id_one']) 
	{
	echo $_REQUEST['vote_id_one'].'-'.$raz_vote->plus;
	}	

	
	}


    exit;
}










  function getAjaxDatatwo()
{

	//Подключение к бд joomla
	$db = JFactory::getDBO();
	
	//Выбираем из какой таблицы будем вытаскивать данные
	$query = 'SELECT * FROM #__priceleaf_vote';
	$db->setQuery($query);
	//Вытаскиваем данные в массив
	$raz_cat = $db->loadObjectlist();
	
	
	//Теперь проверяем совпадает ли ip адрес	
	foreach ($raz_cat as $raz_valuta ){
	if ($_REQUEST['vote_ip']==$raz_valuta->ip and $_REQUEST['vote_id_two']==$raz_valuta->id_tovar) 
	{
	//Если ip уже есть в базе
	$ip_user = 0;
		break;
	}
	else { 	
	//Записываем новый ip в базу данных
	$ip_user = 1;
	}

	}
	
	if ($ip_user==true) { 

	//Обновляем данные
	$query = 'UPDATE #__priceleaf_na SET  minus=minus+1 WHERE id="'.$_REQUEST['vote_id_two'].'"';	
	$db->setQuery($query);	
	$db->query();
	//И записываем ip адрес пользователя

	$query = 'INSERT INTO #__priceleaf_vote (`ip`, `id_tovar`) VALUES ("'.$_REQUEST['vote_ip'].'", "'.$_REQUEST['vote_id_two'].'") ';	
	$db->setQuery($query);	
	$db->query();
	
	}

	
	//А теперь сделаем запрос и обновим содержимое поля.
	$query = 'SELECT * FROM #__priceleaf_na';
	$db->setQuery($query);
	//Вытаскиваем данные в массив
	$raz_na = $db->loadObjectlist();
	
	
	//Теперь проверяем совпадает ли ip адрес	
	foreach ($raz_na as $raz_vote ){
	if ($raz_vote->id==$_REQUEST['vote_id_one']) 
	{
	echo $raz_vote->plus;
	}	

	
	}

//Закрываем
    exit;
}


}

?>