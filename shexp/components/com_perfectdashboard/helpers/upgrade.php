<?php
/**
 * @package     perfectdashboard
 * @version     1.2.0
 *
 * @copyright   Copyright (C) 2017 Perfect Dashboard. All rights reserved. https://perfectdashboard.com
 * @license     GNU General Public Licence http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die;

/**
 * Upgrade class - gets extension upgrade info for specified Joomla versions.
 */
class PerfectDashobardUpgrade extends JObject
{
    /**
     * Versions of Joomla for which extension upgrade info will be checked.
     *
     * @var    array
     */
    public $cms_versions;

    /**
     * Version of extension for which pgrade info will be checked.
     *
     * @var    string
     */
    public $ext_version;

    /**
     * Result upgrade info for extension.
     *
     * @var    array
     */
    public $upgrade_status;

    /**
     * For collections.
     *
     * @var    array
     */
    public $detailsurl;

    /**
     * For collections.
     *
     * @var    array
     */
    public $currentExtension;

    /**
     * For collections.
     *
     * @var    string
     */
    public $extType;

    /**
     * For collections.
     *
     * @var    string
     */
    public $extElement;

    /**
     * Update manifest <name> element
     *
     * @var    string
     */
    protected $name;

    /**
     * Update manifest <description> element
     *
     * @var    string
     */
    protected $description;

    /**
     * Update manifest <element> element
     *
     * @var    string
     */
    protected $element;

    /**
     * Update manifest <type> element
     *
     * @var    string
     */
    protected $type;

    /**
     * Update manifest <version> element
     *
     * @var    string
     */
    protected $version;

    /**
     * Update manifest <infourl> element
     *
     * @var    string
     */
    protected $infourl;

    /**
     * Update manifest <client> element
     *
     * @var    string
     */
    protected $client;

    /**
     * Update manifest <group> element
     *
     * @var    string
     */
    protected $group;

    /**
     * Update manifest <downloads> element
     *
     * @var    string
     */
    protected $downloads;

    /**
     * Update manifest <tags> element
     *
     * @var    string
     */
    protected $tags;

    /**
     * Update manifest <maintainer> element
     *
     * @var    string
     */
    protected $maintainer;

    /**
     * Update manifest <maintainerurl> element
     *
     * @var    string
     */
    protected $maintainerurl;

    /**
     * Update manifest <category> element
     *
     * @var    string
     */
    protected $category;

    /**
     * Update manifest <relationships> element
     *
     * @var    string
     */
    protected $relationships;

    /**
     * Update manifest <targetplatform> element
     *
     * @var    string
     */
    protected $targetplatform;

    /**
     * Resource handle for the XML Parser
     *
     * @var    resource
     */
    protected $xmlParser;

    /**
     * Element call stack
     *
     * @var    array
     */
    protected $stack = array('base');

    /**
     * Unused state array
     *
     * @var    array
     */
    protected $stateStore = array();

    /**
     * Object containing the current update data
     *
     * @var    stdClass
     */
    protected $currentUpdate;

    /**
     * Object containing the latest update data
     *
     * @var    stdClass
     */
    protected $latest;

    public function __construct($properties = null)
    {
        parent::__construct($properties);

        $this->extType = isset($properties['type']) ? $properties['type'] : '';
        $this->extElement = isset($properties['element']) ? $properties['element'] : '';

        foreach ($this->cms_versions as $cms_version) {
            $this->upgrade_status[$cms_version] = 0;
            $this->detailsurl[$cms_version] = '';
        }
    }

    /**
     * Gets the reference to the current direct parent
     *
     * @return  object
     */
    protected function _getStackLocation()
    {
        return implode('->', $this->stack);
    }

    /**
     * Get the last position in stack count
     *
     * @return  string
     */
    protected function _getLastTag()
    {
        return $this->stack[count($this->stack) - 1];
    }

    /**
     * XML Start Element callback
     *
     * @param   object  $parser  Parser object
     * @param   string  $name    Name of the tag found
     * @param   array   $attrs   Attributes of the tag
     *
     * @return  void
     *
     * @note    This is public because it is called externally
     */
    public function _startElement($parser, $name, $attrs = array())
    {
        array_push($this->stack, $name);
        $tag = $this->_getStackLocation();

        // Reset the data
        if (isset($this->$tag)) {
            $this->$tag->_data = "";
        }

        switch ($name) {
            // This is a new update; create a current update
            case 'UPDATE':
                $this->currentUpdate = new stdClass;
                break;

            // Don't do anything
            case 'UPDATES':
                break;

            case 'EXTENSION':
                $this->currentExtension = new stdClass;

                foreach ($attrs as $key => $data) {
                    $key                          = strtolower($key);
                    $this->currentExtension->$key = $data;
                }
                break;

            // Don't do anything
            case 'EXTENSIONSET':
                break;

            // For everything else there's...the default!
            default:
                $name = strtolower($name);

                if (!isset($this->currentUpdate->$name)) {
                    $this->currentUpdate->$name = new stdClass;
                }
                $this->currentUpdate->$name->_data = '';

                foreach ($attrs as $key => $data) {
                    $key                              = strtolower($key);
                    $this->currentUpdate->$name->$key = $data;
                }
                break;
        }
    }

