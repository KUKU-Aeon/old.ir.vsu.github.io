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

/**
 * @package		Joomla.Administrator
 * @subpackage	com_messages
 * @since		1.6
 */
class DroptablesTablesHelper
{
    /**
     * Convert an object of files to a multidimentional array
     * @param array/object $tables
     */
    public static function categoryObject($tables){
        $ordered = array();
        foreach ($tables as $table){
            $ordered[$table->id_category][] = $table;
        }
        return $ordered;
    }
}