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

class DroptablesViewCharts extends JViewLegacy
{
	
	/**
	 * Display the view
	 */
	public function display($tpl = null){
            $id_table = JFactory::getApplication()->input->getInt('id_table');
            $model = $this->getModel();
            $items = $model->getCharts($id_table);
            echo json_encode($items);
	}
}
