<?php
/**
 * @package     perfectdashboard
 * @version     1.4.1
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

/**
 * Perfect Dsashboard Component Controller
 */
class PerfectdashboardController extends JControllerLegacy
{
    public $japp;
    public $jinput;

    /**
     * Constructor.
     */
    public function __construct($config = array())
    {
        $config['default_task'] = 'undefinedTask';
        parent::__construct($config);

        // There were lot of warnings during request for J!3.0.0
        if (version_compare(JVERSION, '3.1') == -1) {
            call_user_func('error'.'_report'.'ing', 0);
        }

        $this->japp   = JFactory::getApplication();
        $this->jinput = $this->japp->input;

        // Set default language.
        $lang = JFactory::getLanguage();
        $lang->setDefault('en-GB');
        $lang->setLanguage('en-GB');
        $lang->load();

        // Set headers and flush them before japp->close()
        if (version_compare(JVERSION, '3.2') == -1) {
            JResponse::setHeader('Content-Type', 'application/json');
            JResponse::sendHeaders();
        } else {
            $this->japp->setHeader('Content-Type', 'application/json');
            $this->japp->sendHeaders();
        }

        $this->setDefaultDbo();

        $this->checkAuthentication();
    }

    private function savePing()
    {

        // grab components params
        $com_params = PerfectDashboardHelper::getChildParams();
        // grab date
        $date       = new DateTime('now');
        // set ping
        $com_params->set('ping', $date->format('d-m-Y H:i:s'));

        //save
        $table = JTable::getInstance('extension');
        $table->load(array('type' => 'component', 'element' => 'com_perfectdashboard'));
        $table->bind(array('params' => $com_params->toString()));

        $table->check();
        $table->store();
    }

    /**
     * Will echo out the response in JSON format, adding some metadata (as of 1.0 - just the version) and close the application with the supplied code (defaults to 0)
     * @param array|object $data Response data to be encoded
     * @param int $code (optional) Code to pass to JApplication::close
     *
     * @return void
     */
    private function respond($data, $code = 0)
    {
        if (is_array($data)) {
            $data = array_merge($data,
                array(
                'metadata' => array(
                    'version' => PERFECTDASHBOARD_VERSION
                )
            ));
        } elseif (is_object($data)) {
            $data->metadata = array(
                'version' => PERFECTDASHBOARD_VERSION
            );
        }
        echo '###'.json_encode($data).'###';
        $this->japp->close($code);
    }

    public function undefinedTask()
    {
        $this->respond(array('state' => 0, 'message' => 'Undefined task: '.$this->jinput->get('task')));
    }

    /**
     * Method to get extensions info.
     */
    public function getExtensions()
    {
        // Get extensions model.
        $model = $this->getModel('extensions');

        // Get extensions update info from model.
        $extensions = $model->getExtensions();

        // Client response.
        $this->respond($extensions);
    }

    public function getLatestBackup()
    {
        $filename = basename($this->jinput->get('filename'));

        if (empty($filename)) {
            $latest_backup = $this->getLatestBackupInfo();

            $lastModFile = $latest_backup->path;
        } else {
            jimport('joomla.filesystem.file');

            $akeeba_path = $this->getBackupToolPath().'backups/';

            $lastModFile = $akeeba_path.$filename;

            if (!JFile::exists($lastModFile)) {
                $this->respond(array('state' => 0, 'message' => 'no files'), 1);
            }
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($lastModFile).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize($lastModFile));
        readfile($lastModFile);
        exit;
    }

    public function getLatestBackupName()
    {
        $latest_backup = $this->getLatestBackupInfo();

        if (!empty($latest_backup)) {
            $this->respond(array('state' => 1, 'id' => $latest_backup->id, 'filename' => $latest_backup->archivename, 'multipart' => $latest_backup->multipart));
        }
    }

    /**
     * Method to do update.
     */
    public function doUpdate()
    {
        //TODO: Handle Joomla older than 3.2.2
        // Get request data.
        $type          = $this->jinput->get('type');
        $slug          = $this->jinput->get('slug', null, 'string');
        $file          = $this->jinput->get('file', '', 'ba'.'se'.'64');
        $prepared      = $this->jinput->get('download_prepared', 0, 'int');
        $action        = $this->jinput->get('action');
        $server_return = $this->jinput->get('return', '', 'ba'.'se'.'64');


        // Get update model.
        $model = $this->getModel('update');
        $model->setExtension($type, $slug);

        // Initialize client response.
        $client_return = array();

        // Call model method basing on request action.
        switch ($action) {
            case 'download':
                $client_return = $model->download($file, $prepared);
                break;
            case 'unpack':
                $client_return = $model->unpack($server_return);
                // Prevent Joomla from converting database tables format
                if ($type == 'cms' && $slug == 'joomla' && !empty($client_return['extract_dir'])) {
                    // Rename SQL files for converting database tables format in install package
                    $model->renameConversionFiles('.sql', '.sql.bak', $client_return['extract_dir']);
                    // and in existing website
                    $model->renameConversionFiles('.sql', '.sql.bak');
                }

                PerfectDashboardHelper::cleanPhpCache();

                break;
            case 'update':
                $client_return = $model->update($server_return);
                if ($type == 'cms' && $slug == 'joomla') {
                    // Restore SQL files after update has finished
                    $model->renameConversionFiles('.sql.bak', '.sql');
                }
            default:
                break;
        }

        // Client response.
        $this->respond($client_return);
    }

    /**
     * Method to do get upgrade status.
     */
    public function getUpgradeStatus()
    {
        // Get request data.
        $versions = $this->jinput->get('versions', null, 'array');

        // Get extensions model.
        $model = $this->getModel('extensions');

        // Client response.
        $this->respond($model->getUpgradeStatus($versions));
    }

    public function getChecksum()
    {
        $checksum_array = PerfectDashboardHelperTest::getFilesChecksum(JPATH_ROOT);
        $this->respond(array('state' => 1, 'file_list' => call_user_func('ba'.'se'.'64'.'_encode',
                json_encode($checksum_array))));
    }

    /**
     * Method to check authentication.
     *
     * @return  boolean
     */
    public function checkAuthentication()
    {
        // Get key from component params.
        $com_params = PerfectDashboardHelper::getChildParams();
        $com_key    = $com_params->get('key');

        // Get key from request.
        $jinput_key = $this->jinput->get('secure_key');

        if (empty($jinput_key)) {
            $this->respond(array('state' => 0, 'message' => JText::_('COM_PERFECTDASHBOARD_AUTH_NO_VERIFICATION_KEY')),
                1);
        } else if ($com_key != $jinput_key) {
            $this->respond(array('state' => 0, 'message' => JText::_('COM_PERFECTDASHBOARD_AUTH_BAD_VERIFICATION_KEY')),
                1);
        }

        //save ping after authenticated connection
        $this->savePing();

        return true;
    }

