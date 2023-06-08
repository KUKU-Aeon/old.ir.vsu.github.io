<?php
/*
Шаблон это вывод данных которые сформированы через модель и вид.
Здесь выводится через цикл. так должно быть echo $row->id; 
а не echo $this->id; id это просто то значение которо нужно
вывести оно может быть любым в зависимости как называются ваши поля в таблице.
Ну и естественно свои классы в joomla для оформления страницы.
*/
//защита от прямого доступа, и параметры для удаления заказов

//Пользовательские данные
$user =& JFactory::getUser();

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_priceleafs.category');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_priceleafs&task=status.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'priceleafshopList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>




<script type="text/javascript">
//Скрипт для выбора чек боксов, что бы после удалить выбранные заказы.
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>




<!--Подключаем css-->
<link rel="stylesheet" type="text/css" href="components/com_priceleafs/css/priceleaf.css">

<!--При удалении заказа пользователем нужно обратно приплюсовать количество товаров-->
<?php 
//Если нажата кнопка отправить выполняем скрипт удаления и обновления количества товаров
if($_POST['submit']) {
//Создаём дополнительную форму через которую и произойдёт удаление товара, сюда мы поместим методом POST данные которые выбрал пользователь
echo "<form action='index.php?option=com_priceleafs&view=status' method='post' name='adminForm' id='adminForm'>";
//Ставим параметры 1 для меременных, которые будем увеличивать на +1
$cid_one=1;

//Поместим почту администратора для уведомления об удалении заказа.
foreach ($this->rows_op as $raz_op) {
$mailDelitzakaz=$raz_op->mail;
}


foreach ($this->rows as $row ) {
//Если выбран чек бокс для удаления проверяем его и к cid добавляем переменную cid_one
if ($_POST['cid'.$cid_one]==true) {
//Помещаем дополнительный чек бокс именно он и будет удалять товар, так как в первой форме псевдо чек бокс его мы лишь проверяем
$ColDeliteid .='<input id="cb'.$row->id.'" style="display:none;" type="checkbox" onclick="Joomla.isChecked(this.checked);" value="'.$row->id.'" name="cid[]" checked><br>';


	$ex=@explode('-', $row->col);
	$exid=@explode('-', $row->col_id);
	$num = count($ex);
	for ($i=0; $i < $num; $i++) {
	$db = JFactory::getDBO();
	//А тут обновляем данные проверив совпадает id с выбранным товаром или нет.
	$query = 'UPDATE #__priceleaf_na SET total_tovar=total_tovar+"'.$ex[$i].'" WHERE id="'.$exid[$i].'"';
	$db->setQuery($query);
	$db->query();
	}


//Отправляем уведомление об удалёных заказах.	
$body = JText::_( 'COM_PRICELEAF_MAIL_DELITE' ).' '.$user->name.' '.JText::_( 'COM_PRICELEAF_MAIL_DELITE_ZAKAZ' ).$row->id.' '.$row->date;
$to = $mailDelitzakaz;
$subject = 'Priceleaf';
$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
// функция, которая отправляет наше письмо. 
mail($to, $subject, $body, $headers); 	

}
else {	
//Чек бокс пишем ещё раз cid иначе если его не вывести товары удалятся не в правильном порядке
$ColDeliteid .='<input id="cb'.$row->id.'" style="display:none;" type="checkbox" onclick="Joomla.isChecked(this.checked);" value="'.$row->id.'" name="cid[]"><br>';
}

$cid_one++;
}
echo $ColDeliteid;
//Вывод скрытых полей для удаления заказов
echo "<input type='submit' id='subbmitclick' class='skritieknopki' value='".JText::_( 'COM_PRICELEAF_DELETE' )."' name='adminForm'>
<input type='hidden' name='task'       value = 'status.delete' />
<input type='hidden' name='option'	   value='com_priceleafs' />
<input type='hidden' name='id'         value='".$this->hello->id."' />
<input type='hidden' name='view'       value='status' />
<input type='hidden' name='check'      value='' />
<input type='hidden' name='boxchecked' value='0' />
<input type='hidden' name='filter_order' value='".$listOrder."' />
<input type='hidden' name='filter_order_Dir' value='".$listDirn."' /></form>";
//Имитируем нажатие кнопки иначе ничего не удалится
echo '<script type="text/javascript">$("subbmitclick").click(); </script>';
}
?>



<div id="v1"> 
<div class="b1"><b></b></div><div class="b2"><b><i><q></q></i></b></div> 
<div class="b3"><b><i></i></b></div><div class="b4"><b></b></div><div class="b5"><b></b></div> 
<div class="text"> 

