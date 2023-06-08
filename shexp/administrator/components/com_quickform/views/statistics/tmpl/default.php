<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('_JEXEC') or die;

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_quickform&view=statistics'); ?>" method="post" name="adminForm" id="adminForm">
	<?php 
	if( qfJVER>2.9){
		JHtml::_('bootstrap.tooltip');
		JHtml::_('behavior.multiselect');
		JHtml::_('formbehavior.chosen', 'select');
		$sortFields = $this->getSortFields();
	?>
	<script type="text/javascript">
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
		window.addEvent('domready', function() {
			$$('.page-title').each(function(el){
				el.innerHTML+=' <h7 style="font-size:12px;">from bigemot.ru</h7>';
			});
		});
  </script>
<?php if(!empty( $this->sidebar)){ ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php }else { ?>
	<div id="j-main-container">
<?php }?>
		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search" class="element-invisible"><?php echo JText::_('JSEARCH_FILTER_LABEL');?></label>
				<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>" />
			</div>
			<div class="btn-group pull-left">
				<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
				<button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC');?></label>
				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>
					<option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?></option>
					<option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY');?></label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
					<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
				</select>
			</div>
      <div class="btn-group pull-right">
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
			</select>
		</div>
      <div class="btn-group pull-right"><?php
        echo $this->lists['st_status'];
      ?></div>
		</div>
		<div class="clearfix"> </div>
		<table class="table table-striped" id="weblinkList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php //echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'JGLOBAL_TITLE', 'a.st_title', $listDirn, $listOrder ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Status', 'a.st_status', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Price', 'a.st_price', $listDirn, $listOrder  ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Curency', 'a.st_cur', $listDirn, $listOrder  ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'User', 'a.st_user', $listDirn, $listOrder ); ?>
			</th>
			<th width="140px" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Date', 'a.st_date', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'IP', 'a.st_ip', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'ID', 'a.id', $listDirn, $listOrder ); ?>
			</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php foreach ($this->items as $i => $item) :
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php //echo $item->catid?>">
					<td class="order nowrap center hidden-phone">
					<?php echo 1+$i; ?>
					</td>
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
			<td>
				<a href="index.php?option=com_quickform&view=statistic&cid[]=<?php echo $item->id ?>"><?php echo $this->escape($item->st_title);?></a>
			</td>
			<td align="center">
				<?php echo $this->st_status[1+$item->st_status]['text']; ?>
			</td>
			<td>
				<?php echo $item->st_price; ?>
			</td>
			<td>
				<?php echo $item->st_cur; ?>
			</td>
			<td>
				<a href="index.php?option=com_users&task=user.edit&id=<?php echo $item->st_user ?>"><?php echo JFactory::getUser($item->st_user)->get('username');?></a>
			</td>
			<td>
				<?php
				$dat=explode(' ',$item->st_date);
				 echo $dat[0].' <span style="font-size:10px">'.$dat[1].'</span>'; ?>
			</td>
			<td align="center">
				<?php echo $item->st_ip; ?>
			</td>
			<td align="center">
				<?php echo $item->id; ?>
			</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
	<?php
	}else{
	?>


	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
		<?php
			echo $this->lists['st_status'];
		?>
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
			</select>
		</div>
	</fieldset>
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'JGLOBAL_TITLE', 'a.st_title', $listDirn, $listOrder ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Status', 'a.st_status', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Price', 'a.st_price', $listDirn, $listOrder  ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Curency', 'a.st_cur', $listDirn, $listOrder  ); ?>
			</th>
			<th width="1%"  nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'User', 'a.st_user', $listDirn, $listOrder ); ?>
			</th>
			<th width="140px" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Date', 'a.st_date', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'IP', 'a.st_ip', $listDirn, $listOrder ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'ID', 'a.id', $listDirn, $listOrder ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="9">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach ($this->items as $i => $item) {
		
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
			<td>
				<a href="index.php?option=com_quickform&view=statistic&cid[]=<?php echo $item->id ?>"><?php echo $this->escape($item->st_title);?></a>
			</td>
			<td align="center">
				<?php echo $this->st_status[1+$item->st_status]['text']; ?>
			</td>
			<td>
				<?php echo $item->st_price; ?>
			</td>
			<td>
				<?php echo $item->st_cur; ?>
			</td>
			<td>
				<a href="index.php?option=com_users&task=user.edit&id=<?php echo $item->st_user ?>"><?php echo JFactory::getUser($item->st_user)->get('username');?></a>
			</td>
			<td>
				<?php
				$dat=explode(' ',$item->st_date);
				 echo $dat[0].' <span style="font-size:10px">'.$dat[1].'</span>'; ?>
			</td>
			<td align="center">
				<?php echo $item->st_ip; ?>
			</td>
			<td align="center">
				<?php echo $item->id; ?>
			</td>
		</tr>
		<?php
	}
	?>
	</tbody>
	</table>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php }?>

