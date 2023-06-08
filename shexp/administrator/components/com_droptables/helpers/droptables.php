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


defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_messages
 * @since		1.6
 */
class DroptablesHelper
{
    
        /**
	 * @var    JObject  A cache for the available actions.
	 * @since  1.6
	 */
	protected static $actions;
        
        protected static $resultCalc;
        protected static $n;
        /**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */

	public static function addSubmenu($vName)
	{
//		JSubMenuHelper::addEntry(
//			JText::_('COM_MESSAGES_ADD'),
//			'index.php?option=com_messages&view=message&layout=edit',
//			$vName == 'message'
//		);
//
//		JSubMenuHelper::addEntry(
//			JText::_('COM_MESSAGES_READ'),
//			'index.php?option=com_messages',
//			$vName == 'messages'
//		);
	}


        public static function compileStyle($table,$style,$customCss){
            jimport( 'joomla.filesystem.folder' );
            jimport( 'joomla.filesystem.file' );
            
            $folder = JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'droptables'.DIRECTORY_SEPARATOR;
            $file = $folder.JFile::makeSafe($table->id.'_'.$table->hash.'.css');
            if(!JFile::exists($file)){
                $files = glob($folder.$table->id.'_*.css');
                foreach ($files as $f) {
                    JFile::delete($f);
                }
            }else{
                return true;
            }
                        
            JLoader::register('lessc', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/lessphp.php');
            JLoader::register('csstidy', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/csstidy/class.csstidy.php');

            $less = new lessc;        
            try {
                $content = $less->compile('#droptablestable'.$table->id.'.droptablestable {'.$style.'}');
            } catch (Exception $exc) {
                return false;
            }
	    
            try {
                $customContent = $less->compile('#droptablestable'.$table->id.'.droptablestable table tbody {'.$customCss.'}');
            } catch (Exception $exc) {
                
            }
	    $content .= $customContent;
            $csstidy = new csstidy();
            $csstidy->parse($content);

            $less->setFormatter('compressed');
            try {
                $content = $less->compile($csstidy->print->plain());
            } catch (Exception $exc) {
                return false;
            }
            if(JFile::write($file, $content)){                
                return true;
            }
            return false;
        }
        
        public static function htmlRender($table) {
            
            $table_hash = md5($table->datas. $table->style. json_encode($table->params) );   
            $folder = JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'droptables'.DIRECTORY_SEPARATOR;                
            $file = $folder . $table->id . '_' . $table_hash . '.html';
            
            if (!file_exists($file)) {
                $files = glob($folder . $table->id . '_*.html');
                foreach ($files as $f) {
                    unlink($f);
                }
            } else {
                return true;
            }
            
            $datas = json_decode($table->datas);
            $style = json_decode($table->style);            
            if(isset($table->params['mergeSetting']) ) {
                $mergeSetting = json_decode($table->params['mergeSetting']);        
            }else {
                $mergeSetting = array();
            }           
                        
            if(isset($style->table->responsive_type) && $style->table->responsive_type=="hideCols"){
                $responsive_type = "hideCols";   
            }else {
                 $responsive_type = "scroll";
            }            
            if($responsive_type == "hideCols"){
                $hideCols = true;
                $res_prioritys = array();
                foreach ($style->cols as $col) {
                    if(isset($col[1]->res_priority)){
                        $res_prioritys[(string)$col[0]] = ($col[1]->res_priority == "persistent") ? "persistent" : (int)$col[1]->res_priority;                          
                    }
                }               
                $priority = json_encode($res_prioritys,JSON_FORCE_OBJECT);               
            } else {
                $hideCols = false;  
                $priority="{}";
            }
            if(!isset($style->table->freeze_col)) $style->table->freeze_col = 0;
            if(!isset($style->table->freeze_row)) $style->table->freeze_row = 0;
            if(!isset($style->table->enable_filters)) $style->table->enable_filters = 0;
            
            if(isset($style->table->use_sortable) && $style->table->use_sortable==1){
                $sortable = true;
                $heads = 1;
            }else{
                $sortable = false;
                $heads = 0;
                if($responsive_type == "scroll"){
                    if( ($style->table->freeze_row) || ($style->table->freeze_col) ){                      
                          $heads = 1;
                    }
                }
                if( $style->table->enable_filters) {
                    $heads = 1;
                } 
            }
            
            $content = '';
            $rowNb = 0;
            if($datas!==null && !empty($datas)){
                $content .= '<div class="droptablesresponsive  droptablestable" id="droptablestable'.(int)$table->id.'">';
                $tblCls = ($sortable ? 'sortable' : '');      
                if(!$hideCols ) {
                    if( ($style->table->freeze_row) || ($style->table->freeze_col) ){                      
                        $tblCls .= ' fxdHdrCol';
                    }
                }
                if( $style->table->enable_filters) {
                    $tblCls .= ' filterable';
                }
                if(!isset($style->table->table_height) ) {
                    $style->table->table_height = 0;
                }
                
                $content .= '<table id="droptablesTbl' . (int) $table->id . '" data-id="'.$table->id. '" data-hidecols="'.(int)$hideCols.'" data-priority="'. htmlspecialchars($priority, ENT_QUOTES, 'UTF-8') . '"'
                  . '  data-freeze-cols="'.(int)$style->table->freeze_col . '"  data-freeze-rows="'.(int)$style->table->freeze_row 
                  .  '" data-table-height="'.(int)$style->table->table_height . '" class="'. $tblCls  . '">';

                foreach ($datas as $row) {
                    if($rowNb<$heads && $rowNb==0){
                        $content .= '<thead>';
                    }else{
                        if($rowNb==$heads){
                            $content .= '<tbody>';
                        }
                    }
                    $content .= '<tr>';
                    $colNb = 0;                
                    foreach ($row as $col) {
                        $mergeInfo = self::checkMergeInfo($rowNb, $colNb,$mergeSetting);

                        if($rowNb<$heads){
                            $content .= '<th '. $mergeInfo .' class="dtr'.$rowNb.' dtc'.$colNb.'">';
                        }else{
                            $content .= '<td '. $mergeInfo .' class="dtr'.$rowNb.' dtc'.$colNb.'">';
                        }
                        
                        $cellHtml = "";
                        if(isset($col[0]) && $col[0]==='='){
                            $pattern = '@^=(SUM|COUNT|MIN|MAX|AVG|CONCAT|sum|count|min|max|avg|concat)\\((.*?)\\)$@';
                            if(preg_match($pattern, $col,$matches)){
                                $cells = explode(";", $matches[2]);
                                $values = array();
                                foreach ($cells as $cell) {
                                    $vals = explode(":",$cell);
                                    $pattern2 = '@([a-zA-Z]+)([0-9]+)@';
                                    if(sizeof($vals)===1){ //single cell
                                        preg_match($pattern2, $cell,$val1);
                                        $d = $datas[$val1[2]-1][self::convertAlpha($val1[1])-1];
                                        $values[] = $d;
                                    }else{ //range          
                                        preg_match($pattern2,$vals[0],$val1);
                                        preg_match($pattern2,$vals[1],$val2);
                                        for($il=$val1[2]-1; $il<=$val2[2]-1; $il++){
                                            for($ik=self::convertAlpha($val1[1])-1; $ik<=self::convertAlpha($val2[1])-1; $ik++){
                                                $values[] = $datas[$il][$ik];
                                            }
                                        }
                                    }
                                }
                                
                                switch (strtoupper($matches[1])){                                    
                                    case 'SUM':                                       
                                        self::$resultCalc = 0;
                                        array_map(function($foo){
                                            if(is_numeric($foo)){
                                                self::$resultCalc += $foo;
                                            }
                                        },$values);
                                      
                                        break;
                                    case 'COUNT':
                                        self::$resultCalc = 0;
                                        array_map(function($foo){
                                            if(is_numeric($foo)){
                                                self::$resultCalc += 1;
                                            }
                                        }, $values);
                                        break;
                                    case 'MIN':
                                        self::$resultCalc = null;
                                        array_map(function($foo){
                                            if(is_numeric($foo)){
                                                if(self::$resultCalc===null || self::$resultCalc > $foo){
                                                    self::$resultCalc = $foo;
                                                }
                                            }
                                        }, $values);
                                        break;
                                    case 'MAX':
                                        self::$resultCalc = 0;
                                        array_map(function($foo){
                                            if(is_numeric($foo)){
                                                if(self::$resultCalc < $foo){
                                                    self::$resultCalc = $foo;
                                                }
                                            }
                                        }, $values);
                                        break;
                                    case 'AVG':
                                        self::$resultCalc = 0;
                                        self::$n = 0;
                                        array_map(function($foo){
                                            if(is_numeric($foo)){
                                                self::$resultCalc += $foo;
                                                self::$n++;
                                            }
                                        }, $values);
                                        if(self::$n > 0){
                                            self::$resultCalc = self::$resultCalc/self::$n;
                                        }
                                        break;
                                    case 'CONCAT':
                                        self::$resultCalc = '';
                                        array_map(function($foo){
                                            if(isset($foo[0]) && (string)$foo[0]!=='=')
                                            self::$resultCalc .= (string)$foo;
                                        }, $values);
                                        break;
                                }
                            }
                            $cellHtml .= self::$resultCalc;
                        }elseif(isset($style->cells->{$rowNb.'!'.$colNb}) && isset($style->cells->{$rowNb.'!'.$colNb}[2]->cell_type) && $style->cells->{$rowNb.'!'.$colNb}[2]->cell_type=='html'){
                                $cellHtml .= $col;
                        }else{
                            $cellHtml .= nl2br($col);
                        }
                        
                        if (isset($style->cells->{$rowNb . '!' . $colNb}) && isset($style->cells->{$rowNb . '!' . $colNb}[2]->tooltip_content) && $style->cells->{$rowNb . '!' . $colNb}[2]->tooltip_content != '') {
                            $content .= '<span class="droptables_tooltip ">'.$cellHtml.'<span class="droptables_tooltipcontent">'.$style->cells->{$rowNb . '!' . $colNb}[2]->tooltip_content .'</span></span>';
                        }else {
                            $content .= $cellHtml;
                        }

                        if($rowNb<$heads){
                            $content .= '</th>';
                        }else{
                            $content .= '</td>';
                        }
                        $colNb++;
                    }
                    if($rowNb<$heads){
                        if($rowNb==$heads){
                            $content .= '</thead>';
                        }
                        $content .= '</th>';
                    }else{
                        $content .= '</tr>';
                    }
                    $rowNb++;
                }

                $content .= '</tbody>';
                
                if( $style->table->enable_filters && count($datas)>10) {
                //pager
                     $content .= '<tfoot><tr>';
                     $content .= '<th colspan="'.$colNb.'" class="ts-pager form-horizontal" >';
                     $content .= '<button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i>
                        </button>
                        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i>
                        </button>	<span class="pagedisplay"></span> 
                        <!-- this can be any element, including an input -->
                        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i>
                        </button>
                        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i>
                        </button>
                        <select class="pagesize input-mini" title="Select page size">
                            <option selected="selected" value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                        <select class="pagenum input-mini" title="Select page number"></select>';
                     $content .= '</th></tr></tfoot>';
                }
        
                $content .= '</table></div>'; //

                
		// Process the content plugins.
		JPluginHelper::importPlugin('content');
                $dispatcher = JEventDispatcher::getInstance();
                $item = new stdClass();
                $item->text = $content;
                $tableParams = array();
		$dispatcher->trigger('onContentPrepare', array ('com_content.article', &$item, &$tableParams, 0));

                $content = $item->text;
            }
            
            if (!file_put_contents($file, @htmlspecialchars($content,ENT_NOQUOTES) )) {
                echo 'error saving file!';
                return false;
            }
            return true;       
        }
        
        //function from http://www.bradino.com/php/excel-column-convert-letters-to-numbers/
        private static function convertAlpha($col){
            $col = str_pad($col,2,'0',STR_PAD_LEFT);
            $i = ($col{0} == '0') ? 0 : (ord($col{0}) - 64) * 26;
            $i += ord($col{1}) - 64;

            return $i;
        }
    
        public static function checkMergeInfo($rowNb, $colNb,$mergeSettings) {
            $result = '';
            if(!is_array($mergeSettings) || count($mergeSettings)==0 ) {
                return $result;
            }
            foreach($mergeSettings as $ms) {
                if($ms->row==$rowNb && $ms->col==$colNb) {
                    $result = ' rowspan="'. $ms->rowspan. '" colspan="'.$ms->colspan. '" ';                         
                }else if( $ms->row <= $rowNb && $rowNb < $ms->row+$ms->rowspan && $ms->col <= $colNb && $colNb < $ms->col+$ms->colspan) {
                    $result = ' style="display:none" ';
                }
            }

            return $result;
        }
    
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return  JObject
	 *
	 * @since   1.6
	 * @todo    Refactor to work with notes
	 */
	public static function getActions()
	{
		if (empty(self::$actions))
		{
			$user = JFactory::getUser();
			self::$actions = new JObject;

			$actions = JAccess::getActions('com_droptables');

			foreach ($actions as $action)
			{
				self::$actions->set($action->name, $user->authorise($action->name, 'com_droptables'));
			}
		}

		return self::$actions;
	}
        
        public static function _displayButtons($e_name, $activedButtons) {
        // Load modal popup behavior
        JHTML::_('behavior.modal', 'a.modal-button');

        $editor = JFactory::getEditor();
        $buttons = array();
        // Get plugins
        $plugins = JPluginHelper::getPlugin('editors-xtd');
        foreach ($plugins as $plugin)
        {
            if ( !in_array($plugin->name, $activedButtons))
            {
                continue;
            }
            JPluginHelper::importPlugin('editors-xtd', $plugin->name, false);
                                $className = 'plgButton' . $plugin->name;

                                if (class_exists($className))
                                {
                                        $plugin = new $className($editor, (array) $plugin);
                                }

                                // Try to authenticate
                                if (method_exists($plugin, 'onDisplay') && $temp = $plugin->onDisplay($e_name,"",""))
                                {
                                        $buttons[] = $temp;
                                }
        }

        $return = '';       
        if (is_array($buttons) || (is_bool($buttons) && $buttons)) {          
            /*
             * This will allow plugins to attach buttons or change the behavior on the fly using AJAX
             */
            if($e_name != 'editor1') {
                $return .= "\n<div id=\"".$e_name."-xtd-buttons\"";
            }else {
                $return .= "\n<div id=\"droptable-xtd-buttons\"";
            }
            
            $return .= " class=\"btn-toolbar \">\n\n<div class=\"btn-toolbar\"";           
            $return .= ">\n";
            $exclue_buttons = array("droptables");
            $exclue_buttons2 = array(JText::_('PLG_READMORE_BUTTON_READMORE'),JText::_('PLG_EDITORSXTD_PAGEBREAK_BUTTON_PAGEBREAK') );
            foreach ($buttons as $button) {
                /*
                 * Results should be an object
                 */
               
                if (!in_array($button->get('name'),$exclue_buttons) && !in_array($button->get('text'),$exclue_buttons2) ) {
                    $modal = ($button->get('modal')) ? ' class="modal-button btn"' : '';
                    $href = ($button->get('link')) ? ' class="btn" href="' . JURI::base() . $button->get('link') . '"' : '';
                    $onclick = ($button->get('onclick')) ? ' onclick="' . $button->get('onclick') . '"' : ' return false;"';
                    $title = ($button->get('title')) ? $button->get('title') : $button->get('text');


                    $return .= '<a' . $modal . ' title="' . $title . '"' . $href . $onclick . ' rel="' . $button->get('options') . '">';                                     
                    $return .= '<i class="icon-' . $button->get('name') . '"></i> ';                                 
                    $return .= $button->get('text') . '</a>';
                }
            }
            
            $return .= "</div>\n";          
            $return .= "</div>\n";
        }

        return $return;
}
	
}