    /**
     * Set CMS to offline.
     */
    public function cmsDisable()
    {
        if (version_compare(JVERSION, '3.2') != -1) {
            require_once JPATH_ROOT.'/components/com_config/model/cms.php';
            require_once JPATH_ROOT.'/components/com_config/model/form.php';

            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_config/model/');
        } else {
            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_config/models/');
        }

        // check sh404sef extension and check if is enabled
	    $shef_on  = 0;
	    $sh404sef = JComponentHelper::getParams('com_sh404sef');
	    if ($sh404sef->get('Enabled', false))
	    {
		    $sh404sef->set('Enabled', 0);
		    $db = JFactory::getDbo();
		    $db->setQuery('UPDATE #__extensions SET params = ' . $db->q($sh404sef->toString()) . ' where element = "com_sh404sef"')->execute();
		    $shef_on = 1;
	    }

        $config_model = JModelLegacy::getInstance('Application', 'ConfigModel');

        $data            = $config_model->getData();
        $data['offline'] = 1;

        $result = $config_model->save($data);
        PerfectDashboardHelper::cleanPhpCache();

	    if ($result) {
		    $this->respond(array('state' => 1, 'shef_on' => $shef_on));
	    } else {
		    $this->respond(array('state' => 0, 'shef_on' => $shef_on, 'error_code' => 0));
	    }
    }

    /**
     *  Set CMS to online.
     */
    public function cmsEnable()
    {
        if (version_compare(JVERSION, '3.2') != -1) {
            require_once JPATH_ROOT.'/components/com_config/model/cms.php';
            require_once JPATH_ROOT.'/components/com_config/model/form.php';

            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_config/model/');
        } else {
            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_config/models/');
        }

        $config_model = JModelLegacy::getInstance('Application', 'ConfigModel');

        $data            = $config_model->getData();
        $data['offline'] = 0;

        // Check if all necessary data is set.
        $check_data         = new JRegistry($data);
        $data['ftp_enable'] = $check_data->get('ftp_enable', '0');
        $data['ftp_host']   = $check_data->get('ftp_host', '');
        $data['ftp_port']   = $check_data->get('ftp_port', '');
        $data['ftp_user']   = $check_data->get('ftp_user', '');
        $data['ftp_pass']   = $check_data->get('ftp_pass', '');
        $data['ftp_root']   = $check_data->get('ftp_root', '');

        $result = $config_model->save($data);
        PerfectDashboardHelper::cleanPhpCache();

	    $shef_on = 0;
	    if(JFactory::getApplication()->input->get('sh404sef', false))
	    {
		    $sh404sef = JComponentHelper::getParams('com_sh404sef');
		    if ($sh404sef->get('Enabled', false) !== false)
		    {
			    $sh404sef->set('Enabled', 1);
			    $db = JFactory::getDbo();
			    $db->setQuery('UPDATE #__extensions SET params = ' . $db->q($sh404sef->toString()) . ' where element = "com_sh404sef"')->execute();
			    $shef_on = 1;
		    }
	    }

	    if ($result) {
		    $this->respond(array('state' => 1, 'shef_on' => $shef_on));
	    } else {
		    $this->respond(array('state' => 0, 'shef_on' => $shef_on, 'error_code' => 0));
	    }
    }

    /**
     * Disable given extensions.
     */
    public function extensionDisable()
    {
        $extensions = $this->jinput->get('extensions', null, 'array');

        // Get extensions model.
        $model = $this->getModel('extensions');

        if ($model->disableExtensions($extensions)) {
            $this->respond(array('state' => 1));
        } else {
            $this->respond(array('state' => 0, 'error_code' => 0));
        }
    }

    /**
     * Enable given extensions.
     */
    public function extensionEnable()
    {
        $extensions = $this->jinput->get('extensions', null, 'array');

        // Get extensions model.
        $model = $this->getModel('extensions');

        if ($model->enableExtensions($extensions)) {
            $this->respond(array('state' => 1));
        } else {
            $this->respond(array('state' => 0, 'error_code' => 0));
        }
    }

    public function beforeCmsUpdate()
    {
        for ($i = 0; $i < 2; $i++) {
            try {
                $this->fixDatabase();
            } catch (Exception $ex) {
                $this->respond(array('state' => 0, 'error_code' => 1, 'message' => 'fix_db_error', 'debug' => $ex->getMessage()));
                return;
            }
        }

        $this->flushAssets();

        $this->respond(array('state' => 1));
    }

    public function beforeCmsUpgrade()
    {
        $this->beforeCmsUpdate();
    }

    public function afterCmsUpdate()
    {
        for ($i = 0; $i < 2; $i++) {
            try {
                $this->fixDatabase();
            } catch (Exception $ex) {
                $this->respond(array('state' => 0, 'error_code' => 1, 'message' => 'fix_db_error', 'debug' => $ex->getMessage()));
                return;
            }
        }

        $this->purgeUpdates();
        $this->flushAssets();

        $this->respond(array('state' => 1));
    }

    public function afterCmsUpgrade()
    {
        $this->afterCmsUpdate();
    }

    /**
     * Fix database.
     * Almost the same code as in /administrator/components/com_installer/controllers/database.php fix method.
     */
    private function fixDatabase()
    {
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_installer/models', 'InstallerModel');
        $model = JModelLegacy::getInstance('Database', 'InstallerModel');
        $model->fix();
    }

    private function purgeUpdates()
    {
        JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_joomlaupdate/models', 'JoomlaupdateModel');
        $model = JModelLegacy::getInstance('default', 'JoomlaupdateModel');
        $model->purge();
    }

    private function flushAssets()
    {
        if (version_compare(JVERSION, '3.2') != -1) {
            // Refresh versionable assets cache
            JFactory::getApplication()->flushAssets();
        }
    }

