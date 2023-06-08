<?php
/*
Шаблон это вывод данных которые сформированы через модель и вид.
Здесь выводится через цикл. так должно быть echo $row->id; 
а не echo $this->id; id это просто то значение которо нужно
вывести оно может быть любым в зависимости как называются ваши поля в таблице.
Ну и естественно свои классы в joomla для оформления страницы.
*/
//защита от прямого доступа
defined('_JEXEC') or die;
?>

<?php JHTML::_('behavior.formvalidation'); ?>

<!--Подключаем css и ява-->
<script language="JavaScript" type="text/javascript" src="components/com_priceleafs/helpers/jquery.js"></script>
<script type="text/javascript" src="components/com_priceleafs/js/vote.js"></script>
<link rel="stylesheet" type="text/css" href="components/com_priceleafs/css/priceleaf.css">
<link rel="stylesheet" type="text/css" href="components/com_priceleafs/css/print.css">
<link rel="stylesheet" type="text/css" href="components/com_priceleafs/css/reveal.css">	
<script type="text/javascript" src="components/com_priceleafs/js/captcha.js"></script>
<script type="text/javascript" src="components/com_priceleafs/js/jquery.reveal.js"></script>




<!--Это две формы которые отвечают за рейтинг товаров-->
<form class="form_vote_plus" action="index.php?option=com_priceleafs&view=priceleafs&task=getAjaxDataone"  method="post" id="ajaxForm_one">
<input type="hidden" name="vote_ip" value="<?php echo $ip = $_SERVER['REMOTE_ADDR']; ?>" /><br>
<input type="hidden" name="vote_id_one" id="vote_id_one" value="" />
<input type="button" style="display:none;" id="ajaxSubmit_one" class="ajaxSubmit_one"><br>
</form>

<form class="form_vote_minus" action="index.php?option=com_priceleafs&view=priceleafs&task=getAjaxDatatwo" method="post" id="ajaxForm_two">
<input type="hidden" name="vote_ip" value="<?php echo $ip = $_SERVER['REMOTE_ADDR']; ?>" /><br>
<input type="hidden" name="vote_id_two" id="vote_id_two" value="" />
<input type="button" style="display:none;" class="ajaxSubmit_two">
</form>




<script>
//Печать заказа!
function Load(){
text = document.getElementById('result').innerHTML;
printwin = open('', 'printwin', 'width=800,height=700');
printwin.document.open();
printwin.document.writeln('<link rel="stylesheet" type="text/css" href="components/com_priceleafs/css/print.css"><body onload=print();close()>');
printwin.document.writeln(text);
printwin.document.writeln('</body>');
printwin.document.close();
}
</script>





<?php
//Социальные кнопки
$dispatcher =& JDispatcher::getInstance();
JPluginHelper::importPlugin( 'extension' );
$results = $dispatcher->trigger( 'onPrepareContent');
?>





<div id="v1"> 
<?php
//Вывод статуса заказа если пользователь зарегистрирован
foreach ($this->rows_valuta as $raz_valuta ){
//Проверим нужно ли выводить кнопки печать и отправить ссылку другу. 
if ($raz_valuta->icons==1) {
echo BlogIcons::email( JRoute::_($_SERVER['REQUEST_URI'] . $id ) );
echo BlogIcons::print_popup( JRoute::_($_SERVER['REQUEST_URI'] . $id ) ); }

//Передача символа для правильной оплаты заказа
$delit_simbol=$raz_valuta->simbol;

//Для проверки вывода формы оплаты
$payment_state_duble=$raz_valuta->payment_state;

$user = &JFactory::getUser();
// если пользователь гость
if ($user->guest) { }
else {
if ($raz_valuta->status==1) { 
echo '<div align="right"><a href="index.php?option=com_priceleafs&view=status"><button>'.JText::_( 'COM_PRICELEAF_STATUS' ).'</button></a></div>';
}}
}

?>





<div class="b1"><b></b></div><div class="b2"><b><i><q></q></i></b></div> 
<div class="b3"><b><i></i></b></div><div class="b4"><b></b></div><div class="b5"><b></b></div> 
<div class="text"> 





<?php 
//Ява скрипт подсчёта стоимости делаю проверку что выбрано услуги или товары в зависимости что выбрано выводится иной скрипт подсчёта
foreach ($this->rows_valuta as $raz_valuta ){

//Вывод валюты для радиокнопок
$cenaradio=$raz_valuta->valuta;

//Разделитель стоимости
echo '<input id="simbol" type="hidden" name="simbol" value="'.$raz_valuta->simbol.'">';


//Проверка на проценты
if($raz_valuta->percent==1){
echo '<input id="percent" type="hidden" name="percent" value="'.$raz_valuta->percent.'">';
echo '<input id="percent_number" type="hidden" name="percent_number" value="'.$raz_valuta->percent_number.'">';
echo '<input id="percent_bill" type="hidden" name="percent_bill" value="'.$raz_valuta->percent_bill.'">';
}
else {
echo '<input id="percent" type="hidden" name="percent" value="0">';
echo '<input id="percent_number" type="hidden" name="percent_number" value="">';
echo '<input id="percent_bill" type="hidden" name="percent_bill" value="">';
}

//Вывод способа подсчёта

echo '<script src="/components/com_priceleafs/js/counting-1.js" type="text/javascript"></script>
<script src="/components/com_priceleafs/js/counting-2.js" type="text/javascript"></script>';
} 
?> 








