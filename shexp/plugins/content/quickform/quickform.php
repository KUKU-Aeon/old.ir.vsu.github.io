<?php 
/**
* @package		Joomla & QuickForm
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class plgContentQuickForm extends JPlugin
{
	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}

		if ( JString::strpos( $row->text, '{QuickForm id=' ) === false ) {
			return true;
		}
		
		$lang = JFactory::getLanguage();
		$lang->load('com_quickform');
		
		require_once(JPATH_ADMINISTRATOR."/components/com_quickform/helpers/form.php");
		$plugin = JPluginHelper::getPlugin('content', 'quickform');
		$pattern = '/{QuickForm\s*.*?}/i';
		if ( !$this->params->def( 'enabled', 1 ) ) {
			$row->text = preg_replace( $pattern, '', $row->text );
			return true;
		}
		preg_match_all( $pattern, $row->text, $matches );
		$count = count( $matches[0] );
		if ( $count ) {
			$this->plgContentReplaceQuickForm( $row, $matches, $count, $pattern );
		}
	}
	
	function plgContentReplaceQuickForm(&$row, &$matches, $count, $pattern) {
		for ( $i=0; $i < $count; $i++ ){
			$id = trim(preg_replace("/.*?id.*?=/i", "", trim($matches[0][$i])));
			$id = str_replace( '}', '', $id );
			$btn	= $this->plgContentLoadQuickForm( $id);
			$row->text 	= str_replace($matches[0][$i], $btn, $row->text );
		}
	}
	
	function plgContentLoadQuickForm($id){
	
		$contents = new QuickForm($id);;
		return $contents->getHTML();
	}
}
