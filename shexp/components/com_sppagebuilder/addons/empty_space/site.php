<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonEmpty_space extends SppagebuilderAddons{

	public function render() {

		$class  = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->hidden_md) && $this->addon->settings->hidden_md) ? ' sppb-hidden-md sppb-hidden-lg' : '';
		$class .= (isset($this->addon->settings->hidden_sm) && $this->addon->settings->hidden_sm) ? ' sppb-hidden-sm' : '';
		$class .= (isset($this->addon->settings->hidden_xs) && $this->addon->settings->hidden_xs) ? ' sppb-hidden-xs' : '';

		return '<div class="sppb-empty-space ' . $class . ' clearfix"></div>';
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$gap = (isset($this->addon->settings->gap) && $this->addon->settings->gap) ? 'padding-bottom: ' . (int) $this->addon->settings->gap . 'px;': '';

		if($gap) {
			$css = $addon_id . ' .sppb-empty-space {';
			$css .= $gap;
			$css .= '}';
		}

		return $css;
	}

}