<?php 
//Формирование письма, в зависимости от выбранного варианта вывода данных
if($_POST['submit']) {

//Цикл для select
foreach ($this->rows_na as $raz_na ){ 
if ($raz_na->opredelenie==3) {
if ($_POST["xz_".$raz_na->id]==$raz_na->cena) {
$sl = $raz_na->radio1;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena1) {
$sl = $raz_na->radio2;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena2) {
$sl = $raz_na->radio3;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena3) {
$sl = $raz_na->radio4;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena4) {
$sl = $raz_na->radio5;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena5) {
$sl = $raz_na->radio6;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena6) {
$sl = $raz_na->radio7;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena7) {
$sl = $raz_na->radio8;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena8) {
$sl = $raz_na->radio9;}
if ($_POST["xz_".$raz_na->id]==$raz_na->cena9) {
$sl = $raz_na->radio10;}

}}

//Процесс создания письма, вытаскиваем данные в цикле и помещаем в переменные.
foreach ($this->rows_na as $raz_na ){
if ($raz_na->opredelenie==0) {
if ($raz_valuta->stoimost==1) {
$namber_mail = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
$cenap2 = $namber_mail.' '.$raz_valuta->valuta; }
}

if ($raz_na->opredelenie==1) {
//Сюда приписываем дополнительные параметры в отдельную переменную и проверяем на нажатие чекбокса..........
if ($_POST['optional_field1'.$raz_na->id]==true) {
$optional_checkbox1 = $raz_na->optional_description1.'<br>'; $optional_checkbox_bill1 = $raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field2'.$raz_na->id]==true) {
$optional_checkbox2 = $raz_na->optional_description2.'<br>'; $optional_checkbox_bill2 = $raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field3'.$raz_na->id]==true) {
$optional_checkbox3 = $raz_na->optional_description3.'<br>'; $optional_checkbox_bill3 = $raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field4'.$raz_na->id]==true) {
$optional_checkbox4 = $raz_na->optional_description4.'<br>'; $optional_checkbox_bill4 = $raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field5'.$raz_na->id]==true) {
$optional_checkbox5 = $raz_na->optional_description5.'<br>'; $optional_checkbox_bill5 = $raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field6'.$raz_na->id]==true) {
$optional_checkbox6 = $raz_na->optional_description6.'<br>'; $optional_checkbox_bill6 = $raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field7'.$raz_na->id]==true) {
$optional_checkbox7 = $raz_na->optional_description7.'<br>'; $optional_checkbox_bill7 = $raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field8'.$raz_na->id]==true) {
$optional_checkbox8 = $raz_na->optional_description8.'<br>'; $optional_checkbox_bill8 = $raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field9'.$raz_na->id]==true) {
$optional_checkbox9 = $raz_na->optional_description9.'<br>'; $optional_checkbox_bill9 = $raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field10'.$raz_na->id]==true) {
$optional_checkbox10 = $raz_na->optional_description10.'<br>'; $optional_checkbox_bill10 = $raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'<br>';}

//Заносим все данные для текстового поля в 1 переменную. А в конце цикла присваиваем пустое значение
$textbox = $optional_checkbox1.$optional_checkbox2.$optional_checkbox3.$optional_checkbox4.$optional_checkbox5.$optional_checkbox6.$optional_checkbox7.$optional_checkbox8.$optional_checkbox9.$optional_checkbox10;

$textbox_cena = $optional_checkbox_bill1.$optional_checkbox_bill2.$optional_checkbox_bill3.$optional_checkbox_bill4.$optional_checkbox_bill5.$optional_checkbox_bill6.$optional_checkbox_bill7.$optional_checkbox_bill8.$optional_checkbox_bill9.$optional_checkbox_bill10;

//.................

if ($raz_valuta->stoimost==1) {
$namber_mail = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
$cenap2 = $namber_mail.' '.$raz_valuta->valuta; }
}

if ($raz_na->opredelenie==2) {
if ($raz_na->state==1) {
if ($raz_valuta->stoimost==1) {
$ex=@explode('-', $_POST["xz_".$raz_na->id]);
$namber_mail = str_replace(',',''.$raz_valuta->simbol.'',number_format($ex[0]));
$cenap2 = $namber_mail.' '.$raz_valuta->valuta; }
}
}

if ($raz_na->opredelenie==3) {

//Сюда приписываем дополнительные параметры в отдельную переменную и проверяем на нажатие чекбокса..........
if ($_POST['optional_field1'.$raz_na->id]==true) {
$optional_checkbox1 = $raz_na->optional_description1.'<br>'; $optional_checkbox_bill1 = $raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field2'.$raz_na->id]==true) {
$optional_checkbox2 = $raz_na->optional_description2.'<br>'; $optional_checkbox_bill2 = $raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field3'.$raz_na->id]==true) {
$optional_checkbox3 = $raz_na->optional_description3.'<br>'; $optional_checkbox_bill3 = $raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field4'.$raz_na->id]==true) {
$optional_checkbox4 = $raz_na->optional_description4.'<br>'; $optional_checkbox_bill4 = $raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field5'.$raz_na->id]==true) {
$optional_checkbox5 = $raz_na->optional_description5.'<br>'; $optional_checkbox_bill5 = $raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field6'.$raz_na->id]==true) {
$optional_checkbox6 = $raz_na->optional_description6.'<br>'; $optional_checkbox_bill6 = $raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field7'.$raz_na->id]==true) {
$optional_checkbox7 = $raz_na->optional_description7.'<br>'; $optional_checkbox_bill7 = $raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field8'.$raz_na->id]==true) {
$optional_checkbox8 = $raz_na->optional_description8.'<br>'; $optional_checkbox_bill8 = $raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field9'.$raz_na->id]==true) {
$optional_checkbox9 = $raz_na->optional_description9.'<br>'; $optional_checkbox_bill9 = $raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'<br>';}

if ($_POST['optional_field10'.$raz_na->id]==true) {
$optional_checkbox10 = $raz_na->optional_description10.'<br>'; $optional_checkbox_bill10 = $raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'<br>';}

//Заносим все данные для текстового поля в 1 переменную. А в конце цикла присваиваем пустое значение
$textbox = $optional_checkbox1.$optional_checkbox2.$optional_checkbox3.$optional_checkbox4.$optional_checkbox5.$optional_checkbox6.$optional_checkbox7.$optional_checkbox8.$optional_checkbox9.$optional_checkbox10;

$textbox_cena = $optional_checkbox_bill1.$optional_checkbox_bill2.$optional_checkbox_bill3.$optional_checkbox_bill4.$optional_checkbox_bill5.$optional_checkbox_bill6.$optional_checkbox_bill7.$optional_checkbox_bill8.$optional_checkbox_bill9.$optional_checkbox_bill10;

//.................

if ($raz_valuta->stoimost==1) {
$namber_mail = str_replace(',',''.$raz_valuta->simbol.'',number_format($_POST['xz_'.$raz_na->id]));
$cenap2 = $namber_mail.' '.$raz_valuta->valuta; }
}


if ($raz_na->opredelenie==0) {
if ($raz_valuta->col==1) {
$cenap0 = '1-'.$raz_na->edizm;}
else {
$cenap0 = '1'; }
}

if ($raz_na->opredelenie==1) {
if ($raz_valuta->col==1) {
$cenap0 = $_POST["xz_".$raz_na->id].'-'.$raz_na->edizm;}
else { 
$cenap0 = $_POST["xz_".$raz_na->id];
}
}

if ($raz_na->opredelenie==2) {
if ($raz_valuta->col==1) {
$ex=@explode('-', $_POST["xz_".$raz_na->id]);
$cenap0 = $ex[2].'&nbsp; 1-'.$raz_na->edizm;}
else {
$cenap0 = $ex[2].'&nbsp; 1';
}
}

if ($raz_na->opredelenie==3) {
if ($raz_valuta->col==1) {
$cenap0 = $sl.'&nbsp; 1-'.$raz_na->edizm;}
else {
$cenap0 = $sl.'&nbsp; 1';
}
}


if($_POST["xz_".$raz_na->id]==true){ if($raz_na->state==1){ $Catigor .='<tr><td>'.$raz_na->name.'<br>'.$textbox.'</td><td>'.$cenap2.'<br>'.$textbox_cena.'</td>'; 
//Проверка для каких услуг формировать таблицу заказа
$Catigor .= "<td>".JText::_( 'COM_PRICELEAF_ZAKAZANO' )."</td><td>".$cenap0."</td></tr>";

//Вывод на печать изображения
if ($raz_valuta->pechat==true){
$pechat = $raz_valuta->pechat;
}
else {$pechat = 'components/com_priceleafs/images/pechat.png';}

//Выводить ли печать вообще!
if ($raz_valuta->pechat_duble==1){
$pechat_duble = $raz_valuta->pechat_duble;
}

if ($raz_valuta->stoimost==1) {
$valuta_pojta="<td colspan='5'><b>".JText::_( 'COM_PRICELEAF_SUMMA' )."</b> ".$_POST[save3].' '.$raz_valuta->valuta."</td>";
$valuta_pojta_duble=$_POST[save3].' '.$raz_valuta->valuta;
$money_payment = $_POST[save3];
}
else {
$valuta_pojta="<td colspan='5'><b>----</b></td>";
$valuta_pojta_duble='----';
$money_payment = '';
}


}}
//Обновляем переменные дополнительных полей
$textbox_cena = '';
$textbox = '';

//Оновляем переменные дополнительных полей для товаров
$textbox = '';
$optional_checkbox1='';
$optional_checkbox2='';
$optional_checkbox3='';
$optional_checkbox4='';
$optional_checkbox5='';
$optional_checkbox6='';
$optional_checkbox7='';
$optional_checkbox8='';
$optional_checkbox9='';
$optional_checkbox10='';

$textbox_cena = '';
$optional_checkbox_bill1='';
$optional_checkbox_bill2='';
$optional_checkbox_bill3='';
$optional_checkbox_bill4='';
$optional_checkbox_bill5='';
$optional_checkbox_bill6='';
$optional_checkbox_bill7='';
$optional_checkbox_bill8='';
$optional_checkbox_bill9='';
$optional_checkbox_bill10='';

} 
$CatMail = $CatMail.$Catigor; $Catigor="";



$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: ".$raz_valuta->from."\r\n"; 

//Если пользователь выбрал дублировать письмо то отправляем сообщение на указанную им почту если нет то нет!
if($_POST["copiy"]==1){
$headers .= "Bcc: ".$_POST[pojta]."\r\n";
}

$body = "<table border='1'>
<tr bgcolor='cbcbcb'><td><b>".JText::_( 'COM_PRICELEAF_NAME' )."</b></td><td colspan='4'>".$_POST[name]."</td></tr>
<tr bgcolor='cbcbcb'><td><b>".JText::_( 'COM_PRICELEAF_MAIL' )."</b></td><td colspan='4'>".$_POST[pojta]."</td></tr>
<tr bgcolor='cbcbcb'><td><b>".JText::_( 'COM_PRICELEAF_TEL' )."</b></td><td colspan='4'>".$_POST[tel]."</td></tr>
<tr bgcolor='cbcbcb'><td><b>".JText::_( 'COM_PRICELEAF_GOLDEN_STATUS' )."</b></td><td colspan='4'>".$_POST[oplata]."</td></tr>
<tr bgcolor='cbcbcb'><td><b>".JText::_( 'COM_PRICELEAF_MESSAGE' )."</b></td><td colspan='4'>".$_POST[mess]."</td>
</tr>".$CatMail."<tr bgcolor='e2ffe1'>".$valuta_pojta."</tr></table>";


		// $to - кому отправляем 
		// $to - кому отправляем 
		foreach ($this->rows_valuta as $raz_valuta ){
		$merchant_id = $raz_valuta->merchant_id;
		$currency_id = $raz_valuta->currency_id;
		$description = $raz_valuta->description;
		$success_url = $raz_valuta->success_url;
		$fail_url = $raz_valuta->fail_url;
		$money_payment_valuta = $raz_valuta->valuta;
		$payment_state = $raz_valuta->payment_state;		
        $to = $raz_valuta->mail; }
		$subject = 'Priceleaf';
        // функция, которая отправляет наше письмо. 
        mail($to, $subject, $body, $headers); 

//Отправка в админку данных заказа.

echo "<form action='index.php?option=com_priceleafs&view=priceleafs' method='post' name='adminForm' id='adminForm'>";
//Запись в бд заказа
echo '<input type="hidden" name="zapisvbd" value="'.$body.'" />
<input type="hidden" name="pechat" value="'.$pechat.'" />
<input type="hidden" name="pechat_duble" value="'.$pechat_duble.'" />
<input type="hidden" name="payment_state" value="'.$payment_state.'" />
<input type="hidden" name="pojta" value="'.$_POST[pojta].'" />
<input type="hidden" name="oplata"       value = "'.$_POST['oplata'].'" />
<input type="hidden" name="cenahidden"          value = "'.$_POST['save3'].'" />
<input type="hidden" name="merchant_id" value="'.$merchant_id.'" />
<input type="hidden" name="currency_id" value="'.$currency_id.'" />
<input type="hidden" name="description" value="'.$description.'" />
<input type="hidden" name="success_url" value="'.$success_url.'" />
<input type="hidden" name="fail_url" value="'.$fail_url.'" />
<input type="hidden" name="adress_link" value="'.$_SERVER['REQUEST_URI'].'">
<input type="hidden" name="date"       value = "'.date("F j, Y, H:i:s").'" />';
//Вывод id user для проверки при просмотре заказов
$user = &JFactory::getUser();
echo "<input type='hidden' name='id_user'       value ='{$user->id}' />";
//Обновление количества товаров

foreach ($this->rows_na as $raz_na ){

if($_POST["xz_".$raz_na->id]==true){ if($raz_na->state==1) { 
$tire="-";
if ($raz_na->opredelenie==1) {

$ColDeliteid .=$tire.$raz_na->id;
$ColDelite .=$tire.$_POST["xz_".$raz_na->id];

$db = JFactory::getDBO();
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'UPDATE #__priceleaf_na SET total_tovar=total_tovar-"'.$_POST["xz_".$raz_na->id].'" WHERE id="'.$raz_na->id.'"';
$db->setQuery($query);
$db->query();
}

if ($raz_na->opredelenie==0) {
$ColDeliteid .=$tire.$raz_na->id;
$ColDelite .=-1;

$db = JFactory::getDBO();
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'UPDATE #__priceleaf_na SET total_tovar=total_tovar-"1" WHERE id="'.$raz_na->id.'"';
$db->setQuery($query);
$db->query();
}

if ($raz_na->opredelenie==2) {
$ColDeliteid .=$tire.$raz_na->id;
$ColDelite .=-1;

$db = JFactory::getDBO();
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'UPDATE #__priceleaf_na SET total_tovar=total_tovar-"1" WHERE id="'.$raz_na->id.'"';
$db->setQuery($query);
$db->query();
}

if ($raz_na->opredelenie==3) {
$ColDeliteid .=$tire.$raz_na->id;
$ColDelite .=-1;

$db = JFactory::getDBO();
//Выбираем из какой таблицы будем вытаскивать данные
$query = 'UPDATE #__priceleaf_na SET total_tovar=total_tovar-"1" WHERE id="'.$raz_na->id.'"';
$db->setQuery($query);
$db->query();
}


}}} 

//скрытое поле количества товаров
echo '<input type="hidden" name="col" value="'.$ColDelite.'" />
<input type="hidden" name="col_id" value="'.$ColDeliteid.'" />
<input type="hidden" name="merchant_id" value="'.$merchant_id.'" />
<input type="hidden" name="currency_id" value="'.$currency_id.'" />
<input type="hidden" name="description" value="'.$description.'" />
<input type="hidden" name="success_url" value="'.$success_url.'" />
<input type="hidden" name="fail_url" value="'.$fail_url.'" />
<input type="hidden" name="money_payment" value="'.$money_payment.'" />
<input type="hidden" name="money_payment_simbol" value="'.$delit_simbol.'" />
<input type="hidden" name="money_payment_valuta" value="'.$money_payment_valuta.'" />

';
echo "<input type='submit' id='subbmitclick' class='skritieknopki' value='".JText::_( 'OTPRAVIT' )."' name='adminForm'>
<input type='hidden' name='task' value = 'oformlenie.save' />
<input type='hidden' name='option'	   value='com_priceleafs' />
<input type='hidden' name='id'         value='".$this->hello->id."' />
<input type='hidden' name='view'       value='oformlenie' />
<input type='hidden' name='check'      value='' />
</form>";


		echo '<script type="text/javascript"> alert ("'.JText::_( 'COM_PRICELEAF_ZAYVKA_OTPRAVLENA').' '.$valuta_pojta_duble.'"); $("#subbmitclick").click(); </script>';
 
}

