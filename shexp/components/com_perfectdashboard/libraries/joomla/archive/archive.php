<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Archive
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
defined('JPATH_LIBRARIES_DASHBOARD') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

JLoader::register('PerfectDashboardHelper', JPATH_ROOT.'/components/com_perfectdashboard/helpers/helper.php');

/**
 * An Archive handling class
 *
 * @since  11.1
 */
class JArchive
{
	/**
	 * @var    array  The array of instantiated archive adapters.
	 * @since  12.1
	 */
	protected static $adapters = array();

	protected static $error;
	protected static $archive;
	protected static $extract_dir;
	protected static $site_root;

    /**
     * Get file extension.
     *
     * @param string $archivename
     *
     * @return string
     *
     * @since version 1.4.15
     */
    public static function getExt($archivename, $stripExt = false)
    {
        $ext = JFile::getExt($archivename);
        if(strstr($ext, '?') || strstr($ext, '&')) {
            $parsed_url = parse_url($archivename);
            $ext = pathinfo($parsed_url['path'], PATHINFO_EXTENSION);
            if($stripExt) {
                $ext = pathinfo(pathinfo($parsed_url['path'], PATHINFO_FILENAME), PATHINFO_EXTENSION);
            }
        } elseif($stripExt) {
            $ext = pathinfo(pathinfo($archivename, PATHINFO_FILENAME), PATHINFO_EXTENSION);
        }

        return $ext;
    }

	/**
	 * Extract an archive file to a directory.
	 *
	 * @param   string  $archivename  The name of the archive file
	 * @param   string  $extractdir   Directory to unpack into
	 *
     * @return  boolean  True for success
	 *
	 * @since   11.1
	 * @throws  InvalidArgumentException
	 */
	public static function extract($archivename, $extractdir)
	{
	    // Prepare error response
        $response               = new stdClass();
        $response->warnings     = array();

		$untar     = false;
		$result    = false;
        $ext        = self::getExt(strtolower($archivename));

		// Check if a tar is embedded...gzip/bzip2 can just be plain files!
		if (self::getExt(strtolower($archivename), true) == 'tar')
		{
			$untar = true;
		}

		try {
            self::$site_root   = JPath::clean(JPATH_ROOT);
            self::$archive     = str_ireplace(self::$site_root, '', JPath::clean($archivename));
            self::$extract_dir = str_ireplace(self::$site_root, '', JPath::clean($extractdir));
            
            // Make sure the archive exists.
            if (!JFile::exists($archivename)) {
                self::setError('no_archive');
                throw new Exception('pd');
            }

            // Make sure the destination folder exists.
            if (!JFolder::create($extractdir)) {
                $error_flag = false;
                PerfectDashboardHelperTest::checkPathWriteAbility($extractdir, $extractdir, $error_flag, true);
                self::setError('unable_to_create_extract_dir');
                throw new Exception('pd');
            }

            if (!is_writable($extractdir)) {
                PerfectDashboardHelperTest::checkPathWriteAbility($extractdir, $extractdir, $error_flag, true);
                self::setError('extract_dir_not_writable');
                throw new Exception('pd');
            }

            switch ($ext) {
                case 'zip':
                    $adapter = self::getAdapter('zip');

                    if ($adapter) {
                        $result = $adapter->extract($archivename, $extractdir);
                    }
                    break;

                case 'tar':
                    $adapter = self::getAdapter('tar');

                    if ($adapter) {
                        $result = $adapter->extract($archivename, $extractdir);
                    }
                    break;

                case 'tgz':
                    // This format is a tarball gzip'd
                    $untar = true;

                case 'gz':
                case 'gzip':
                    // This may just be an individual file (e.g. sql script)
                    $adapter = self::getAdapter('gzip');

                    if ($adapter) {
                        $config = JFactory::getConfig();
                        $tmpfname = $config->get('tmp_path') . '/' . uniqid('gzip');
                        try {
                            $adapter->extract($archivename, $tmpfname);
                        } catch (Exception $e) {
                            @unlink($tmpfname);
                            throw $e;
                        }

                        if ($untar) {
                            // Try to untar the file
                            $tadapter = self::getAdapter('tar');

                            if ($tadapter) {
                                $result = $tadapter->extract($tmpfname, $extractdir);
                            }
                        } else {
                            $path = JPath::clean($extractdir);
                            JFolder::create($path);
                            $result = JFile::copy($tmpfname, $path . '/' . JFile::stripExt(basename(strtolower($archivename))), null, 1);
                        }

                        @unlink($tmpfname);
                    }
                    break;

                case 'tbz2':
                    // This format is a tarball bzip2'd
                    $untar = true;

                case 'bz2':
                case 'bzip2':
                    // This may just be an individual file (e.g. sql script)
                    $adapter = self::getAdapter('bzip2');

                    if ($adapter) {
                        $config = JFactory::getConfig();
                        $tmpfname = $config->get('tmp_path') . '/' . uniqid('bzip2');
                        try {
                            $adapter->extract($archivename, $tmpfname);
                        } catch (Exception $e) {
                            @unlink($tmpfname);
                            throw $e;
                        }

                        if ($untar) {
                            // Try to untar the file
                            $tadapter = self::getAdapter('tar');

                            if ($tadapter) {
                                $result = $tadapter->extract($tmpfname, $extractdir);
                            }
                        } else {
                            $path = JPath::clean($extractdir);
                            JFolder::create($path);
                            $result = JFile::copy($tmpfname, $path . '/' . JFile::stripExt(basename(strtolower($archivename))), null, 1);
                        }

                        @unlink($tmpfname);
                    }
                    break;

                default:
                    self::setError('unknown_archive_type', $ext);
                    throw new Exception('pd');
                    break;
            }
        } catch (Exception $e) {
            $message = $e->getMessage();

            // Probably unhandled error
            if ($message !== 'pd') {
                $current_error = self::getError();
                if (empty($current_error)) {
                    self::setError('unhandled_error', $e);
                }
            }

            return false;
        }

		if (!$result || $result instanceof Exception) {
            $current_error = self::getError();
            if (empty($current_error)) {
                self::setError('unhandled_error', $result);
            }
            return false;
		}

		return true;
	}

