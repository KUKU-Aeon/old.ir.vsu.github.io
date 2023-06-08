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

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerlegacy');

class DroptablesController extends JControllerLegacy
{
      
    /**
    * default view for this controller
    */
    protected $default_view = 'droptables';
    
    /**
     * Method to display the view.
     *
     * @access	public
     */
    function display($cachable = false, $urlparams = false) 
    {
        // Load the submenu.
        DroptablesHelper::addSubmenu(JRequest::getCmd('view', $this->default_view ));
        
        
        $vName = JRequest::getCmd('view', $this->default_view);
        $layout = JRequest::getCmd('layout','default');

            if($vName=='droptables'){
                $view = $this->getView($vName,'html');        
                $modelCategory = $this->getModel('category');
                $view->setModel($modelCategory, false);
                $modelCategories = $this->getModel('categories');
                $view->setModel($modelCategories, false);
                $modelTables = $this->getModel('tables');
                $view->setModel($modelTables, false);
                $modelStyles = $this->getModel('styles');
                $view->setModel($modelStyles, false);
                $modelChartTyles = $this->getModel('chartTypes');
                $view->setModel($modelChartTyles, false);
            }elseif($vName=='category' && $layout=='default'){
                $view = $this->getView($vName,'raw');
                $model = $this->getModel('category');
                $view->setModel($model, false);
            } elseif($vName=='charttyle'){
                $view = $this->getView($vName,'json');
                $model = $this->getModel('charttype');                
                $view->setModel($model, true);
            } elseif($vName=='dbtable'){
                $view = $this->getView($vName,'raw');        
                $modelTable = $this->getModel('table');
                $view->setModel($modelTable, false);
            }
//        }
        parent::display($cachable, $urlparams);
        return $this;
    }
    
    public function htaccessdo(){
        DroptablesBase::edithtaccess();
    }
}