?>








<form name="form" class="form-validate" id='me_order_form' action="<?php $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" onkeyup="price(this)" action="" onclick="price(this)" method="post" enctype="multipart/form-data">
<input type="hidden" name="tot_pr" value="" id="total_pr" />





<!--Вывод основного содержимого данных, а именно разделы, категории и принадлежащие к ним меню. Всё взаимосвязанно и помещено в одну отдельную таблицу. Всё разбито на небольшие блоки, но категории и принадлежащие к ним меню не разбиты.-->
<table class="tablica" border="0px">
<tr class="td_not_border"><td class="td_not_border" valign="top">




<!--Вывод имени разделов-->
<?php 
//Вывод только указанных разделов!
$menuitemid = JRequest::getInt( 'Itemid' );
$menu = JSite::getMenu();
$id = $menu->getParams( $menuitemid )->get('id');
$razdel_id=@explode(':', $id);
$num_raz = count($razdel_id);



if ($sposob_vivoda_razdela==0 or $sposob_vivoda_razdela==1) {
$tab_raz=2;
$tab_raz_one=1;
echo "<div class='menu1'>";
foreach ($this->rows as $row ) { 
if($row->state==1){
echo '<br id="tab'.$tab_raz.'"/>';
$tab_raz++;
}}


$tab_raz=2;
for ($i=0; $i < $num_raz; $i++) {
foreach ($this->rows as $row ) {
if($id==true){ 
if ($razdel_id[$i]==$row->id){
if($row->state==1){
	echo '<a href="#tab'.$tab_raz_one.'"><b>'.$row->name.'</b></a>'; 
$tab_raz_one++;
$tab_raz++;
}}}

else {
if($row->state==1){
echo '<a href="#tab'.$tab_raz_one.'"><b>'.$row->name.'</b></a>'; 
$tab_raz_one++;
$tab_raz++;

}

}}}
?>





<?php
$b=1;
//Цикл вывода раздела но не просто вывода а вывода скрытых вкладок


for ($i=0; $i < $num_raz; $i++) {
foreach ($this->rows as $row ) {
if($id==true){ 
if ($razdel_id[$i]==$row->id){
//Опубликован раздел или нет
if($row->state==1){
//Первая ссылка с id
echo "<div class='blok-kontent-div' id=".$row->id.">";


//Выводим данные для каждого раздела в цикле.
echo ''.$row->text.'<br><div id="shapka-left"></div><div id="shapka-center"><div id="otstup-raz"><center>'.$row->name.'</center></div></div><div id="shapka-right"></div>'; 	




	
	
//В зависимости от того товары или услуги проверяем как вывести информационную панель
foreach ($this->rows_valuta as $raz_valuta ){ 
//вывод наименования

if ($raz_valuta->stoimost==0 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-2">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==0 and $raz_valuta->col==1) {
echo '<div class="otstup-duble-1">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-3">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==1) {
echo '<div class="otstup-1">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

//Вывод стоимости
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2">'.JText::_( 'COM_PRICELEAF_STOIMOST' ).'</div>';
}

echo '<div class="otstup-3">'.JText::_( 'COM_PRICELEAF_KOLLIJESTVO' ).'</div><div class="otstup-5">&nbsp;&nbsp;&nbsp;&nbsp;'.JText::_( 'COM_PRICELEAF_DOSTUPNO' ).'</div>';

if ($raz_valuta->col==1) {
echo '<div class="otstup-5">&nbsp;&nbsp;&nbsp;&nbsp;'.JText::_( 'COM_PRICELEAF_EDIZM' ).'</div><br>'; 
}}







//Вывод категорий для разделов
foreach ($this->rows_cat as $raz_cat ) { 

if( $raz_cat->raz_cat ==$row->id) {
if($raz_cat->state==1){

echo <<<sds
<span><a class="text-name" href="" onclick="obj=this.parentNode.childNodes[1].style; 
tmp=(obj.display!='block') ? 'block' : 'none'; 
obj.display=tmp; 
return false;"><div id="cat-left"></div><div id="cat-center"><div id="otstup-cat-open">
sds;
echo $raz_cat->name_cat;
echo '</div></div><div id="cat-right"></div></a>';
//Проверка спойлера как выводить категории свёрнутыми или нет
foreach ($this->rows_valuta as $raz_valuta ){ 
if($raz_valuta->spoiler==0){
echo '<div style="display: none";>';
}
else {echo '<div style="display: block";>';}
}

}
else{echo "<div>";} 






foreach ($this->rows_na as $raz_na ){
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
if($raz_cat->state==1){
if($raz_na->state==1){
$a = $raz_cat->id;
if( $raz_na->cat_naimenovanie ==$a) {
//Тут формируются данные
//Проверка опубликован раздел или нет так как всё в проверку заключить нельзя из за foreach






echo '<div class="blok-kontent-div">';


if ($raz_valuta->stoimost==0 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-2">';
}

elseif ($raz_valuta->stoimost==0 and $raz_valuta->col==1) {
echo '<div class="otstup-duble-1">';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-3">';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==1) {
echo '<div class="otstup-1">';
}



echo <<<sds
<span><a class="text-name" href="" onclick="obj=this.parentNode.childNodes[1].style; 
tmp=(obj.display!='block') ? 'block' : 'none'; 
obj.display=tmp; 
return false;">
sds;

echo $raz_na->name;



if ($raz_valuta->vote==1){
if ($row->vote_raz==1){
echo '<br>';
$vote_true=0;
foreach ($this->rows_vote as $raz_vote ){
if ($raz_vote->id_tovar == $raz_na->id and $raz_vote->ip == $_SERVER['REMOTE_ADDR']) {
$vote_true=1;
echo '
<input type="button" disabled id="'.$raz_na->id.'vote_knopka_plus" style="height: 20px; width: 20px;" class="vote_knopka_plus" onclick="vote1('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_one_id"  name="vote_total_one" class="text_plus" disabled value="'.$raz_na->plus.'" >
<input type="hidden"  id="'.$raz_na->id.'-vote" value="'.$raz_na->id.'">
<input type="button" disabled id="'.$raz_na->id.'vote_knopka_minus" style="height: 20px; width: 20px;" class="vote_knopka_minus" onclick="vote2('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_two_id" name="vote_total_two" class="text_plus" disabled value="'.$raz_na->minus.'" >';
}
}

if ($vote_true==false) {

echo '
<input type="button" id="'.$raz_na->id.'vote_knopka_plus" style="height: 20px; width: 20px;" class="vote_knopka_plus" onclick="vote1('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_one_id"  name="vote_total_one" class="text_plus" disabled value="'.$raz_na->plus.'" >
<input type="hidden" id="'.$raz_na->id.'-vote" value="'.$raz_na->id.'">
<input type="button" id="'.$raz_na->id.'vote_knopka_minus" style="height: 20px; width: 20px;" class="vote_knopka_minus" onclick="vote2('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_two_id" name="vote_total_two" class="text_plus" disabled value="'.$raz_na->minus.'" >';
}

}}
echo '</a>';




foreach ($this->rows_valuta as $raz_valuta ){
if ($raz_na->opredelenie==0) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" style="width: 55px; color: #01d50b; font-weight:bold;" value="'.$namber_simbol.'" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}
if ($raz_na->opredelenie==1) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" style="width: 55px; color: #01d50b; font-weight:bold;" value="'.$namber_simbol.'" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}
if ($raz_na->opredelenie==2) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}

if ($raz_na->opredelenie==3) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" id="'.$raz_na->id.'-select3" name="'.$raz_na->id.'-select3" style="width: 55px; color: #01d50b; font-weight:bold;" value="0" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';}
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}
echo '<div class="otstup-3">';
}

}






//Проверка что выбрано услуги или товары!? И в зависимости от выбранного выводим либо чек боксы либо текстовое поле
foreach ($this->rows_valuta as $raz_valuta ){
//Вывод чекбокс 
if($raz_na->opredelenie==0){
if ($_REQUEST["xz_".$raz_na->id]==true) {
echo '<input type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'" checked>&nbsp;'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'">&nbsp;'; }
else { echo '<input type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'">&nbsp;';  }
}
}

//Вывод текстового поля
elseif ($raz_na->opredelenie==1){
if ($raz_na->total_tovar==0) {echo '<input type="text" placeholder="0" readonly="" name="xz_'.$raz_na->id.'" style="width: 50px;" value="'.JRequest::getVar('xz_'.$raz_na->id.'').'" id="inp_'.$b.'" onKeyUp=\'calculate(this.value, '.$raz_na->cena.', '.$raz_na->total_tovar.', "bdo_'.$b.'")\'>&nbsp;&nbsp;&nbsp;&nbsp;'; }
else {
echo '
<img src="components/com_priceleafs/images/col1.png" onclick="cols1('.$raz_na->id.')" width="20px">
<img src="components/com_priceleafs/images/col2.png" onclick="cols2('.$raz_na->id.')" width="20px">
<input type="hidden"  id="'.$raz_na->id.'-coltotal" value="'.$raz_na->total_tovar.'">
<input  type="text" placeholder="0"  name="xz_'.$raz_na->id.'" style="width: 50px;" value="'.JRequest::getVar('xz_'.$raz_na->id.'').'" id="'.$raz_na->id.'-col"  onBlur=\'calculate(this.value, '.$raz_na->cena.', '.$raz_na->total_tovar.', "bdo_'.$b.'" , "'.$raz_na->id.'")\'>&nbsp;&nbsp;&nbsp;&nbsp;';
}}






//Вывод радиокнопка
elseif ($raz_na->opredelenie==2){
if ($_REQUEST["xz_".$raz_na->id]==true) {
if ($raz_na->radio1==true) {
$ex=@explode('-', $_POST["xz_".$raz_na->id]);

if ($raz_valuta->stoimost==1) {
$new_string = $ex[2].'&nbsp;'.$ex[0].'&nbsp;'.$ex[1];
}
else {
$new_string = $ex[2];
}

echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$ex[0].'-'.$ex[1].'-'.$ex[2].'" checked>&nbsp;&nbsp;'; 
echo $new_string;
}}


else {
if ($raz_na->total_tovar==0) {
if ($raz_na->radio1==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'-'.$raz_valuta->valuta.'-'.$raz_na->radio1.'" >&nbsp;&nbsp;'.$raz_na->radio1.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
 
 
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena1));
if ($raz_na->radio2==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena1.'-'.$raz_valuta->valuta.'-'.$raz_na->radio2.'">&nbsp;&nbsp;'.$raz_na->radio2.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena2));
if ($raz_na->radio3==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena2.'-'.$raz_valuta->valuta.'-'.$raz_na->radio3.'">&nbsp;&nbsp;'.$raz_na->radio3.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena3));
if ($raz_na->radio4==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena3.'-'.$raz_valuta->valuta.'-'.$raz_na->radio4.'">&nbsp;&nbsp;'.$raz_na->radio4.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena4));
if ($raz_na->radio5==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena4.'-'.$raz_valuta->valuta.'-'.$raz_na->radio5.'">&nbsp;&nbsp;'.$raz_na->radio5.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena5));
if ($raz_na->radio6==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena5.'-'.$raz_valuta->valuta.'-'.$raz_na->radio6.'">&nbsp;&nbsp;'.$raz_na->radio6.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena6));
if ($raz_na->radio7==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena6.'-'.$raz_valuta->valuta.'-'.$raz_na->radio7.'">&nbsp;&nbsp;'.$raz_na->radio7.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena7)); 
if ($raz_na->radio8==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena7.'-'.$raz_valuta->valuta.'-'.$raz_na->radio8.'">&nbsp;&nbsp;'.$raz_na->radio8.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena8));
if ($raz_na->radio9==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena8.'-'.$raz_valuta->valuta.'-'.$raz_na->radio9.'">&nbsp;&nbsp;'.$raz_na->radio9.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena9));
if ($raz_na->radio10==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena9.'-'.$raz_valuta->valuta.'-'.$raz_na->radio10.'">&nbsp;&nbsp;'.$raz_na->radio10.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}

}

else {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
if ($raz_na->radio1==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'-'.$raz_valuta->valuta.'-'.$raz_na->radio1.'" checked>&nbsp;&nbsp;'.$raz_na->radio1.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena1));
if ($raz_na->radio2==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena1.'-'.$raz_valuta->valuta.'-'.$raz_na->radio2.'">&nbsp;&nbsp;'.$raz_na->radio2.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena2));
if ($raz_na->radio3==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena2.'-'.$raz_valuta->valuta.'-'.$raz_na->radio3.'">&nbsp;&nbsp;'.$raz_na->radio3.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena3));
if ($raz_na->radio4==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena3.'-'.$raz_valuta->valuta.'-'.$raz_na->radio4.'">&nbsp;&nbsp;'.$raz_na->radio4.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena4));
if ($raz_na->radio5==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena4.'-'.$raz_valuta->valuta.'-'.$raz_na->radio5.'">&nbsp;&nbsp;'.$raz_na->radio5.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena5));
if ($raz_na->radio6==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena5.'-'.$raz_valuta->valuta.'-'.$raz_na->radio6.'">&nbsp;&nbsp;'.$raz_na->radio6.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena6));
if ($raz_na->radio7==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena6.'-'.$raz_valuta->valuta.'-'.$raz_na->radio7.'">&nbsp;&nbsp;'.$raz_na->radio7.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena7));
if ($raz_na->radio8==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena7.'-'.$raz_valuta->valuta.'-'.$raz_na->radio8.'">&nbsp;&nbsp;'.$raz_na->radio8.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}

