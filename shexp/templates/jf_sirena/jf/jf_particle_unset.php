<?php
/**
* @version		JF_PDT_090
* @author		JoomForest http://www.joomforest.com
* @copyright	Copyright (C) 2011-2016 JoomForest.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Error Report
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);


/*#######
#########
##  1  ##	[FIGUREOUT]
#########
#######*/
/** START ---------------------------------------------------------------------------------------------------------------------------------*/
	$jf_unset_doc 			= JFactory::getDocument();
	$jf_unset_headerdata 	= $jf_unset_doc->getHeadData();
	$jf_unset_styleSheets 	= $jf_unset_headerdata['styleSheets'];
	$jf_unset_scripts 		= $jf_unset_headerdata['scripts'];
/** END   ---------------------------------------------------------------------------------------------------------------------------------*/



/*#######
#########
##  2  ##	[UNSET ELEMENTS]
#########
#######*/
/** START ---------------------------------------------------------------------------------------------------------------------------------*/
	foreach ($jf_unset_styleSheets as $url => $type) {
		// UNSET - jf_typo.min.css			- Stylesheet is added MANUALLY in PARTICLE
			if (preg_match('/custom\/css-compiled\/jf_typo/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_waves.min.css			- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_waves/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_buttons.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_buttons/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_tabs.min.css			- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_tabs/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_acc_toggl.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_acc_toggl/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_dropdowns.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_dropdowns/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_dialogs.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_dialogs/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_pricing.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_pricing/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_cards.min.css			- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_cards/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_messages.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_messages/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_social_icons.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_social_icons/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_tooltips.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_tooltips/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - bs_buttons.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/bs_buttons/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - bs_modals.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/bs_modals/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - bs_dropdowns.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/bs_dropdowns/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - bs_popovers.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/bs_popovers/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - bs_carousels.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/bs_carousels/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_css3_anim.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_css3_anim/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_flip_boxes.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_flip_boxes/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_parallax.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_parallax/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_lightboxes.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_lightboxes/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_img_hovers.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_img_hovers/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_hotspots.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_hotspots/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_carousels.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_carousels/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_testimonials.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_testimonials/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_icon_lists.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_icon_lists/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_icon_boxes.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_icon_boxes/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_counters.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_counters/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_progress_bars.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_progress_bars/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_process_steps.min.css- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_process_steps/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_pies_inf.min.css		- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_pies_inf/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_charts.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_charts/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
		// UNSET - jf_graphs.min.css	- Stylesheet is added MANUALLY in PARTICLE	
			if (preg_match('/custom\/css-compiled\/jf_graphs/i', $url) && preg_match('/\?/i', $url)) {
				unset($this->_styleSheets[$url]);
				// $jf_doc->addScriptDeclaration('alert("jf_particle_unset.php - boom + '.$url.'");');
			}
	}
/** END   ---------------------------------------------------------------------------------------------------------------------------------*/