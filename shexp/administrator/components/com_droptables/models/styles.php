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


class DroptablesModelStyles extends JModelList
{       
    
    
    /**
	 * @return	string
	 * @since	1.6
	 */
	function getStyles()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		
		$query->select('*');
		$query->from('#__droptables_styles AS s');
		$query->orderBy('ordering ASC');
                
                $db->setQuery($query);
                if(!$db->query()){
                    return false;
                }
		return $db->loadObjectList();
	}
    
    
    

}