//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena8));
if ($raz_na->radio9==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena8.'-'.$raz_valuta->valuta.'-'.$raz_na->radio9.'">&nbsp;&nbsp;'.$raz_na->radio9.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena9));
if ($raz_na->radio10==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena9.'-'.$raz_valuta->valuta.'-'.$raz_na->radio10.'">&nbsp;&nbsp;'.$raz_na->radio10.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}} }
echo "<br>";
}}


//Вывод выпадающий список
elseif ($raz_na->opredelenie==3){
echo '
<select style="width:65px;" onclick="select1('.$raz_na->id.')" name="xz_'.$raz_na->id.'" id="'.$raz_na->id.'-select2">';



if ($_REQUEST["xz_".$raz_na->id]==true) { 
if ($_POST['xz_'.$raz_na->id]==$raz_na->cena) {
echo '<option value="'.$raz_na->cena.'" selected="selected">'.$raz_na->radio1.'</option>';}
else {echo '<option value="'.$raz_na->cena.'">'.$raz_na->radio1.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena1) {
echo '<option value="'.$raz_na->cena1.'" selected="selected">'.$raz_na->radio2.'</option>';}
else {echo '<option value="'.$raz_na->cena1.'">'.$raz_na->radio2.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena2) {
echo '<option value="'.$raz_na->cena2.'" selected="selected">'.$raz_na->radio3.'</option>';}
else {echo '<option value="'.$raz_na->cena2.'">'.$raz_na->radio3.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena3) {
echo '<option value="'.$raz_na->cena3.'" selected="selected">'.$raz_na->radio4.'</option>';}
else {echo '<option value="'.$raz_na->cena3.'">'.$raz_na->radio4.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena4) {
echo '<option value="'.$raz_na->cena4.'" selected="selected">'.$raz_na->radio5.'</option>';}
else {echo '<option value="'.$raz_na->cena4.'">'.$raz_na->radio5.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena5) {
echo '<option value="'.$raz_na->cena5.'" selected="selected">'.$raz_na->radio6.'</option>';}
else {echo '<option value="'.$raz_na->cena5.'">'.$raz_na->radio6.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena6) {
echo '<option value="'.$raz_na->cena6.'" selected="selected">'.$raz_na->radio7.'</option>';}
else {echo '<option value="'.$raz_na->cena6.'">'.$raz_na->radio7.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena7) {
echo '<option value="'.$raz_na->cena7.'" selected="selected">'.$raz_na->radio8.'</option>';}
else {echo '<option value="'.$raz_na->cena7.'">'.$raz_na->radio8.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena8) {
echo '<option value="'.$raz_na->cena8.'" selected="selected">'.$raz_na->radio9.'</option>';}
else {echo '<option value="'.$raz_na->cena8.'">'.$raz_na->radio9.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena9) {
echo '<option value="'.$raz_na->cena9.'" selected="selected">'.$raz_na->radio10.'</option>';}
else {echo '<option value="'.$raz_na->cena9.'">'.$raz_na->radio10.'</option>';}

}

else {
if ($raz_na->radio1==true) { echo '<option value="'.$raz_na->cena.'">'.$raz_na->radio1.'</option>';}
if ($raz_na->radio2==true) { echo '<option value="'.$raz_na->cena1.'">'.$raz_na->radio2.'</option>';}
if ($raz_na->radio3==true) { echo '<option value="'.$raz_na->cena2.'">'.$raz_na->radio3.'</option>';}
if ($raz_na->radio4==true) { echo '<option value="'.$raz_na->cena3.'">'.$raz_na->radio4.'</option>';}
if ($raz_na->radio5==true) { echo '<option value="'.$raz_na->cena4.'">'.$raz_na->radio5.'</option>';}
if ($raz_na->radio6==true) { echo '<option value="'.$raz_na->cena5.'">'.$raz_na->radio6.'</option>';}
if ($raz_na->radio7==true) { echo '<option value="'.$raz_na->cena6.'">'.$raz_na->radio7.'</option>';}
if ($raz_na->radio8==true) { echo '<option value="'.$raz_na->cena7.'">'.$raz_na->radio8.'</option>';}
if ($raz_na->radio9==true) { echo '<option value="'.$raz_na->cena8.'">'.$raz_na->radio9.'</option>';}
if ($raz_na->radio10==true) { echo '<option value="'.$raz_na->cena9.'">'.$raz_na->radio10.'</option>';}
}

echo'</select>
<input type="hidden" id="'.$raz_na->id.'-select4" name="select4" style="width: 50px;" value="'.JRequest::getVar('select4').'" disabled>';


//Ссылка на модальное окно для выбора дополнительных параметров..................................................
if ($raz_valuta->more_options==1) {
echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';
}
else {echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"></div>
<div class="big-link" ><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';}
//.....................................................................................

}


} 