	/**
	 * Get a file compression adapter.
	 *
	 * @param   string  $type  The type of adapter (bzip2|gzip|tar|zip).
	 *
	 * @return  JArchiveExtractable  Adapter for the requested type
	 *
	 * @since   11.1
	 * @throws  UnexpectedValueException
	 */
	public static function getAdapter($type)
	{
		if (!isset(self::$adapters[$type]))
		{
			// Try to load the adapter object
			$class = 'PerfectdashboardArchive' . ucfirst($type);

			if (!class_exists($class))
			{
				throw new UnexpectedValueException('Unable to load archive', 500);
			}

			self::$adapters[$type] = new $class;
		}

		return self::$adapters[$type];
	}

	public static function setError($error_type, $data = null)
    {
        if (empty(self::$error)) {
            self::$error = new stdClass();
        }

        self::$error->error_type = $error_type;

        if (!empty($data)) {
            if ($data instanceof Exception) {
                self::$error->ex          = new stdClass();
                self::$error->ex->code    = $data->getCode();
                self::$error->ex->message = $data->getMessage();
                self::$error->ex->file    = str_ireplace(self::$site_root, '', JPath::clean($data->getFile()));
                self::$error->ex->line    = $data->getLine();
            } else {
                self::$error->data = $data;
            }
        }

        if (!empty(self::$archive)) {
            self::$error->archive = self::$archive;
        }

        if (!empty(self::$extract_dir)) {
            self::$error->extract_dir = self::$extract_dir;
        }
    }

	public static function getError()
    {
        return self::$error;
    }
}
