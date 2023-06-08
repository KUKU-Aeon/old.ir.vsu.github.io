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
//jimport('joomla.access.access');

require_once(JPATH_ROOT.DIRECTORY_SEPARATOR.'administrator'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_categories'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'category.php');

class DroptablesModelCategory extends CategoriesModelCategory
{
    
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param	type	The table type to instantiate
     * @param	string	A prefix for the table class name. Optional.
     * @param	array	Configuration array for model. Optional.
     * @return	JTable	A database object
     * @since	1.6
     */
    public function getTable($type = 'Category', $prefix = 'DroptablesTable', $config = array()){
            return JTable::getInstance($type, $prefix, $config);
    }
    
    /**
     * Get category file
     * @param type $id
     * @return boolean
     */
    public function getCategory($idcat=null){
        if($idcat==null){
            $idcat = JRequest::getInt('id',0);
        }
        $user = JFactory::getUser();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->from('#__categories as a');
        
        $query->select('a.level, a.id, a.title, a.parent_id');
        
        $query->where('a.published=1');
        $query->where('a.extension='.$db->quote('com_droptables'));
        $query->where('a.id='.(int)$idcat);
        
        $query->select('b.title as parent_title');
        $query->select('b.id as parent_id');
        $query->join('LEFT OUTER','#__categories AS b ON b.id=a.parent_id AND b.extension='.$db->quote('com_droptables'));
       
        
        // Implement View Level Access
        if (!$user->authorise('core.admin')){
            $groups	= implode(',', $user->getAuthorisedViewLevels());
            $query->where('a.access IN ('.$groups.')');
        }
        $db->setQuery($query);
        if($db->query()){
            return $db->loadObject();
        }
        return null;
    }
    
    public function isCategoryExist($idcat) {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->from('#__categories as a');        
        $query->select('a.id');        
        $query->where('a.published=1');
        $query->where('a.extension='.$db->quote('com_droptables'));
        $query->where('a.id='.(int)$idcat);
        $db->setQuery($query);
        if($result = $db->loadResult() ){
            return true;
        }
        
        return false;
    }
    
    public function addCategory($catName) {
        $datas = array();
        $datas['id'] = 0;
        $datas['extension'] = 'com_droptables';
        $datas['title'] = $catName;
        $datas['alias'] =  JText::_('COM_DROPTABLES_MODEL_CATEGORY_DEFAULT_NAME').'-'.date('dmY-h-m-s',time());
        $datas['parent_id'] = 1;
        $datas['published'] = 1;
        $datas['language'] = '*';
        $datas['metadata']['tags'] = '';
        $this->setState('category.extension', 'category');
        $this->save($datas);
        $savedId = $this->getState($this->getName().'.id');
        return $savedId;
    }
    
    /**
     * Set the title of a category
     * @param int $id_category
     * @param string $title
     * @return int 
     */
    public function setTitle($id_category,$title){
        $dbo = $this->getDbo();
        if($title==''){
            return false;
        }
        $filter = JFilterInput::getInstance();
        $title = $filter->clean($title);
        
        $table = $this->getTable();
        if(!$table->load($id_category)){
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
    
    /**
    * Method to test whether a record can be deleted.
    *
    * @param   object  $record  A record object.
    *
    * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
    *
    * @since	1.6
    */
   protected function canDelete($record)
   {
           if (!empty($record->id))
           {
                   $user = JFactory::getUser();

                   return $user->authorise('core.delete', $record->extension . '.category.' . (int) $record->id);
           }
   }
   
   public function delete(&$pks) {
        if(parent::delete($pks)){
            foreach($pks as $i=>$pk){
                $pks[$i] = (int)$pk;
            }
            //Delete files under category
            $dbo = $this->getDbo();
            $query = 'DELETE FROM #__droptables_tables WHERE id_category IN ('.implode(',', $pks).')';
            $dbo->setQuery($query);
            if(!$dbo->query()){
                return false;
            }
            return true;
        }
        return false;
   }
   
   //There is no ckeckin or checkout in ajax
   public function checkin($pks = array()) {
       return true;
   }
   
   public function checkout($pk = null) {
       return true;
   }
   

}