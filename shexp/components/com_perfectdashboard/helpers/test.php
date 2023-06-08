<?php
/**
 * @package     perfectdashboard
 * @version     1.4.0
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

JLoader::register('PerfectDashboardHelper', JPATH_ROOT . '/components/com_perfectdashboard/helpers/helper.php');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

/**
 * Test helper class
 */
class PerfectDashboardHelperTest
{

    /**
     * Get files checksum
     *
     * @param   string $dir     Directory to scan
     * @param   array  $results Results of scan
     *
     * @return  array  $results  Results of scan
     */
    public static function getFilesChecksum($dir, &$results = array())
    {
        $files     = scandir($dir);
        $home_path = JPATH_ROOT . '/';

        foreach ($files as $key => $value) {
            $path     = realpath($dir . '/' . $value);
            $rel_path = str_replace($home_path, '', $path);

            if (!is_dir($path)) {
                $results[] = utf8_encode($rel_path) . ' ' . md5_file($path);
            } else if (is_dir($path) && $value != '.' && $value != '..') {
                self::getFilesChecksum($path, $results);
            }
        }

        return $results;
    }

    /*
     * Check which part of path isn't writable
     */
    public static function checkPathWriteAbility($path = null, $entry_path = null, &$error_flag = null, $error_occured = false)
    {
        // Flag to clean cache only once
        static $clean_cache = true;

        if ($clean_cache) {
            $clean_cache = false;
            PerfectDashboardHelper::cleanPhpCache();
        }

        static $nested = array();
        static $checked_paths = array(); // To not check same path again
        static $write_errors = array(
            'not_writable' => array(
                'dir' => array(),
                'file' => array()
            ),
            'other_problems' => array()
        );
        static $site_root = null;

        if (empty($path)) {
            $test_result = self::removeIndexes($write_errors);
            if (empty($test_result['other_problems']) && empty($test_result['not_writable']['dir']) &&
                empty($test_result['not_writable']['file'])
            ) {
                return;
            } else {
                return $test_result;
            }
        }

        try {
            $parent = JPath::clean(dirname($path));

            if (empty($site_root)) {
                $site_root = JPath::clean(JPATH_ROOT);
            }

            // Checks for snooping outside of the file system root
            $path = JPath::check($path);
        } catch (Exception $e) {
            return self::removeIndexes($write_errors);
        }

        // Add entry path to other problems
        if ($error_occured) {
            $error_flag = true;
            // Don't display full path
            $entry_relative_path                         = str_ireplace($site_root, '', $entry_path);
            $write_errors['other_problems'][$entry_path] = $entry_relative_path;
        }

        // Prevent infinite loops
        if (empty($nested[$entry_path])) {
            $nested              = array(); // Clear array, so it has only current entry_path counter.
            $nested[$entry_path] = 0;
        }

        $nested[$entry_path]++;

        // Prevent infinite loops
        if (($nested[$entry_path] > 20) || ($parent == $path)) {
            return self::removeIndexes($write_errors);
        }

        if (empty($checked_paths[$path])) {
            $checked_paths[$path] = true;
        } else {
            // Path already checked
            return self::removeIndexes($write_errors);
        }

        if (JFile::exists($path) && !is_writable($path)) {
            $error_flag = true;
            // Don't display full path
            $relative_path                                        = str_ireplace($site_root, '', $path);
            $write_errors['not_writable']['file'][$relative_path] = JPath::getPermissions($path);

            // It seems that there is problem with write ability, so remove entry path from other problems
            if (!empty($write_errors['other_problems'][$entry_path])) {
                unset($write_errors['other_problems'][$entry_path]);
            }
        } elseif (JFolder::exists($path) && !is_writable($path)) {
            $error_flag = true;
            // Don't display full path
            $relative_path                                       = str_ireplace($site_root, '', $path);
            $write_errors['not_writable']['dir'][$relative_path] = JPath::getPermissions($path);

            // It seems that there is problem with write ability, so remove entry path from other problems
            if (!empty($write_errors['other_problems'][$entry_path])) {
                unset($write_errors['other_problems'][$entry_path]);
            }
        }

        if (empty($checked_paths[$parent])) {
            self::checkPathWriteAbility($parent, $entry_path, $error_flag);
        }

        return self::removeIndexes($write_errors);
    }

    /*
     * Change array('other_problems' => array('path1' => 'path1', 'path2' => 'path2', ...)) to
     * array('other_problems' => array(0 => 'path1', 1 => 'path2', ...))
     *
     */
    protected static function removeIndexes($write_errors)
    {
        if (!empty($write_errors['other_problems'])) {
            $write_errors['other_problems'] = array_values($write_errors['other_problems']);
        }

        return $write_errors;
    }

