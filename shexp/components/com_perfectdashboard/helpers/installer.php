<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Installer
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

if (version_compare(JVERSION, '3.1', '>=')) {
    JLoader::register('JInstaller', JPATH_LIBRARIES . '/cms/installer/installer.php');
} else {
    jimport('joomla.installer.install');
}

/**
 * Extended Joomla base installer class, which gather errors
 *
 * @since  3.1
 */
class PerfectDashboardJInstaller extends JInstaller
{
    protected static $jerrors = array();

    /**
     * JInstaller instance container.
     *
     * @var    JInstaller
     * @since  3.1
     * @deprecated  4.0
     */
    protected static $instance;

    /**
     * JInstaller instances container.
     *
     * @var    JInstaller[]
     * @since  3.4
     */
    protected static $instances;

    public function __construct($basepath = null, $classprefix = 'JInstallerAdapter', $adapterfolder = 'adapter')
    {
        if (version_compare(JVERSION, '3.1', '>=')) {
            $basepath = $basepath ?: JPATH_LIBRARIES . '/cms/installer';

            parent::__construct($basepath, $classprefix, $adapterfolder);
        } else {
            parent::__construct(JPATH_LIBRARIES . '/joomla/installer', 'JInstaller');
        }
    }

    public static function getInstance($basepath = null, $classprefix = 'JInstallerAdapter', $adapterfolder = 'adapter')
    {
        if (version_compare(JVERSION, '3.1', '>=')) {
            $basepath = $basepath ?: JPATH_LIBRARIES . '/cms/installer';

            if (!isset(self::$instances[$basepath])) {
                self::$instances[$basepath] = new PerfectDashboardJInstaller($basepath, $classprefix, $adapterfolder);

                // For B/C, we load the first instance into the static $instance container, remove at 4.0
                if (!isset(self::$instance)) {
                    self::$instance = self::$instances[$basepath];
                }
            }

            return self::$instances[$basepath];
        } else {
            if (!isset(self::$instance))
            {
                self::$instance = new PerfectDashboardJInstaller;
            }
            return self::$instance;
        }
    }

    public function abort($msg = null, $type = null)
    {
        $error = array();
        if ($msg) {
            $error['message'] = $msg;
        }
        if ($type) {
            $error['type'] = $type;
        }
        if (!empty($error)) {
            self::$jerrors[] = $error;
        }

        return parent::abort($msg, $type);
    }

    public static function getJErrors()
    {
        return self::$jerrors;
    }
}