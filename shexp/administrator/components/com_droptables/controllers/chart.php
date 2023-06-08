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


class DroptablesControllerChart extends JControllerForm
{

    public function save($key = null, $urlVar = null) {
        $id = JRequest::getInt('id',0);    
        $data = JRequest::getVar('jform', array());    
        $model = $this->getModel();
        $data['id'] = $id;
       if($model->save($data)){        
            $this->exit_status(true);
        }else{            
            $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
    }
    
    public function add() {
        $id_table = JFactory::getApplication()->input->getInt('id_table');
        $datas =  JFactory::getApplication()->input->getString('datas');
        $model = $this->getModel();
        $newItem = $model->add($id_table,$datas);
       
        if($newItem){
            $table = $model->getItem($newItem);
            $this->exit_status(true,array('id'=>$newItem, 'datas'=> $table->datas, 'type'=> "Line", 'title'=>JText::_('COM_DROPTABLES_MODEL_CHART_DEFAULT_TITLE')));
        }else {
            $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
    }
    
    public function copy() {
        $id = JFactory::getApplication()->input->getInt('id');
        $model = $this->getModel();                
        $newItem = $model->copy($id);
        if($newItem){
            $table = $model->getItem($newItem);
            $this->exit_status(true,array('id'=>$table->id,'title'=>$table->title, 'datas'=> $table.datas));
        }else {
            $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
    }
    
    public function delete(){
        $id = JFactory::getApplication()->input->getInt('id');
        $model = $this->getModel();
        if($model->delete($id)){
            $this->exit_status(true);
        }else {
            $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
    }
    
    public function setTitle(){
        $id = JRequest::getInt('id',0);
        
        $model = $this->getModel();
        $canDo = DroptablesHelper::getActions();
        if(!$canDo->get('core.edit')){
            if($canDo->get('core.edit.own')){
                $chart = $model->getItem($id);
                if($chart->author != JFactory::getUser()->id){
                    $this->exit_status('not permitted');
                }
            }else{
                $this->exit_status('not permitted');
            }
        }
        
        $title = JFactory::getApplication()->input->getString('title');
        
        if($model->setTitle($id,$title)){
            $this->exit_status(true);
        }else{
             $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
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