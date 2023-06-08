<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

if( qfJVER>2.5){
	class QFView extends JViewLegacy{}
}else{
	class QFView extends JView{}
}

class QuickformViewQuickform extends QFView
{
	protected $item;

    function display($tpl = null)
    {
			require_once(JPATH_COMPONENT.'/models/quickform.php');
			$model = new QuickformModelQuickform;
			$this->item		=$model->getData();
			
			if (count($errors = $this->get('Errors'))) {
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
			
			$css  = JFolder::files(JPATH_COMPONENT_SITE.'/css');
			for ($i=0, $n=count($css); $i < $n; $i++) {
				if(substr($css[$i], strrpos($css[$i], '.') + 1)=='css'){
					$arr[]=array ( "value"=>$css[$i], "text"=>$css[$i]);
				}
			}
			$this->lists['css'] = JHTML::_('select.genericlist', $arr, 'qfcss', 'class="inputbox" size="1" ', 'value', 'text', $this->item->qfcss );
			
			$this->addToolbar();
			parent::display($tpl);
	}

	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));

		JToolBarHelper::title('QuickForm', 'weblinks.png');

		// If not checked out, can save the item.
		if (!$checkedOut )
		{
			JToolBarHelper::apply('apply');
			JToolBarHelper::save('save');
			JToolBarHelper::save2new('save2new');
		}
		// If an existing item, can save to a copy.
		if (!$this->item->id < 1) {
			JToolBarHelper::save2copy('save2copy');
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('cancel');
		}
		else {
			JToolBarHelper::cancel('cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('help', true);
	}


}

