<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die;
jimport('joomla.application.component.controlleradmin');

class QuickformControllerQuickforms extends JControllerAdmin
{
	public function getModel($name = 'quickform', $prefix = 'quickformModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$model = $this->getModel();

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_quickform&view=quickforms' ));

		// Initialise variables.
		$input	= JFactory::getApplication()->input;
		$vars	= $input->post->get('batch', array(), 'array');
		$cid	= $input->post->get('cid', array(), 'array');

		$contexts = array();
		foreach ($cid as $id)
		{
			$contexts[$id] = 'com_quickform.quickform' . '.' . $id;
		}

		// Attempt to run the batch operation.
		if ($model->batchAccess($vars['assetgroup_id'], $cid, $contexts))
		{
			$this->setMessage(JText::_('JLIB_APPLICATION_SUCCESS_BATCH'));

			return true;
		}
		else
		{
			$this->setMessage(JText::sprintf('JLIB_APPLICATION_ERROR_BATCH_FAILED', $model->getError()));
			return false;
		}
	}
}
