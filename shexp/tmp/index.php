<?php
/**
 * @package   Gantry 5 Theme
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2016 RocketTheme, LLC
 * @license   GNU/GPLv2 and later
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

defined('_JEXEC') or die;

// Bootstrap Gantry framework or fail gracefully (inside included file).
$gantry = include __DIR__ . '/includes/gantry.php';

/** @var \Gantry\Framework\Theme $theme */
$theme = $gantry['theme'];

/** @var \Gantry\Framework\Outlines $outlines */
$outlines = $gantry['outlines'];

// All the custom twig variables can be defined in here:
$context = array();

// Render the page.
echo $theme->render('index.html.twig', $context);

//include_once dirname(__FILE__).'/jf/jf_particle_unset.php';
include_once (dirname(__FILE__).'/jf/jf_tools.php');