//Таже проверка услуги или товары
foreach ($this->rows_valuta as $raz_valuta ){ 
if($raz_na->opredelenie==0){
echo '';
}
if ($raz_na->opredelenie==1){
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol"><bdo dir="ltr" id="bdo_'.$b.'">0</bdo>&nbsp;'.$raz_valuta->valuta.'</span>';

//Ссылка на модальное окно для выбора дополнительных параметров..................................................
if ($raz_valuta->more_options==1) {
echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';
}
else {echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"></div>
<div class="big-link" ><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';}
//.....................................................................................

}
else {echo '<bdo dir="ltr" style="display:none;" id="bdo_'.$b.'">0</bdo>&nbsp;<span style="display:none;">'.$raz_valuta->valuta.'</span>';}
}}

$b++; 
foreach ($this->rows_valuta as $raz_valuta ) { 

if ($raz_na->pereopredelenie==1) {
echo '</div><div class="otstup-4">'.$raz_na->total_tovar.'</div>';
}
else{
echo '</div><div class="otstup-4">~</div>';
}

if ($raz_valuta->col==1) {
echo '<div class="otstup-4">'.$raz_na->edizm.'</div>';}}
echo '</div><br>';
}}
else{} 
}}
$b++; 

echo '</div>';
echo '<br>';

}}									
echo "</div>";
}}}







