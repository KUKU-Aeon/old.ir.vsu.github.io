<?php
/**
 * @package     perfectdashboard
 * @version     1.2.0
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

// load libraries
define('JPATH_LIBRARIES_DASHBOARD', dirname(__FILE__) . '/libraries');

JLoader::import('joomla.http.transport', JPATH_LIBRARIES_DASHBOARD);
JLoader::register('JHttpTransport', JPATH_LIBRARIES_DASHBOARD.'/joomla/http/transport.php', true);

JLoader::import('joomla.http.transport.curl', JPATH_LIBRARIES_DASHBOARD);
JLoader::register('JHttpTransportCurl', JPATH_LIBRARIES_DASHBOARD.'/joomla/http/transport/curl.php', true);

JLoader::import('joomla.http.transport.socket', JPATH_LIBRARIES_DASHBOARD);
JLoader::register('JHttpTransportSocket', JPATH_LIBRARIES_DASHBOARD.'/joomla/http/transport/socket.php', true);

JLoader::import('joomla.http.transport.stream', JPATH_LIBRARIES_DASHBOARD);
JLoader::register('JHttpTransportStream', JPATH_LIBRARIES_DASHBOARD.'/joomla/http/transport/stream.php', true);

if (version_compare(JVERSION, '2.5.15') == -1)
{
	JLoader::import('joomla.http.factory', JPATH_LIBRARIES_DASHBOARD);
	JLoader::register('JHttpFactory', JPATH_LIBRARIES_DASHBOARD.'/joomla/http/factory.php', false);
}

JLoader::register('JArchive', JPATH_LIBRARIES_DASHBOARD.'/joomla/archive/archive.php', true);
JLoader::discover('PerfectdashboardArchive', JPATH_LIBRARIES_DASHBOARD.'/joomla/archive/adapters');

// load helpers
JLoader::register('PerfectDashboardHelper', JPATH_ROOT.'/components/com_perfectdashboard/helpers/helper.php');
JLoader::register('PerfectDashboardJInstaller', JPATH_ROOT.'/components/com_perfectdashboard/helpers/installer.php');
JLoader::register('PerfectDashboardHelperTest', JPATH_ROOT.'/components/com_perfectdashboard/helpers/test.php');

require_once JPATH_ADMINISTRATOR.'/components/com_perfectdashboard/version.php';

$controller = JControllerLegacy::getInstance('Perfectdashboard');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
