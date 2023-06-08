<?php
/**
 * @package     perfectdashboard
 * @version     1.2.0
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

jimport('joomla.updater.update');
require_once JPATH_ADMINISTRATOR.'/components/com_installer/models/update.php';

class PerfectdashboardModelExtensions extends JModelLegacy
{
    public $language;
    public $core_extensions = array(
        'component' => array(
            'com_admin',
            'com_ajax',
            'com_banners',
            'com_cache',
            'com_categories',
            'com_checkin',
            'com_config',
            'com_contact',
            'com_content',
            'com_contenthistory',
            'com_cpanel',
            'com_finder',
            'com_installer',
            'com_joomlaupdate',
            'com_languages',
            'com_login',
            'com_mailto',
            'com_media',
            'com_menus',
            'com_messages',
            'com_modules',
            'com_newsfeeds',
            'com_plugins',
            'com_postinstall',
            'com_redirect',
            'com_search',
            'com_tags',
            'com_templates',
            'com_users',
            'com_wrapper',
        ),
        'module' => array(
            'mod_articles_archive',
            'mod_articles_categories',
            'mod_articles_category',
            'mod_articles_latest',
            'mod_articles_news',
            'mod_articles_popular',
            'mod_banners',
            'mod_breadcrumbs',
            'mod_custom',
            'mod_feed',
            'mod_finder',
            'mod_footer',
            'mod_languages',
            'mod_login',
            'mod_menu',
            'mod_random_image',
            'mod_related_items',
            'mod_search',
            'mod_stats',
            'mod_syndicate',
            'mod_tags_popular',
            'mod_tags_similar',
            'mod_users_latest',
            'mod_weblinks',
            'mod_whosonline',
            'mod_wrapper',
            'admin/mod_custom',
            'admin/mod_feed',
            'admin/mod_latest',
            'admin/mod_logged',
            'admin/mod_login',
            'admin/mod_menu',
            'admin/mod_multilangstatus',
            'admin/mod_popular',
            'admin/mod_quickicon',
            'admin/mod_stats_admin',
            'admin/mod_status',
            'admin/mod_submenu',
            'admin/mod_title',
            'admin/mod_toolbar',
            'admin/mod_version',
        ),
        'plugin' => array(
            'authentication/cookie',
            'authentication/gmail',
            'authentication/joomla',
            'authentication/ldap',
            'captcha/recaptcha',
            'content/contact',
            'content/emailcloak',
            'content/finder',
            'content/geshi',
            'content/joomla',
            'content/loadmodule',
            'content/pagebreak',
            'content/pagenavigation',
            'content/vote',
            'editors/codemirror',
            'editors/none',
            'editors/tinymce',
            'editors-xtd/article',
            'editors-xtd/image',
            'editors-xtd/pagebreak',
            'editors-xtd/readmore',
            'extension/joomla',
            'finder/categories',
            'finder/contacts',
            'finder/content',
            'finder/newsfeeds',
            'finder/tags',
            'quickicon/eosnotify',
            'quickicon/extensionupdate',
            'quickicon/joomlaupdate',
            'search/categories',
            'search/contacts',
            'search/content',
            'search/newsfeeds',
            'search/tags',
            'system/cache',
            'system/debug',
            'system/highlight',
            'system/languagecode',
            'system/languagefilter',
            'system/log',
            'system/logout',
            'system/p3p',
            'system/redirect',
            'system/remember',
            'system/sef',
            'twofactorauth/totp',
            'twofactorauth/yubikey',
            'user/contactcreator',
            'user/joomla',
            'user/profile',
        ),
        'template' => array(
            'atomic',
            'beez3',
            'beez5',
            'beez_20',
            'protostar',
            'admin/bluestork',
            'admin/hathor',
            'admin/isis',
        ),
        'library' => array(
            'fof',
            'idna_convert',
            'joomla',
            'lib_fof30',
            'phpmailer',
            'phpass',
            'phputf8',
            'simplepie',
        ),
        'language' => array(
            'en-GB',
            'admin/en-GB',
        ),
        'file' => array(
            'joomla'
        )
    );

    public function __construct($config = array())
    {
        parent::__construct($config);

        $this->language = JFactory::getLanguage();
    }

    /**
     * Method to get extensions update info.
     *
     * @return  array		Array of extensions update info.
     */
    public function getExtensions()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('name, type, element, folder, client_id, extension_id, manifest_cache, enabled')
            ->from($db->qn('#__extensions'));

        $db->setQuery($query);

        try {
            $exts = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        if (!empty($exts)) {
            // Get info about update servers.
            $update_servers = $this->getUpdateServers();
            // Get info about installed packages.
            $packages       = $this->getPackages();

            $extensions1 = array();
            $extensions2 = array();

            foreach ($exts as $item) {

                $item->element = strtolower(trim($item->element));
                $item->type    = strtolower(trim($item->type));
                $item->folder  = strtolower(trim($item->folder));

                $this->loadLanguage($item->element, $item->type, $item->folder, $item->client_id);

                $extension                 = new stdClass();
                $extension->title          = trim(html_entity_decode(JText::_($item->name)));
                $extension->name           = trim(html_entity_decode($item->name));
                $extension->slug           = $item->element;
                $extension->type           = $item->type;
                $extension->enabled        = $item->enabled;
                $extension->package        = '';
                $extension->update_servers = ((!empty($update_servers[$item->extension_id])) ? $update_servers[$item->extension_id] : null);

                if ($item->type == 'plugin') {
                    $extension->slug = $item->folder.'/'.$item->element;
                }
                if ($item->client_id && in_array($item->type, array('module', 'language', 'template'))) {
                    $extension->slug = 'admin/'.$item->element;
                }

                $pkg_key = md5($extension->type.$extension->slug);
                if (isset($packages[$pkg_key])) {
                    $extension->package = $packages[$pkg_key];
                }

	            // check manifest
	            if (!$manifest = $this->parseJSON($item->manifest_cache))
	            {
		            $manifest = $this->checkManifest($item);
	            }

	            $manifest = new JRegistry($manifest);

                $extension->author     = trim(html_entity_decode($manifest->get('author', '')));
                $extension->author_url = trim(html_entity_decode($manifest->get('authorUrl', '')));

                if ($extension->type == 'file' && $extension->slug == 'joomla') {
                    $extension->type = 'cms';
                    $extension->version = JVERSION;

                    array_unshift($extensions1, $extension);
                } else {
                    $extension->version = $manifest->get('version');

                    if ($extension->package) {
                        // Package child items put at the end
                        array_push($extensions2, $extension);
                    } else {
                        array_push($extensions1, $extension);
                    }
                }
            }
        }

        $output = array(
            'result' => array_merge($extensions1, $extensions2)
        );

        return $output;
    }

	protected function checkManifest($extension)
	{
		switch ($extension->type)
		{
			case 'component':
				$xml_path = JPATH_ADMINISTRATOR . '/components/' . $extension->element . '/' . str_replace('com_', '',
						$extension->element) . '.xml';
				break;

			case 'file':
				$xml_path = JPATH_MANIFESTS . '/files/' . $extension->element . '.xml';
				break;

			case 'library':
				$xml_path = JPATH_MANIFESTS . '/libraries/' . $extension->element . '.xml';
				break;

			case 'module':
				$client   = JApplicationHelper::getClientInfo($extension->client_id);
				$xml_path = $client->path . '/modules/' . $extension->element . '/' . $extension->element . '.xml';
				break;

			case 'package':
				$xml_path = JPATH_MANIFESTS . '/packages/' . $extension->element . '.xml';
				break;

			case 'plugin':
				$client   = JApplicationHelper::getClientInfo($extension->client_id);
				$basePath = $client->path . '/plugins/' . $extension->folder;

				if (is_dir($basePath . '/' . $extension->element))
				{
					$xml_path = $basePath . '/' . $extension->element . '/' . $extension->element . '.xml';
				}
				else
				{
					// @deprecated 4.0 - This path supports Joomla! 1.5 plugin folder layouts
					$xml_path = $basePath . '/' . $extension->element . '.xml';
				}
				break;

			// client can change template folder and language
			// so we try to not search for xml by far.
			// TODO make it better and working.
			case 'language':
			case 'template':
				$xml_path = null;
				break;
		}

		if (!($array = JInstaller::parseXMLInstallFile($xml_path)))
		{
			$array = $this->tryToFixJSON($extension);
		}

		return $array;
	}

	protected function tryToFixJSON($extension)
	{
		// first problem i might know is a to long string ended with not a json tail :(
		if (preg_match('/(.*description\"\:\")(.*)/', $extension->manifest_cache, $match) && isset($match[1]))
		{
			return $this->parseJSON($match[1]);
		}

		return false;
	}

	protected function parseJSON($json_string)
	{
		$json = json_decode($json_string, true);

		// If we are using PHP 5.3.0 or bigger or
		// if this is php 5.2 and json string don't contains `NULL` and function returns null
		if ((function_exists('json_last_error') && json_last_error() !== JSON_ERROR_NONE) || (is_null($json) && strtolower($json_string) !== 'null'))
		{
			return false;
		}
		else
		{
			return $json;
		}
	}

    /**
     * Get update sites with their extensions (it's possible that extnesion has more than one update server).
     *
     * @return boolean
     */
    public function getUpdateServers()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('ue.extension_id, us.type, us.location, us.enabled, '.(version_compare(JVERSION, '3.2.2', '>=') ? 'us.extra_query' : 'NULL AS extra_query'))
            ->from($db->qn('#__update_sites', 'us'))
            ->leftJoin($db->qn('#__update_sites_extensions', 'ue').' ON us.update_site_id = ue.update_site_id')
            ->order('us.enabled DESC, us.update_site_id DESC');

        $db->setQuery($query);

        try {
            $items = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        if (version_compare(JVERSION, '3.0.0', '<'))
        {
            $dispatcher = JDispatcher::getInstance();
        }
        else
        {
            $dispatcher = JEventDispatcher::getInstance();
        }

        $update_sites = array();
        foreach ($items as $item) {

            if (filter_var($item->location, FILTER_VALIDATE_URL) === false) {
                continue;
            }

            if (empty($update_sites[$item->extension_id])) {
                $update_sites[$item->extension_id] = array();
            }

            $headers = array();
            $url = $item->location;
            $results = $dispatcher->trigger('onInstallerBeforePackageDownload', array(&$url, &$headers));

            $update_site = array(
                'url' => $item->location,
                'type' => $item->type,
                'enabled' => $item->enabled
            );

            if (!empty($item->extra_query)) {
                $update_site['dl_query'] = $item->extra_query;
            }
            if ($url != $item->location) {
                $update_site['dl_url'] = $url;
            }
            if (!empty($headers)) {
                $update_site['dl_headers'] = $headers;
            }

            $update_sites[$item->extension_id][] = $update_site;
        }

        return $update_sites;
    }

    /**
     * Method to get extensions upgrade status.
     *
     * @return  array		Array of extensions update info.
     */
    public function getUpgradeStatus($versions)
    {
        if (!is_array($versions)) {
            return false;
        }

        // Get all extensions.
        $exts = $this->getExtensionsDbIdKey();

        // Get all available upgrades.
        $exts_upgrades = $this->getUpgrades($versions, $exts);

        // Get all available update sites.
        $exts_with_upsites = $this->getUpdateSitesExtensions();

        $extensions = array();

        foreach ($exts as $item) {
            $this->loadLanguage($item->element, $item->type, $item->folder, $item->client_id);
            $extension       = new stdClass();
            $extension->name = JText::_($item->name);
            $extension->slug = $item->element;
            $extension->cms  = array();

            if (isset($exts_with_upsites[$item->extension_id])) {
                if (isset($exts_upgrades[$item->extension_id])) {
                    $extension->cms = $exts_upgrades[$item->extension_id];
                } else {
                    foreach ($versions as $version) {
                        $extension->cms[$version] = 0;
                    }
                }
            } else {
                foreach ($versions as $version) {
                    $extension->cms[$version] = 0;
                }
            }

            $extensions[] = $extension;
        }

        return $extensions;
    }

    /**
     * Method to get extensions from db.
     *
     * @return  mixed		Array of extensions on success, false in otherway.
     */
    public function getExtensionsDb($offset = 0, $limit = 4)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('name, type, element, folder, client_id, extension_id, manifest_cache, enabled')
            ->from('#__extensions')
            ->order('case when type = "file" then 1 else 2 end, case when element = "joomla" then 1 else 2 end');

        $db->setQuery($query, $offset, $limit);

        try {
            $result = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }

    /**
     * Method to get extensions from db indexed by extenions id.
     *
     * @return  mixed		Array of extensions on success, false in otherway.
     */
    public function getExtensionsDbIdKey()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('name, type, element, folder, client_id, extension_id, manifest_cache, enabled')
            ->from('#__extensions');

        $db->setQuery($query);

        try {
            $result = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        $extensions = array();
        foreach ($result as $item) {
            $extensions[$item->extension_id] = $item;
        }

        return $extensions;
    }

    /**
     * Method to set fresh updates info in db.
     */
    public function findUpdates()
    {
        // Use this model to get purge - not in every J! versions it's findUpdates method
        // has purge, so we call purge and then JUpdater::findUpdates
        $update_model = new InstallerModelUpdate();

        try {
            $update_model->purge();
            $updater = JUpdater::getInstance();
            $updater->findUpdates();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Method to get versions of extensions from fresh updates.
     *
     * @return  array		Array of versions of extensions.
     */
    public function getUpdates($extensions_ids = null)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('extension_id, version, detailsurl')
            ->from('#__updates');

        if (!empty($extensions_ids)) {
            $query->where('extension_id IN ('.(is_array($extensions_ids) ? implode(',',
                        $extensions_ids) : $extensions_ids).')');
        }

        $db->setQuery($query);

        try {
            $result = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        $ver = new JVersion;

        $updates = array();
        foreach ($result as $item) {
            // Get update details url
            $update = new JUpdate;
            $update->loadFromXML($item->detailsurl);

            $update_ext = new stdClass();

            // Check for version and optional min_dev_level and max_dev_level attributes to specify target platform
            if (preg_match('/'.$update->get('targetplatform')->version.'/',
                    $ver->RELEASE) && ((!isset($update->get('targetplatform')->min_dev_level))
                || $ver->DEV_LEVEL >= $update->get('targetplatform')->min_dev_level)
                && ((!isset($update->get('targetplatform')->max_dev_level)) || $ver->DEV_LEVEL
                <= $update->get('targetplatform')->max_dev_level)) {
                // If current version fits update target platform then extension is not actual.
                $update_ext->update_state = 2;
            } else {
                // If current version doesn't fit update target platform then it is actual.
                $update_ext->update_state = 1;
            }

            $update_ext->update_version = $item->version;

            $updates[$item->extension_id] = $update_ext;
        }

        return $updates;
    }

    /**
     * Method to get upgrade status of extensions from updates for specified joomla veriosn.
     *
     * @return  array		Array of versions of extensions.
     */
    public function getUpgrades($cms_versions, $extensions)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // check version and use extra_query
        $query->select('extension_id, location as detailsurl, type')
            ->from($db->quoteName('#__update_sites', 'us'))
            ->innerJoin($db->quoteName('#__update_sites_extensions', 'use').' ON us.update_site_id = use.update_site_id');

        $db->setQuery($query);

        try {
            $result = $db->loadObjectList();
        } catch (Exception $e) {
            return false;
        }

        $ver = new JVersion;

        $upgrades = array();

        require_once JPATH_COMPONENT.'/helpers/upgrade.php';

        foreach ($result as $item) {
            if (empty($extensions[$item->extension_id]) || empty($extensions[$item->extension_id]->manifest_cache)) {
                continue;
            }

            $ext_manifest = json_decode($extensions[$item->extension_id]->manifest_cache);
            $ext_version  = $ext_manifest->version;
            $properties   = array('cms_versions' => $cms_versions, 'ext_version' => $ext_version);

            if ($item->type == 'collection') {
                $properties['type'] = $extensions[$item->extension_id]->type;
                $properties['element'] = $extensions[$item->extension_id]->element;
                $upgrade      = new PerfectDashobardUpgrade($properties);
                // Get upgrade details url
                $upgrade->loadFromXML($item->detailsurl);

                $detailsurls = $upgrade->get('detailsurl');

                // Take all same url in one element and gather for it all versions.
                $url_for_versions = array();
                foreach ($detailsurls as $version => $url) {
                    if (!empty($url)) {
                        if (empty($url_for_versions[$url])) {
                            $url_for_versions[$url] = array();

                        }
                        $url_for_versions[$url][] = $version;
                    }
                }

                if (empty($upgrades[$item->extension_id])) {
                    $upgrades[$item->extension_id] = array();
                }
                foreach ($url_for_versions as $detailsurl => $versions) {
                    $properties = array('cms_versions' => $versions, 'ext_version' => $ext_version);
                    $upgrade    = new PerfectDashobardUpgrade($properties);

                    $upgrade->loadFromXML($detailsurl);

                    $upgrades[$item->extension_id] = array_merge($upgrades[$item->extension_id], $upgrade->get('upgrade_status'));
                }
            } else {
                $upgrade      = new PerfectDashobardUpgrade($properties);
                // Get upgrade details url
                $upgrade->loadFromXML($item->detailsurl);

                $upgrades[$item->extension_id] = $upgrade->get('upgrade_status');
            }

            if (empty($upgrades[$item->extension_id])) {
                foreach ($cms_versions as $version) {
                    $upgrades[$item->extension_id][$version] = 0;
                }
            }
        }

        return $upgrades;
    }

    /**
     * Method to get all extensions that have available update site.
     *
     * @return  array		Array of update sites of extensions.
     */
    public function getUpdateSitesExtensions($extensions_ids = null)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('DISTINCT extension_id')
            ->from('#__update_sites_extensions');

        if (!empty($extensions_ids)) {
            $query->where('extension_id IN ('.(is_array($extensions_ids) ? implode(',',
                        $extensions_ids) : $extensions_ids).')');
        }

        $db->setQuery($query);

        try {
            $result = $db->loadColumn();
        } catch (Exception $e) {
            return false;
        }

        return array_flip($result);
    }

    public function isUpToDate($extension_id)
    {
        $has_update_site = $this->getUpdateSitesExtensions($extension_id);
        if (empty($has_update_site)) {
            return false;
        } else {
            //$this->findUpdates();//Maybe not neccessary - get newest update info.
            $updates = $this->getUpdates($extension_id);

            if (isset($updates[$extension_id]->update_state) && $updates[$extension_id]->update_state
                == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Method to load language for specific extension.
     *
     * @param   string  $name   Name of extension.
     */
    public function loadLanguage($element, $type, $folder, $client_id)
    {
        $paths = array(JPATH_ADMINISTRATOR, JPATH_ROOT);
        if ($type == 'component') {
            $key = $element;
            $paths[] = JPATH_ADMINISTRATOR.'/components/'.$element;
            $paths[] = JPATH_ROOT.'/components/'.$element;
        } elseif ($type == 'module') {
            $key = $element;
            $paths[] = ($client_id ? JPATH_ADMINISTRATOR : JPATH_ROOT).'/modules/'.$element;
        } elseif ($type == 'plugin') {
            $key = 'plg_'.$folder.'_'.$element;
            $paths[] = JPATH_PLUGINS.'/'.$folder.'/'.$element;
        } elseif ($type == 'template') {
            $key = 'tpl_'.$element;
            $paths[] = ($client_id ? JPATH_ADMINISTRATOR : JPATH_ROOT).'/templates/'.$element;
        } elseif ($type == 'library') {
            $key = 'lib_'.$element;
        } elseif ($type == 'file') {
            $key = 'file_'.$element;
        } else {
            $key = $element;
        }

        foreach ($paths as $path) {
            if ($this->language->load($key.'.sys', $path, 'en-GB')) {
                break;
            }
        }
    }

    /**
     * Get installed packages info.
     *
     * @return string
     */
    public function getPackages()
    {
        jimport('joomla.filesystem.folder');
        $manifests_files = JFolder::files(JPATH_MANIFESTS.'/packages/', '\.xml$');

        $packages = array();
        foreach ($manifests_files as $manifests_file) {
            $manifest = simplexml_load_file(JPATH_MANIFESTS.'/packages/'.$manifests_file);
            $pkg_name = 'pkg_'.strtolower(trim($manifest->packagename));
            if (isset($manifest->files->file)) {
                foreach ($manifest->files->file as $file) {

                    if (isset($file['id']) && $file['id']) {
                        $slug = strtolower(trim($file['id']));
                    } else {
                        continue;
                    }

                    $type = null;
                    if (isset($file['type']) && $file['type']) {
                        $type = strtolower(trim($file['type']));
                        if ($file['type'] == 'plugin' && isset($file['group']) && $file['group']) {
                            $slug = strtolower(trim($file['group'])).'/'.$slug;
                        } elseif (isset($file['client']) && ($file['client'] == 1 || strtolower($file['client']) == 'administrator')
                            && in_array($file['type'], array('module', 'language', 'template'))) {
                            $slug = 'admin/'.$slug;
                        }
                    }

                    $packages[md5($type.$slug)] = $pkg_name;
                }
            }
        }

        return $packages;
    }

    /**
     * Disable all none core extensions, or extensions given in argument.
     *
     * @param array $extensions List of extensions to disable.
     * @return boolean
     */
    public function disableExtensions($extensions)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Fields to update.
        $fields = array(
            $db->quoteName('enabled').' = 0',
        );

        $glue = 'AND';
        // Set conditions for which records should be updated.
        if (empty($extensions)) { // Disable all non core extensions.
            $conditions = array();
            foreach ($this->core_extensions as $type => $slugs) {
                foreach ($slugs as $slug) {
                    $extension = $this->getExtension($type, $slug);

                    $where = array();
                    if ($extension->folder !== null) {
                        $where[] = $db->quoteName('folder').' != '.$db->quote($extension->folder);
                    }
                    if ($extension->client_id !== null) {
                        $where[] = $db->quoteName('client_id').' != '.$db->quote($extension->client_id);
                    }

                    $where[] = $db->quoteName('type').' != '.$db->quote($extension->type);
                    $where[] = $db->quoteName('element').' != '.$db->quote($extension->element);

                    $conditions[] = '('.implode(' OR ', $where).')';
                }
            }
            // Also do not disable com_perfectdashboard extension.
            $conditions[] = '('.$db->quoteName('element').' != '.$db->q('com_perfectdashboard').' OR '.$db->quoteName('type').' != '.$db->q('component').')';
        } else { // Disable extensions given in argument.
            $conditions = array();
            foreach ($extensions as $ext) {
                $extension = $this->getExtension($ext['type'], $ext['slug']);

                $where = array();
                if ($extension->folder !== null) {
                    $where[] = $db->quoteName('folder').' = '.$db->quote($extension->folder);
                }
                if ($extension->client_id !== null) {
                    $where[] = $db->quoteName('client_id').' = '.$db->quote($extension->client_id);
                }

                $where[] = $db->quoteName('type').' = '.$db->quote($extension->type);
                $where[] = $db->quoteName('element').' = '.$db->quote($extension->element);

                $conditions[] = '('.implode(' AND ', $where).')';
            }
            $glue = 'OR';
        }

        $query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions,
            $glue);

        $db->setQuery($query);

        try {
            $db->execute();
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }

    /**
     * Enable all none core extensions, or extensions given in argument.
     *
     * @param array $extensions List of extensions to enable, if it contains only 'all' element then all extensions will be enabled.
     * @return boolean
     */
    public function enableExtensions($extensions)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Fields to update.
        $fields = array(
            $db->quoteName('enabled').' = 1',
        );

        $glue = 'AND';
        // Set conditions for which records should be updated.
        if (empty($extensions)) { // Enable all non core extensions.
            $conditions = array();
            foreach ($this->core_extensions as $type => $slugs) {
                foreach ($slugs as $slug) {
                    $extension = $this->getExtension($type, $slug);

                    $where = array();
                    if ($extension->folder !== null) {
                        $where[] = $db->quoteName('folder').' != '.$db->quote($extension->folder);
                    }
                    if ($extension->client_id !== null) {
                        $where[] = $db->quoteName('client_id').' != '.$db->quote($extension->client_id);
                    }

                    $where[] = $db->quoteName('type').' != '.$db->quote($extension->type);
                    $where[] = $db->quoteName('element').' != '.$db->quote($extension->element);

                    $conditions[] = '('.implode(' OR ', $where).')';
                }
            }
            // Also do not enable com_perfectdashboard (it is already enabled)
            $conditions[] = '('.$db->quoteName('element').' != '.$db->q('com_perfectdashboard').' OR '.$db->quoteName('type').' != '.$db->q('component').')';
        } else { // Enable extensions basing on argument.
            $conditions = array();
            if (isset($extensions[0]) && $extensions[0] == 'all') { // Enable all extensions.
                $conditions = array('1');
            } else { // Enable only extensions from argument.
                foreach ($extensions as $ext) {
                    $extension = $this->getExtension($ext['type'], $ext['slug']);

                    $where = array();
                    if ($extension->folder !== null) {
                        $where[] = $db->quoteName('folder').' = '.$db->quote($extension->folder);
                    }
                    if ($extension->client_id !== null) {
                        $where[] = $db->quoteName('client_id').' = '.$db->quote($extension->client_id);
                    }

                    $where[] = $db->quoteName('type').' = '.$db->quote($extension->type);
                    $where[] = $db->quoteName('element').' = '.$db->quote($extension->element);

                    $conditions[] = '('.implode(' AND ', $where).')';
                }
                $glue = 'OR';
            }
        }

        $query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions,
            $glue);

        $db->setQuery($query);

        try {
            $db->execute();
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }

    public function getExtension($type, $slug)
    {
        $extension            = new stdClass();
        $extension->folder    = null;
        $extension->client_id = null;

        if ($slug == 'joomla' && $type == 'cms') {
            $type = 'file';
        } elseif ($type == 'plugin') {
            list($extension->folder, $slug) = explode('/', $slug, 2);
        } elseif (in_array($type, array('module', 'language', 'template'))) {
            if (strpos($slug, 'admin/') === 0) {
                $extension->client_id = 1;
                list(, $slug) = explode('/', $slug, 2);
            } else {
                $extension->client_id = 0;
            }
        }
        $extension->type    = $type;
        $extension->element = $slug;

        return $extension;
    }
}
