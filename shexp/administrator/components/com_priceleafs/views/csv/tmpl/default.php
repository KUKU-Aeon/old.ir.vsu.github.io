<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

?>
<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		
		<div class="clearfix"> </div>

<form action="index.php" method="post" name="adminForm" id="adminForm">

<center>
<table width="500px" class="admintable" align="left">
<tr>
<td class="key"><center>
<?php

// Каталог, в который мы будем принимать файл:
$uploaddir = '../images/';
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

// Копируем файл из каталога для временного хранения файлов:
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
echo "<h3>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS' )."</h3>";
}
else { echo "<h3>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_ERROR' )."</h3>"; }

// Выводим информацию о загруженном файле:
echo "<h3>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_FILE' )."</h3>";
echo "<p><b>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_NAME' ).$_FILES['uploadfile']['name']."</b></p>";
echo "<p><b>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_TIPE' ).$_FILES['uploadfile']['type']."</b></p>";
echo "<p><b>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_SIZE' ).$_FILES['uploadfile']['size']."</b></p>";
echo "<p><b>".JText::_( 'COM_PRICELEAF_CSV_IMPORT_DETALIS_IMPORT' ).$_FILES['uploadfile']['tmp_name']."</b></p>";
echo "<p><a style='color:green;' href='index.php?option=com_priceleafs&view=priceleafs'>Вернуться на главную</a></p>";

$adres="../images/";

if(!$handle = fopen($adres.$_FILES['uploadfile']['name'], "r"))
{
     print 'Could not open file!!!';
     die;
}else{
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
mysql_query("REPLACE INTO `".$_POST['prefix']."_priceleaf_na` (`id`, `cat_naimenovanie`, `name`, `opisanie`, `cena`, `cena1`, `cena2`, `cena3`, `cena4`, `cena5`, `cena6`, `cena7`, `cena8`, `cena9`, `radio1`, `radio2`, `radio3`, `radio4`, `radio5`, `radio6`, `radio7`, `radio8`, `radio9`, `radio10`, `optional_field1`, `optional_field2`, `optional_field3`, `optional_field4`, `optional_field5`, `optional_field6`, `optional_field7`, `optional_field8`, `optional_field9`, `optional_field10`, `optional_description1`, `optional_description2`, `optional_description3`, `optional_description4`, `optional_description5`, `optional_description6`, `optional_description7`, `optional_description8`, `optional_description9`, `optional_description10`, `state`, `ordering`, `opredelenie`, `edizm`, `total_tovar`, `pereopredelenie`, `old`, `minus`, `plus`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]', '$data[14]', '$data[15]', '$data[16]', '$data[17]', '$data[18]', '$data[19]', '$data[20]', '$data[21]', '$data[22]', '$data[23]', '$data[24]', '$data[25]', '$data[26]', '$data[27]', '$data[28]', '$data[29]', '$data[30]', '$data[31]', '$data[32]', '$data[33]', '$data[34]', '$data[35]', '$data[36]', '$data[37]', '$data[38]', '$data[39]', '$data[40]', '$data[41]', '$data[42]', '$data[43]', '$data[44]', '$data[45]', '$data[46]', '$data[47]', '$data[48]', '$data[49]', '$data[50]', '$data[51]', '$data[52]');");
}
fclose($handle);

?></center>
</td>
</tr>
</table>
</center>

<div>
	<!--Скрытые поля для выбора чек боксов-->
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>