//Дубль вывода данных!..............................................
else {
//Опубликован раздел или нет
if($row->state==1){
//Первая ссылка с id
echo "<div class='blok-kontent-div' id=".$row->id.">";


//Выводим данные для каждого раздела в цикле.
echo ''.$row->text.'<br><div id="shapka-left"></div><div id="shapka-center"><div id="otstup-raz"><center>'.$row->name.'</center></div></div><div id="shapka-right"></div>'; 	




	
	
//В зависимости от того товары или услуги проверяем как вывести информационную панель
foreach ($this->rows_valuta as $raz_valuta ){ 
//вывод наименования

if ($raz_valuta->stoimost==0 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-2">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==0 and $raz_valuta->col==1) {
echo '<div class="otstup-duble-1">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-3">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==1) {
echo '<div class="otstup-1">'.JText::_( 'COM_PRICELEAF_NAIMENOWANIE' ).'</div>';
}

//Вывод стоимости
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2">'.JText::_( 'COM_PRICELEAF_STOIMOST' ).'</div>';
}

echo '<div class="otstup-3">'.JText::_( 'COM_PRICELEAF_KOLLIJESTVO' ).'</div><div class="otstup-5">&nbsp;&nbsp;&nbsp;&nbsp;'.JText::_( 'COM_PRICELEAF_DOSTUPNO' ).'</div>';

if ($raz_valuta->col==1) {
echo '<div class="otstup-5">&nbsp;&nbsp;&nbsp;&nbsp;'.JText::_( 'COM_PRICELEAF_EDIZM' ).'</div><br>'; 
}}







//Вывод категорий для разделов
foreach ($this->rows_cat as $raz_cat ) { 

if( $raz_cat->raz_cat ==$row->id) {
if($raz_cat->state==1){

echo <<<sds
<span><a class="text-name" href="" onclick="obj=this.parentNode.childNodes[1].style; 
tmp=(obj.display!='block') ? 'block' : 'none'; 
obj.display=tmp; 
return false;"><div id="cat-left"></div><div id="cat-center"><div id="otstup-cat-open">
sds;
echo $raz_cat->name_cat;
echo '</div></div><div id="cat-right"></div></a>';
//Проверка спойлера как выводить категории свёрнутыми или нет
foreach ($this->rows_valuta as $raz_valuta ){ 
if($raz_valuta->spoiler==0){
echo '<div style="display: none";>';
}
else {echo '<div style="display: block";>';}
}

}
else{echo "<div>";} 






foreach ($this->rows_na as $raz_na ){
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
if($raz_cat->state==1){
if($raz_na->state==1){
$a = $raz_cat->id;
if( $raz_na->cat_naimenovanie ==$a) {
//Тут формируются данные
//Проверка опубликован раздел или нет так как всё в проверку заключить нельзя из за foreach






echo '<div class="blok-kontent-div">';


if ($raz_valuta->stoimost==0 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-2">';
}

elseif ($raz_valuta->stoimost==0 and $raz_valuta->col==1) {
echo '<div class="otstup-duble-1">';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==0) {
echo '<div class="otstup-duble-3">';
}

elseif ($raz_valuta->stoimost==1 and $raz_valuta->col==1) {
echo '<div class="otstup-1">';
}



echo <<<sds
<span><a class="text-name" href="" onclick="obj=this.parentNode.childNodes[1].style; 
tmp=(obj.display!='block') ? 'block' : 'none'; 
obj.display=tmp; 
return false;">
sds;

echo $raz_na->name;




if ($raz_valuta->vote==1){
if ($row->vote_raz==1){
echo '<br>';
$vote_true=0;
foreach ($this->rows_vote as $raz_vote ){
if ($raz_vote->id_tovar == $raz_na->id and $raz_vote->ip == $_SERVER['REMOTE_ADDR']) {
$vote_true=1;
echo '
<input type="button" disabled id="'.$raz_na->id.'vote_knopka_plus" style="height: 20px; width: 20px;" class="vote_knopka_plus" onclick="vote1('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_one_id"  name="vote_total_one" class="text_plus" disabled value="'.$raz_na->plus.'" >
<input type="hidden"  id="'.$raz_na->id.'-vote" value="'.$raz_na->id.'">
<input type="button" disabled id="'.$raz_na->id.'vote_knopka_minus" style="height: 20px; width: 20px;" class="vote_knopka_minus" onclick="vote2('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_two_id" name="vote_total_two" class="text_plus" disabled value="'.$raz_na->minus.'" >';
}
}

if ($vote_true==false) {

echo '
<input type="button" id="'.$raz_na->id.'vote_knopka_plus" style="height: 20px; width: 20px;" class="vote_knopka_plus" onclick="vote1('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_one_id"  name="vote_total_one" class="text_plus" disabled value="'.$raz_na->plus.'" >
<input type="hidden" id="'.$raz_na->id.'-vote" value="'.$raz_na->id.'">
<input type="button" id="'.$raz_na->id.'vote_knopka_minus" style="height: 20px; width: 20px;" class="vote_knopka_minus" onclick="vote2('.$raz_na->id.')"><input type="text" id="'.$raz_na->id.'vote_total_two_id" name="vote_total_two" class="text_plus" disabled value="'.$raz_na->minus.'" >';
}

}}
echo '</a>';




foreach ($this->rows_valuta as $raz_valuta ){
if ($raz_na->opredelenie==0) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" style="width: 55px; color: #01d50b; font-weight:bold;" value="'.$namber_simbol.'" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}
if ($raz_na->opredelenie==1) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" style="width: 55px; color: #01d50b; font-weight:bold;" value="'.$namber_simbol.'" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}
if ($raz_na->opredelenie==2) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><br>';
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}

}
echo '<div class="otstup-3">';
}

if ($raz_na->opredelenie==3) {
echo '<div style="display: none";>'.$raz_na->opisanie.'</div></span></div>';
if ($raz_valuta->stoimost==1) {
echo '<div class="otstup-2"><input type="text" id="'.$raz_na->id.'-select3" name="'.$raz_na->id.'-select3" style="width: 55px; color: #01d50b; font-weight:bold;" value="0" disabled><span class="namber_simbol">'.$raz_valuta->valuta.'
</span><class="cena1"><br>';}
if ($raz_na->old==true) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_old = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->old));
echo '<span class="old">&nbsp;'.$namber_old.' '.$raz_valuta->valuta.'</span></div>';
}
else { echo '</div>';}
echo '<div class="otstup-3">';
}

}






//Проверка что выбрано услуги или товары!? И в зависимости от выбранного выводим либо чек боксы либо текстовое поле
foreach ($this->rows_valuta as $raz_valuta ){
//Вывод чекбокс 
if($raz_na->opredelenie==0){
if ($_REQUEST["xz_".$raz_na->id]==true) {
echo '<input type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'" checked>&nbsp;'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'">&nbsp;'; }
else { echo '<input type="checkbox" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'">&nbsp;'; 

 }
}
}

//Вывод текстового поля
elseif ($raz_na->opredelenie==1){
if ($raz_na->total_tovar==0) {echo '<input type="text" placeholder="0" readonly="" name="xz_'.$raz_na->id.'" style="width: 50px;" value="'.JRequest::getVar('xz_'.$raz_na->id.'').'" id="inp_'.$b.'" onKeyUp=\'calculate(this.value, '.$raz_na->cena.', '.$raz_na->total_tovar.', "bdo_'.$b.'")\'>&nbsp;&nbsp;&nbsp;&nbsp;'; }
else {
echo '
<img src="components/com_priceleafs/images/col1.png" onclick="cols1('.$raz_na->id.')" width="20px">
<img src="components/com_priceleafs/images/col2.png" onclick="cols2('.$raz_na->id.')" width="20px">
<input type="hidden"  id="'.$raz_na->id.'-coltotal" value="'.$raz_na->total_tovar.'">
<input  type="text" placeholder="0" name="xz_'.$raz_na->id.'" style="width: 50px;" value="'.JRequest::getVar('xz_'.$raz_na->id.'').'" id="'.$raz_na->id.'-col"  onBlur=\'calculate(this.value, '.$raz_na->cena.', '.$raz_na->total_tovar.', "bdo_'.$b.'" , "'.$raz_na->id.'")\'>&nbsp;&nbsp;&nbsp;&nbsp;';
}}






//Вывод радиокнопка
elseif ($raz_na->opredelenie==2){
if ($_REQUEST["xz_".$raz_na->id]==true) {
$ex=@explode('-', $_POST["xz_".$raz_na->id]);


if ($ex[0]!=$raz_na->cena) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
if ($raz_na->radio1==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'-'.$raz_valuta->valuta.'-'.$raz_na->radio1.'" checked>&nbsp;&nbsp;'.$raz_na->radio1.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena1) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena1));
if ($raz_na->radio2==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena1.'-'.$raz_valuta->valuta.'-'.$raz_na->radio2.'" checked>&nbsp;&nbsp;'.$raz_na->radio2.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena2) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena2));
if ($raz_na->radio3==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena2.'-'.$raz_valuta->valuta.'-'.$raz_na->radio3.'" checked>&nbsp;&nbsp;'.$raz_na->radio3.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena3) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena3));
if ($raz_na->radio4==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena3.'-'.$raz_valuta->valuta.'-'.$raz_na->radio4.'" checked>&nbsp;&nbsp;'.$raz_na->radio4.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena4) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena4));
if ($raz_na->radio5==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena4.'-'.$raz_valuta->valuta.'-'.$raz_na->radio5.'" checked>&nbsp;&nbsp;'.$raz_na->radio5.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena5) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena5));
if ($raz_na->radio6==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena5.'-'.$raz_valuta->valuta.'-'.$raz_na->radio6.'" checked>&nbsp;&nbsp;'.$raz_na->radio6.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena6) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena6));
if ($raz_na->radio7==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena6.'-'.$raz_valuta->valuta.'-'.$raz_na->radio7.'" checked>&nbsp;&nbsp;'.$raz_na->radio7.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena7) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena7));
if ($raz_na->radio8==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena7.'-'.$raz_valuta->valuta.'-'.$raz_na->radio8.'" checked>&nbsp;&nbsp;'.$raz_na->radio8.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena8) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena8));
if ($raz_na->radio9==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena8.'-'.$raz_valuta->valuta.'-'.$raz_na->radio9.'" checked>&nbsp;&nbsp;'.$raz_na->radio9.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($ex[0]!=$raz_na->cena9) {
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena9));
if ($raz_na->radio10==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena9.'-'.$raz_valuta->valuta.'-'.$raz_na->radio10.'" checked>&nbsp;&nbsp;'.$raz_na->radio10.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
}

if ($raz_na->radio1==true) {
if ($raz_valuta->stoimost==1) {
$new_string = $ex[2].'&nbsp;<span class="namber_simbol">'.$ex[0].'&nbsp;'.$ex[1].'</span><br>';
}
else {
$new_string = '<span class="namber_simbol">'.$ex[2].'</span><br>';
}

echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$ex[0].'-'.$ex[1].'-'.$ex[2].'" checked>&nbsp;&nbsp;'; 
echo $new_string;
}

}




//..............................................




else {
if ($raz_na->total_tovar==0) {
if ($raz_na->radio1==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'-'.$raz_valuta->valuta.'-'.$raz_na->radio1.'" >&nbsp;&nbsp;'.$raz_na->radio1.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}
 
 
//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena1));
if ($raz_na->radio2==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena1.'-'.$raz_valuta->valuta.'-'.$raz_na->radio2.'">&nbsp;&nbsp;'.$raz_na->radio2.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena2)); 
if ($raz_na->radio3==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena2.'-'.$raz_valuta->valuta.'-'.$raz_na->radio3.'">&nbsp;&nbsp;'.$raz_na->radio3.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena3));
if ($raz_na->radio4==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena3.'-'.$raz_valuta->valuta.'-'.$raz_na->radio4.'">&nbsp;&nbsp;'.$raz_na->radio4.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena4));
if ($raz_na->radio5==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena4.'-'.$raz_valuta->valuta.'-'.$raz_na->radio5.'">&nbsp;&nbsp;'.$raz_na->radio5.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena5));
if ($raz_na->radio6==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena5.'-'.$raz_valuta->valuta.'-'.$raz_na->radio6.'">&nbsp;&nbsp;'.$raz_na->radio6.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena6));
if ($raz_na->radio7==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena6.'-'.$raz_valuta->valuta.'-'.$raz_na->radio7.'">&nbsp;&nbsp;'.$raz_na->radio7.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena7));
if ($raz_na->radio8==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena7.'-'.$raz_valuta->valuta.'-'.$raz_na->radio8.'">&nbsp;&nbsp;'.$raz_na->radio8.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena8));
if ($raz_na->radio9==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena8.'-'.$raz_valuta->valuta.'-'.$raz_na->radio9.'">&nbsp;&nbsp;'.$raz_na->radio9.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena9));
if ($raz_na->radio10==true) { echo '<input type="radio" disabled="" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena9.'-'.$raz_valuta->valuta.'-'.$raz_na->radio10.'">&nbsp;&nbsp;'.$raz_na->radio10.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}

}

