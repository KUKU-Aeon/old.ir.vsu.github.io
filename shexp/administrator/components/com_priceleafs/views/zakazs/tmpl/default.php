<!--Priceleaf pro (c1) компонент онлайн калькулятор.Версия pro (c1) 2012.11.07Автор ВаняCopyright (C) 2012 joomla-umnikОфициальный сайт http://joomla-umnik.ru--><?php/*Это соновной шаблон главной страницы. Он зазбит на 3 части шапка, контент, и футер*/// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.defined('_JEXEC') or die;JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');JHtml::_('bootstrap.tooltip');JHtml::_('behavior.multiselect');JHtml::_('formbehavior.chosen', 'select');$user		= JFactory::getUser();$userId		= $user->get('id');$listOrder	= $this->escape($this->state->get('list.ordering'));$listDirn	= $this->escape($this->state->get('list.direction'));$canOrder	= $user->authorise('core.edit.state', 'com_priceleafs.category');$saveOrder	= $listOrder == 'a.ordering';if ($saveOrder){	$saveOrderingUrl = 'index.php?option=com_priceleafs&task=zakazs.saveOrderAjax&tmpl=component';	JHtml::_('sortablelist.sortable', 'priceleafList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);}$sortFields = $this->getSortFields();?><!----><script type="text/javascript">	Joomla.orderTable = function() {		table = document.getElementById("sortTable");		direction = document.getElementById("directionTable");		order = table.options[table.selectedIndex].value;		if (order != '<?php echo $listOrder; ?>') {			dirn = 'asc';		} else {			dirn = direction.options[direction.selectedIndex].value;		}		Joomla.tableOrdering(order, dirn, '');	}</script><form action="<?php echo JRoute::_('index.php?option=com_priceleafs&view=zakazs'); ?>" method="post" name="adminForm" id="adminForm"><?php if(!empty( $this->sidebar)): ?>	<div id="j-sidebar-container" class="span2">		<?php echo $this->sidebar; ?>	</div>	<div id="j-main-container" class="span10"><?php else : ?>	<div id="j-main-container"><?php endif;?>		<div id="filter-bar" class="btn-toolbar">			<div class="filter-search btn-group pull-left">				<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_PRICELEAF_SEARCH_IN_TITLE');?></label>				<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('COM_PRICELEAF_SEARCH_IN_TITLE'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_PRICELEAF_SEARCH_IN_TITLE'); ?>" />			</div>			<div class="btn-group pull-left">				<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>				<button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>			</div>			<div class="btn-group pull-right hidden-phone">				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>				<?php echo $this->pagination->getLimitBox(); ?>			</div>			<div class="btn-group pull-right hidden-phone">				<label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC');?></label>				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>					<option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?></option>					<option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?></option>				</select>			</div>			<div class="btn-group pull-right">				<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY');?></label>				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>					<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>				</select>			</div>		</div>		<div class="clearfix"> </div>		<table class="table table-striped" id="priceleafList">			<thead>	<tr>	<th width="10%">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_NAMBERZAKAZ', 'a.id', $listDirn, $listOrder); ?>	</th>	<th width="1%" class="hidden-phone">	<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />	</th>			<th width="10%">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_POJTA', 'a.pojta', $listDirn, $listOrder); ?>	</th>	<th width="10%">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_DATE', 'a.date', $listDirn, $listOrder); ?>	</th>		<th width="10%">	<?php echo JHtml::_('grid.sort',  'COM_PRICELEAF_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>	<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'priceleafs.saveorder'); ?>	</th>	<th>	<?php echo JHtml::_('grid.sort', 'COM_PRICELEAF_NAMBERZAKAZ_STATUS', 'a.state', $listDirn, $listOrder); ?>	</th>	</tr>	</thead>			<tfoot>				<tr>					<td colspan="10">						<?php echo $this->pagination->getListFooter(); ?>					</td>				</tr>			</tfoot>			<tbody>	<!--Запускаем цикл кторый выведет данные на странице-->				<?php foreach ($this->items as $i => $item) :				$ordering   = ($listOrder == 'a.ordering');				$canCreate  = $user->authorise('core.create',     'com_priceleafs.category.' . $item->catid);				$canEdit    = $user->authorise('core.edit',       'com_priceleafs.category.' . $item->catid);				$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;				$canChange  = $user->authorise('core.edit.state', 'com_priceleafs.category.' . $item->catid) && $canCheckin;				?>	<tr class="row<?php echo $i % 2; ?>">	<!--Выводим id записей-->	<td>	<a href="<?php echo JRoute::_('index.php?option=com_priceleafs&task=zakaz.edit&id='.(int) $item->id); ?>"><?php echo $item->id; ?></a>	</td>	<td>	<?php echo JHtml::_('grid.id', $i, $item->id); ?>	</td>	<td>	<a href="<?php echo JRoute::_('index.php?option=com_priceleafs&task=zakaz.edit&id='.(int) $item->id); ?>"><?php echo $item->pojta; ?></a>	</td>	<td>	<?php echo $item->date; ?>	</td>		<!--Параметры сортировки данных-->	<td align="center">	<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />	</td>	<!--Параметры публикации-->	<td align="center">	<?php echo JHtml::_('jgrid.published', $item->state, $i, 'zakazs.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>	</td>	</tr>	<?php endforeach; ?>	</tbody></table>				<?php //Загрузка формы пакетной обработки. ?>		<?php echo $this->loadTemplate('batch'); ?>		<input type="hidden" name="task" value="" />		<input type="hidden" name="boxchecked" value="0" />		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />		<?php echo JHtml::_('form.token'); ?>	</div></form>