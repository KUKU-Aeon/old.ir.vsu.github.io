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


//-- No direct access
defined('_JEXEC') || die('=;)');


jimport('joomla.plugin.plugin');
jimport( 'joomla.application.categories' );
jimport( 'joomla.filesystem.file' );

/**
 * Content Plugin.
 *
 * @package    droptables
 * @subpackage Plugin
 */
class plgContentdroptables extends JPlugin
{
    public static $Once=1;
    /**
     * Example before display content method
     *
     * Method is called by the view and the results are imploded and displayed in a placeholder
     *
     * @param  string  $context     The context for the content passed to the plugin.
     * @param  object  &$article    The content object.  Note $article->text is also available
     * @param  object  &$params     The content params
     * @param  int     $limitstart  The 'page' number
     *
     * @return string
     */
    public function onContentPrepare($context, &$article, &$params, $limitstart)
    {

        $this->context = $context;
        
        $article->text = preg_replace_callback('@<img.*?data\-droptablestable="([0-9]+)".*?>@', array($this,'replace'),$article->text);

        /*
         * Sync page code use cUrl
         *
         * */
        $componentParams=JComponentHelper::getParams('com_droptables');
        $sync_periodicity = (int)$componentParams->get('sync_periodicity');
        if( !empty($sync_periodicity) )  {
            $curSyncInterval = $this->curSyncInterval($componentParams);
          
            if ($curSyncInterval >= $sync_periodicity && self::$Once==1) {
		$doc = JFactory::getDocument();
		
                JHtml::_('jquery.framework');
                $script = "jQuery(document).ready(function(){
                        jQuery.ajax({
                            url: '". JUri::root() . "index.php?option=com_droptables&task=frontexcel.syncSpreadsheet'
                        }).done(function (data) {
                           //do nothing
                        });
                    });";
                $doc->addScriptDeclaration($script);
             
		self::$Once=0;
            }
        }
      
        return true;
    }
    
    //number of minutes from now to last sync
    private function curSyncInterval($params){

        //get last_log param       
        if($params->get('last_sync') != null){
            $last_log=$params->get('last_sync');
            $time_old=(int)strtotime($last_log);
        }
        else{
            $time_old=0;
        }

        $time_new=(int)strtotime(date('Y-m-d H:i:s'));
        $timeInterval=$time_new-$time_old;
        $curtime=$timeInterval/60;

        return $curtime;
    }
    
    private function replace($match){
        JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_droptables/models/','DroptablesModelTable');
        JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_droptables/tables/','DroptablesTablesTable');
        $version = '2.3.0';
          
        $exp = '@<img.*data\-droptables\-chart="([0-9]+)".*?>@';
        preg_match($exp, $match[0], $matches);
        if(count($matches) > 0 ) { //is a chart
            $content = '';
            $model = JModelLegacy::getInstance('Chart','droptablesModel');

            $chart = $model->getChart($matches[1]);           
            if($chart) {
                //var_dump($chart);
                $chartData = $this->getChartData($chart->datas, $chart->tData);
               // var_dump($chartData);
                $chartConfig = json_decode($chart->config);
                //var_dump($chartConfig);
                $jsChartData = $this->buildJsChartData($chartData, $chart->type, $chartConfig);
                //var_dump($jsChartData);
                if(!$chartConfig) {
                    $chartConfig = new stdClass();
                }
                $chartConfig->width = isset($chartConfig->width) ? $chartConfig->width : 500;
                $chartConfig->height = isset($chartConfig->height) ? $chartConfig->height : 375;
                $chartConfig->chart_align = isset($chartConfig->chart_align) ? $chartConfig->chart_align : "center";
                
                $js = 'var DropChart = {};' . "\n";            
                $js .= 'DropChart.id = "'.$chart->id .'" ; ' . "\n";
                $js .= 'DropChart.type = "'.$chart->type .'" ; ' . "\n";
                $js .= 'DropChart.data = '.$jsChartData .'; ' . "\n";
                if($chart->config) {
                    $js .= 'DropChart.config = '. $chart->config .'; ';                
                }else {
                    $js .= 'DropChart.config = {} ; ';                
                }
                $js .= ' DropCharts.push(DropChart) ; ';                
                
                JHtml::_('jquery.framework');
                $document = JFactory::getDocument();
                $document->addScript(JUri::base().'components/com_droptables/assets/js/chart.min.js');                
                $document->addScriptDeclaration($js);
                $document->addScript(JUri::base().'components/com_droptables/assets/js/dropchart.js?v='.$version);
                
                $content = '<div class="chartContainer" id="chartContainer'. $chart->id. '">';
                
                $align = "";
                switch ($chartConfig->chart_align){
                    case 'left':
                        $align = " margin : 0 auto 0 0; ";
                        break;
                    case 'right':
                        $align = " margin : 0 0 0 auto ";
                        break;
                    case 'none':
                        break;
                    case 'center':
                    default:
                        $align = " margin : 0 auto 0 auto ";
                        break;
                }
        
                $content .= '<div class="canvasWraper" style="max-height:'.$chartConfig->height 
                                . 'px; max-width:'. $chartConfig->width.'px;'.$align.'" >';
                $content .= '<canvas class="canvas"  height="' . $chartConfig->height . '" width="' . $chartConfig->width  . '"></canvas>';                                 
                $content .= '</div></div>';                                
            }
            
        } else { // is a table
            
            JHtml::_('jquery.framework');
            $document = JFactory::getDocument();                            
                
            $model = JModelLegacy::getInstance('Table','droptablesModel');
            $table = $model->getItem($match[1]);
            if (empty($table) || empty($table->id) ) { return ''; }
            $datas = json_decode($table->datas);
            $style = json_decode($table->style);    
            $params = $table->params; 
            $table_type = 'html'; 
            if(is_array($params) && isset($params['table_type']) && $params['table_type']=='mysql') {
                $table_type = 'mysql';
                $datas = $table->datas;
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
            }
            if(!isset($style->table->enable_filters)) $style->table->enable_filters = false;            
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
                
            }else{
                $hideCols = false;    
                $priority="{}";
            }

            $content = '';
            $rowNb = 0;
            if($datas!==null && !empty($datas)){
                JHtml::_('jquery.framework');
                $document = JFactory::getDocument();
                if($sortable && !$style->table->enable_filters ) {
                    $document->addScript(JUri::base().'components/com_droptables/assets/js/sorttable.js');                               
                }
                //resTable
                $document->addScript(JUri::base().'components/com_droptables/assets/restable/js/restable.js');  
                $document->addStyleSheet(JURI::root().'components/com_droptables/assets/restable/css/restable.css');
                
                if($responsive_type == "scroll"){
                    if( (isset($style->table->freeze_row) && $style->table->freeze_row) || (isset($style->table->freeze_col) && $style->table->freeze_col) ){                      
                        $document->addScript(JUri::base().'components/com_droptables/assets/js/fixed_table_rc.js');  
                        $document->addStyleSheet(JURI::root().'components/com_droptables/assets/css/fixed_table_rc.css');                      
                    }
                }
                 
                if( $style->table->enable_filters || (isset($style->table->enable_pagination) && $style->table->enable_pagination) ) {
                    $document->addScript(JUri::base().'components/com_droptables/assets/tablesorter/jquery.tablesorter.js');  
                    $document->addScript(JUri::base().'components/com_droptables/assets/tablesorter/jquery.tablesorter.widgets.js');  
                    $document->addScript(JUri::base().'components/com_droptables/assets/tablesorter/jquery.tablesorter.pager.js');  
                   
                    $document->addStyleSheet(JURI::root().'components/com_droptables/assets/tablesorter/theme.jui.css');                      
                    $document->addStyleSheet(JURI::root().'components/com_droptables/assets/tablesorter/theme.bootstrap.css');  
                    $document->addStyleSheet(JURI::root().'components/com_droptables/assets/tablesorter/jquery.tablesorter.pager.css');                                          
                }
                $document->addScript(JUri::base().'components/com_droptables/assets/js/front.js?v='.$version);
                
                if($table_type=='html') {
                    JLoader::register('DroptablesHelper', JPATH_ADMINISTRATOR.'/components/com_droptables/helpers/droptables.php');
                    DroptablesHelper::htmlRender($table) ;   
                    $table_hash = md5($table->datas. $table->style. json_encode($table->params) );   
                    $folder = JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'droptables'.DIRECTORY_SEPARATOR;                
                    $file = $folder . $table->id . '_' . $table_hash . '.html';
                    $content .= file_get_contents($file);
                    $content = html_entity_decode($content);
                } else {
                    $limit = isset($style->table->limit_rows)? (int)$style->table->limit_rows: 0;
                    $enable_pagination = isset($style->table->enable_pagination)? (int)$style->table->enable_pagination: 0;
                                     
                    $query = $table->datas ;                   
                    if(!$enable_pagination && $limit) {
                        $query = $table->datas . ' LIMIT '.$limit;                                                        
                    }                   
                    $result = $model->getTableData($query);
                  
                    if (!empty($result)) {
                        $content = '<div class="droptablesresponsive  droptablestable droptables_dbtable" id="droptablestable' . (int) $table->id . '">';
                        $tblCls = ($sortable ? 'sortable' : '');      

                        if(!$hideCols ) {
                            if( ($style->table->freeze_row) || ($style->table->freeze_col) ){                      
                                $tblCls .= ' fxdHdrCol';
                            }
                        }            
                        if(!isset($style->table->table_height) ) {
                            $style->table->table_height = 0;
                        }
                        if( $style->table->enable_filters) {
                             $tblCls .= ' filterable';
                        }else {
                            if($enable_pagination && $limit) {
                                 $tblCls .= ' enablePager';
                            }
                            
                        }
                        if(!$enable_pagination || !$limit) {
                            $tblCls .= ' disablePager';
                        }
                        
                        $content .= '<table id="droptablesTbl' . (int) $table->id . '" data-id="'.$table->id. '" data-hidecols="'.$hideCols.'" data-priority="'.$priority. '"'
                                  . '  data-freeze-cols="'.(int)$style->table->freeze_col . '"  data-freeze-rows="'.(int)$style->table->freeze_row 
                                  .  '" data-table-height="'.(int)$style->table->table_height . '" class="'. $tblCls  . '" data-pagesize="'.$limit.'">';
                        
                        $headers = $params['custom_titles'];        
                        ob_start();
                        include( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_droptables' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'table_preview.inc.php' );
                        $ret_val = ob_get_contents();
                        ob_end_clean();
                        
                        $content .= $ret_val;
                        
                       if($enable_pagination && $limit) {
                           $colNb = count($result[0]);
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
                                   <option ';                         
                              if($limit==10) { $content .= ' selected="selected"'; }                             
                             $content .= ' value="10">10</option>
                                   <option ';
                              if($limit==20) { $content .= ' selected="selected"'; }                             
                             $content .= ' value="20">20</option>
                                   <option ';
                              if($limit==40) { $content .= ' selected="selected"'; }                             
                             $content .= ' value="40">40</option>'
                                     . '<option ';                               
                             if($limit==0) { $content .= ' selected="selected"'; }                             
                             $content .= ' value="99999">All</option>';
                            $content .= '
                               </select>
                               <select class="pagenum input-mini" title="Select page number"></select>';
                            $content .= '</th></tr></tfoot>';
                       }
                        $content .= '</table></div>';
                        
                    } else {
                        $content = JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_TABLE_EMPTY');
                    }
                }
                
                $this->styleRender($table);

            }
        }
                      
        return $content;
    }
       
    
    //function from http://www.bradino.com/php/excel-column-convert-letters-to-numbers/
    private function convertAlpha($col){
	$col = str_pad($col,2,'0',STR_PAD_LEFT);
	$i = ($col{0} == '0') ? 0 : (ord($col{0}) - 64) * 26;
	$i += ord($col{1}) - 64;
 
	return $i;
    }
    
    private function styleRender($table){
        $style = json_decode($table->style);
        if($style===null){
            return;
        }
        
        $content = 'table {';
        
        //render global table params
        if(isset($style->table->alternate_row_odd_color) &&$style->table->alternate_row_odd_color){
            $content .= "tr:nth-child(even) td {background-color: ".$style->table->alternate_row_odd_color.";}";
        }
        if(isset($style->table->alternate_row_even_color) &&$style->table->alternate_row_even_color){
            $content .= "tr:nth-child(odd) td {background-color: ".$style->table->alternate_row_even_color.";}";
        }
        if(isset($style->table->row_border) && $style->table->row_border){
            $content .= "tr td {border-bottom: ".$style->table->row_border.";}";
        }

        //render global rows
        foreach ($style->rows as $row) {            
            if(isset($row[1]->height)){
                $content .= ".dtr".(int)($row[0])." {height: ".(int)$row[1]->height."px;}";
            }
        }
        
        //render global cols
        foreach ($style->cols as $col) {
            if(isset($col[1]->width)){
                $content .= ".dtc".(int)($col[0])." {width: ".(int)$col[1]->width."px; min-width: ".(int)$col[1]->width."px;}";
            }
        }

        foreach ($style->cells as $cell) {
            if(isset($cell[2]->cell_background_color) && $this->validateColor($cell[2]->cell_background_color) ){               
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {background-color: ".$cell[2]->cell_background_color.";}";
            }
            if(isset($cell[2]->cell_border_top)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-top: ".$cell[2]->cell_border_top.";}";
            }
            if(isset($cell[2]->cell_border_right)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-right: ".$cell[2]->cell_border_right.";}";
            }
            if(isset($cell[2]->cell_border_bottom)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-bottom: ".$cell[2]->cell_border_bottom.";}";
            }
            if(isset($cell[2]->cell_border_left)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-left: ".$cell[2]->cell_border_left.";}";
            }
            if(isset($cell[2]->cell_font_family)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {font-family: ".$cell[2]->cell_font_family.";}";
            }
            if(isset($cell[2]->cell_font_size)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {font-size: ".$cell[2]->cell_font_size."px;}";
            }
			
            if(isset($cell[2]->cell_font_color) && $this->validateColor($cell[2]->cell_font_color) ){				
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {color: ".$cell[2]->cell_font_color.";}";
            }
            if(isset($cell[2]->cell_font_bold) && $cell[2]->cell_font_bold===true){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {font-weight: bold;}";
            }
            if(isset($cell[2]->cell_font_italic) && $cell[2]->cell_font_italic===true){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {font-style: italic;}";
            }
            if(isset($cell[2]->cell_font_underline) && $cell[2]->cell_font_underline===true){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {text-decoration: underline;}";
            }
            if(isset($cell[2]->cell_text_align)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {text-align: ".$cell[2]->cell_text_align.";}";
            }
            if(isset($cell[2]->cell_vertical_align)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {vertical-align: ".$cell[2]->cell_vertical_align.";}";
            }
            if(isset($cell[2]->cell_padding_left)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {padding-left: ".$cell[2]->cell_padding_left."px;}";
            }
            if(isset($cell[2]->cell_padding_top)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {padding-top: ".$cell[2]->cell_padding_top."px;}";
            }
            if(isset($cell[2]->cell_padding_right)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {padding-right: ".$cell[2]->cell_padding_right."px;}";
            }
            if(isset($cell[2]->cell_padding_bottom)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {padding-bottom: ".$cell[2]->cell_padding_bottom."px;}";
            }
            if(isset($cell[2]->cell_background_radius_left_top)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-top-left-radius: ".$cell[2]->cell_background_radius_left_top."px;}";
            }
            if(isset($cell[2]->cell_background_radius_right_top)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-top-right-radius: ".$cell[2]->cell_background_radius_right_top."px;}";
            }
            if(isset($cell[2]->cell_background_radius_right_bottom)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-bottom-right-radius: ".$cell[2]->cell_background_radius_right_bottom."px;}";
            }
            if(isset($cell[2]->cell_background_radius_left_bottom)){
                $content .= ".dtr".(int)($cell[0]).".dtc".(int)($cell[1])." {border-bottom-left-radius: ".$cell[2]->cell_background_radius_left_bottom."px;}";
            }
            
            if (isset($cell[2]->tooltip_width) && !empty($cell[2]->tooltip_width) ) {                    
                    $content .= ".dtr" . (int) ($cell[0]) . ".dtc" . (int) ($cell[1]) . " .droptables_tooltipcontent_show {width: " . $cell[2]->tooltip_width . "px; }";
                }else {
                    $content .= ".dtr" . (int) ($cell[0]) . ".dtc" . (int) ($cell[1]) . " .droptables_tooltipcontent_show {width: 200px; }";
            }
        }
        if(isset($style->table->width) && $style->table->width>0){
            $content .= "& {width : ".$style->table->width."px;}";
        }
	
	if(!isset($style->table->table_align)){
	    $style->table->table_align = 'center';
	}
	switch ($style->table->table_align){
	    case 'left':
		$content .= "& {margin : 0 auto 0 0 }";
		break;
	    case 'right':
		$content .= "& {margin : 0 0 0 auto }";
		break;
	    case 'none':
		break;
	    case 'center':
	    default:
		$content .= "& {margin : 0 auto 0 auto }";
		break;
	}
	
	$content .= '}';
	
        JLoader::register('DroptablesHelper', JPATH_ADMINISTRATOR.'/components/com_droptables/helpers/droptables.php');
        DroptablesHelper::compileStyle($table,$content,$table->css);
        $document = JFactory::getDocument();
        $document->addStyleSheet(JUri::base().'media/droptables/'.JFile::makeSafe($table->id.'_'.$table->hash.'.css'));
        $document->addStyleSheet(JURI::root().'components/com_droptables/assets/css/front.css');
    }
    
	private function validateColor($color) {
       $result = false;
       if (isset($color[0]) && $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
       
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
            if(preg_match('/^[a-f0-9]{6}$/i', $color)) //hex color is valid
            {
                $result = true;
            }
        }elseif ( strlen( $color ) == 3 ) {
             if(preg_match('/^[a-f0-9]{3}$/i', $color)) //hex color is valid
            {
                $result = true;
            }
        }	          
        return $result;
   }
   
   private function buildJsChartData($data, $type, $config) {
       $result = '';
      
       if(!$config || !is_object($config)) {
           $config = new stdClass();
           $config->pieColors = "";
           $config->colors = "";
       }
       $config->dataUsing = isset($config->dataUsing) ? $config->dataUsing : "row";
       $config->useFirstRowAsLabels = isset($config->useFirstRowAsLabels) ? $config->useFirstRowAsLabels : false;
       $dataSets = $this->getDataSets($data, $config->dataUsing);
       if(!isset($dataSets->data) || (count($dataSets->data)==0) ) {
           return $result;
       }
       
       switch ($type) {
           case 'PolarArea':
           case 'Pie':
           case 'Doughnut':
               $chartData = $this->convertForPie($dataSets->data[0], $dataSets->axisLabels, $config->pieColors );
               break;
           
           case 'Bar':
           case 'Radar':
           case 'Line':
           default:
               $chartData = $this->convertForLine($dataSets,$config->useFirstRowAsLabels, $config->colors);
               break;
       }
       $result  = json_encode($chartData);
       return $result;
   }
         
    private function getDataSets($cellsData, $dataUsing) {
        $result = new stdClass();
        $result->data = array();
        $result->graphLabel = array();
        $result->axisLabels = array();
        
        $axisLabels = array();
        $grapLabels = array();
        
         $rValid = $this->hasNumbericRow($cellsData);
         $rCellsData = $this->transposeArr($cellsData);
         $cValid = $this->hasNumbericRow($rCellsData);
                
        if (!$rValid && !$cValid) { //remove first row and column
             $axisLabels = array_shift($cellsData);
             array_shift($axisLabels);
        
            $rcellsData = $this->transposeArr($cellsData);    
            $grapLabels = array_shift($rcellsData);
            $cellsData = $this->transposeArr($rcellsData);            
        
        }else if(!$rValid && $cValid) { // remove first column
             $rcellsData = $this->transposeArr($cellsData); 
             $grapLabels = array_shift($rcellsData);
             $cellsData = $this->transposeArr($rcellsData);  
             $axisLabels = $cellsData[0];
        }else if(!$cValid && $rValid) { //remove first row
            $axisLabels = array_shift($cellsData);
			$rcellsData = $this->transposeArr($cellsData); 
            $grapLabels = $rcellsData[0];            
        }else {
            //do nothing yet
            $axisLabels = $cellsData[0];
            $rcellsData = $this->transposeArr($cellsData); 
            $grapLabels = $rcellsData[0];
        }
        
         //switch cell data and label
        if($dataUsing != "row") {
            $cellsData = $this->transposeArr($cellsData);  
            $temp = $axisLabels;
            $axisLabels = $grapLabels;
            $grapLabels = $temp;
        }
        
        $result->axisLabels = $axisLabels;
        $j = 0;
        for ($i = 0; $i < count($cellsData); $i++) {
                
            if ($this->isNumbericArray($cellsData[$i])) {               
                $result->data[$j] = $cellsData[$i];      
                $result->graphLabel[$j] =  $grapLabels[$i];     
                $j++;
            }
        }
        
        if ( count($result->data) == 0) {
            $cellsData = $this->transposeArr($cellsData);
            for ($i = 0; $i < count($cellsData); $i++) {
                
                if ($this->isNumbericArray($cellsData[$i])) {               
                    $result->data[$j] = $cellsData[$i];      
                    $result->graphLabel[$j] =  $grapLabels[$i];      
                    $j++;
                }
            }
        }
        
         return $result;   
    
    }
    
    private function convertForLine($dataSets, $useFirstRowAsLabels, $colors) {
        $result = new stdClass();
        $result->labels = array();
        $result->datasets = array();
        if(!is_array($dataSets->data) || (count($dataSets->data)==0) ) {
            return $result;
        }
        if($useFirstRowAsLabels) {
            for($i=0;$i< count($dataSets->data[0]); $i++) {
                $result->labels[$i] = $dataSets->axisLabels[$i];
            }
        } else {
            for($i=0;$i< count($dataSets->data[0]); $i++) {
                $result->labels[$i] = "";
            }
        }
        
       
         for($i=0;$i< count($dataSets->data); $i++) {
             $dataSet = new stdClass();
             $dataSet->data = $dataSets->data[$i];
             $dataSet->label = $dataSets->graphLabel[$i];
             $styleSet  = $this->getStyleSet($i, $colors); 
             $dataSet = (object) array_merge((array) $dataSet, (array)$styleSet );
             $result->datasets[$i] = $dataSet;
         }
         
         return $result;
    }
    
    private function convertForPie($data, $axisLabels, $pieColors) {
      
        $datas = array();
      
        $defaultColors = array("#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360");
        $highlights = array("#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774");
        
        if(!$pieColors) {
            $colors = $defaultColors;      
        }else {                        
            $colors = explode(",",$pieColors) ; 
        }
        
        for ( $i = 0; $i < count($data); $i++) {
            
            $dataSet = new stdClass();
            $dataSet->value = (float)$data[$i];
            $dataSet->label = (string)$axisLabels[$i];
            if(isset($colors[$i])) {
                $dataSet->color = $colors[$i];
                $dataSet->highlight = $this->alter_brightness($colors[$i],0.3);
            }else {
                $dataSet->color = $defaultColors[$i % 5];
                $dataSet->highlight = $highlights[$i % 5];
            }
                        
            $datas[$i] = $dataSet;
        }
        // console.log(datas);
        return $datas;
    }

    function alter_brightness($colourstr, $steps) {
        $colourstr = str_replace('#','',$colourstr);
        $rhex = substr($colourstr,0,2);
        $ghex = substr($colourstr,2,2);
        $bhex = substr($colourstr,4,2);

        $r = hexdec($rhex);
        $g = hexdec($ghex);
        $b = hexdec($bhex);

        $r = max(0,min(255,$r + $r*$steps));
        $g = max(0,min(255,$g + $g *$steps));  
        $b = max(0,min(255,$b + $b*$steps));

        return '#'.dechex($r).dechex($g).dechex($b);
    }

    private function getStyleSet($i, $colors) {
        $result =  null;
        $defaultColors = array("#DCDCDC","#97BBCD","#4C839E");
        
        if(!$colors) {
            $arrColors = $defaultColors;
        }else {
            $arrColors = explode(",", $colors);     
        }
                
        if( count($arrColors) && isset($arrColors[$i]) ) {
            $color = $arrColors[$i];            
        }else {
            $color = $defaultColors[$i % 3];
        }
        $result = new ChartStyleSet($color);
        
        return $result;
    }
    
 
    private function isNumbericArray($arr) { 
        $valid = true;
        for ($c = 0; $c < count($arr); $c++) {
            if (!is_numeric($arr[$c]) ) {
                $valid = false;
            }
        }

        return $valid;
    }
    
    private function hasNumbericRow($cells) {
        $rValid = true;
        $rNaN = 0;
        for ($r = 0; $r < count($cells); $r++) {

            $valid = true;
            for ($c = 0; $c < count($cells[$r]); $c++) {
                if (!is_numeric($cells[$r][$c])) {
                    $valid = false;
                }
            }

            if (!$valid) {
                $rNaN++;
            }
        }
        if ($rNaN == count($cells)) {
            $rValid = false;
        }

        return $rValid;
    }
    
    private function transposeArr($array) {
        $transposed_array = array();
        if ($array) {
            foreach ($array as $row_key => $row) {
                if (is_array($row) && !empty($row)) { //check to see if there is a second dimension
                    foreach ($row as $column_key => $element) {
                        $transposed_array[$column_key][$row_key] = $element;
                    }
                } else {
                    $transposed_array[0][$row_key] = $row;
                }
            }
            return $transposed_array;
        }
    }

    
    private function getChartData($cellRange, $tData) {
        $result =  array();
        $arr_cellRanges = json_decode($cellRange) ;
        $tableData = json_decode($tData) ;
        //var_dump($tableData);
        for($i=0; $i < count($arr_cellRanges); $i++) {
            $row = $arr_cellRanges[$i];
            for($j=0 ; $j< count($row); $j++) {
                $result[$i][$j] = $this->getCellData($row[$j], $tableData);                
            }
        }
        
        return $result;
    }
    
    private function getCellData($cellPos, $tableData) {
        $result = '';
        //var_dump($cellPos);
        list($r,$c) = explode(':', $cellPos);
        $result = $tableData[$r][$c];
        return $result;
    }
}

class ChartStyleSet {
    
      public  $fillColor ;
      public  $strokeColor ;
      public  $pointColor ;
      public  $pointStrokeColor ;
      public  $pointHighlightFill ;
      public  $pointHighlightStroke ;
      
      public function __construct($color) {
           $this->fillColor = $this->hex2rgba($color, 0.2);
           $this->strokeColor = $this->hex2rgba($color, 0.5);
           $this->pointColor = $this->hex2rgba($color, 1);
           $this->pointStrokeColor = "#fff";
           $this->pointHighlightFill = "#fff";
           $this->pointHighlightStroke = $this->hex2rgba($color, 1);
           
      }
      
      function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }

     
}  