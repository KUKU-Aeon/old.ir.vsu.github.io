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
			<?php //echo $this->form->getField('opisanie')->save(); ?>
			Joomla.submitform(task, document.getElementById('priceleaf-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_priceleafs&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="priceleaf-form" class="form-validate">


<?php if(!empty( $this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		
		<div class="clearfix"> </div>


<div>		
<fieldset class="adminform">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_PRICELEAF_OPTION_BASIC') : JText::sprintf('COM_PRICELEAF_OPTION_BASIC', $this->item->id); ?></a></li>
<li><a href="#discount" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_PERCENT_NUMBER');?></a></li>
<li><a href="#mail" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_MAIL');?></a></li>
<li><a href="#print" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_IMAGES_HIDDEN');?></a></li>
<li><a href="#payment" data-toggle="tab"><?php echo JText::_('COM_PRICELEAF_PAYMENT');?></a></li>				
</ul>


<div class="tab-content">
			<div class="tab-pane active" id="details">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('valuta'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('valuta'); ?></div>				

					<div class="control-label"><?php echo $this->form->getLabel('spoiler'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('spoiler'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('forma'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('forma'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('total_sum'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('total_sum'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('stoimost'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('stoimost'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('col'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('col'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('vote'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('vote'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('captcha'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('captcha'); ?></div>		
					
					<div class="control-label"><?php echo $this->form->getLabel('icons'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('icons'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('more_options'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('more_options'); ?></div>						
<br><br>					
				</div>
			</div>



			<div class="tab-pane" id="discount">
					<div class="control-group">
				
					<div class="control-label"><?php echo $this->form->getLabel('percent'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('percent'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('percent_number'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('percent_number'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('percent_bill'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('percent_bill'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('percent_order'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('percent_order'); ?></div>
								
				</div>
			</div>	
			
			
			<div class="tab-pane" id="mail">
					<div class="control-group">

					<div class="control-label"><?php echo $this->form->getLabel('mail'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('mail'); ?></div>
					
					<div class="control-label"><?php echo $this->form->getLabel('from'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('from'); ?></div>						
					
				</div>
			</div>		


			<div class="tab-pane" id="print">
					<div class="control-group">

					<div class="control-label"><?php echo $this->form->getLabel('pechat'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('pechat'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('pechat_duble'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('pechat_duble'); ?></div>					
					
				</div>
			</div>				

			
			
			<div class="tab-pane" id="payment">
				<?php echo JText::_('COM_PRICELEAF_PAYMENT_DETALIS');?>
					<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('payment_state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('payment_state'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('merchant_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('merchant_id'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('currency_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('currency_id'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('description'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('success_url'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('success_url'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('fail_url'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('fail_url'); ?></div>	

					<div class="control-label"><?php echo $this->form->getLabel('simbol'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('simbol'); ?></div>

					<div class="control-label"><?php echo $this->form->getLabel('status'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('status'); ?></div>					
								
				</div>
			</div>			
			
			
			</div>
</fieldset>
</div>
<div>
	<input type="hidden" name="task" value="priceleaf.edit" />
	<?php echo JHtml::_('form.token'); ?>
</div>
</form>