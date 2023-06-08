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

require_once(JPATH_ROOT.DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_categories'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'category.php');

class DroptablesControllerCategory extends CategoriesControllerCategory
{

    private $savedId;

    public function setTitle(){
        $id_category = JRequest::getInt('id_category',0);
        
        $model = $this->getModel();
        $canDo = DroptablesHelper::getActions();
        if(!$canDo->get('core.edit')){
            if($canDo->get('core.edit.own')){
                $category = $model->getItem($id_category);
                if($category->created_user_id != JFactory::getUser()->id){
                    $this->exit_status('not permitted');
                }
            }else{
                $this->exit_status('not permitted');
            }
        }
        
        $title = JFactory::getApplication()->input->getString('title');
        
        if($model->setTitle($id_category,$title)){
            $this->exit_status(true);
        }else{
            $this->exit_status(JText::_('COM_DROPTABLES_GLOBAL_ERROR'));
        }
    }

    /**
     * Method to add a category 
     */
    public function addCategory(){
        $canDo = DroptablesHelper::getActions();
        if(!$canDo->get('core.create')){
            $this->exit_status('not permitted');
        }
        $datas = array();
        $datas['jform']['id'] = 0;
        $datas['jform']['extension'] = 'com_droptables';
        $datas['jform']['title'] = JText::_('COM_DROPTABLES_MODEL_CATEGORY_DEFAULT_NAME');
        $datas['jform']['alias'] = JText::_('COM_DROPTABLES_MODEL_CATEGORY_DEFAULT_NAME').'-'.date('dmY-h-m-s',time());
        $datas['jform']['parent_id'] = 1;
        $datas['jform']['published'] = 1;
        $datas['jform']['language'] = '*';
        $datas['jform']['metadata']['tags'] = '';

        //Set state value to retreive the correct table
        $model = $this->getModel();
        $model->setState('category.extension', 'category');

	JFactory::getApplication()->input->set('id', 0);
        foreach ($datas as $data => $val) {
            JFactory::getApplication()->input->post->set($data, $val);
        }

        if($this->save())
        {
            $this->exit_status(true,array('id_category'=> $this->savedId ,'name'=>JText::_('COM_DROPTABLES_MODEL_CATEGORY_DEFAULT_NAME')));
        }
        $this->exit_status('error while adding category');
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
    
    /**
     * We cannot checkin and checkout because we use ajax
     */
    protected function checkEditId($context, $id){
                return true;
    }
    
    protected function postSaveHook(\JModelLegacy $model, $validData = array()) {
	$this->savedId = $model->getState($model->getName().'.id');
        parent::postSaveHook($model, $validData);
    }

}