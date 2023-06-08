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

jimport('joomla.application.component.modeladmin');

class DroptablesModelTable extends JModelAdmin
{
    /**
    * Returns a Table object, always creating it.
    *
    * @param	type	The table type to instantiate
    * @param	string	A prefix for the table class name. Optional.
    * @param	array	Configuration array for model. Optional.
    *
    * @return	JTable	A database object
   */
   public function getTable($type = 'Table', $prefix = 'DroptablesTable', $config = array())
   {
           return JTable::getInstance($type, $prefix, $config);
   }
   
    public function getForm($data = array(), $loadData = true){
        $form = $this->loadForm('com_droptables.table', 'table', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
                return false;
        }
        return $form;
    }
    
    public function getItem($pk = null) {
         
        $item = parent::getItem($pk);

        return $item;
    }
    
    public function getTableData($query) {
        $dbo = $this->getDbo();
        $dbo->setQuery($query);
        $reuslts = $dbo->loadAssocList();
        return $reuslts;
    }
    
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = $this->getItem();
        return $data;
    }

}