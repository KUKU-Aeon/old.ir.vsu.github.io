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

jimport('joomla.application.component.controllerform');


class DroptablesControllerDbtable extends JControllerForm {
 
    public function changeTables() {
        $tables = JFactory::getApplication()->input->get("tables") ;
        $model = $this->getModel();
        $columns = $model->listMySQLColumns( $tables );
        
        $this->exit_status(true,array('columns'=> $columns));
    }            
    
    public function generateQueryAndPreviewdata() {
      
        $table_data =  JFactory::getApplication()->input->get("table_data", array(), 'ARRAY');
      
        $model = $this->getModel();
        $result = $model->generateQueryAndPreviewdata( $table_data );
        
        $this->exit_status(true, $result );
    }
    
    //create new table for selected mysql tables
    public function createTable() {
        $table_data =   JFactory::getApplication()->input->get("table_data", array(), 'ARRAY');
        $model = $this->getModel();
        $result = $model->createTable( $table_data );
        
        $this->exit_status(true, $result );
        
    }
    
    //update table with new change
    public function updateTable() {
        $table_data =   JFactory::getApplication()->input->get("table_data", array(), 'ARRAY');
        $id_table = (int)$table_data['id_table'];
        $model = $this->getModel();
        $buildQueryandData = $model->generateQueryAndPreviewdata( $table_data );
        $table_data['query'] = $buildQueryandData['query'];
        
        $result = $model->updateTable($id_table, $table_data );
        
        $this->exit_status(true, $result );
        
    }
    
     /**
    * Return a json response
    * @param $status
    * @param array $datas array of datas to return with the json string
    * 
    */
   private function exit_status($status,$datas=array()){
            $response = array('response'=>$status,'datas'=>$datas);
            echo json_encode($response);
            JFactory::getApplication()->close();
   }
    
}

?>
