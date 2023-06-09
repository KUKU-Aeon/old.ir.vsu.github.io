<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_empty_space',
		'category'=>'Deprecated',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_DESC'),
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'gap'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EMPTY_SPACE_GAP_DESC'),
					'std'=>'20'
				),

				'hidden_md'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD_DESC'),
				),

				'hidden_sm'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM_DESC'),
				),

				'hidden_xs'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS_DESC'),
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),

			),
		),
	)
);
