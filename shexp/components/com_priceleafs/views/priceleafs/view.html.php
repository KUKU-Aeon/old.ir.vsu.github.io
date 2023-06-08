
<?php


//Защита от прямого обращения к скрипту
defined('_JEXEC') or die;

class PriceleafsViewPriceleafs extends JViewLegacy
{
function display ($tpl = null)
	{
	$model = $this->getModel();
	$rows = $model->getPriceleaf();
	$this->assignRef('rows',$rows);
	
	$rows_cat = $model->getPriceleafcat();
	$this->assignRef('rows_cat',$rows_cat);
	
	$rows_na = $model->getPriceleafnaimenowanie();
	$this->assignRef('rows_na',$rows_na);
	
	$rows_valuta = $model->getPriceleafvaluta();
	$this->assignRef('rows_valuta',$rows_valuta);
	
	$rows_vote = $model->getPriceleafvote();
	$this->assignRef('rows_vote',$rows_vote);	
	
	    $this->loadHelper( 'priceleafs_icons' );
	
parent::display($tp1);
	}


}