    /**
     * Get system info.
     */
    public function sysInfo()
    {
        $db             = JFactory::getDbo();
		$config         = JFactory::getConfig();
        $security_audit = $this->jinput->getInt('security_audit');

        $additional_data = array();
        $database_name = null;
        $database_version = null;
        if ($security_audit) {
            jimport('joomla.filesystem.file');
            jimport('joomla.filesystem.folder');

            // Check if username admin exists.
            $query = $db->getQuery(true);
            $query->select($db->quoteName('id'))->from($db->quoteName('#__users'))
                ->where($db->quoteName('username').'='.$db->quote('admin'));

            $db->setQuery($query);

            try {
                $admin_user = $db->loadResult();
            } catch (Exception $e) {}

            // Check if somebody use one of popular passwords.
            $popular_passwords = array('123456', 'password', '12345678', 'qwerty', '12345', '123456789', 'football',
                '1234', '1234567', 'baseball', 'welcome', '1234567890', 'abc123', '111111', '1qaz2wsx', 'dragon',
                'master', 'monkey', 'letmein', 'login', 'princess', 'qwertyuiop', 'solo', 'passw0rd', 'starwars');

            // Get users only with core.login.admin access.
            // Get rules from root asset with information about connection between core.login.admin action and access level which can do this action.
            $query = $db->getQuery(true);
            $query->select($db->quoteName('rules'))->from($db->quoteName('#__assets'))
                ->where($db->quoteName('parent_id').'=0');

            $db->setQuery($query);

            $groups_with_backend = array();
            try {
                $root_rules = json_decode($db->loadResult(), true);
                if (!empty($root_rules['core.login.admin'])) {
                    foreach ($root_rules['core.login.admin'] as $group_id => $rule) {
                        if ($rule) {
                            $groups_with_backend[] = $group_id;
                        }
                    }
                }
                if (!empty($root_rules['core.admin'])) {
                    foreach ($root_rules['core.admin'] as $group_id => $rule) {
                        if ($rule) {
                            $groups_with_backend[] = $group_id;
                        }
                    }
                }
            } catch (Exception $e) {}

            // Get users from groups.
            if (!empty($groups_with_backend)) {
                $groups_with_backend = array_merge($groups_with_backend, $this->getChildrenOfGroups($groups_with_backend));

                $query = $db->getQuery(true);
                $query->select($db->quoteName('u.password'))->from($db->quoteName('#__users', 'u'))
                    ->innerJoin($db->quoteName('#__user_usergroup_map', 'uum').' ON uum.user_id=u.id')
                    ->where(array(
                        $db->quoteName('u.block') . '=0',
                        $db->quoteName('uum.group_id').' IN ('.implode(',', $groups_with_backend).')'
                    ));

                $db->setQuery($query);

                try {
                    $users_passwords = $db->loadColumn();
                } catch (Exception $e) {}

                if (!empty($users_passwords)) {
                    foreach ($users_passwords as $user_password) {
                        foreach ($popular_passwords as $popular_password) {
                            if (PerfectDashboardHelper::verifyPassword($popular_password, $user_password) === true) {
                                $popular_password_exist = true;
                                break 2;
                            }
                        }
                    }
                }
            }

            // Check if template can show module positions.
            $query = $db->getQuery(true);
            $query->select($db->quoteName('params'))->from($db->quoteName('#__extensions'))
                ->where(array($db->quoteName('name').'='.$db->quote('com_templates'), $db->quoteName('type').'='.$db->quote('component')));

            $db->setQuery($query);

            try {
                $com_templates_params = json_decode($db->loadResult());
                $template_positions_display = $com_templates_params->template_positions_display;
            } catch (Exception $e) {}

            // Check if any popular backup tool is installed, if yes then check if it's backup folder is accessible through http.
            $http                    = JHttpFactory::getHttp();
            $timeout                 = 3;
            $site_url                = JUri::root();
            $backups_http_accessible = array();

            // Check AKEEBA
            $backups_http_accessible = array_merge($backups_http_accessible, PerfectDashboardHelper::checkBackupsHttpAccessAkeeba($site_url, $http, $timeout));

            // Check EJB - Easy Joomla Backup
            $backups_http_accessible = array_merge($backups_http_accessible, PerfectDashboardHelper::checkBackupsHttpAccessEJB($site_url, $http, $timeout));

            // Check Xcloner
            $backups_http_accessible = array_merge($backups_http_accessible, PerfectDashboardHelper::checkBackupsHttpAccessXCloner($site_url, $http, $timeout));

            // At last - check Perfect Dashboard backups folder
            $backups_http_accessible = array_merge($backups_http_accessible, PerfectDashboardHelper::checkBackupsHttpAccessPerfectDashboard($site_url, $this->getBackupToolPath(), $http, $timeout));

            // Data for security audit - all results have value 1 if they are ok and 0 otherwise.
            $additional_data = array(
                'error_reporting' => $this->checkErrorReporting(),
                'expose_php' => ini_get('expose_php') ? 0 : 1,
                'allow_url_include' => ini_get('allow_url_include') ? 0 : 1,
                'database_prefix' => (int)($config->get('dbprefix') != 'jos_'),
                'database_user' => (int)($config->get('user') != 'root'),
                'debug_mode' => (int)(!$config->get('debug')),
                'readme_file' => (int)(!(JFile::exists(JPATH_ROOT.'/readme.txt') || JFile::exists(JPATH_ROOT.'/README.txt')
                    || JFile::exists(JPATH_ROOT.'/readme.html') || JFile::exists(JPATH_ROOT.'/README.html')
                    || JFile::exists(JPATH_ROOT.'/joomla.xml'))),
                'admin_user' => (int)empty($admin_user),
                'popular_password' => (int)empty($popular_password_exist),
                'template_positions_display' => (int)empty($template_positions_display),
                'installation_folder' => (int)(!JFolder::exists(JPATH_INSTALLATION)),
                'backups_http_accessible' => $backups_http_accessible,
            );
        }
        
        $query = $db->getQuery(true);
        $query->select('version()');
        $db->setQuery($query);
        
        try {
            $database_version_info = $db->loadResult();
        } catch(Exception $e) {
            $database_version_info = false;
        }        
        
        if($database_version_info) {
            $database_name = strpos(strtolower($database_version_info), 'mariadb') !== false ? 'MariaDB' : 'MySQL';
        } else {
            $database_name = $db->name;
        }
        
        $database_version = $db->getVersion();
        if($database_name == 'MariaDB' && $database_version_info) {
            $version = explode('-', $database_version_info);
            $database_version = empty($version) !== true ? $version[0] : $db->getVersion();
        }

        $query = $db->getQuery(true);
        $query->select('version()');
        $db->setQuery($query);
        
        try {
            $database_version_info = $db->loadResult();
        } catch(Exception $e) {
            $database_version_info = false;
        }        
        
        if($database_version_info) {
            $database_name = strpos(strtolower($database_version_info), 'mariadb') !== false ? 'MariaDB' : 'MySQL';
        } else {
            $database_name = $db->name;
        }
        
        $database_version = $db->getVersion();
        if($database_name == 'MariaDB' && $database_version_info) {
            $version = explode('-', $database_version_info);
            $database_version = empty($version) !== true ? $version[0] : $db->getVersion();
        }

        $this->respond(array(
            'state' => 1,
            'cms_type' => 'joomla',
            'cms_version' => JVERSION,
            'php_version' => PHP_VERSION,
            'os' => php_uname('s'),
            'server' => isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '',
            'database_name' => $database_name,
            'database_version' => $database_version,
            'additional_data' => $additional_data
        ));
    }

    /**
     * Recursive function to get all children of user's group.
     *
     * @param $groups
     * @return array|mixed
     */
    public function getChildrenOfGroups($groups)
    {
        static $counter = 10; // Max 10 levels of recursion for safety.

        $counter--;

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select($db->quoteName('id'))->from($db->quoteName('#__usergroups'))
            ->where($db->quoteName('parent_id').' IN ('.implode(',', $groups).')');

        $db->setQuery($query);

        try {
            $children = $db->loadColumn();
        } catch (Exception $e) {}

        if (empty($children) || empty($counter)) {
            return array();
        } else {
            $children_of_children = $this->getChildrenOfGroups($children);

            $children = array_merge($children, $children_of_children);

            return $children;
        }
    }

    /**
     * Check error_reporting
     */
    public function checkErrorReporting()
    {
        $config             = JFactory::getConfig();
        $statusInConfig     = $config->get('error_reporting');
        $statusInPHP        = ini_get('error_reporting');
        $statusInPHPdisplay = ini_get('display_errors');

        if ($statusInConfig == 'none') {
            return '1';
        }

        if ($statusInPHPdisplay == 0) {
            return '1';
        } elseif ($statusInPHPdisplay > 0 && $statusInPHP == 0) {
            return '1';
        }

        return '0';
    }