    /**
     * Callback for closing the element
     *
     * @param   object  $parser  Parser object
     * @param   string  $name    Name of element that was closed
     *
     * @return  void
     *
     * @note    This is public because it is called externally
     */
    public function _endElement($parser, $name)
    {
        array_pop($this->stack);
        switch ($name) {
            // Closing update, find the latest version and check
            case 'UPDATE':
                $ver     = new JVersion;
                $product = strtolower(JFilterInput::getInstance()->clean($ver->PRODUCT,
                        'cmd'));

                // Check for optional min_dev_level and max_dev_level attributes to further specify targetplatform (e.g., 3.0.1)
                if (isset($this->currentUpdate->targetplatform->name) && $product
                    == $this->currentUpdate->targetplatform->name) {
                    foreach ($this->cms_versions as $cms_version) {
                        $cms_version_explode = explode('.', $cms_version);
                        if (isset($cms_version_explode[1])) {
                            $cms_release = $cms_version_explode[0].'.'.$cms_version_explode[1];
                        } else {
                            $cms_release = $cms_version;
                        }
                        if (isset($cms_version_explode[2])) {
                            $cms_dev_level = $cms_version_explode[2];
                        } else {
                            $cms_dev_level = 0;
                        }

                        if (empty($this->upgrade_status[$cms_version]) && preg_match('/'.$this->currentUpdate->targetplatform->version.'/',
                                $cms_release) && ((!isset($this->currentUpdate->targetplatform->min_dev_level))
                            || $cms_dev_level >= $this->currentUpdate->targetplatform->min_dev_level)
                            && ((!isset($this->currentUpdate->targetplatform->max_dev_level))
                            || $cms_dev_level <= $this->currentUpdate->targetplatform->max_dev_level)) {
                            if (version_compare($this->currentUpdate->version->_data,
                                    $this->ext_version, '>') == 1) {
                                $this->upgrade_status[$cms_version] = 2;
                            } else {
                                $this->upgrade_status[$cms_version] = 1;
                            }
                        }
                    }
                }
                break;
            case 'UPDATES':
                // If the latest item is set then we transfer it to where we want to
                if (isset($this->latest)) {
                    foreach (get_object_vars($this->latest) as $key => $val) {
                        $this->$key = $val;
                    }
                    unset($this->latest);
                    unset($this->currentUpdate);
                } elseif (isset($this->currentUpdate)) {
                    // The update might be for an older version of j!
                    unset($this->currentUpdate);
                }
                break;
            case 'EXTENSION':
                if ($this->currentExtension->type == $this->extType && $this->currentExtension->element == $this->extElement) {
                    foreach ($this->cms_versions as $cms_version) {
                        // For collections there is a extension list.
                        if (empty($this->currentExtension->targetplatformversion)) {
                            // If item of this list hasn't got targetplatformversion, then set it's details url for each cms_version.
                            if (empty($this->detailsurl[$cms_version])) {
                                $this->detailsurl[$cms_version] = $this->currentExtension->detailsurl;
                            }
                        } else {
                            if ($cms_version == $this->currentExtension->targetplatformversion) {
                                $this->detailsurl[$cms_version] = $this->currentExtension->detailsurl;
                            } else {
                                $cms_version_explode = explode('.', $cms_version);
                                if (isset($cms_version_explode[1])) {
                                    $cms_release = $cms_version_explode[0].'.'.$cms_version_explode[1];
                                } else {
                                    $cms_release = $cms_version;
                                }
                                if ($cms_release == $this->currentExtension->targetplatformversion) {
                                    $this->detailsurl[$cms_version] = $this->currentExtension->detailsurl;
                                }
                            }
                        }
                    }
                }
                break;
            case 'EXTENSIONSET':
                break;
        }
    }

    /**
     * Character Parser Function
     *
     * @param   object  $parser  Parser object.
     * @param   object  $data    The data.
     *
     * @return  void
     *
     * @note    This is public because its called externally.
     */
    public function _characterData($parser, $data)
    {
        $tag = $this->_getLastTag();

        // @todo remove code: if(!isset($this->$tag->_data)) $this->$tag->_data = '';
        // @todo remove code: $this->$tag->_data .= $data;
        // Throw the data for this item together
        $tag = strtolower($tag);
        if (isset($this->currentUpdate->$tag)) {
            $this->currentUpdate->$tag->_data .= $data;
        }
    }

    /**
     * Loads an XML file from a URL.
     *
     * @param   string  $url  The URL.
     *
     * @return  boolean  True on success
     */
    public function loadFromXML($url)
    {
        $http     = JHttpFactory::getHttp();
        $response = $http->get($url);
        if (200 != $response->code) {
            // TODO: Add a 'mark bad' setting here somehow
            JLog::add(JText::sprintf('JLIB_UPDATER_ERROR_EXTENSION_OPEN_URL',
                    $url), JLog::WARNING, 'jerror');
            return false;
        }

        $this->xmlParser = xml_parser_create('');
        xml_set_object($this->xmlParser, $this);
        xml_set_element_handler($this->xmlParser, '_startElement', '_endElement');
        xml_set_character_data_handler($this->xmlParser, '_characterData');

        if (!xml_parse($this->xmlParser, $response->body)) {
            die(
                sprintf(
                    "XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($this->xmlParser)),
                    xml_get_current_line_number($this->xmlParser)
                )
            );
        }
        xml_parser_free($this->xmlParser);
        return true;
    }
}