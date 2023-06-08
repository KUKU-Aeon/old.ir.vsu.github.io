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
			<?php echo $this->form->getField('opisanie')->save(); ?>
			Joomla.submitform(task, document.getElementById('priceleaf-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_priceleafs&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="priceleaf-form" class="form-validate">
<div >	
<fieldset>

<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_PRICELEAF_DETALIS') : JText::sprintf('COM_PRICELEAF_DETALIS', $this->item->id); ?></a></li>
<li><a href="#cena" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_CENA_VKLADKA');?></a></li>			
<li><a href="#dop_pole" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_DOPOLNITELNIE_POLY');?></a></li>		
</ul>

<div class="tab-content">
			<div class="tab-pane active" id="details">

				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('name'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('cat_naimenovanie'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cat_naimenovanie'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('opredelenie'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('opredelenie'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('pereopredelenie'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('pereopredelenie'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('edizm'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('edizm'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('total_tovar'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('total_tovar'); ?></div>					
					
					<div class="control-label"><?php echo $this->form->getLabel('opisanie'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('opisanie'); ?></div>					
				</div>
			</div>
			
			<div class="tab-pane" id="cena">
				<?php echo JText::_('COM_PRICELEAF_CENA_MANA');?>
					<div class="control-group">
					
					<div class="control-label"><?php echo $this->form->getLabel('old'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('old'); ?></div>		

					<div class="control-label"><?php echo $this->form->getLabel('radio1'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio1'); ?></div>						
					
					<div class="control-label"><?php echo $this->form->getLabel('cena'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio2'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio2'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('cena1'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena1'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio3'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio3'); ?></div>					

					<div class="control-label"><?php echo $this->form->getLabel('cena2'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena2'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio4'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio4'); ?></div>					

					<div class="control-label"><?php echo $this->form->getLabel('cena3'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena3'); ?></div>	
					
					<div class="control-label"><?php echo $this->form->getLabel('radio5'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio5'); ?></div>					

					<div class="control-label"><?php echo $this->form->getLabel('cena4'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena4'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio6'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio6'); ?></div>					

					<div class="control-label"><?php echo $this->form->getLabel('cena5'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena5'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio7'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio7'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('cena6'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena6'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio8'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio8'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('cena7'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena7'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio9'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio9'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('cena8'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena8'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('radio10'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('radio10'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('cena9'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('cena9'); ?></div>
										
				</div>
			</div>
	
	
			<div class="tab-pane" id="dop_pole">
				<?php echo JText::_('COM_PRICELEAF_DOPOLNITELNIE_POLY_DOC');?>
					<div class="control-group">
					
					<div class="control-label"><?php echo $this->form->getLabel('optional_description1'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description1'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field1'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field1'); ?></div>					

					<div class="control-label"><?php echo $this->form->getLabel('optional_description2'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description2'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('optional_field2'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field2'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description3'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description3'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field3'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field3'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description4'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description4'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field4'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field4'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description5'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description5'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field5'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field5'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description6'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description6'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field6'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field6'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description7'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description7'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('optional_field7'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field7'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description8'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description8'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field8'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field8'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description9'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description9'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field9'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field9'); ?></div>						

					<div class="control-label"><?php echo $this->form->getLabel('optional_description10'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_description10'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('optional_field10'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('optional_field10'); ?></div>						
			
				</div>
			</div>	
	
	
</div>	

</div>
<div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>