    /**
     * Check server environment.
     */
    public function checkSysEnv()
    {
        // Get request data.
        $php_ver_min = $this->jinput->get('php_ver_min');
        $php_ver_max = $this->jinput->get('php_ver_max');

        if (($php_ver_min && version_compare(PHP_VERSION, $php_ver_min) == -1) ||
            ($php_ver_max && version_compare(PHP_VERSION, $php_ver_max) == 1)) {
            $this->respond(array('state' => 0, 'message' => JText::sprintf('COM_PERFECTDASHBOARD_WRONG_PHP_VERSION',
                    PHP_VERSION, $php_ver_min, $php_ver_max)), 1);
        } else {
            $this->respond(array('state' => 1));
        }
    }

    public function installBackupTool()
    {
        $download_url = $this->jinput->get('download_url', null, 'ba'.'se'.'64');
        $install_dir  = $this->jinput->get('install_dir');
        $login        = $this->jinput->get('login');
        $password     = $this->jinput->get('password');
        $secret       = $this->jinput->get('secret');
        $version      = $this->jinput->get('version');
        $htaccess     = $this->jinput->get('htaccess');
        $update       = false;

        if (empty($download_url) || empty($install_dir) || empty($login) || empty($password) || empty($secret)) {
            $this->respond(array('state' => 0, 'message' => 'wrong_entry_params'));
        }

        $download_url = call_user_func('ba'.'se'.'64'.'_decode', $download_url);

        // Check if backup tool is already installed.
        $com_params     = PerfectDashboardHelper::getChildParams();
        $com_backup_dir = $com_params->get('backup_dir');

        if (!empty($com_backup_dir) && file_exists(JPATH_ROOT.'/'.$com_backup_dir.'/index.php')) {

            if ($install_dir != $com_backup_dir) {
                $prefix_db = $this->getAkeebaDbPrefix($com_backup_dir);
                $this->changeBackupAcces($login, $password, $secret, $prefix_db, $htaccess, $install_dir,
                    $com_backup_dir);
            }

            if (!empty($version) && file_exists(JPATH_ROOT.'/'.$com_backup_dir.'/version.php')) {
                include_once JPATH_ROOT.'/'.$com_backup_dir.'/version.php';
                if (defined('AKEEBA_VERSION') && version_compare(AKEEBA_VERSION, $version) < 1) {
                    $update = true;
                } elseif (defined('AKEEBABACKUP_VERSION') && version_compare(AKEEBABACKUP_VERSION, $version) < 1) {
                    $update = true;
                }
            }

            if (!$update) {
                $this->respond(array('state' => 1, 'message' => 'installed'));
            }
        }

        // Check if backup tool is already installed - for childs installed before version 1.1
        $com_ak_access = $com_params->get('ak_access');

        if (!empty($com_ak_access['ak_prefix_folder']) &&
            file_exists(JPATH_ROOT.'/'.$com_ak_access['ak_prefix_folder'].'perfectdashboard_akeeba'.'/index.php')) {

            $com_backup_dir = $com_ak_access['ak_prefix_folder'].'perfectdashboard_akeeba';
            if ($install_dir != $com_backup_dir) {
                $prefix_db = $com_ak_access['ak_prefix_db'];
                $this->changeBackupAcces($login, $password, $secret, $prefix_db, $htaccess, $install_dir,
                    $com_backup_dir);
            }

            if (!empty($version) && file_exists(JPATH_ROOT.'/'.$com_backup_dir.'/version.php')) {
                include_once JPATH_ROOT.'/'.$com_backup_dir.'/version.php';
                if (defined('AKEEBA_VERSION') && version_compare(AKEEBA_VERSION, $version) === -1) {
                    $update = true;
                } elseif (defined('AKEEBABACKUP_VERSION') && version_compare(AKEEBABACKUP_VERSION, $version) === -1) {
                    $update = true;
                }
            }

            if (!$update) {
                $this->respond(array('state' => 1, 'message' => 'installed'));
            }
        }

        //$p_file = JInstallerHelper::downloadPackage($download_url); // was
        if (!class_exists('PerfectdashboardModelUpdate')) {
            require_once JPATH_COMPONENT.'/models/update.php';
        }

        $results = PerfectdashboardModelUpdate::downloadPackage($download_url);

        if($results['success'] == 1) {
            $p_file = $results['name'];
        }

        // Was the package downloaded?
        if (empty($p_file)) {
            $debug = empty($results['debug']) ? null : $results['debug'];
            $this->respond(array('status' => 0, 'message' => 'download_error', 'debug' => $debug));
        }

        $config   = JFactory::getConfig();
        $tmp_dest = $config->get('tmp_path');

        $p_file = JPath::clean($tmp_dest.'/'.$p_file);

        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.archive');

        $prefix_db = 'as'.substr(md5(uniqid('backup_tool_tables')), 0, 5).'_'.'perfectdashboard_backup_tool_';

        $install_path = JPATH_ROOT.'/'.$install_dir.'/';

        try {
            $res_extract = JArchive::extract($p_file, $install_path);
        } catch (Exception $e) {
            // TODO - add deleting $install_path
            $this->respond(array('state' => 0, 'message' => 'unpack_error',
                'debug' => PerfectDashboardHelper::getDebugInfo('jarchive_error',
                    array('archive' => $p_file, 'extract_dir' => $install_path), $e)));
        }

        if ($res_extract) {
            if ($update) {
                $this->initAkeeba($install_dir, null, null, $secret, null, $htaccess);
            } else {
                $this->initAkeeba($install_dir, $login, $password, $secret, $prefix_db, $htaccess);
            }
        } else {
            // TODO - add deleting $install_path
            $this->respond(array('state' => 0, 'message' => 'unpack_error',
                'debug' => PerfectDashboardHelper::getDebugInfo('jarchive_error',
                    array('archive' => $p_file, 'extract_dir' => $install_path))));
        }

        JFile::delete($p_file);

        $this->respond(array('state' => 1, 'message' => $update ? 'updated' : 'installed'));
    }

    public function configureBackupTool()
    {
        $htaccess_param = $this->jinput->get('htaccess');
        $part_size      = $this->jinput->get('part_size', null, 'int');

        $install_dir = basename($this->getBackupToolPath());

        if (empty($install_dir)) {
            $this->respond(array('state' => 0, 'message' => 'missing install_dir'));
        }

        if ($this->initAkeeba($install_dir, null, null, null, null, $htaccess_param, $part_size)) {
            $this->respond(array('state' => 1, 'message' => 'configured'));
        }
    }

