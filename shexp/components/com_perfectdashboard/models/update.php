<?php
/**
 * @package     perfectdashboard
 * @version     1.4.6
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

jimport('joomla.updater.update');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

class PerfectdashboardModelUpdate extends JModelLegacy
{
    protected $type;
    protected $element;
    protected $folder = null;
    protected $client_id = null;
    protected $site_root = '';

    public function __construct($config)
    {
        parent::__construct($config);

        try {
            $this->site_root = JPath::clean(JPATH_ROOT);
        } catch (Exception $e) {}
    }

    public function setExtension($type, $slug)
    {
        if ($slug == 'joomla' && $type == 'cms') {
            $type = 'file';
        } elseif ($type == 'plugin') {
            list($this->folder, $slug) = explode('/', $slug, 2);
        } elseif (in_array($type, array('module', 'language', 'template'))) {
            if (strpos($slug, 'admin/') === 0) {
                $this->client_id = 1;
                list(, $slug) = explode('/', $slug, 2);
            } else {
                $this->client_id = 0;
            }
        }
        $this->type = $type;
        $this->element = $slug;
    }
    /**
     * Get extension id basing on slug (element in extensions db table).
     *
     * @param   string  $slug  Element name
     *
     * @return  mixed   int with extension id or boolean on failure
     */
    public function getExtensionId()
    {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('extension_id')
            ->from('#__extensions');
	
        if ($this->folder !== null) {
            $query->where($db->quoteName('folder') . ' = ' . $db->quote($this->folder));
        }
        if ($this->client_id !== null) {
            $query->where($db->quoteName('client_id') . ' = ' . $db->quote($this->client_id));
        }

        $query->where($db->quoteName('type') . ' = ' . $db->quote($this->type))
            ->where($db->quoteName('element') . ' = ' . $db->quote($this->element));

        $db->setQuery($query);

        try {
            $result = $db->loadResult();		
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }

    /**
     * Get extension update id basing on extension id .
     *
     * @param   int  $eid  Extension id
     *
     * @return  mixed   int with update id or boolean on failure
     */
    public function getUpdateId($eid)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('update_id')
            ->from('#__updates');
		
        if(!is_null($eid)) {
            $query->where('extension_id = '.(int) $eid);
        } else {
            
            if ($this->folder !== null) {
                $query->where($db->quoteName('folder') . ' = ' . $db->quote($this->folder));
            }
            if ($this->client_id !== null) {
                $query->where($db->quoteName('client_id') . ' = ' . $db->quote($this->client_id));
            }

            $query->where($db->quoteName('type') . ' = ' . $db->quote($this->type))
                ->where($db->quoteName('element') . ' = ' . $db->quote($this->element));
        }

        $db->setQuery($query);

        try {
            $result = $db->loadResult();
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }

    /**
     * Method to download package.
     *
     * @param   string  $type  Extension type
     * @param   string  $slug  Extension slug
     * @param   string   $file  Extension package file
     * @param   int $prepared Whether the link was completely prepared on Perfect Dashboard (0/1)
     *
     * @return  array   array with status info and message
     */
    public function download($file, $prepared)
    {
        if ($this->element == 'joomla' && $this->type == 'file') {
            $prepared = true;
            $cms = true;
        } else {
            $cms = false;
        }

        if(empty($file)){
            return array('status' => 0, 'message' => 'invalid_package');
        }
        $url = call_user_func('ba' . 'se' . '64' . '_decode', $file);

        if(!$url){
            return array('status' => 0, 'message' => 'invalid_package');
        }
		        
      	$target = JInstallerHelper::getFilenameFromURL($url);

		if (strpos($target, '?') !== false) {
		    $target = 'dummy.zip';
		}

        if(!$prepared && version_compare(JVERSION, '3.2.2', '>=')){
            //Check for extra query
            try{

                $db = JFactory::getDbo();
                $q = $db->getQuery(true);
                $q
                    ->select('us.extra_query')
                    ->from('#__update_sites AS us')
                    ->innerJoin('#__update_sites_extensions AS us1 ON us1.update_site_id = us.update_site_id')
                    ->innerJoin('#__extensions AS ex ON us1.extension_id = ex.extension_id')
                    ->where(array(
                        'ex.type = ' . $db->q($this->type),
                        'ex.element = ' . $db->q($this->element)
                    ));
                if ($this->folder !== null) {
                    $q->where('ex.folder = '.$db->q($this->folder));
                }
                if ($this->client_id !== null) {
                    $q->where('ex.client_id = '.$db->q((int) $this->client_id));
                }
                $db->setQuery($q);
                $extra_query = $db->loadResult();
                $url .= !empty($extra_query) ? '&' . $extra_query : ''; //All download links come with ?perfect=dashboard
            }
            catch(Exception $e){
                //It looks like the upgrade to 3.2.2 was broken.
                //Ignoring exceptions is not a good idea, but what can you do.
            }
        }
        
        $results = self::downloadPackage($url, $target, $cms);
        
        if($results['success'] == 1) {
        	$p_file = $results['name'];
        }

        // Was the package downloaded?
        if (empty($p_file)) {
            $debug = empty($results['debug']) ? null : $results['debug'];
            return array('status' => 0, 'message' => 'download_error', 'debug' => $debug);
        }

        $p_file = call_user_func('ba' . 'se' . '64' . '_encode', $p_file);

        return array('status' => 1, 'return' => $p_file);
    }

    /**
     * Method to upack package.
     *
     * @param   string  $server_return The `return` value from the last step (i.e. download)
     *
     * @return  array   array with status info and message
     */
    public function unpack($server_return)
    {
        $p_file = call_user_func('ba'.'se'.'64'.'_decode', $server_return);

        $config   = JFactory::getConfig();
        $tmp_dest = $config->get('tmp_path');

        if ($this->element == 'joomla' && $this->type == 'file') {

            // Unpack Joomla to the root path of CMS
            try {
                $extract = JArchive::extract($tmp_dest.'/'.$p_file, JPATH_ROOT);
            } catch (Exception $e) {
                // Setting here install_error instead of unpack_error will enable rollback button in Perfect Dashboard app *
                return array('status' => 0, 'message' => 'install_error',
                    'debug' => PerfectDashboardHelper::getDebugInfo('jarchive_error',
                    array('archive' => $tmp_dest.'/'.$p_file), $e));
            }

            if ($extract !== true) {
                // Setting here install_error instead of unpack_error will enable rollback button in Perfect Dashboard app *
                return array('status' => 0, 'message' => 'install_error',
                    'debug' => PerfectDashboardHelper::getDebugInfo('jarchive_error',
                        array('archive' => $tmp_dest.'/'.$p_file)));
            } else {
                $return = array(
                    'extractdir' => null,
                    'packagefile' => $p_file,
                    'type' => 'file'
                );
            }
            // * Which seems to be right thing, because we are overriding site files.
        } else {
            // Unpack the downloaded package file
            $package = $this->unpackFile($tmp_dest.'/'.$p_file);

            if (!empty($package->error_type)) {
                return array('status' => 0, 'message' => 'unpack_error', 'debug' => $package);
            }

            $return = array(
                'extractdir' => basename($package->extract_dir),
                'packagefile' => basename($package->archive),
                'dir' => basename($package->dir)
            );
        }

        // Serialize response and encode it.
        $return = call_user_func('ba'.'se'.'64'.'_encode', json_encode($return));

        return array('status' => 1, 'return' => $return);
    }

    /**
     * Method to update extension.
     *
     * @param   string  $type  Extension type
     * @param   string  $slug  Extension slug
     * @param   string  $return  Return info (serialized and encoded) from unpack method
     *
     * @return  array   array with status info and message
     */
    public function update($return)
    {
        // Decode and unserialize return info.
        $return = json_decode(call_user_func('ba'.'se'.'64'.'_decode', $return), true);

        // Check if return info is valid.
        if (!is_array($return) || empty($return['packagefile'])) {
            return array('status' => 0, 'message' => 'wrong_entry_params',
                'debug' => PerfectDashboardHelper::getDebugInfo('wrong_return_params'));
        }

        if ($this->type == 'file' && $this->element == 'joomla') {

            // Save downloaded filename for clean up
            JFactory::getApplication()->setUserState('com_joomlaupdate.file', $return['packagefile']);

            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_joomlaupdate/models', 'JoomlaupdateModel');
            $model = JModelLegacy::getInstance('default', 'JoomlaupdateModel');

            // Update Joomla
            try {
                if (!$model->finaliseUpgrade()) {

                    // Get the same installer instance as in above finaliseUpgrade method
                    if (version_compare(JVERSION, '3.4', '>=')) {
                        $installer = JInstaller::getInstance(JPATH_ADMINISTRATOR.'/components/com_joomlaupdate/models');
                    } else {
                        $installer = JInstaller::getInstance();
                    }
                    return array('status' => 0, 'message' => 'install_error', 'debug' => PerfectDashboardHelper::getDebugInfo(
                        'finalise_upgrade_return_false', array('archive' => $return['packagefile'], 'installer_message' => $installer->message)));
                }
            } catch (Exception $ex) {
                return array('status' => 0, 'error_code' => 1, 'message' => 'install_error',
                    'debug' => PerfectDashboardHelper::getDebugInfo('finalise_upgrade_exception',
                        array('archive' => $return['packagefile']), $ex));
            }

            $model->cleanUp();
        } else {

            // Check if return info is valid.
            if (empty($return['extractdir']) || empty($return['dir'])) {
                $extract_dir = empty($return['extractdir']) ? null : $return['extractdir'];
                return array('status' => 0, 'message' => 'wrong_entry_params',
                    'debug' => PerfectDashboardHelper::getDebugInfo('wrong_return_params',
                        array('archive' => $return['packagefile'], 'extract_dir' => $extract_dir)));
            }

            $extract_dir  = $return['extractdir'];
            $dir          = $return['dir'];
            $package_file = $return['packagefile'];

            $config   = JFactory::getConfig();
            $tmp_dest = $config->get('tmp_path');

            // Add tmp_path to return info folders and files.
            if ($dir != $extract_dir) {
                // If dir is not equal extractdir then there are different folders (dir is in extractdir).
                $dir = JPath::clean($tmp_dest.'/'.$extract_dir.'/'.$dir);
            } else {
                // If dir is equal extractdir then there are the same folder.
                $dir = JPath::clean($tmp_dest.'/'.$dir);
            }
            $extract_dir  = JPath::clean($tmp_dest.'/'.$extract_dir);
            $package_file = JPath::clean($tmp_dest.'/'.$package_file);

            $installer = PerfectDashboardJInstaller::getInstance();

            // Install the package
            try {
                if (!$installer->update($dir)) {
                    PerfectDashboardHelperTest::testFilesWriteAbilityForExtension($installer);

                    return array('status' => 0, 'message' => 'install_error',
                        'debug' => PerfectDashboardHelper::getDebugInfo('jinstaller_error',
                            array('message' => $installer->message, 'archive' => $package_file, 'extract_dir' => $extract_dir)));
                }
            } catch (Exception $ex) {
                PerfectDashboardHelperTest::testFilesWriteAbilityForExtension($installer);

                return array('status' => 0, 'error_code' => 1, 'message' => 'install_error',
                    'debug' => PerfectDashboardHelper::getDebugInfo('jinstaller_exception',
                        array('archive' => $package_file, 'extract_dir' => $extract_dir), $ex));
            }

            // Cleanup the install files
            if (!is_file($package_file)) {
                $package_file = $tmp_dest.'/'.$package_file;
            }

            JInstallerHelper::cleanupInstall($package_file, $extract_dir);

            // Remove update of this extension from updates db table. // Check if this is neccessary
            $eid = $this->getExtensionId();
            $uid = $this->getUpdateId($eid);
            if (empty($uid)) {
                $uid = $this->getUpdateId(null);
            }

            $update_row = JTable::getInstance('update');
            try {
                $update_row->delete($uid);
            } catch (Exception $ex) {
                
            }
        }

        return array('status' => 1);
    }

    public function renameConversionFiles($from, $to, $extract_dir = null)
    {
        if ($extract_dir) {
            $config = JFactory::getConfig();
            $root   = JPath::clean($config->get('tmp_path').'/'.$extract_dir);
        } else {
            $root = JPATH_ROOT;
        }
        $files = JFolder::files($root.'/administrator/components/com_admin/sql/others/mysql',
                '.+'.str_replace('.', '\.', $from).'$', false, true);
        if (!empty($files)) {
            foreach ($files as $file) {
                $dest = substr($file, 0, 0 - strlen($from)).$to;
                JFile::move($file, $dest);
            }
        }
    }

    /**
     * Get url of update site.
     *
     * @param type $eid Extension id.
     * @return boolean
     */
    public function getUpdateSiteLocation($eid)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('location, type')
            ->from($db->quoteName('#__update_sites', 'us'))
            ->innerJoin($db->quoteName('#__update_sites_extensions', 'use').' ON us.update_site_id = use.update_site_id')
            ->where('use.extension_id = '.(int) $eid);

        $db->setQuery($query);

        try {
            $result = $db->loadObject();
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
    
    /*
     * Method to download the package
     */
    static function downloadPackage($url, $target = false, $cms = false)
	{
		$config = JFactory::getConfig();
		// Capture PHP errors
		$track_errors = ini_get('track_errors');
		ini_set('track_errors', true);
		// Set user agent
		$version = new JVersion;
		ini_set('user_agent', $version->getUserAgent('Installer'));
		$http = JHttpFactory::getHttp();
		// Load installer plugins, and allow url and headers modification
		$headers = array();
		JPluginHelper::importPlugin('installer');

        if ($cms !== true) {
            if (version_compare(JVERSION, '3.0.0', '<')) {
                $dispatcher = JDispatcher::getInstance();
            } else {
                $dispatcher = JEventDispatcher::getInstance();
            }
            $dispatcher->trigger('onInstallerBeforePackageDownload', array(&$url, &$headers));
        }
		try
		{
			$response = $http->get($url, $headers);
		}
		catch (Exception $exception)
		{
			JLog::add(JText::sprintf('JLIB_INSTALLER_ERROR_DOWNLOAD_SERVER_CONNECT', $exception->getMessage()), JLog::WARNING, 'jerror');
			
			return array(
				'success' => 0,
				'name' => '',
                'debug' => PerfectDashboardHelper::getDebugInfo('http_request_failed', null, $exception)
			);
		}

        if (in_array($response->code, array(301, 302, 303)) && isset($response->headers['Location']))
		{
			return self::downloadPackage($response->headers['Location']);
		}
		elseif (200 != $response->code)
		{
			JLog::add(JText::sprintf('JLIB_INSTALLER_ERROR_DOWNLOAD_SERVER_CONNECT', $response->code), JLog::WARNING, 'jerror');
			
			return array(
				'success' => 0,
				'name' => '',
                'debug' => PerfectDashboardHelper::getDebugInfo('http_request_failed', array('code' => $response->code))
			);
		}
		// Parse the Content-Disposition header to get the file name
		if (isset($response->headers['Content-Disposition'])
			&& preg_match("/\s*filename\s?=\s?(.*)/", $response->headers['Content-Disposition'], $parts))
		{
			$target = trim(rtrim($parts[1], ";"), '"');
		}
		// Set the target path if not given
		if (!$target)
		{
			$target = $config->get('tmp_path') . '/' . JInstallerHelper::getFilenameFromUrl($url);
		}
		else
		{
			$target = $config->get('tmp_path') . '/' . basename($target);
		}

		// Write buffer to file
		if (!JFile::write($target, $response->body)) {
            $error_flag = false;
            PerfectDashboardHelperTest::checkPathWriteAbility($target, $target, $error_flag, true);

            return array(
                'success' => 0,
                'name' => '',
                'debug' => PerfectDashboardHelper::getDebugInfo('unable_to_write_entry')
            );
        }
		// Restore error tracking to what it was before
		ini_set('track_errors', $track_errors);
		// Bump the max execution time because not using built in php zip libs are slow
		@set_time_limit(ini_get('max_execution_time'));
		// Return the name of the downloaded package
		return array(
			'success' => 1,
			'name' => basename($target),
		);
	}

    /*
     * Unpacks a file (based on /libraries/cms/installer/helper.php)
     */
    public function unpackFile($p_filename)
    {
        // Path to the archive
        $archivename = $p_filename;

        // Temporary folder to extract the archive into
        $tmpdir = uniqid('install_');

        // Clean the paths to use for archive extraction
        $extractdir = JPath::clean(dirname($p_filename) . '/' . $tmpdir);
        $archivename = JPath::clean($archivename);

        // Do the unpacking of the archive
        try {
            $extract = JArchive::extract($archivename, $extractdir);
        }
        catch (Exception $e) {
            return PerfectDashboardHelper::getDebugInfo('jarchive_error',
                array('archive' => $archivename, 'extract_dir' => $extractdir), $e);
        }

        if (empty($extract)) {
            return PerfectDashboardHelper::getDebugInfo('jarchive_error',
                array('archive' => $archivename, 'extract_dir' => $extractdir));
        }

        $response              = new stdClass();
        $response->archive     = $archivename;
        $response->extract_dir = $extractdir;

        $dirList = array_merge((array) JFolder::files($extractdir, ''), (array) JFolder::folders($extractdir, ''));

        if (count($dirList) == 1) {
            if (JFolder::exists($extractdir . '/' . $dirList[0])) {
                $extractdir = JPath::clean($extractdir . '/' . $dirList[0]);
            }
        }

        $response->dir         = $extractdir;
        $response->type        = JInstallerHelper::detectType($extractdir);

        if (!$response->type) {
            return PerfectDashboardHelper::getDebugInfo('could_not_detect_extension_type',
                array('archive' => $archivename, 'extract_dir' => $extractdir));
        }

        return $response;
    }
}