<form action="<?php echo JRoute::_('index.php?option=com_priceleafs&view=status'); ?>" method="post">

<?php 

foreach ($this->rows_op as $raz_op) {
//Вытаскиваем разделительный символ
$delit_simbol=$raz_op->simbol;
}


//Вывод навигации для возврата на главную страницу
echo "<div class='menu1'><br id='tab1'/>";
echo '<a href="index.php?option=com_priceleafs&view=priceleafs"><b>'.JText::_( 'COM_PRICELEAF_HOME' ).'</b></a></div><br><br><br>'; 
echo JText::_( 'COM_PRICELEAF_OPISANIE' ).'<br>';
?>

<table class="table-oformlenie">
<tr>
<td>

<tr class="color-tovary">
<td class="td-tovar" width="20%">
<?php echo JText::_( 'COM_PRICELEAF_NAMBER_ZAKAZ' ); ?>
</td>
<td class="td-tovar" width="20%">
<?php echo JText::_( 'COM_PRICELEAF_DATA' ); ?>
</td>

<td class="td-tovar" width="20%">
<?php echo JText::_( 'COM_PRICELEAF_STATUS' ); ?>
</td>

<td class="td-tovar" width="20%">
<?php echo JText::_( 'COM_PRICELEAF_DELETE' ); ?>
</td>
</tr>


<?php 
$cid_one=1;
$b=1;
$user =& JFactory::getUser();
foreach ($this->rows as $row ) {
if ($row->id_user==$user->id) { 


$extire=1;
echo '<tr class="color-tovaryone">
<td class="td-tovar" width="20%">'.$row->id.'</td>

<td class="td-tovar" width="20%">'.$row->date.'</td>';


if($row->state==0) {echo "<td class='td-tovar' width='20%'>".JText::_( 'COM_PRICELEAF_STATUS' )."&nbsp;&nbsp;<img src='/administrator/templates/hathor/images/menu/icon-16-checkin.png' title='".JText::_( 'COM_PRICELEAF_OBRABOTAN' )."'></td>";}
else {echo "<td class='td-tovar' width='20%'>".JText::_( 'COM_PRICELEAF_STATUS' )."&nbsp;&nbsp;<img src='/administrator/templates/hathor/images/menu/icon-16-delete.png' title='".JText::_( 'COM_PRICELEAF_NOOBRABOTAN' )."'></td>";}


if ($row->state==1) {echo $delete ='<td class="td-tovar" width="20%"><input id="cb'.$row->id.'" type="checkbox" onclick="Joomla.isChecked(this.checked);" value="'.$row->id.'" name="cid'.$cid_one.'"></td>';} else { echo $delete ='<td></td>';}


echo '</tr><tr><td>';

echo $row->zapisvbd;

if ($row->oplata==true) {
//Удаляем разделительные символы
$replase = str_replace( $delit_simbol, "", $row->cenahidden); 

echo '<form method="post" action="https://merchant.w1.ru/checkout/default.aspx" accept-charset="UTF-8">
  </form>
<form method="post" action="https://merchant.w1.ru/checkout/default.aspx" accept-charset="UTF-8">
  <input type="hidden" name="WMI_MERCHANT_ID"    value="'.$row->merchant_id.'"/>
  <input type="hidden" name="WMI_PAYMENT_AMOUNT" value="'.$replase.'"/>
  <input type="hidden" name="WMI_CURRENCY_ID"    value="'.$row->currency_id.'"/>
  <input type="hidden" name="WMI_DESCRIPTION"    value="'.$row->description.'"/>
  <input type="hidden" name="WMI_SUCCESS_URL"    value="'.$row->success_url.'"/>
  <input type="hidden" name="WMI_FAIL_URL"       value="'.$row->fail_url.'"/>
  <div class="line-style"><input type="submit" style="float:right;" value="'.JText::_( 'COM_PRICELEAF_PAYMENT' ).'" /></div>
  </form>';}

echo '</td></tr>';

$cid_one++;
}

else {
echo '<input id="cb'.$row->id.'" style="display:none;" type="checkbox" onclick="Joomla.isChecked(this.checked);" value="'.$row->id.'" name="cid'.$cid_one.'">';
$cid_one++;
}

}

?>


</td>
</tr>
</table>


<br><br>

<input type="submit" value="<?php echo JText::_( 'COM_PRICELEAF_DELETE' ); ?>" name="submit">


<?php echo JHtml::_('form.token'); ?>
</form>


</div> 
<div class="b5"><b></b></div><div class="b4"><b></b></div><div class="b3"><b><i></i></b></div> 
<div class="b2"><b><i><q></q></i></b></div><div class="b1"><b></b></div> 
</div>