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

class DroptablesViewDbtable extends JViewLegacy {
    
    protected $state;
    /**
	 * Display the view
    */
    public function display($tpl = null) {
        
        $id_table = JFactory::getApplication()->input->getInt('id_table');
        $model = $this->getModel('dbtable');       
        $this->selected_tables = array();
        $this->availableColumns = array();
        $this->selected_columns = array();
        $this->join_rules = array();
        $this->params = new stdClass();
        $this->id_table = $id_table;
        $this->default_ordering_dir  = 'asc';
        if($id_table) {
            $modelTable = $this->getModel('table');
            $item = $modelTable->getItem($id_table); 
            $params = $item->params;         
            $this->params =  $params;
            $this->selected_tables = $params['tables'];
         
            $columns = $model->listMySQLColumns($this->selected_tables );
          
            $this->availableColumns = $columns['all_columns'] ;
            $this->selected_columns =  $params['mysql_columns'];
            $this->sorted_columns = $columns['sorted_columns'] ;
            $this->join_rules =     isset($params['join_rules'])?$params['join_rules']: array();
            $this->default_ordering_column =  $params['default_ordering'];
            $this->default_ordering_dir =  $params['default_ordering_dir'];
            $this->custom_titles =  $params['custom_titles']; 
        }
        $this->mysql_tables = $model->listMySQLTables();
               
        parent::display($tpl);
    }
}