<?php
/**
 * @package     perfectdashboard
 * @version     1.4.0
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

class PerfectDashboardHelper
{
    protected static $params = null;

    /**
     * Used this instead of JComponentHelper::getParams because of possible caching.
     * @return JRegistry|void
     */
    public static function getChildParams()
    {
        if (empty(self::$params)) {
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);

            $query->select($db->quoteName('params'))
                ->from($db->quoteName('#__extensions'))
                ->where($db->quoteName('type') . '=' . $db->quote('component'))
                ->where($db->quoteName('element') . '=' . $db->quote('com_perfectdashboard'));

            $db->setQuery($query);

            try {
                $result = $db->loadResult();
            } catch (Exception $e) {
                return;
            }

            self::$params = new JRegistry($result);
        }

        return self::$params;
    }

    /**
     * Verify password with backward compatibility
     *
     * @param   string $password The plaintext password to encrypt.
     * @param   string $hash     The hash to verify against.
     *
     * @return  bool    True if the password and hash match, false otherwise
     *
     * @since   1.4.6
     */
    public static function verifyPassword($password, $hash)
    {
        if (version_compare(JVERSION, '3.2.1') == -1) {
            if (version_compare(JVERSION, '3.2.0') == -1) {
                // Taken from /plugins/authentication/joomla/joomla.php onUserAuthenticate
                $parts     = explode(':', $hash);
                $crypt     = $parts[0];
                $salt      = @$parts[1];
                $testcrypt = JUserHelper::getCryptedPassword($password, $salt);

                if ($crypt == $testcrypt) {
                    return true;
                } else {
                    return false;
                }
            } else {
                // Taken from /plugins/authentication/joomla/joomla.php onUserAuthenticate
                $match = false;
                if (substr($hash, 0, 4) == '$2y$') {
                    // BCrypt passwords are always 60 characters, but it is possible that salt is appended although non standard.
                    $password60 = substr($hash, 0, 60);

                    if (JCrypt::hasStrongPasswordSupport()) {
                        $match = password_verify($password, $password60);
                    }
                } elseif (substr($hash, 0, 8) == '{SHA256}') {
                    // Check the password
                    $parts     = explode(':', $hash);
                    $crypt     = $parts[0];
                    $salt      = @$parts[1];
                    $testcrypt = JUserHelper::getCryptedPassword($password, $salt, 'sha256', false);

                    if ($hash == $testcrypt) {
                        $match = true;
                    }
                } else {
                    // Check the password
                    $parts = explode(':', $hash);
                    $crypt = $parts[0];
                    $salt  = @$parts[1];

                    $testcrypt = JUserHelper::getCryptedPassword($password, $salt, 'md5-hex', false);

                    if ($crypt == $testcrypt) {
                        $match = true;
                    }
                }

                return $match;
            }
        } else {
            return JUserHelper::verifyPassword($password, $hash);
        }
    }

    /**
     * @return array empty array if its not accesible or array with backup accesible dir(s)
     */
    public static function testBackupsFolderHttpRequest($site_url, $backups_directory_path, $http = null, $timeout = 3)
    {
        if (empty($http)) {
            $http = JHttpFactory::getHttp();
        }

        $path_root              = str_replace('\\', '/', JPATH_ROOT);
        $backups_directory_path = str_replace('\\', '/', $backups_directory_path);
        $backups_directory      = str_replace($path_root, '', $backups_directory_path);

        try {
            $response = $http->get($site_url . $backups_directory, null, $timeout);

            if (!empty($response->code) && $response->code < 400) {
                return array($backups_directory);
            }
        } catch (Exception $e) {
        }

        return array();
    }

    /**
     * Check if backups' folder of Akeeba J! is accessible through http
     *
     * @param  string        $site_url
     * @param  JHttp object  $http
     * @param  int           $timeout
     * @return array empty array if its not accesible or array with backup accesible dir(s)
     *
     * @since 1.4.7
     */
    public static function checkBackupsHttpAccessAkeeba($site_url, $http = null, $timeout = 3)
    {
        $akeeba_path = JPATH_ADMINISTRATOR . '/components/com_akeeba';
        $fof30_path  = JPATH_LIBRARIES . '/fof30';

        if (JFolder::exists(JPATH_ADMINISTRATOR . '/components/com_akeeba') && JFile::exists($akeeba_path . '/BackupEngine/Factory.php') &&
            JFile::exists($fof30_path . '/Autoloader/Autoloader.php') && JFile::exists($fof30_path . '/Container/Container.php')
        ) {
            if (!defined('AKEEBAENGINE')) {
                define('AKEEBAENGINE', 1);
                define('AKEEBAROOT', $akeeba_path . '/BackupEngine');
                define('ALICEROOT', $akeeba_path . '/AliceEngine');
            }

            require_once $akeeba_path . '/BackupEngine/Factory.php';

            // Load ALICE (Pro version only)
            if (JFile::exists($akeeba_path . '/AliceEngine/factory.php')) {
                require_once $akeeba_path . '/AliceEngine/factory.php';
            }

            require_once $fof30_path . '/Autoloader/Autoloader.php';
            require_once $fof30_path . '/Container/Container.php';

            // Get profile_id from last backup - that's how Akeeba is getting profile id.
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select($db->quoteName('profile_id'))->from($db->quoteName('#__ak_stats'))
                ->order($db->quoteName('id') . ' DESC');

            $db->setQuery($query, 0, 1);

            try {
                $profile_id = $db->loadResult();
                $profile_id = $profile_id ?: 1;
                Akeeba\Engine\Platform::addPlatform('joomla3x', $akeeba_path . '/BackupPlatform/Joomla3x');
                Akeeba\Engine\Platform::getInstance()->load_configuration($profile_id);
                $akeeba_engine_config   = Akeeba\Engine\Factory::getConfiguration();
                $backups_directory_path = $akeeba_engine_config->get('akeeba.basic.output_directory');
            } catch (Exception $e) {
            }

            if (!empty($backups_directory_path) && JFolder::exists($backups_directory_path)) {
                // Http request to check response code.
                return self::testBackupsFolderHttpRequest($site_url, $backups_directory_path, $http, $timeout);
            }
        }

        return array();
    }

    /**
     * Check if backups' folder of EJB - Easy Joomla Backup is accessible through http
     *
     * @param  string        $site_url
     * @param  JHttp object  $http
     * @param  int           $timeout
     * @return array empty array if its not accesible or array with backup accesible dir(s)
     *
     * @since 1.4.7
     */
    public static function checkBackupsHttpAccessEJB($site_url, $http = null, $timeout = 3)
    {
        // This backup folder can not be changed by config ou user settings.
        $backups_directory_path = JPATH_ADMINISTRATOR . '/components/com_easyjoomlabackup/backups/';
        if (JFolder::exists($backups_directory_path)) {
            return self::testBackupsFolderHttpRequest($site_url, $backups_directory_path, $http, $timeout);
        }

        return array();
    }

    /**
     * Check if backups' folder of XCloner is accessible through http
     *
     * @param  string        $site_url
     * @param  JHttp object  $http
     * @param  int           $timeout
     * @return array empty array if its not accesible or array with backup accesible dir(s)
     *
     * @since 1.4.7
     */
    public static function checkBackupsHttpAccessXCloner($site_url, $http = null, $timeout = 3)
    {
        $config_file = JPATH_ADMINISTRATOR . '/components/com_xcloner-backupandrestore\cloner.config.php';
        if (JFile::exists($config_file)) {
            require_once $config_file;

            if (isset($_CONFIG['backup_path'])) {
                // Taken from administrator/components/com_xcloner-backupandrestore/common.php
                $backups_dir = str_replace("//administrator", "/administrator", $_CONFIG['backup_path'] . "/administrator/backups");
                $backups_dir = str_replace("\\", "/", $backups_dir);

                $backups_directory_path = $backups_dir;
                if (JFolder::exists($backups_directory_path)) {
                    return self::testBackupsFolderHttpRequest($site_url, $backups_directory_path, $http, $timeout);
                }
            }
        }

        return array();
    }

    /**
     * Check if backups' folder of Perfect Dashboard is accessible through http
     *
     * @param  string        $site_url
     * @param  string        $backup_tool_path
     * @param  JHttp object  $http
     * @param  int           $timeout
     * @return array empty array if its not accesible or array with backup accesible dir(s)
     *
     * @since 1.4.7
     */
    public static function checkBackupsHttpAccessPerfectDashboard($site_url, $backup_tool_path, $http = null, $timeout = 3)
    {
        if (!empty($backup_tool_path) && JFolder::exists($backup_tool_path)) {
            $backups_directory_path = $backup_tool_path . 'backups/';

            if (JFolder::exists($backups_directory_path)) {
                return self::testBackupsFolderHttpRequest($site_url, $backups_directory_path, $http, $timeout);
            }
        }

        return array();
    }

    public static function cleanPhpCache()
    {
        // Make sure that PHP has the latest data of the files.
        clearstatcache();

        // Remove all compiled files from opcode cache.
        if (function_exists('opcache_reset')) {
            // Always reset the OPcache if it's enabled. Otherwise there's a good chance the server will not know we are
            // replacing .php scripts. This is a major concern since PHP 5.5 included and enabled OPcache by default.
            @opcache_reset();
        } elseif (function_exists('apc_clear_cache')) {
            @apc_clear_cache();
        }
    }

    public static function getDebugInfo($error_type, $data = null, $exception = null)
    {
        static $site_root;

        try {
            if (empty($site_root)) {
                $site_root = JPath::clean(JPATH_ROOT);
            }

            // Prepare error response
            $debug             = new stdClass();
            $debug->error_type = $error_type;

            // Check disk free space
            $bytes = @disk_free_space(JPATH_ROOT);
            if (!empty($bytes) && $bytes < 10485760) { // 5242880 - 5MB or 10485760 - 10MB?
                $debug->warnings['free_disk_space'] = $bytes;
            }

            if (!empty($data)) {
                // Prepare response data
                if (is_array($data)) {
                    if (!empty($data['archive'])) {
                        $config   = JFactory::getConfig();
                        $tmp_dest = $config->get('tmp_path');
                        $tmp_dest = JPath::clean($tmp_dest);

                        $archive = $data['archive'] = JPath::clean($data['archive']);
                        if (stripos($archive, $tmp_dest) === false) {
                            $archive = null;
                        }

                        $extract_dir = null;

                        if (!empty($data['extract_dir'])) {
                            $extract_dir = $data['extract_dir'] = JPath::clean($data['extract_dir']);

                            // Don't remove JPATH_ROOT folder :/ and folders that are not in Joomla tmp folder
                            if ($extract_dir == $site_root || stripos($extract_dir, $tmp_dest) === false) {
                                $extract_dir = null;
                            }
                        }

                        JInstallerHelper::cleanupInstall($archive, $extract_dir);
                    }

                    foreach ($data as $d_key => $d_item) {
                        if (empty($d_item)) {
                            unset($data[$d_key]);
                        } else {
                            // Don't show full path
                            if (in_array($d_key, array('archive', 'extract_dir', 'packagefile', 'extractdir', 'dir'))) {
                                $debug->$d_key = str_ireplace($site_root, '', $data[$d_key]);
                                unset($data[$d_key]);
                            } elseif (is_string($d_key)) {
                                $debug->$d_key = $d_item;
                                unset($data[$d_key]);
                            }
                        }
                    }
                }

                if (!empty($data)) {
                    $debug->data = $data;
                }
            }

            switch ($error_type) {
                case 'jarchive_error':
                    if (method_exists('JArchive', 'getError') && JArchive::getError()) {
                        $debug = JArchive::getError();
                    }
                    break;
                case 'jinstaller_error':
                case 'jinstaller_exception':
                    // During install there may also occurs JArchive error
                    if (method_exists('JArchive', 'getError') && JArchive::getError()) {
                        $debug             = JArchive::getError();
                        $debug->error_type = 'jarchive_error';
                    }
                    $jinstaller_error = PerfectDashboardJInstaller::getJErrors();
                    if (!empty($jinstaller_error)) {
                        $debug->jinstaller_errors = $jinstaller_error;
                    }
                    break;
                default:
                    break;
            }

            if (in_array($debug->error_type, array('unable_to_write_entry', 'unable_to_write_archive',
                'unable_to_create_extract_dir', 'extract_dir_not_writable', 'jinstaller_error', 'jinstaller_exception'))) {
                $test_result = PerfectDashboardHelperTest::checkPathWriteAbility();
                if (!empty($test_result)) {
                    $debug->writable_test = $test_result;
                }
            }

            if (!empty($exception) && $exception instanceof Exception) {
                $debug->ex          = new stdClass();
                $debug->ex->code    = $exception->getCode();
                $debug->ex->message = $exception->getMessage();
                $debug->ex->file    = str_ireplace($site_root, '', JPath::clean($exception->getFile()));
                $debug->ex->line    = $exception->getLine();
            }

            return $debug;
        } catch (Exception $e) {
            return array('error_type' => 'debug_exception', 'message' => $e->getMessage());
        }
    }
}