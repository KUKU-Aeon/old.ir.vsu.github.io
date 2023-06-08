<?php
/**
* @package		Joomla & QuickForm
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

if( qfJVER>2.5){
	class QFController extends JControllerLegacy{}
}else{
	class QFController extends JController{}
}


class QuickformController extends QFController
{
	protected $default_view = 'quickforms';
	function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask( 'apply', 'save');
		$this->registerTask( 'save2new', 'save');
		$this->registerTask( 'save2copy', 'save');
		
		$this->registerTask( 'st_apply', 'st_save');
	}
	
	public function display($cachable = false, $urlparams = false)
	{
		switch(JRequest::getCmd('task'))
		{
			case 'create'     :
			case 'edit'    :
			{
				JRequest::setVar( 'view'  , 'quickform');
			} break;
		}
		
		parent::display();
		return $this;
	}
	
	function save() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$model = $this->getModel('quickform');
		$msg = JText::_( 'JGLOBAL_MODIFIED' );
		$type = 'message';
		if(JRequest::getCmd('task')=='save2copy')$_POST['id']=0;
		if ($model->store())
		{
		  switch (JRequest::getCmd('task')) {
				case 'apply':
				case 'save2copy':
					if(!(int) $_POST['id']) $_POST['id']= $model->getMaxid() ;
					$link = 'index.php?option=com_quickform&view=quickform&cid[]='. (int) $_POST['id'];
					break;
				case 'save':
					$link = 'index.php?option=com_quickform';
					break;
				case 'save2new':
					$link = 'index.php?option=com_quickform&view=quickform&cid[]=0';
					break;
		  }
		}else{
		  $msg = JText::_( 'Error saving your settings.' );
			$type = 'error';
		  $link = 'index.php?option=com_quickform';
		}
		$this->setRedirect($link, $msg, $type);
	}
	
	function st_save() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$model = $this->getModel('statistic');
		$msg ='';
		$type = 'message';
		if ($model->store())
		{
		  switch (JRequest::getCmd('task')) {
				case 'st_apply':
					$link = 'index.php?option=com_quickform&view=statistic&cid[]='. (int) $_POST['id'];
					break;
				case 'st_save':
					$link = 'index.php?option=com_quickform&view=statistics';
					break;
		  }
		}else{
		  $msg = JText::_( 'Error saving your settings.' );
			$type = 'error';
		  $link = 'index.php?option=com_quickform';
		}
		$this->setRedirect($link, $msg, $type);
	}
	
	function st_cancel() {
		$link = 'index.php?option=com_quickform&view=statistics';
		$this->setRedirect($link);
	}
	
}

