<!--Priceleaf pro (c1) компонент онлайн калькулятор.Версия pro (c1) 2012.11.07Автор ВаняCopyright (C) 2012 joomla-umnikОфициальный сайт http://joomla-umnik.ru--><?php/*Это соновной шаблон главной страницы. Он зазбит на 3 части шапка, контент, и футер*/// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.defined('_JEXEC') or die('Restricted Access'); // Загрузка подсказокJHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');JHtml::_('behavior.tooltip');JHtml::_('script','system/multiselect.js', false, true);$listOrder	= $this->escape($this->state->get('list.ordering'));$listDirn	= $this->escape($this->state->get('list.direction'));?><form action="<?php echo JRoute::_('index.php?option=com_priceleaf&view=options'); ?>" method="post" name="adminForm"><table class="adminlist">	<thead>	<tr>	<th width="5">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_ID', 'a.id', $listDirn, $listOrder); ?>	</th>	<th width="20">	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />	</th>				<th>	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_VALUTA', 'a.valuta', $listDirn, $listOrder); ?>	</th>	<th width="10%">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>	<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'options.saveorder'); ?>	</th>	<th>	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_PUBLISHED', 'a.published', $listDirn, $listOrder); ?>	</th>	</tr>	</thead>	<tfoot>	<tr>	<td colspan="10">	<?php echo $this->pagination->getListFooter(); ?>	</td>	</tr>	</tfoot>			<tbody>	<!--Запускаем цикл кторый выведет данные на странице-->	<?php foreach ($this->items as $i => $item) :?>	<tr class="row<?php echo $i % 2; ?>">	<!--Выводим id записей-->	<td>	<?php echo $item->id; ?>	</td>	<td>	<?php echo JHtml::_('grid.id', $i, $item->id); ?>	</td>	<!--Заключаем название в ссылку, и присваиваем названию id что бы при нажатии подгрузилась именно эта запись-->	<td>	<a href="<?php echo JRoute::_('index.php?option=com_priceleaf&task=option.edit&id=' . $item->id); ?>"><?php echo $item->valuta; ?></a>	</td>	<!--Параметры сортировки данных-->	<td align="center">	<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />	</td>	<!--Параметры публикации-->	<td align="center">	<?php echo JHtml::_('jgrid.published', $item->published, $i, 'options.', true, 'cb', null, null); ?>	</td>	</tr>	<?php endforeach; ?>	</tbody></table><div>	<!--Скрытые поля для выбора чек боксов-->	<input type="hidden" name="task" value="" />	<input type="hidden" name="boxchecked" value="0" />	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />	<?php echo JHtml::_('form.token'); ?></div></form>