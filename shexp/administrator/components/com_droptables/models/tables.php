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

jimport('joomla.application.component.modellist');
jimport('joomla.access.access');


class DroptablesModelTables extends JModelList
{       
    
    
    /**
	 * @return	string
	 * @since	1.6
	 */
	function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
                                    't.id, t.id_category, t.title, t.created_time, t.modified_time, t.author'
			)
		);
		$query->from('#__droptables_tables AS t');
		$query->order('position');
		// Filter by category
		if ($category = $this->getState('filter.category')) {
			$query->where('t.id_category = '.$db->quote($category));
		}

		return $query;
	}
    
    
    
    
    
    /**
	 * Auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
            
		$category = JRequest::getInt('id_category', 0);
		$this->setState('filter.category', $category );
                
                parent::populateState($ordering, $direction);
                
                $this->setState('list.limit', 100000);
	}
    
    
    
    /**
     * Method to add a file into database
     * @param string $file 
     * @param int   $id_category
     * @return inserted row id, false if an error occurs
     */
    public function addTable($data){
        $dbo = $this->getDbo();
        $date	= JFactory::getDate();
        $ordering = $this->getNextPosition($data['id_category']);
        $query = 'INSERT INTO #__droptables_files (file,catid,ordering,title,ext,size,created_time,modified_time) 
                  VALUES ('.$dbo->quote($data['file']).','.intval($data['id_category']).','.intval($ordering).','.$dbo->quote($data['title']).','.$dbo->quote($data['ext']).','.(int)$data['size'].','.$dbo->quote($date->toSql()).','.$dbo->quote($date->toSql()).')';
        $dbo->setQuery($query);
        if(!$dbo->query()){
            return false;
        }
        return $dbo->insertid();
    }
    
    
    /**
     * Methode to retrieve file information
     * @param int $id_file 
     * @return object file, false if an error occurs
     */
    public function getFile($id_file){
        $dbo = $this->getDbo();
        $query = 'SELECT * FROM #__droptables_files WHERE id='.$dbo->quote($id_file);
        $dbo->setQuery($query);
        if(!$dbo->query()){
           return false; 
        }
        return $dbo->loadObject();
    }
  

}