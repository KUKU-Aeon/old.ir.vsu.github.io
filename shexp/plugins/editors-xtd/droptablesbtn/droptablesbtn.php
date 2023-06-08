<?php
/** 
 * Droptables
 * 
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package Droptables
 * @copyright Copyright (C) 2014 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2014 Damien Barrère (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;

class plgButtonDroptablesbtn extends JPlugin
{
    
        protected $do = true;
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{

            parent::__construct($subject, $config);
            JLoader::register('DroptablesBase', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/droptablesBase.php');
            if(!class_exists('DroptablesBase')){
                $this->do = false;
            }
            $lang = JFactory::getLanguage();
            $lang->load('plg_editors-xtd_droptablesbtn',JPATH_PLUGINS.'/editors-xtd/droptablesbtn',null,true);
            $lang->load('plg_editors-xtd_droptablesbtn.sys',JPATH_PLUGINS.'/editors-xtd/droptablesbtn',null,true);
            
            // Access check.
            if (!JFactory::getUser()->authorise('core.manage', 'com_droptables')) {
                $this->do = false;
            }
        }


	/**
	 * Display the button
	 *
	 * @return array A four element array of (code)
	 */
	public function onDisplay($name)
	{
            
                if(!$this->do){
                    return '';
                }
		/*
		 * Javascript to insert the link
		 * View element calls jSelectArticle when an article is clicked
		 * jSelectArticle creates the link tag, sends it to the editor,
		 * and closes the select frame.
		 */
		$js = "
		function jInsertTable(html) {
			jInsertEditorText(html, '".$name."');
			SqueezeBox.close();
		}";

		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);

		$doc->addStyleDeclaration('.icon-droptables:before {
		    content: "\e600";
		}');
		$doc->addStyleSheet(JUri::root(true).'/components/com_droptables/assets/css/font.css');
                
		JHtml::_('behavior.modal');
                
		/*
		 * Use the built-in element view to select the article.
		 * Currently uses blank class.
		 */
                $path = urlencode(JURI::root(true)) ;
                
		$link = 'index.php?option=com_droptables&amp;tmpl=component&amp;'.JSession::getFormToken().'=1&caninsert=1&e_name=' . $name . '&template=system&path='.$path;
                
                
		$button = new JObject();
		$button->set('modal', true);
		$button->set('link', $link);
		$button->set('class', 'btn');
		$button->set('text', JText::_('PLG_DROPTABLES_BUTTON'));
		$button->set('name', 'droptables');
		$button->set('options', "{handler: 'iframe', size: {x: (window.getSize().x*80/100), y: (window.getSize().y-50)}}");

		return $button;
	}
}