else {

//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena));
if ($raz_na->radio1==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena.'-'.$raz_valuta->valuta.'-'.$raz_na->radio1.'" checked>&nbsp;&nbsp;'.$raz_na->radio1.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena1));
if ($raz_na->radio2==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena1.'-'.$raz_valuta->valuta.'-'.$raz_na->radio2.'">&nbsp;&nbsp;'.$raz_na->radio2.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena2)); 
if ($raz_na->radio3==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena2.'-'.$raz_valuta->valuta.'-'.$raz_na->radio3.'">&nbsp;&nbsp;'.$raz_na->radio3.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena3)); 
if ($raz_na->radio4==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena3.'-'.$raz_valuta->valuta.'-'.$raz_na->radio4.'">&nbsp;&nbsp;'.$raz_na->radio4.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena4));
if ($raz_na->radio5==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena4.'-'.$raz_valuta->valuta.'-'.$raz_na->radio5.'">&nbsp;&nbsp;'.$raz_na->radio5.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena5));
if ($raz_na->radio6==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena5.'-'.$raz_valuta->valuta.'-'.$raz_na->radio6.'">&nbsp;&nbsp;'.$raz_na->radio6.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena6));
if ($raz_na->radio7==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena6.'-'.$raz_valuta->valuta.'-'.$raz_na->radio7.'">&nbsp;&nbsp;'.$raz_na->radio7.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena7));
if ($raz_na->radio8==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena7.'-'.$raz_valuta->valuta.'-'.$raz_na->radio8.'">&nbsp;&nbsp;'.$raz_na->radio8.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena8));
if ($raz_na->radio9==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena8.'-'.$raz_valuta->valuta.'-'.$raz_na->radio9.'">&nbsp;&nbsp;'.$raz_na->radio9.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}}


//Разбиваем стоимость в читабельную форму скажем не 1000243 а 1 000 243
$namber_simbol = str_replace(',',''.$raz_valuta->simbol.'',number_format($raz_na->cena9));
if ($raz_na->radio10==true) { echo '<input type="radio" name="xz_'.$raz_na->id.'" value="'.$raz_na->cena9.'-'.$raz_valuta->valuta.'-'.$raz_na->radio10.'">&nbsp;&nbsp;'.$raz_na->radio10.'&nbsp;&nbsp;';
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol">'.$namber_simbol.'&nbsp;&nbsp;'.$cenaradio.'</span><br>'; }
else {echo '<br>';}} }}}


//Вывод выпадающий список
elseif ($raz_na->opredelenie==3){
echo '
<select style="width:65px;" onclick="select1('.$raz_na->id.')" name="xz_'.$raz_na->id.'" id="'.$raz_na->id.'-select2">';



if ($_REQUEST["xz_".$raz_na->id]==true) { 
if ($_POST['xz_'.$raz_na->id]==$raz_na->cena) {
echo '<option value="'.$raz_na->cena.'" selected="selected">'.$raz_na->radio1.'</option>';}
else {echo '<option value="'.$raz_na->cena.'">'.$raz_na->radio1.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena1) {
echo '<option value="'.$raz_na->cena1.'" selected="selected">'.$raz_na->radio2.'</option>';}
else {echo '<option value="'.$raz_na->cena1.'">'.$raz_na->radio2.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena2) {
echo '<option value="'.$raz_na->cena2.'" selected="selected">'.$raz_na->radio3.'</option>';}
else {echo '<option value="'.$raz_na->cena2.'">'.$raz_na->radio3.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena3) {
echo '<option value="'.$raz_na->cena3.'" selected="selected">'.$raz_na->radio4.'</option>';}
else {echo '<option value="'.$raz_na->cena3.'">'.$raz_na->radio4.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena4) {
echo '<option value="'.$raz_na->cena4.'" selected="selected">'.$raz_na->radio5.'</option>';}
else {echo '<option value="'.$raz_na->cena4.'">'.$raz_na->radio5.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena5) {
echo '<option value="'.$raz_na->cena5.'" selected="selected">'.$raz_na->radio6.'</option>';}
else {echo '<option value="'.$raz_na->cena5.'">'.$raz_na->radio6.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena6) {
echo '<option value="'.$raz_na->cena6.'" selected="selected">'.$raz_na->radio7.'</option>';}
else {echo '<option value="'.$raz_na->cena6.'">'.$raz_na->radio7.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena7) {
echo '<option value="'.$raz_na->cena7.'" selected="selected">'.$raz_na->radio8.'</option>';}
else {echo '<option value="'.$raz_na->cena7.'">'.$raz_na->radio8.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena8) {
echo '<option value="'.$raz_na->cena8.'" selected="selected">'.$raz_na->radio9.'</option>';}
else {echo '<option value="'.$raz_na->cena8.'">'.$raz_na->radio9.'</option>';}

if ($_POST['xz_'.$raz_na->id]==$raz_na->cena9) {
echo '<option value="'.$raz_na->cena9.'" selected="selected">'.$raz_na->radio10.'</option>';}
else {echo '<option value="'.$raz_na->cena9.'">'.$raz_na->radio10.'</option>';}

}

else {
if ($raz_na->radio1==true) { echo '<option value="'.$raz_na->cena.'">'.$raz_na->radio1.'</option>';}
if ($raz_na->radio2==true) { echo '<option value="'.$raz_na->cena1.'">'.$raz_na->radio2.'</option>';}
if ($raz_na->radio3==true) { echo '<option value="'.$raz_na->cena2.'">'.$raz_na->radio3.'</option>';}
if ($raz_na->radio4==true) { echo '<option value="'.$raz_na->cena3.'">'.$raz_na->radio4.'</option>';}
if ($raz_na->radio5==true) { echo '<option value="'.$raz_na->cena4.'">'.$raz_na->radio5.'</option>';}
if ($raz_na->radio6==true) { echo '<option value="'.$raz_na->cena5.'">'.$raz_na->radio6.'</option>';}
if ($raz_na->radio7==true) { echo '<option value="'.$raz_na->cena6.'">'.$raz_na->radio7.'</option>';}
if ($raz_na->radio8==true) { echo '<option value="'.$raz_na->cena7.'">'.$raz_na->radio8.'</option>';}
if ($raz_na->radio9==true) { echo '<option value="'.$raz_na->cena8.'">'.$raz_na->radio9.'</option>';}
if ($raz_na->radio10==true) { echo '<option value="'.$raz_na->cena9.'">'.$raz_na->radio10.'</option>';}
}

echo'</select>
<input type="hidden" id="'.$raz_na->id.'-select4" name="select4" style="width: 50px;" value="'.JRequest::getVar('select4').'" disabled>';


//Ссылка на модальное окно для выбора дополнительных параметров..................................................
if ($raz_valuta->more_options==1) {
echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';
}
else {echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"></div>
<div class="big-link" ><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';}
//.....................................................................................

}
} 

