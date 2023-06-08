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
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'priceleaf.cancel' || document.formvalidator.isValid(document.id('priceleaf-form'))) {
			<?php echo $this->form->getField('text')->save(); ?>
			Joomla.submitform(task, document.getElementById('priceleaf-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_priceleafs&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="priceleaf-form" class="form-validate">
<div class="width-100 fltlft">		
<fieldset class="adminform">

<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_PRICELEAF_DETALIS') : JText::sprintf('COM_PRICELEAF_DETALIS', $this->item->id); ?></a></li>			
</ul>

	<?php foreach($this->form->getFieldset() as $field): ?>
	<?php if (!$field->hidden): ?>
	<?php echo $field->label; ?>
	<?php endif; ?>
	<?php echo $field->input; ?>
	<?php endforeach; ?>
</fieldset>
</div>


	
<div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>