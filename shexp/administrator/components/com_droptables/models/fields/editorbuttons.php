<?php
/** 
 * Droptables
 * 
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package Dropfiles
 * @copyright Copyright (C) 2013 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2013 Damien Barr?re (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */

defined('_JEXEC') or die;

jimport('joomla.form.formfield');
JFormHelper::loadFieldClass('list');
/**
 * Form Field class for the Joomla Framework.
 */

class JFormFieldEditorbuttons extends JFormField
{
	
	protected $type = 'editorbuttons';

	/**
	 */
	protected function getInput()
	{
            $html = array();
            $lang = JFactory::getLanguage();
            $base_dir = JPATH_ADMINISTRATOR;            
            $reload = true;
            
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
				->select('element AS name, name AS title')
				->from('#__extensions')
				->where('enabled = 1')
				->where('type =' . $db->quote('plugin'))
                                ->where('folder =' . $db->quote('editors-xtd'))                                
				->where('state IN (0,1)')				
				->order('ordering');

            $plugins= $db->setQuery($query)->loadObjectList();

            $exclue_buttons = array("droptables","readmore","pagebreak");            
            $i = 0;
            $class= ' class="radio"';           
            if(empty($this->value)) { $this->value = array("image"=>"image"); }
            foreach ($plugins as $plugin) {    
                 
                if (!in_array($plugin->name,$exclue_buttons) ) {
                    $lang->load("plg_editors-xtd_".$plugin->name, $base_dir, null, $reload);
                    $checked = (in_array($plugin->name, $this->value) )? ' checked="checked"' : '';
                    $html[] = '<div><div style="width: 180px;display:inline-block">' .JText::_($plugin->title) .'</div>';
                    $html[] = '<fieldset id="editor_buttons" class="radio btn-group" >';
                    $html[] = '<input type="radio" id="editor_buttons' . $i . '" name="jform[editor_buttons]['.$plugin->name.']" value="'.$plugin->name.'"' . $checked . $class  . ' />';
                    $html[] = '<label for="editor_buttons' . $i . '" class="btn" >'. JText::_('JYES') . '</label>';
                    $i++;
                    if($checked != "") { 
                        $checked = '';
                    }else {
                        $checked = ' checked="checked"';
                    }
                    $html[] = '<input type="radio" id="editor_buttons' . $i . '" name="jform[editor_buttons]['.$plugin->name.']" value="0"' . $checked . $class  . ' />';
                    $html[] = '<label for="editor_buttons' . $i . '" class="btn " >'. JText::_('JNO') . '</label>';
                    $i++;
                    $html[] = '</fieldset></div>' .'<br/>';
                    
                }
            }
            return implode($html);
	}
        
}