    protected function getBackupToolPath()
    {
        $com_params = PerfectDashboardHelper::getChildParams();
        $backup_dir = $com_params->get('backup_dir');

        // For childs installed before version 1.1
        if (empty($backup_dir)) {

            $old_params = $com_params->get('ak_access');
            if ($old_params) {

                $old_params = unserialize(call_user_func('ba'.'se'.'64'.'_decode', $old_params));
                $backup_dir = $old_params['ak_prefix_folder'].'perfectdashboard_akeeba';

                // Save the parameters
                $com_params->set('backup_dir', $backup_dir);
                $table = JTable::getInstance('extension');
                $table->load(array('type' => 'component', 'element' => 'com_perfectdashboard'));
                $table->bind(array('params' => $com_params->toString()));

                $table->check();
                $table->store();
            }
        }

        if ($backup_dir) {
            return JPATH_ROOT.'/'.$backup_dir.'/';
        }
        return null;
    }

    public function removeLastBackup()
    {
        jimport('joomla.filesystem.file');

        $last_backup_info = $this->getLatestBackupInfo();
        $deleted_all      = true;

        if (!JFile::delete($last_backup_info->path)) {
            $deleted_all = false;
        }

        if ($last_backup_info->multipart) {
            jimport('joomla.filesystem.folder');
            $akeeba_dir = $this->jinput->get('akeeba_dir', '', 'string');

            if (empty($akeeba_dir)) {
                $this->respond(array('state' => 0, 'message' => 'no akeeba_dir parameter'));
            }

            $backups_path = JPATH_ROOT.'/'.$akeeba_dir.'/backups/';

            $basename = pathinfo($last_backup_info->archivename, PATHINFO_FILENAME);
            $files    = JFolder::files($backups_path, '^'.$basename.'.*');

            if (is_array($files)) {
                foreach ($files as $file) {
                    if (!JFile::delete($backups_path.$file)) {
                        $deleted_all = false;
                    }
                }
            } else {
                $this->respond(array('state' => 0, 'message' => 'no multipart files'), 1);
            }
        }

        if ($deleted_all) {
            $this->respond(array('state' => 1));
        } else {
            $this->respond(array('state' => 0, 'message' => 'can not delete file'), 1);
        }
    }

    protected function changeBackupAcces($login, $password, $secret, $prefix_db, $htaccess_param = null, $dest,
                                         $src = null)
    {
        if (empty($src)) {
            $com_params     = PerfectDashboardHelper::getChildParams();
            $com_backup_dir = $com_params->get('backup_dir');

            if (!empty($com_backup_dir) && file_exists(JPATH_ROOT.'/'.$com_backup_dir.'/index.php')) {
                $src = $com_backup_dir;
            } else {
                $this->respond(array('state' => 0, 'message' => 'file not exists'), 1);
            }
        }

        jimport('joomla.filesystem.folder');
        if ($src == $dest OR JFolder::move($src, $dest, JPATH_ROOT) === true) {
            $this->initAkeeba($dest, $login, $password, $secret, $prefix_db, $htaccess_param);
        } else {
            $this->respond(array('state' => 0, 'message' => 'moving folder error'));
        }
    }

    protected function initAkeeba($backup_dir, $login = null, $password = null, $secret = null, $prefix_db = null,
                                  $htaccess_param = null, $part_size = null)
    {
        $jconfig     = JFactory::getConfig();
        $backup_path = JPATH_ROOT.'/'.$backup_dir.'/';

        // Include the autoloader
        if (false === (include $backup_path.'Awf/Autoloader/Autoloader.php')) {
            $this->respond(array('state' => 0, 'message' => 'include_autoloader_error'));
        }

        // Load the platform defines
        if (!defined('APATH_BASE')) {
            if (false === (include $backup_path.'defines.php')) {
                $this->respond(array('state' => 0, 'message' => 'include_defines_error'));
            }
        }

        // Add our app to the autoloader, if it's not already set
        $prefixes = Awf\Autoloader\Autoloader::getInstance()->getPrefixes();
        if (!array_key_exists('Solo\\', $prefixes)) {
            Awf\Autoloader\Autoloader::getInstance()->addMap('Solo\\', APATH_BASE.'/Solo');
        }

        // Include the Akeeba Engine factory
        if (!defined('AKEEBAENGINE')) {
            define('AKEEBAENGINE', 1);
            if (false == include $backup_path.'Solo/engine/Factory.php') {
                $this->respond(array('state' => 0, 'message' => 'include_engine_factory_error'));
            }

            if (file_exists($backup_path.'Solo/alice/factory.php')) {
                if (false == include $backup_path.'Solo/alice/factory.php') {
                    $this->respond(array('state' => 0, 'message' => 'include_alice_factory_error'));
                }
            }

            Akeeba\Engine\Platform::addPlatform('Solo', $backup_path.'Solo/Platform/Solo');
            Akeeba\Engine\Platform::getInstance()->load_version_defines();
            Akeeba\Engine\Platform::getInstance()->apply_quirk_definitions();
        }

        try {
            // Create the container if it doesn't already exist
            if (!isset($application)) {
                $application = \Awf\Application\Application::getInstance('Solo');
            }
            // Initialise the application
            $application->initialise();

            $container = $application->getContainer();

            $model_setup = new \Solo\Model\Setup();

            $session = $container->segment;

            $session->set('db_driver', $jconfig->get('dbtype', 'mysqli'));
            $session->set('db_host', $jconfig->get('host', 'localhost'));
            $session->set('db_user', $jconfig->get('user', ''));
            $session->set('db_pass', $jconfig->get('password', ''));
            $session->set('db_name', $jconfig->get('db', ''));
            $session->set('db_prefix', $prefix_db ? $prefix_db : $this->getAkeebaDbPrefix($backup_path));

            $model_setup->applyDatabaseParameters();

            if ($prefix_db !== null) {
                $model_setup->installDatabase();
            }

            $live_site = JUri::root(false).$backup_dir;

            $session->set('setup_timezone', 'UTC');
            $session->set('setup_live_site', $live_site);
            $session->set('setup_session_timeout', 1440);

            $session->set('setup_fs_driver', $jconfig->get('ftp_enable') ? 'ftp' : 'file');
            $session->set('setup_fs_host', $jconfig->get('ftp_host'));
            $session->set('setup_fs_port', $jconfig->get('ftp_port'));
            $session->set('setup_fs_username', $jconfig->get('ftp_user'));
            $session->set('setup_fs_password', $jconfig->get('ftp_pass'));
            $session->set('setup_fs_directory', $jconfig->get('ftp_root'));
            $session->set('setup_fs_ssl', false);
            $session->set('setup_fs_passive', true);

            if ($login && $password) {
                $session->set('setup_user_username', $login);
                $session->set('setup_user_password', $password);
                $session->set('setup_user_password2', $password);
                $session->set('setup_user_email', 'dashboard@perfectdashboard.co');
                $session->set('setup_user_name', 'Perfect Dashboard');
            }

            // Apply configuration settings to app config
            $model_setup->setSetupParameters();

            // Try to create the new admin user and log them in
            if ($login && $password) {
                $model_setup->createAdminUser();
            }

            // Set akeeba system configuration
            if ($secret) {
                $container->appConfig->set('options.frontend_enable', true);
                $container->appConfig->set('options.frontend_secret_word', $secret);
            } else {
                $secret = $container->appConfig->get('options.frontend_secret_word', null);
            }
            $container->appConfig->set('stats_enabled', 0);
            $container->appConfig->set('useencryption', 1);
            $container->appConfig->set('options.frontend_email_on_finish', false);
            $container->appConfig->set('options.displayphpwarning', false);
            $container->appConfig->set('options.siteurl', $live_site.'/');
            $container->appConfig->set('options.confwiz_upgrade', 0);
            $container->appConfig->set('mail.online', false);

            $container->appConfig->saveConfiguration();
            //Generate the secret key if needed
            $main_model = new \Solo\Model\Main();
            $main_model->checkEngineSettingsEncryption();

            // Configuration Wizard.
            $siteParams                                       = array();
            $siteParams['akeeba.basic.output_directory']      = '[DEFAULT_OUTPUT]';
            $siteParams['akeeba.basic.log_level']             = 1;
            $siteParams['akeeba.platform.site_url']           = JUri::root(false);
            $siteParams['akeeba.platform.newroot']            = JPATH_ROOT;
            $siteParams['akeeba.platform.dbdriver']           = $jconfig->get('dbtype', '');
            $siteParams['akeeba.platform.dbhost']             = $jconfig->get('host', '');
            //$siteParams['akeeba.platform.dbport'];
            $siteParams['akeeba.platform.dbusername']         = $jconfig->get('user', '');
            $siteParams['akeeba.platform.dbpassword']         = $jconfig->get('password', '');
            $siteParams['akeeba.platform.dbname']             = $jconfig->get('db', '');
            $siteParams['akeeba.platform.dbprefix']           = $jconfig->get('dbprefix', '');
            $siteParams['akeeba.platform.override_root']      = 1;
            $siteParams['akeeba.platform.override_db']        = 1;
            $siteParams['akeeba.platform.addsolo']            = 0;
            $siteParams['akeeba.platform.scripttype']         = 'joomla';
            $siteParams['akeeba.advanced.embedded_installer'] = 'angie';
            $siteParams['akeeba.advanced.virtual_folder']     = 'external_files';
            $siteParams['akeeba.advanced.uploadkickstart']    = 0;
            $siteParams['akeeba.quota.enable_count_quota']    = 0;
            $siteParams['engine.archiver.common.part_size']   = ($part_size ? : '104857600');

            $config = \Akeeba\Engine\Factory::getConfiguration();

            $protectedKeys = $config->getProtectedKeys();
            $config->setProtectedKeys(array());

            foreach ($siteParams as $k => $v) {
                $config->set($k, $v);
            }

            \Akeeba\Engine\Platform::getInstance()->save_configuration();

            $config->setProtectedKeys($protectedKeys);
            // End Configuration Wizard.
            
            // Store akeeba username, password and secret word in perfectdashboard parameters.
            $com_params = PerfectDashboardHelper::getChildParams();
            $com_params->set('backup_dir', $backup_dir);

            // Save the parameters
            $table = JTable::getInstance('extension');
            $table->load(array('type' => 'component', 'element' => 'com_perfectdashboard'));
            $table->bind(array('params' => $com_params->toString()));

            $table->check();
            $table->store();
        } catch (Exception $ex) {
            $this->respond(array('state' => 0, 'message' => 'install_error',
                'debug' => PerfectDashboardHelper::getDebugInfo('backup_install_exception', null, $ex)));
        }

        try {
            $this->setWAFExceptionsForBackupTool($htaccess_param);
        } catch (Exception $ex) {
            $this->respond(array('state' => 0, 'message' => 'set_waf_exceptions_backup_tool_error',
                'debug' => $ex->getMessage()));
        }

        return true;
    }