//Таже проверка услуги или товары
foreach ($this->rows_valuta as $raz_valuta ){ 
if($raz_na->opredelenie==0){
echo '';
}
if ($raz_na->opredelenie==1){
if ($raz_valuta->stoimost==1) {
echo '<span class="namber_simbol"><bdo dir="ltr" id="bdo_'.$b.'">0</bdo>&nbsp;'.$raz_valuta->valuta.'</span>';


//Ссылка на модальное окно для выбора дополнительных параметров..................................................
if ($raz_valuta->more_options==1) {
echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';
}
else {echo '<br>
<div class="big-link" id="big-link'.$raz_na->id.'"></div>
<div class="big-link" ><a href="#"  data-reveal-id="myModal'.$b.'" data-animation="fade">Больше параметров</a></div>
<div id="myModal'.$b.'" class="reveal-modal">';


if ($raz_na->optional_field1==true) {
if ($_REQUEST["optional_field1".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'" checked>&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field1'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;'.$raz_na->optional_description1.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">&nbsp;<span class="text-name">'.$raz_na->optional_description1.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field1.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_a'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field2==true) {
if ($_REQUEST["optional_field2".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'" checked>&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field2'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;'.$raz_na->optional_description2.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field2'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field2.'">&nbsp;<span class="text-name">'.$raz_na->optional_description2.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field2.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_b'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field3==true) {
if ($_REQUEST["optional_field3".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'" checked>&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field3'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;'.$raz_na->optional_description3.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field3'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field3.'">&nbsp;<span class="text-name">'.$raz_na->optional_description3.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field3.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_c'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field4==true) {
if ($_REQUEST["optional_field4".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'" checked>&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field4'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;'.$raz_na->optional_description4.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field4'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field4.'">&nbsp;<span class="text-name">'.$raz_na->optional_description4.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field4.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_d'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field5==true) {
if ($_REQUEST["optional_field5".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'" checked>&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field5'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;'.$raz_na->optional_description5.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field5'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field5.'">&nbsp;<span class="text-name">'.$raz_na->optional_description5.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field5.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_e'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field6==true) {
if ($_REQUEST["optional_field6".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'" checked>&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field6'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;'.$raz_na->optional_description6.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field6'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field6.'">&nbsp;<span class="text-name">'.$raz_na->optional_description6.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field6.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_f'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field7==true) {
if ($_REQUEST["optional_field7".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'" checked>&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field7'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;'.$raz_na->optional_description7.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field7'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field7.'">&nbsp;<span class="text-name">'.$raz_na->optional_description7.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field7.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_g'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field8==true) {
if ($_REQUEST["optional_field8".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'" checked>&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field8'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;'.$raz_na->optional_description8.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field8'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field8.'">&nbsp;<span class="text-name">'.$raz_na->optional_description8.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field8.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_h'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field9==true) {
if ($_REQUEST["optional_field9".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'" checked>&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field9'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;'.$raz_na->optional_description9.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field9'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field9.'">&nbsp;<span class="text-name">'.$raz_na->optional_description9.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field9.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_i'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}

if ($raz_na->optional_field10==true) {
if ($_REQUEST["optional_field10".$raz_na->id]==true) {
echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'" checked>&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; 
}
else {
if ($raz_na->total_tovar==0) {echo '<input disabled="" type="checkbox" name="optional_field10'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;'.$raz_na->optional_description10.'&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>'; }
else { echo '<input type="checkbox" name="optional_field10'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field10.'">&nbsp;<span class="text-name">'.$raz_na->optional_description10.'</span>&nbsp;<span class="namber_simbol">'.$raz_na->optional_field10.'&nbsp;'.$raz_valuta->valuta.'</span><br>';  }
}}
else {echo '<input type="checkbox" class="big-link" name="optional_field1'.$raz_na->id.'" id="optional_j'.$raz_na->id.'" value="'.$raz_na->optional_field1.'">';}


echo '<a class="close-reveal-modal">&#215;</a>
</div>
';}
//.....................................................................................


}
else {echo '<bdo dir="ltr" style="display:none;" id="bdo_'.$b.'">0</bdo>&nbsp;<span style="display:none;">'.$raz_valuta->valuta.'</span>';}
}}

$b++; 
foreach ($this->rows_valuta as $raz_valuta ) { 

if ($raz_na->pereopredelenie==1) {
echo '</div><div class="otstup-4">'.$raz_na->total_tovar.'</div>';
}
else{
echo '</div><div class="otstup-4">~</div>';
}

if ($raz_valuta->col==1) {
echo '<div class="otstup-4">'.$raz_na->edizm.'</div>';}}
echo '</div><br>';
}}
else{} 
}}
$b++; 

echo '</div>';
echo '<br>';

}}									
echo "</div>";
}
}








}}
echo "</div></div>";
}









?>
</td>
</tr>
</table>









<!--Таблица с конечной стоимостью-->
<center>
<table align="center">
<tr class="td_not_border"><td class="td_not_border" align="center">


<?php
//Проверка услуг товаров для вывода общей стоимости
//Вывод суммы которая складывается в одну общую.

foreach ($this->rows_valuta as $raz_valuta ) { 

if ($raz_valuta->total_sum==0) {
echo '<div class="summa-left"></div>
<div class="summa-left1" style="color: #993300;font-weight:bold; padding-top:5px; font-size:14px"><b>'.JText::_( 'COM_PRICELEAF_SUMMA' ).'&nbsp;&nbsp;</b></div>';
echo'
<input id="total_price" readonly="" type="hidden" name="save1" value="'.JRequest::getVar('save1').'">
<input id="total_sum" readonly="" type="hidden" name="save2" value="'.JRequest::getVar('save2').'">
<input id="total_select" readonly=""  type="hidden" name="save6" value="'.JRequest::getVar('save6').'">
<div class="summa-left1" style="color: #993300;padding-top:5px;font-weight:bold; font-size:14px">
<input id="total_priceobshee" readonly="" style="width: 100px;" type="text" name="save4" value="'.JRequest::getVar('save4').'"></div>
<div class="summa-left1" style="color: #000000;padding-top:5px;font-weight:bold; font-size:14px">&nbsp;&nbsp;';


echo $raz_valuta->valuta.'</div> <div class="summa-left2"></div>';
}
else {
echo'
<input id="total_price" readonly=""  type="hidden" name="save1" value="'.JRequest::getVar('save1').'">
<input id="total_sum" readonly=""  type="hidden" name="save2" value="'.JRequest::getVar('save2').'">
<input id="total_priceobshee" readonly=""  type="hidden" name="save4" value="'.JRequest::getVar('save4').'">
<input id="total_select" readonly=""  type="hidden" name="save6" value="'.JRequest::getVar('save6').'">';
}}
?>
</td>
</tr>
</table>


<?php foreach ($this->rows_valuta as $raz_valuta ) {
if($raz_valuta->forma==0){$forma='style="display:none;"';}
else {}}
?>



<!--Выводим уведомление о скидках-->
<font color="#ff0000" <?php echo $forma; ?>>
<?php foreach ($this->rows_valuta as $raz_valuta ) {
if($raz_valuta->percent==1){
echo $raz_valuta->percent_order,$raz_valuta->percent_number,'%';
}

//А тут заносим в переменную данные для скрытия капчи
if($raz_valuta->captcha==1) {
$captcha_status=1;
}
} ?> 
</font>



<!--Форма заполнения данных заказчика-->



<table align="center" <?php echo $forma; ?> >
<tr class="td_not_border">
<td class="td_not_border">
<br><br>
<p class="mail-zakaz"><?php echo JText::_( 'COM_PRICELEAF_MAIL_ZAKAZ' ); ?><p> 
<font color="#ff0000">*</font> <?php echo JText::_( 'COM_PRICELEAF_NAME' ); ?><br /> 
<input  class="inputbox required" type="text" name="name" value="<?php echo $name = JRequest::getVar('name'); ?>" size="40" ><br />

<font color="#ff0000">*</font> E-mail:<br />
<input class="inputbox required validate-email"  type="text" name="pojta" value="<?php echo $pojta = JRequest::getVar('pojta'); ?>" size="40" ><br />
 
<font color="#ff0000">*</font> <?php echo JText::_( 'COM_PRICELEAF_PHONE' ); ?><br /> 
<input class="inputbox required validate-numeric"  type="text" name="tel" value="<?php echo $tel = JRequest::getVar('tel'); ?>" size="40" ><br />

<?php echo JText::_( 'COM_PRICELEAF_MESSAGE' ); ?><br /> 
<textarea name="mess" rows="10" cols="40"><?php echo $mess = JRequest::getVar('mess'); ?></textarea><br /><br>

<?php echo JText::_( 'COM_PRICELEAF_EMAIL' ); ?><br>
<select name = "copiy">
  <option value = "1"><?php echo JText::_( 'COM_PRICELEAF_YES' ); ?>
  <option value = "0"><?php echo JText::_( 'COM_PRICELEAF_NO' ); ?>
</select>
<br>

<?php
if ($payment_state_duble==true) {
echo'
<font color="#ff0000">*</font>'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS' ).'<br /> 
<select style="width: 120px" name="oplata" >
<option value="'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_OPLATA' ).'">'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_OPLATA' ).'</option>
<option value="'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_VIVOZ' ).'">'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_VIVOZ' ).'</option>
<option value="'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_ZERO' ).'">'.JText::_( 'COM_PRICELEAF_GOLDEN_STATUS_ZERO' ).'</option>
</select><br />
';
}
?>

<!--Это скрытая форма куда передаётся общая сумма заказа, которая потом извлекается и отправляется в письме
это то действие которое присваивает value значение document.getElementById("total_prie").value=total;
-->
<?php

echo '<input id="total_priceobsheemail" readonly="" style="width: 100px;" type="hidden" name="save3" value="'.JRequest::getVar('save3').'">';
?>

</td>
</tr>
</table>



<?php
//выводим сообщение о том что ни один пункт товаров не выбран.
echo '<input type="hidden" id="textcaptcha_otpravit" value="'.JText::_( 'COM_PRICELEAF_CAPTCHA_OTPRAVIT' ).'">';

if ($captcha_status==1) {
echo '
<body onLoad="captcha();">
<br><input type="hidden" id="textcaptcha" value="'.JText::_( 'COM_PRICELEAF_OTPRAVIT' ).'">
<input type="hidden" id="textcaptchaerror" value="'.JText::_( 'COM_PRICELEAF_CAPTCHA' ).'">
<input type="hidden" id="uvedomlenie" value="'. JText::_( 'COM_PRICELEAF_ERROR_NOT_CAPTCHA' ).'>">
<tr>
<td>
<canvas id="captcha" '.$forma.' width="140" height="35" onClick="captcha();"></canvas>
</td>
</tr>
<tr>
<td>
<form>
<br><input type="text" id="cap" size="12"'.$forma.'><br>
<input type="button" '.$forma.' value="'.JText::_( 'COM_PRICELEAF_ERROR_NOT_CAPTCHA' ).'" onClick="check_captcha();">
</form>
</td>
</tr>
<tr>
<td>
<span id="message"></span>
</td>
</tr>
</body>
';
}
else {
echo '<input type="submit"  value="'.JText::_( 'COM_PRICELEAF_OTPRAVIT' ).'" id="submit_textr" onclick="submit_text(1)" name="submit">';
}

?>


<br>
<font color="#ff0000" <?php echo $forma; ?>>* <?php echo JText::_( 'COM_PRICELEAF_MARKED_FIELDS' ); ?></font>

<br>
<a href="http://joomla-umnik.ru">Priceleaf</a></center>





<!--Имитация нажатия на id="name" что бы посчитать сразу стоимость. И скрытые поля информации-->
<script type='text/javascript'>
$('#cap').click();
</script>







<input type="hidden" id="textcounting" value="<?php echo JText::_( 'COM_PRICELEAF_COUNT' ); ?>">
<input type="hidden" id="textcounting_two" value="<?php echo JText::_( 'COM_PRICELEAF_CON' ); ?>">
<input type="hidden" id="textcounting_three" value="<?php echo JText::_( 'COM_PRICELEAF_CON_THREE' ); ?>">
</form>





</div> 
<div class="b5"><b></b></div><div class="b4"><b></b></div><div class="b3"><b><i></i></b></div> 
<div class="b2"><b><i><q></q></i></b></div><div class="b1"><b></b></div> 
</div>