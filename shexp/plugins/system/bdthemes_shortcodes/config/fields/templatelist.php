<?php

/**
 * BDThemes Shortcode Ultimate 
 *
 * @package		Shortcode Ultimate Joomla 3.0
 * @subpackage	BDThemes Schortcodes
 * @copyright Copyright (C) 2011-2014 BDThemes Ltd. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @author BDThemes
 * @author url http://bdthemes.com
 * 
 */

// No direct access.
defined('JPATH_BASE') or die;

/**
 * Renders a filelist element
 *
 * @package		Joomla.Framework
 * @subpackage	Parameter
 * @since		1.5
 */

class JFormFieldTemplatelist extends JFormField
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	protected $type = 'Templatelist';

	protected function getInput()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('template AS value, title AS text, id');
		$query->from('`#__template_styles`');
		$query->where('`client_id` = 0');
		$query->order('`id` ASC');
		$db->setQuery($query);

		$rows = $db->loadObjectList();

		$this->multiple = false;

		//print_r($rows);

		return JHtml::_('select.genericlist', $rows, $this->getName($this->fieldname),
			array(
				'id' => $this->id,
				'list.attr' => 'class="inputbox" size="'. count($rows). '"',
				'list.select' => $this->value
			)
		);
	}
}