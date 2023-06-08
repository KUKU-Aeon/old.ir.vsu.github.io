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
        $params= $item->params;
        if( isset($params['query']) && $params['query']) {
            $tableData = $this->getTableData($params['query'] . " Limit 50");
            $cols = array_keys($tableData[0] );
            $headerCols  = array();
            $i= 0;
            foreach ($cols as $col) {
                $headerCols[$col] = $params['custom_titles'][$i];
                $i++;
            }
            array_unshift($tableData, $headerCols);
            $item->datas = json_encode($tableData);
            $item->query =  $params['query'];
        }
    
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

    public function add($id_category) {
        $dbo = $this->getDbo();
        $dbo->setQuery('INSERT INTO #__droptables_tables '
                . '(id_category, title, created_time, modified_time, author) '
                . 'VALUES '
                . '('.(int)$id_category.','.$dbo->quote(JText::_('COM_DROPTABLES_MODEL_TABLE_DEFAULT_TITLE')).','.$dbo->quote(date("Y-m-d H:i:s")).','.$dbo->quote(date("Y-m-d H:i:s")).','.(int)JFactory::getUser()->id.')');
        if(!$dbo->query()){
            return false;
        }
        return $dbo->insertid();
    }

    public function copy($id){
        $table = $this->getTable();
        if($table->load($id)){
            $table->id = null;
            $table->title = $table->title.JText::_('COM_DROPTABLES_MODEL_TABLE_COPY');
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
    
    public function setPosition($tables) {
      
        $ids = explode(",",$tables);
        $db = $this->getDbo();        
        $i = 1;
        foreach ($ids as $id) {      
            $query = $db->getQuery(true);          
            $query->update($db->quoteName('#__droptables_tables'))
                    ->set(array($db->quoteName('position') . ' = '. $i) )
                    ->where(array($db->quoteName('id') . ' = '.(int)$id) );
            $db->setQuery($query);                        
            if(!$db->execute()){
                return false;
            }
        
            $i++;
        }
        
        return true;
    }
    
    public function changeCategory($id_table,$id_cat) {
        $db = $this->getDbo();  
        $query = $db->getQuery(true);   
        $query->update($db->quoteName('#__droptables_tables'))
                    ->set(array($db->quoteName('id_category') . ' = '. (int)$id_cat) )
                    ->where(array($db->quoteName('id') . ' = '.(int)$id_table) );
        $db->setQuery($query);                        
        if(!$db->execute()){
            return false;
        }
            
        return true;
    }
    
    public function validate($form, $data, $group = NULL) {
        $validData = $data;
        if(isset($data["datas"]) && $data["datas"]=="") {
            unset( $validData["datas"]);
            unset( $validData["params"]);
        }
        return $validData;
    }
}