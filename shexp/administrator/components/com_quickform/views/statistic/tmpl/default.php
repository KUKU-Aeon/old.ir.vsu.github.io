<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
			Joomla.submitform(task, document.forms.adminForm);
	}
  window.addEvent('domready', function() {
		$$('.page-title').each(function(el){
			el.innerHTML+=' <h7 style="font-size:12px;">from bigemot.ru</h7>';
		});
  });
</script>
<form action="index.php" method="post" name="adminForm">
  <div style="padding:20px 20px 20px 80px">
    <h3><?php echo $this->item->st_title; ?></h3>
    <div style="float:left; width:60%;">
      <?php echo $this->item->st_form;  ?>
    </div>
    <div style="float:left; width:40%">
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td><?php echo JText::_('status') ?>: </td>
        <td><?php echo $this->lists['st_status']; ?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('note') ?>: </td>
        <td><textarea name="st_desk"><?php echo $this->item->st_desk; ?></textarea></td>
      </tr>
    </table>
    </div>
  </div> 
  <input type="hidden" name="option" value="com_quickform" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="id" value="<?php echo $this->item->id ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>

