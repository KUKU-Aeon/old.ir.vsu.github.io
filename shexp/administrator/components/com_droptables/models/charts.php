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


class DroptablesModelCharts extends JModelList
{       
    
    
    /**
	 * @return	string
	 * @since	1.6
	 */
	function getCharts($id_table)
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
                                    't.id, t.id_table, t.title, t.datas, t.type, t.config, t.created_time, t.modified_time, t.author'
			)
		);
		$query->from('#__droptables_charts AS t');
                $query->where('t.id_table = '.$db->quote($id_table));
                $query->order('t.created_time');
				
                $db->setQuery($query);
                return $db->loadObjectList();		
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
    
    
    

}