    /**
     * Check if extension's files are writable.
     * It's not super accurate - it's not checking all possible extension's files, but most of them.
     *
     * @param null $installer         instance of JInstaller
     * @param null $extension_type    e.g. plugin, module
     * @param null $extension_element e.g. com_perfectdashboard
     * @param null $plugin_group      e.g. content, system
     * @param null $client            administrator/site
     *
     * @return bool true if error occurs
     *
     * @since 1.5
     */
    public static function testFilesWriteAbilityForExtension($installer = null, $extension_type = null, $extension_element = null, $plugin_group = null, $client = null)
    {
        $error_flag = false;
        $folders    = array();
        $files      = array();

        try {
            if (!$installer) {
                if (!$extension_type || !$extension_element || ($extension_type == 'plugin' && !$plugin_group)
                    || ($extension_type == 'module' && !$client)
                ) {
                    return;
                }
            }

            if ($installer) {
                $manifest = $installer->getManifest();

                if (empty($manifest) || !is_object($manifest)) {
                    return false;
                }

                $extension_type = (string)$manifest->attributes()->type;
                $adapter        = $installer->setupInstall('update', true);

                if (empty($adapter) || !is_object($adapter)) {
                    return false;
                }

                $extension_element = $adapter->getElement();

                if ($extension_type == 'plugin') {
                    $plugin_group = (string)$manifest->attributes()->group;
                }

                // Define folders to check
                // Media folder
                if ((string)$manifest->media) {
                    $media_folder              = (string)$manifest->media->attributes()->folder ?: 'media';
                    $default_media_destination = ($extension_type == 'plugin') ? 'plg_' . $plugin_group . '_' . $extension_element : $extension_element;
                    $media_destination         = (string)$manifest->media->attributes()->destination ?: $default_media_destination;
                    $folders[]                 = JPATH_ROOT . '/' . $media_folder . '/' . $media_destination;
                }

                // Language files
                if (!empty($manifest->languages->language) && is_object($manifest->languages->language) &&
                    (string)$manifest->languages->language) {
                    foreach ($manifest->languages->language as $lang_element) {
                        $files[] = JPATH_ROOT . '/language/' . (string)$lang_element->attributes()->tag . '/' . basename((string)$lang_element);
                    }
                }
                if (!empty($manifest->administration->languages->language) && is_object($manifest->administration->languages->language) &&
                    (string)$manifest->administration->languages->language
                ) {
                    foreach ($manifest->administration->languages->language as $lang_element) {
                        $files[] = JPATH_ADMINISTRATOR . '/language/' . (string)$lang_element->attributes()->tag . '/' . basename((string)$lang_element);
                    }
                }

                // Plugin files
                if (!empty($manifest->plugins->plugin) && is_object($manifest->plugins->plugin)
                    && (string)$manifest->plugins->plugin->attributes()->plugin
                ) {
                    foreach ($manifest->plugins->plugin as $plg_element) {
                        self::testFilesWriteAbilityForExtension(null, 'plugin', (string)$plg_element->attributes()->plugin, (string)$plg_element->attributes()->group);
                    }
                }
            }

            // Core extension folders
            switch ($extension_type) {
                case 'component':
                    $folders[] = JPATH_ROOT . '/components/' . $extension_element;
                    $folders[] = JPATH_ADMINISTRATOR . '/components/' . $extension_element;

                    break;
                case 'module':
                    if (!empty($manifest) && is_object($manifest)) {
                        $client = (string)$manifest->attributes()->client;
                    }
                    $root_folder = ($client == 'site') ? JPATH_ROOT : JPATH_ADMINISTRATOR;
                    $folders[]   = $root_folder . '/modules/' . $extension_element;

                    break;
                case 'plugin':
                    $folders[] = JPATH_PLUGINS . '/' . $plugin_group . '/' . $extension_element;

                    break;
                case 'library':
                    if (!empty($manifest) && is_object($manifest)) {
                        $library_name = (string)$manifest->libraryname;
                        if ($library_name) {
                            $folders[] = JPATH_LIBRARIES . '/' . $library_name;
                            $files[]   = JPATH_ADMINISTRATOR . '/manifests/libraries/' . $library_name . '.xml';
                        }
                    }

                    break;
                case 'package':
                    $files[] = JPATH_ADMINISTRATOR . '/manifests/packages/pkg_' . (string)$manifest->packagename . '.xml';
                    if (!empty($manifest->files) && is_object($manifest->files)) {
                        $sub_items = $manifest->files->file;
                        if ((string)$sub_items) {
                            foreach ($sub_items as $sub_item) {
                                $sub_type   = (string)$sub_item->attributes()->type;
                                $sub_id     = (string)$sub_item->attributes()->id;
                                $sub_group  = null;
                                $sub_client = null;
                                if ($sub_type) {
                                    if ($sub_type == 'plugin') {
                                        $sub_group = (string)$sub_item->attributes()->group;
                                    }
                                    if ($sub_type == 'module') {
                                        $sub_client = (string)$sub_item->attributes()->client;
                                    }
                                    self::testFilesWriteAbilityForExtension(null, $sub_type, $sub_id, $sub_group, $sub_client);
                                }
                            }
                        }
                    }
                default:
                    break;
            }

            foreach ($folders as $path) {
                if (JFolder::exists($path)) {
                    $iterator = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS | RecursiveDirectoryIterator::CURRENT_AS_PATHNAME),
                        RecursiveIteratorIterator::SELF_FIRST,
                        RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
                    );

                    foreach ($iterator as $item_path) {
                        self::checkPathWriteAbility($item_path, $item_path, $error_flag);
                    }
                }
            }

            foreach ($files as $file) {
                if (JFile::exists($file)) {
                    self::checkPathWriteAbility($file, $file, $error_flag);
                }
            }
        } catch (Exception $e) {
        }

        return $error_flag;
    }
}
