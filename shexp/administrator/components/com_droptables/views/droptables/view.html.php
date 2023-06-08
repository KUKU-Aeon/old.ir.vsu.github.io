<?php
/** 
 * Droptables
 * 
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package Droptables
 * @copyright Copyright (C) 2014 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2014 Damien Barrère (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;


class DroptablesViewDroptables extends JViewLegacy
{
	
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
                $this->canDo = DroptablesHelper::getActions();
                $this->params = $params = JComponentHelper::getParams('com_droptables');
                            
                $model = $this->getModel('categories');
                JFactory::getApplication()->setUserState('list.limit', 100000);
                $this->categories = $model->getItems();
                
                $modelTables = $this->getModel('tables');
                $this->tables = $modelTables->getItems();
                $this->tables = DroptablesTablesHelper::categoryObject($this->tables);
                
                $modelStyles = $this->getModel('styles');
                $this->styles = $modelStyles->getStyles();

                $modelChartTypes = $this->getModel('chartTypes');
                $this->chartTypes = $modelChartTypes->getChartTypes();
               
                $this->dbtable_cat = (int)$params->get('dbtable_cat',0);   
                 
                $this->setLayout(JRequest::getCmd('layout','default'));
                
		parent::display($tpl);
                
                $app = JFactory::getApplication();
                if($app->isAdmin()){
                    $this->addToolbar();
                }
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{

		$canDo	= DroptablesHelper::getActions();

		JToolBarHelper::title(JText::_('COM_DROPTABLES_MAIN_PAGE'), 'droptables.png');

		$toolbar = JToolBar::getInstance();		
		
		if ($canDo->get('core.admin')) {
			$toolbar->appendButton( 'popup', 'support', JText::_('COM_DROPTABLE_VIEW_SUPPORT'), 'index.php?option=com_droptables&view=support&tmpl=component', 700, 600,0,0 );
			JToolBarHelper::preferences('com_droptables');
		}

		JToolBarHelper::divider();
	}
}