    private function getAkeebaDbPrefix($backup_dir)
    {
        $backup_path = JPATH_ROOT.'/'.basename($backup_dir);

        // Get db prefix from akeeba config file.
        $config_file = $backup_path.'/Solo/assets/private/config.php';

        jimport('joomla.filesystem.file');

        if (JFile::exists($config_file)) {
            $config = file_get_contents($config_file);

            if ($config !== false) {
                $config = explode("\n", $config, 2);

                if (count($config) >= 2) {
                    $config    = new JRegistry($config[1]);
                    $prefix_db = $config->get('prefix');
                    return $prefix_db;
                }
            }
        }

        $this->respond(array('state' => 0, 'message' => 'backup db prefix error'));
    }

    /**
     * Get info about latest backup filename, path and multipart count.
     *
     * @return type
     */
    protected function getLatestBackupInfo()
    {
        $backup_path = $this->getBackupToolPath();
        $backup_dir  = basename($backup_path);
        $prefix_db   = $this->getAkeebaDbPrefix($backup_dir);

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Get latest completed backup.
        $query->select('`id`, `archivename`, `multipart`')
            ->from($db->quoteName($prefix_db.'ak_stats'))
            ->where('status = '.$db->q('complete'))->order('`id` DESC');

        $db->setQuery($query);

        try {
            $backups = $db->loadObjectList();
        } catch (Exception $e) {
            $this->respond(array('state' => 0, 'message' => 'db error'), 1);
        }

        if (empty($backups)) {
            $this->respond(array('state' => 0, 'message' => 'no backups'), 1);
        }

        $result = new stdClass();

        foreach ($backups as $backup) {

            if (!isset($backup->id) || !isset($backup->archivename) || !isset($backup->multipart)) {
                continue;
            }

            $file = basename($backup->archivename);
            $path = $backup_path.'backups/'.$file;

            jimport('joomla.filesystem.file');

            if (JFile::exists($path)) {

                $result              = $backup;
                $result->archivename = $file;

                if ($result->multipart == 1) {
                    $result->multipart = 0;
                }

                $result->path = $path;

                break;
            }
        }

        if (!isset($result->id)) {
            $this->respond(array('state' => 0, 'message' => 'missing backup information'));
            return null;
        }

        return $result;
    }

