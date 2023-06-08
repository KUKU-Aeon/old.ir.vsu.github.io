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

class DroptablesModelChart extends JModelAdmin
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
   public function getTable($type = 'Chart', $prefix = 'DroptablesTable', $config = array())
   {
           return JTable::getInstance($type, $prefix, $config);
   }
   
    public function getForm($data = array(), $loadData = true){
        $form = $this->loadForm('com_droptables.chart', 'chart', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
                return false;
        }
        return $form;
    }
    
    
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = $this->getItem();
        return $data;
    }

    public function add($id_table, $datas) {
        $dbo = $this->getDbo();
        $dbo->setQuery('INSERT INTO #__droptables_charts '
                . '(id_table, title, datas, type, created_time, modified_time, author) '
                . 'VALUES '
                . '('.(int)$id_table.','.$dbo->quote(JText::_('COM_DROPTABLES_MODEL_CHART_DEFAULT_TITLE')).','. $dbo->quote($datas) .',' . $dbo->quote("Line").',' .$dbo->quote(date("Y-m-d H:i:s")).','.$dbo->quote(date("Y-m-d H:i:s")).','.(int)JFactory::getUser()->id.')');
        if(!$dbo->query()){
            return false;
        }
        return $dbo->insertid();
    }

    public function save($data) {
        $table = $this->getTable();   
        $id = $data['id'];
        if($id && $table->load($id)){      
            if(isset($data['type']) && $data['type']!= "" ) {
                $table->type = $data['type'];
            }
            $table->config = $data['config'];
            $table->store();
            return $table->id;
        }
        return false;
    }
    
    
    public function copy($id){
        $table = $this->getTable();
        if($table->load($id)){
            $table->id = null;
            $table->title = $table->title.JText::_('COM_DROPTABLES_MODEL_CHART_COPY');
            $table->store();
            return $table->id;
        }
        return false;
    }


    /**
     * Set the title of a table
     * @param int $id_category
     * @param string $title
     * @return int 
     */
    public function setTitle($id,$title){
        if($title==''){
            return false;
        }
        $filter = JFilterInput::getInstance();
        $title = $filter->clean($title);
        
        $table = $this->getTable();
        if(!$table->load($id)){
            return false;
        }
        if(!$table->bind(array('title'=>$title))){
            return false;
        }
        if(!$table->store()){
            return false;
        }
        return true;
    }
    
    public function getChart($id) {
        $dbo = $this->getDbo();
        $dbo->setQuery('Select c.*, t.datas As tData From #__droptables_charts As c '
                . ' JOIN #__droptables_tables As t On t.id = c.id_table '
                . ' WHERE c.id = ' . (int)$id );                
        
        $result = $dbo->loadObject();
        return $result;
    }
}