    /**
     * Set exceptions for access backup tool directories.
     */
    private function setWAFExceptionsForBackupTool($htaccess_param = null)
    {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $backup_tool_path = $this->getBackupToolPath();
        $backup_tool_dir  = basename($backup_tool_path);

        // Add backup directory to admintools fullaccessdirs.
        // If admin tools are installed.
        if (JFolder::exists(JPATH_ADMINISTRATOR.'/components/com_admintools')) {
            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->select($db->quoteName('value'))
                ->from($db->quoteName('#__admintools_storage'))
                ->where($db->quoteName('key').' = '.$db->quote('cparams'));

            $db->setQuery($query);

            try {
                $res = $db->loadResult();
            } catch (Exception $e) {
                // Most probably table #__admintools_storage doesn't exist, so admintools are not installed now (but folder exist)
                $res = null;
            }

            $config   = new JRegistry($res);
            $htconfig = $config->get('htconfig');

            if (!empty($htconfig)) {
                $htconfig = json_decode(call_user_func('ba'.'se'.'64'.'_decode', $htconfig), true);

                if (empty($htconfig['fullaccessdirs'])) {
                    $htconfig['fullaccessdirs'] = array();
                }

                $found = false;
                foreach ($htconfig['fullaccessdirs'] as $path) {
                    if (strpos($path, $backup_tool_dir) !== false) {
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $htconfig['fullaccessdirs'][] = $backup_tool_dir;
                }

                $htconfig = call_user_func('ba'.'se'.'64'.'_encode', json_encode($htconfig));

                $config->set('htconfig', $htconfig);

                $query = $db->getQuery(true);

                $query->update($db->quoteName('#__admintools_storage'))
                    ->set($db->quoteName('value').' = '.$db->quote($config->toString()))
                    ->where($db->quoteName('key').' = '.$db->quote('cparams'));

                $db->setQuery($query);

                $db->execute();
            }
        }

        // Check if backup folder has full access rule in htaccess - if not add it.
        $htaccess_file = JPATH_ROOT.'/.htaccess';

        if (JFile::exists($htaccess_file)) {
            $htaccess_content                    = file_get_contents($htaccess_file);
            $backup_tool_accessdir_line_position = strpos($htaccess_content, $backup_tool_dir);

            if ($backup_tool_accessdir_line_position === false) {
                $backup_tool_accessdir_line = 'RewriteRule ^'.$backup_tool_dir.'/ - [L]';

                $fullaccessdirs_block_end = strpos($htaccess_content,
                    '##### Advanced server protection rules exceptions -- END');

                if ($fullaccessdirs_block_end !== false) {
                    $new_htaccess_content = substr_replace($htaccess_content, $backup_tool_accessdir_line.PHP_EOL,
                        $fullaccessdirs_block_end, 0);
                    file_put_contents($htaccess_file, $new_htaccess_content);
                } elseif (preg_match('/RewriteEngine\s+On/i', $htaccess_content, $match)) {
                    $new_htaccess_content = str_replace($match[0], $match[0].PHP_EOL.$backup_tool_accessdir_line,
                        $htaccess_content);
                    file_put_contents($htaccess_file, $new_htaccess_content);
                }
            }
        }

        if ($htaccess_param == 'disable') {
            $backup_tool_htaccess_file = $backup_tool_path.'.htaccess';

            if (JFile::exists($backup_tool_htaccess_file)) {
                JFile::move($backup_tool_htaccess_file, $backup_tool_path.'.htaccess.disable');
            }
        } else {
            // For apache servers - set htaccess.txt in backup tool dir to .htaccess
            $server_software                    = JFactory::getApplication()->input->server->get('SERVER_SOFTWARE');
            $backup_tool_htaccess_file          = $backup_tool_path.'htaccess.txt';
            $backup_tool_htaccess_disabled_file = $backup_tool_path.'.htaccess.disable';

            if (strpos(strtolower($server_software), 'apache') !== false && JFile::exists($backup_tool_htaccess_file) && !JFile::exists($backup_tool_htaccess_disabled_file)) {
                JFile::move($backup_tool_htaccess_file, $backup_tool_path.'.htaccess');
            }
        }
    }

    public function downloadBackup()
    {
        $backup_url      = $this->jinput->get('backup_url', '', 'ba'.'se'.'64');
        $backup_filename = $this->jinput->get('backup_filename', '', 'ba'.'se'.'64');

        if (empty($backup_url)) {
            $this->respond(array('state' => 0, 'message' => 'no backup url'));
        }
        if (empty($backup_filename)) {
            $this->respond(array('state' => 0, 'message' => 'no backup file name'));
        }

        set_time_limit(0);
        ini_set('memory_limit', '2000M');

        $backup_url      = call_user_func('ba'.'se'.'64'.'_decode', $backup_url);
        $backup_filename = call_user_func('ba'.'se'.'64'.'_decode', $backup_filename);

        $backup_tool_path = $this->getBackupToolPath();

        //Build the local path
        $path = $backup_tool_path.'backups/'.$backup_filename;
        $data = @file_get_contents($backup_url);

        if ($data === false) {
            $this->respond(array('state' => 0, 'message' => 'could not get content for file '.$backup_filename));
        }

        $file = fopen($path, "w+");
        fputs($file, $data);
        fclose($file);

        $this->respond(array('state' => 1, 'message' => 'downloaded to '.$path));
    }

    /**
     * Set db to default driver's class to prevent messing with database operations by some extensions.
     */
    private function setDefaultDbo()
    {
        $db = JFactory::getDbo();

        if (version_compare(JVERSION, '3.0') === -1) {
            // For J2 class names examples: JDatabaseMySQL, JDatabaseMySQLi, JDatabaseSQLAzure, JDatabaseSQLSrv.
            $pattern = '/^JDatabase[A-Za-z]+$/';
        } else {
            // For J3 class names examples: JDatabaseDriverMysql, JDatabaseDriverMysqli, JDatabaseDriverSqlazure, JDatabaseDriverSqlsrv.
            $pattern = '/^JDatabaseDriver[A-Z]{1}[a-z]+$/';
        }

        // Only if db is not instance of default driver's class.
        if (!preg_match($pattern, get_class($db))) {
            $conf = JFactory::getConfig();

            $host     = $conf->get('host');
            $user     = $conf->get('user');
            $password = $conf->get('password');
            $database = $conf->get('db');
            $prefix   = $conf->get('dbprefix');
            $driver   = $conf->get('dbtype');
            $debug    = $conf->get('debug');

            $options = array('driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $password, 'database' => $database,
                'prefix' => $prefix);

            try {
                if (version_compare(JVERSION, '3.0') === -1) {
                    $db = JDatabase::getInstance($options);
                } else {
                    $db = JDatabaseDriver::getInstance($options);
                }
            } catch (Exception $e) {
                $this->respond(array('state' => 0, 'message' => 'set dbo error', 'debug' => $e->getMessage()));
            }

            $db->setDebug($debug);

            JFactory::$database = $db;
        }
    }

    /**
     * Clean Joomla cache.
     */
    public function cacheClean()
    {
        $config = JFactory::getConfig();

        // Check if cache is enabled.
        if ($config->get('caching')) {
            // Groups of cache to clean.
            $groups = $this->jinput->get('groups', null, 'array');

            $cache = JFactory::getCache();
            if (empty($groups)) {
                $cache->clean(null, 'notgroup');
            } else {
                foreach ($groups as $group) {
                    $cache->clean($group, 'group');
                }

                // Additionaly clean page group to see changes on pages.
                $cache->clean('page', 'group');
            }

            $this->respond(array('state' => 1, 'message' => 'cache cleaned'));
        } else {
            $this->respond(array('state' => 1, 'message' => 'cache is off'));
        }
    }

    /**
     * Set custom child name, extension view information and login page information.
     */
    public function whiteLabelling()
    {
        $name                        = $this->jinput->get('name', '', 'ba'.'se'.'64');
        $extensions_view_information = $this->jinput->get('extensions_view_information', '', 'ba'.'se'.'64');
        $login_page_information      = $this->jinput->get('login_page_information', '', 'ba'.'se'.'64');
        $errors                      = array();

        if (!empty($name)) {
            $name = call_user_func('ba'.'se'.'64'.'_decode', $name);
        }
        if (!empty($extensions_view_information)) {
            $extensions_view_information = call_user_func('ba'.'se'.'64'.'_decode', $extensions_view_information);
        }
        if (!empty($login_page_information)) {
            $login_page_information = call_user_func('ba'.'se'.'64'.'_decode', $login_page_information);
        }

        // Override name of Perfect Dashboard component.
        // Get all available languages on site.
        $languages = JLanguage::getKnownLanguages();

        foreach ($languages as $lang) {
            // Set language for right JText value.
            $jlang = JFactory::getLanguage();
            $jlang->setDefault($lang['tag']);
            $jlang->load();
            $jlang->load('com_perfectdashboard');

            $override_filename = JPATH_ADMINISTRATOR.'/language/overrides/'.$lang['tag'].'.override.ini';

            $override_name = array(
                'language' => $lang['name'].' ['.$lang['tag'].']',
                'client' => 'Administrator',
                'file' => $override_filename
            );

            $name_overrides = array(
                'PERFECT DASHBOARD' => $name,
                'COM_PERFECTDASHBOARD' => $name,
                'COM_PERFECTDASHBOARD_CONFIGURATION' => $name.' '.JText::_('JOPTIONS'),
                'COM_PREFECTDASHBOARD_HEADER' => $name,
                'COM_PERFECTDASHBOARD_AUTHENTICATION_INFO' => JText::_('COM_PERFECTDASHBOARD_AUTHENTICATION_INFO'),
                'COM_PERFECTDASHBOARD_FIELDSET_CONFIG_OPTIONS_DESC' => '',
                'COM_PERFECTDASHBOARD_FIELD_KEY_DESC' => JText::_('COM_PERFECTDASHBOARD_FIELD_KEY_DESC'),
            );

            if (empty($name)) {
                foreach ($name_overrides as $id => $item) {
                    $override_name['id'] = $id;
                    if (!$this->deleteOverride($override_name) && empty($errors['delete_override'])) {
                        $errors['delete_override'] = true;
                    }
                }
            } else {
                foreach ($name_overrides as $id => $item) {
                    $override_name['key']      = $id;
                    $override_name['override'] = $item;
                    $override_name['id']       = $id;
                    if (!$this->saveOverride($override_name) && empty($errors['save_override'])) {
                        $errors['save_override'] = true;
                    }
                }
            }
        }

        // Override view information of Perfect Dashboard component.
        // Grab components params
        $com_params = PerfectDashboardHelper::getChildParams();
        $com_params->set('extensions_view_information', $extensions_view_information);

        //save
        $table = JTable::getInstance('extension');
        $table->load(array('type' => 'component', 'element' => 'com_perfectdashboard'));
        $table->bind(array('params' => $com_params->toString()));
        $table->check();
        try {
            $table->store();
        } catch (Exception $e) {
            $errors['extensions_view_information'] = true;
        }

        // Override login page information.
        // Check if custom module in position "login" exist - we store login_page_information there.
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('id')
            ->from($db->quoteName('#__modules'))
            ->where(array(
                $db->quoteName('title').'='.$db->quote('Admin login page'),
                $db->quoteName('position').'='.$db->quote('login'),
                $db->quoteName('module').'='.$db->quote('mod_custom'),
        ));

        $db->setQuery($query);

        try {
            $module_id = $db->loadResult();
        } catch (Exception $e) {
            $errors['login_page_information'] = true;
        }

        if (empty($module_id)) {
            // Module doesn't exist - add it.
            $module            = new stdClass();
            $module->title     = 'Admin login page';
            $module->content   = $login_page_information;
            $module->ordering  = 1;
            $module->position  = 'login';
            $module->published = 1;
            $module->module    = 'mod_custom';
            $module->access    = 1;
            $module->params    = '{"prepare_content":"1"}';
            $module->client_id = 1;
            $module->language  = '*';

            try {
                $db->insertObject('#__modules', $module, 'id');
            } catch (Exception $e) {
                $errors['login_page_information'] = true;
            }

            if (!empty($module->id)) {
                $modules_menu           = new stdClass();
                $modules_menu->moduleid = $module->id;
                $modules_menu->menuid   = 0;

                try {
                    $db->insertObject('#__modules_menu', $modules_menu);
                } catch (Exception $e) {
                    $errors['login_page_information'] = true;
                }
            }
        } else {
            $query = $db->getQuery(true);

            // Update module's content.
            $query->update($db->quoteName('#__modules'))
                ->set($db->quoteName('content').'='.$db->quote($login_page_information))
                ->where($db->quoteName('id').'='.(int) $module_id);

            $db->setQuery($query);

            try {
                $db->execute();
            } catch (Exception $e) {
                $errors['login_page_information'] = true;
            }
        }

        if (empty($errors)) {
            $this->respond(array('state' => 1, 'message' => 'white labelling complete'));
        } else {
            $message = 'There were errors during:';
            foreach ($errors as $err_type => $item) {
                $message .= ' '.$err_type.';';
            }
            $this->respond(array('state' => 0, 'message' => $message));
        }
    }

    /**
     * Override language constants values.
     * It's part of administrator\components\com_languages\models\override.php save method, not used directly because off JPATH_COMPONENT usage there.
     *
     * @param $data
     * @return bool
     */
    private function saveOverride($data)
    {
        require_once JPATH_ADMINISTRATOR.'/components/com_languages/helpers/languages.php';

        // Parse the override.ini file in oder to get the keys and strings.
        $strings = LanguagesHelper::parseFile($data['file']);

        if (isset($strings[$data['id']])) {
            // If an existent string was edited check whether
            // the name of the constant is still the same.
            if ($data['key'] == $data['id']) {
                // If yes, simply override it.
                $strings[$data['key']] = $data['override'];
            } else {
                // If no, delete the old string and prepend the new one.
                unset($strings[$data['id']]);
                $strings = array($data['key'] => $data['override']) + $strings;
            }
        } else {
            // If it is a new override simply prepend it.
            $strings = array($data['key'] => $data['override']) + $strings;
        }

        return $this->writeOverride($strings, $data);
    }

    /**
     * Delete override of language constants values.
     * It's part of administrator\components\com_languages\models\overrides.php delete method, not used directly because off JPATH_COMPONENT usage there.
     *
     * @param $data
     * @return bool
     */
    private function deleteOverride($data)
    {
        require_once JPATH_ADMINISTRATOR.'/components/com_languages/helpers/languages.php';

        // Parse the override.ini file in oder to get the keys and strings.
        $strings = LanguagesHelper::parseFile($data['file']);

        // Unset strings that shall be deleted
        if (isset($strings[$data['id']])) {
            unset($strings[$data['id']]);
        }

        foreach ($strings as $key => $string) {
            $strings[$key] = str_replace('"', '"_QQ_"', $string);
        }

        return $this->writeOverride($strings, $data);
    }

    /**
     * Helper method used in saveOverride and deleteOverride.
     *
     * @param $strings
     * @param $data
     * @return bool
     */
    private function writeOverride($strings, $data)
    {
        jimport('joomla.filesystem.file');

        foreach ($strings as $key => $string) {
            $strings[$key] = str_replace('"', '"_QQ_"', $string);
        }

        // Write override.ini file with the strings.
        $registry = new JRegistry;
        $registry->loadObject($strings);
        $reg      = $registry->toString('INI');

        if (JFile::write($data['file'], $reg)) {
            return true;
        }
    }
}
