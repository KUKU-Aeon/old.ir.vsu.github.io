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

// No direct access.
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.framework');
JHtml::_('behavior.colorpicker');
JHtml::_('formbehavior.chosen','.chzn-select');
// Load the modal behavior script.
JHtml::_('behavior.modal');

jimport('joomla.html.html.bootstrap');
jimport('joomla.application.component.helper');

$function	= JRequest::getCmd('function', 'jInsertTable');

JText::script('COM_DROPTABLES_JS_ARE_YOU_SURE');
JText::script('COM_DROPTABLES_JS_DELETE');
JText::script('COM_DROPTABLES_JS_EDIT');
JText::script('COM_DROPTABLES_JS_DBLCLICK_TO_EDIT_TITLE');
JText::script('COM_DROPTABLES_JS_WANT_DELETE');
JText::script('COM_DROPTABLES_JS_CANCEL');
JText::script('COM_DROPTABLES_JS_OK');
JText::script('COM_DROPTABLES_JS_CONFIRM');
JText::script('COM_DROPTABLES_JS_SAVE');
JText::script('COM_DROPTABLES_VIEW_DROPTABLES_TABLE_ADD');
JText::script('COM_DROPTABLES_LAYOUT_DROPTABLES_SELECT_ONE');
JText::script('COM_DROPTABLES_JS_WARNING_CHANGE_THEME');
JText::script('COM_DROPTABLES_NOTICE_MSG_TABLE_SYNCABLE');
JText::script('COM_DROPTABLES_NOTICE_MSG_TABLE_DATABASE');

$doc = JFactory::getDocument();
$doc->addScriptDeclaration('gcaninsert='.(JRequest::getBool('caninsert',false)?'true':'false').';');
$doc->addScriptDeclaration('e_name="'.JRequest::getString('e_name').'";');
if(JRequest::getBool('caninsert')){
    $doc->addStyleDeclaration('html {width: 100%;}');
}
$params = JComponentHelper::getParams('com_droptables');

$collapse = DroptablesBase::getParam('catcollapsed',0);

$declaration = 
            "if(typeof(Droptables)=='undefined'){"
          . "     Droptables={};"
          . "}"
          . "Droptables.token = '".JSession::getFormToken()."';"
          . "Droptables.can = {};"
          . "Droptables.can.config=".(int)$this->canDo->get('core.admin').";"
          . "Droptables.can.create=".(int)$this->canDo->get('core.create').";"
          . "Droptables.can.edit=".(int)$this->canDo->get('core.edit').";"
          . "Droptables.can.editown=".(int)$this->canDo->get('core.edit.own').";"
          . "Droptables.can.delete=".(int)$this->canDo->get('core.delete').";"
          . "Droptables.author=".(int)JFactory::getUser()->id.";"
        
          . "Droptables.collapse=".($collapse?'true':'false').";"
          . "Droptables.version='".droptablesComponentHelper::getVersion()."';";

$baseurl = JURI::root();
$declaration  .= 'CKEDITOR_BASEPATH = "'.$baseurl.'components/com_droptables/assets/ckeditor/";'
	       . 'CKEDITOR.disableAutoInline = true;'
	       . 'CKEDITOR.allowedContent = true;';
$doc->addScriptDeclaration($declaration);

$editor_buttons  = $params->get('editor_buttons', array("image"=>"image"));
$activedButtons = array();
if(!empty($editor_buttons)) {    
    foreach ($editor_buttons as $key => $value) {
        if($value != "0") {
            $activedButtons[] = $value;
        }
    }
}
$extButtons = DroptablesHelper::_displayButtons("editor1",$activedButtons);
$tooltip_extButtons = DroptablesHelper::_displayButtons("tooltip_content",$activedButtons);


$doc->addScript(JURI::root() . 'components/com_droptables/assets/js/handlebars-1.0.0-rc.3.js');
$doc->addScript(JURI::root() . 'components/com_droptables/assets/js/dbtable.js');
?>
<div id="droptable-xtdbuttons-container">
    <?php echo $extButtons; ?>
</div>
<div id="tooltip-xtdbuttons-container">
    <?php echo $tooltip_extButtons; ?>
</div>
<div id="mybootstrap"class="<?php if(droptablesBase::isJoomla30()) echo 'joomla30'; ?>">
    <?php echo $this->loadTemplate('cats'); ?>

    <div id="rightcol">
        <?php if(JRequest::getBool('caninsert')): ?>
            <a id="inserttable" class="btn btn-success btn-block" href="" onclick="if (window.parent) {window.parent.jInsertEditorText(insertTable(),'<?php echo JFactory::getApplication()->input->getVar('e_name');?>');window.parent.SqueezeBox.close();}"><?php echo JText::_('COM_DROPTABLES_LAYOUT_DROPTABLES_INSERT_TABLE'); ?></a>
        <?php endif; ?>
	    
        <?php if( $params->get('enable_autosave',1) == '0') : ?>
                    <div class="control-group">
                        <label id="jform_saveTable-lbl">
                              <a id="saveTable" class="btn btn-default nephritis-flat-button" title="<?php echo JText::_('COM_DROPTABLES_LAYOUT_DROPTABLES_SAVE_MODIFICATIONS'); ?>" >
                                  <?php echo JText::_('COM_DROPTABLES_LAYOUT_DROPTABLES_SAVE_MODIFICATIONS');?></a> 
                        </label>
                    </div>
        <?php endif; ?>
            
        <div class="<?php if(!$this->canDo->get('core.edit') && !$this->canDo->get('core.edit.own')): ?>hidden<?php endif; ?>">

            <ul class="nav nav-tabs" id="configTable">
              <li class="referTable" class="active"><a data-toggle="tab" href="#table"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TAB_TABLE'); ?></a></li>
              <li class="referCell"><a data-toggle="tab" href="#cell"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TAB_CELL'); ?></a></li>
              <li class="tableMore"><a data-toggle="tab" href="#css"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TAB_ADVANCED'); ?></a></li>
            </ul>
            <?php 
            echo JHtml::_('bootstrap.startPane', 'tableTab', array('active' => 'table'));
            echo JHtml::_('bootstrap.addPanel', 'tableTab', 'table');
            ?>
            <div class="control-group">
                <div class="table-styles">
                    <ul>
                    <?php foreach ($this->styles as $style): ?>
                        <li><a href="#" data-id="<?php echo $style->id; ?>"><img src="<?php echo JUri::root(true).'/components/com_droptables/assets/images/styles/'.$style->image; ?>"/></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <hr/>
            <div>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_alternate_row_even_color-lbl" for="jform_alternate_row_even_color">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALTERNATE_ROW_EVEN_COLOR'); ?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="minicolors minicolors-input observeChanges"  data-position="left" data-control="hue" type="text" name="jform[alternate_row_even_color]" id="jform_alternate_row_even_color" value="" size="7" />
                    </div>
                </div>    
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_alternate_row_odd_color-lbl" for="jform_alternate_row_odd_color">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALTERNATE_ROW_ODD_COLOR'); ?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="minicolors minicolors-input observeChanges"  data-position="left" data-control="hue" type="text" name="jform[alternate_row_odd_color]" id="jform_alternate_row_odd_color" value="" size="7" />
                    </div>
                </div>    
		<hr/>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_use_sortable-lbl" for="jform_use_sortable">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_USE_SORTABLE'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges" name="jform[jform_use_sortable]" id="jform_use_sortable">
                            <option value="0"><?php echo JText::_('JNO'); ?></option>
                            <option value="1"><?php echo JText::_('JYES'); ?></option>
                        </select>
                    </div>
                </div>    
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_table_align-lbl" for="jform_table_align">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges" name="jform[jform_table_align]" id="jform_table_align">
                            <option value="center"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_CENTER');?></option>
                            <option value="right"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_RIGHT');?></option>
                            <option value="left"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_LEFT');?></option>
                            <option value="none"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_NONE');?></option>
                        </select>
                    </div>
                </div>    
                
                 <div class="control-group">
                    <div class="control-label">
                        <label id="jform_responsive_type-lbl" for="jform_responsive_type">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_RESPONSIVE'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges" name="jform[jform_responsive_type]" id="jform_responsive_type">
                            <option value="scroll"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_RESPONSIVE_SCROLL');?></option>
                            <option value="hideCols"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_RESPONSIVE_HIDE_COLUMN');?></option>                         
                        </select>
                    </div>
                </div>    
                
                <div id="freeze_options">
                            <div class="control-group">
                               <div class="control-label">
                                   <label id="jform_freeze_row-lbl" for="jform_freeze_row">                                              
                                       <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FREEZE_FIRST');  ?>                       
                                       <select class="chzn-select observeChanges" name="freeze_row" id="jform_freeze_row" style="width:auto">
                                           <?php for($i=0;$i<6;$i++) { ?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                           <?php } ?>                                                            
                                        </select>
                                       <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FREEZE_ROWS');  ?>                                    
                                   </label>
                               </div>                         
                            </div>  
                            
                            <div class="control-group" id="table_height_container">
                               <div class="control-label">
                                    <label id="jform_table_height-lbl" for="jform_table_height">
                                        <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_TABLE_HEIGHT');  ?>  
                                        <div class="controls inline">
                                            <input class="observeChanges input-mini" type="text" name="jform[table_height]" id="jform_table_height" value="" size="7" />
                                        </div>
                                        <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_PX');?>    
                                    </label>
                                </div>
                                
                            </div>
                    
                            <div class="control-group">
                                     <div class="control-label">
                                         <label id="jform_freeze_col-lbl" for="jform_freeze_col">                                         
                                             <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FREEZE_FIRST'); ?>    
                                               <select class="chzn-select observeChanges" name="freeze_col" id="jform_freeze_col" style="width:auto">
                                                <?php for($i=0;$i<6;$i++) { ?>
                                                 <option value="<?php echo $i;?>"><?php echo $i;?></option>   
                                                <?php } ?>                                                            
                                             </select>
                                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FREEZE_COLS');  ?>       
                                         </label>
                                     </div>
                                
                            </div>  
                        </div>
                        <div class="control-group" >
                            <div class="control-label">
                                <label id="jform_enable_filters-lbl" for="jform_enable_filters">
                                    <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ENABLE_FILTERS'); ?> :                                 
                                </label>
                            </div>
                            <div class="controls">
                                <select class="chzn-select observeChanges" name="jform[jform_enable_filters]" id="jform_enable_filters">
                                    <option value="0"><?php echo JText::_('JNO');?></option>
                                    <option value="1"><?php echo JText::_('JYES');  ?></option>
                                </select>
                            </div>
                        </div> 
                        
                        <div style="display:none" class="dbtable_params">
                            <div class="control-group" style="margin-bottom: 10px">
                                <div class="control-label">
                                    <label id="jform_enable_pagination-lbl" for="jform_enable_pagination">
                                        <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ENABLE_PAGINATION');  ?> :                                 
                                    </label>
                                </div>
                                <div class="controls">
                                    <select class="chzn-select observeChanges" name="jform[enable_pagination]" id="jform_enable_pagination">                                    
                                        <option value="1"><?php echo JText::_('JYES'); ?></option>
                                        <option value="0"><?php echo JText::_('JNO') ; ?></option>
                                    </select>
                                </div>
                            </div>   
                        
                       
                           <div class="control-group" style="margin-bottom: 10px">
                                <div class="control-label">
                                    <label id="jform_limit_rows-lbl" for="jform_limit_rows">
                                        <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ROWS_PER_PAGE');  ?> :                                 
                                    </label>
                                </div>
                                <div class="controls">
                                    <select class="chzn-select observeChanges" name="jform[limit_rows]" id="jform_limit_rows">
                                        <option value="0"><?php echo JText::_('JALL') ; ?></option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="40">40</option>                                       
                                    </select>
                                </div>
                            </div>   
                        </div>
                
                        <div class="control-group spreadsheet_sync" >
                            <div class="control-label">
                                <label id="spreadsheet_url-lbl" for="jform_spreadsheet_url">
                                    <?php  echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_SPREADSHEET_LINK');   ?> :                                 
                                </label>
                            </div>
                            <div class="controls">
                                <input type="text" class="observeChanges" name="jform[jform_spreadsheet_url]" id="jform_spreadsheet_url" value="" />
                                <a class="nephritis-flat-button button" id="fetch_spreadsheet" href="" ><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FECTH_DATA');  ?></a>
                                <a id="browse_files" onclick="openModal();" href="javascript:void(0)" rel="{handler: \'iframe\', size: {x: 600, y: 400}}"  class="modal button carrot-flat-button"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BROWSE'); ?></a>        
                            </div>
                        </div>
                        
                        <div class="control-group spreadsheet_sync" >
                            <div class="control-label">
                                <label id="auto_sync-lbl" for="jform_auto_sync">
                                    <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_AUTO_SYNC');   ?> :                                 
                                </label>
                            </div>
                            <div class="controls">
                                <select name="auto_sync" id="jform_auto_sync" class="chzn-select observeChanges">
                                    <option value="1" ><?php  echo JText::_('JYES'); ?></option>
                                    <option value="0"><?php echo JText::_('JNO'); ?></option>                                   
                                </select>       
                            </div>
                        </div>
                
                        <div class="control-group" style="margin-bottom: 50px"></div>
            </div>
            <?php
            echo JHtml::_('bootstrap.endPanel');
            echo JHtml::_('bootstrap.addPanel', 'tableTab', 'cell');
            ?>            
            <div>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_cell_type-lbl" for="jform_cell_type">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CELL_TYPE');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <select class="chzn-select observeChanges" name="jform[jform_cell_type]" id="jform_cell_type">
                            <option value=""><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CELL_TYPE_DEFAULT');?></option>
                            <option value="html"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CELL_TYPE_HTML');?></option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_cell_background_color-lbl" for="jform_cell_background_color">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CELL_BACKGROUND_COLOR');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="minicolors minicolors-input observeChanges"  data-position="left" data-control="hue" type="text" name="jform[jform_cell_background_color]" id="jform_cell_background_color" value="" size="7" />
                    </div>
                </div>
                <hr/>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_cell_border_type-lbl" for="jform_cell_border_type">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BORDERS');?> :
                        </label>
                    </div>
                    <div class="clr"></div>
                    <div class="controls">
                        <div>
                            <select class="chzn-select" name="jform[jform_cell_border_type]" id="jform_cell_border_type">
                                <option value="solid"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BORDERS_SOLID');?></option>
                                <option value="dashed"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BORDERS_DASHED');?></option>
                                <option value="dotted"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BORDERS_DOTTED');?></option>
                                <option value="none"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_BORDERS_NO_BORDER');?></option>
                            </select>

			    <div class="form-inline">
				<div class="input-append">
				    <input type="text" name="jform[jform_cell_border_width]" id="jform_cell_border_width" value="1"/>
				    <button class="btn" type="button" id="cell_border_width_incr">+</button>
				    <button class="btn" type="button" id="cell_border_width_decr">-</button>
				</div>
				<input class="minicolors minicolors-input observeChanges"  data-position="left" data-control="hue" type="text" name="jform[jform_cell_border_color]" id="jform_cell_border_color" value="#CCCCCC" size="7" />
			    </div>
                        </div>
                        <div class="aglobuttons">
                            <button class="btn observeChanges" name="jform[jform_cell_border_top]" type="button"><span class="sprite sprite_border_top"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_right]" type="button"><span class="sprite sprite_border_right"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_bottom]" type="button"><span class="sprite sprite_border_bottom"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_left]" type="button"><span class="sprite sprite_border_left"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_all]" type="button"><span class="sprite sprite_border_all"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_inside]" type="button"><span class="sprite sprite_border_inside"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_outline]" type="button"><span class="sprite sprite_border_outline"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_horizontal]" type="button"><span class="sprite sprite_border_horizontal"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_vertical]" type="button"><span class="sprite sprite_border_vertical"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_border_remove]" type="button"><span class="sprite sprite_border_remove"></span></button>
                        </div>                        
                    </div>
                </div>    
		<hr/>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_cell_font_family-lbl" for="jform_cell_font_family">
			    <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_FONT');?> :
                        </label>
                    </div>
                    <div class="controls">

                        <select class="chzn-select observeChanges" name="jform[jform_cell_font_family]" id="jform_cell_font_family">
                            <option value="Arial">Arial</option>
                            <option value="Arial Black">Arial Black</option>
                            <option value="Comic Sans MS">Comic Sans MS</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Impact">Impact</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Trebuchet MS">Trebuchet MS</option>
                            <option value="Verdana">Verdana</option>
                        </select>
                        
			<div class="form-inline">
			    <div class="input-append">
				<input class="observeChanges"  type="text" name="jform[jform_cell_font_size]" id="jform_cell_font_size" value="13"/>
				<button class="btn" type="button" id="cell_font_size_incr">+</button>
				<button class="btn" type="button" id="cell_font_size_decr">-</button>
			    </div>
			    <input class="minicolors minicolors-input observeChanges"  data-position="left" data-control="hue" type="text" name="jform[jform_cell_font_color]" id="jform_cell_font_color" value="#000000" size="7" />
                        </div>
                        <div class="aglobuttons">
                            <button class="btn observeChanges" name="jform[jform_cell_font_bold]" type="button"><span class="sprite sprite_text_bold"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_font_underline]" type="button"><span class="sprite sprite_text_underline"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_font_italic]" type="button"><span class="sprite sprite_text_italic"></span></button>
			    <br/>
                            <button class="btn observeChanges" name="jform[jform_cell_align_left]" type="button"><span class="sprite sprite_text_align_left"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_align_center]" type="button"><span class="sprite sprite_text_align_center"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_align_right]" type="button"><span class="sprite sprite_text_align_right"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_align_justify]" type="button"><span class="sprite sprite_text_align_justify"></span></button>
                            <br/>
			    <button class="btn observeChanges" name="jform[jform_cell_vertical_align_top]" type="button"><span class="sprite sprite_vertical_align_top"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_vertical_align_middle]" type="button"><span class="sprite sprite_vertical_align_middle"></span></button>
                            <button class="btn observeChanges" name="jform[jform_cell_vertical_align_bottom]" type="button"><span class="sprite sprite_vertical_align_bottom"></span></button>
                        </div>                        
                    </div>
                </div>
		<hr/>
		
		<div class="control-group">
		    <div class="control-label">
                        <label id="jform_row_height-lbl" for="jform_row_height">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ROW_HEIGHT');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="observeChanges input-mini" type="text" name="jform[jform_row_height]" id="jform_row_height" value="" size="7" />
                    </div>
		    <div class="control-label">
                        <label id="jform_col_width-lbl" for="jform_col_width">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_COL_WIDTH');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="observeChanges input-mini" type="text" name="jform[jform_col_width]" id="jform_col_width" value="" size="7" />
                    </div>
                    
                    <?php if( $params->get('enable_tooltip',0) == '1') : ?>
                    <div class="control-group">                    
                            <label id="jform_tooltip_content-lbl" for="jform_tooltip_content">
                                  <a id="editToolTip" class="btn btn-primary" title="<?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_EDIT_TOOLTIP') ; ?>" href="#droptables_editToolTip"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_EDIT_TOOLTIP') ;?></a> 
                            </label>

                            <div id="droptables_editToolTip" style="display:none">
                                <div id="tooltip_editor">
                                    <textarea id="tooltip_content" name="tooltip_content" class="observeChanges"></textarea>
                                    <a id="saveToolTipbtn" class="btn btn-primary" title="<?php echo JText::_('JAPPLY'); ?>" href="javascript:void(0)"><?php echo JText::_('JAPPLY');?></a>
                                    <a id="cancelToolTipbtn" class="btn" title="<?php echo JText::_('JCANCEL'); ?>" href="javascript:void(0)"><?php echo JText::_('JCANCEL');?></a>
                                </div>
                            </div>                    

                            <div class="control-label">
                              <label id="jform_tooltip_width-lbl" for="jform_tooltip_width">
                                  <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_TOOLTIP_WIDTH'); ?> :
                              </label>
                            </div>
                            <div class="controls">
                                <input class="observeChanges input-mini" type="text" name="jform[jform_tooltip_width]" id="jform_tooltip_width" value="" size="7" />
                            </div>                   
                     </div>	
                    <?php endif ;?>
		</div>
            </div>
	    <?php
            echo JHtml::_('bootstrap.endPanel');
            echo JHtml::_('bootstrap.addPanel', 'tableTab', 'css');
            ?>            
            <div>
		<div class="control-group">
				<?php if($params->get('enable_import_excel',1) == '1'): ?>
				  <div class="progress progress-striped active" role="progressbar" style="display: none;" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
					<div class="bar progress-bar-success data-dz-uploadprogress" style="width:0%;" data-dz-uploadprogress></div>
				  </div>
                    <div class="controls">
                         <div class="control-label">
                            <label id="import_style-lbl" for="import_style">                            
                                <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_STYLE'); ?> :
                            </label>
                        </div>
                        <div class="controls" style="margin-bottom: 10px;">
                            <select class="chzn-select observeChanges2" name="jform[import_style]" id="jform_import_style">
                                <option value="1"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_DATA_STYLE'); ?></option>
                                <option value=""><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_ONLY_DATA'); ?></option>
                            </select>			
                        </div>
                    </div>
                    
                    <div class="controls pull-left">
                    	<form action="index.php?option=com_droptables&task=excel.import" id="proc-excel" class="dropzone pull-left" accept-charset="utf-8">
				<a title="<?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_BTN_DESC') ?>" href="javascript:void(0);" class="dz-btn nephritis-flat-button"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_BTN') ?></a>
			</form>
                    </div>
                    <div class="controls pull-right" style="margin-right:10px">
                    	<a title="<?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_EXPORT_BTN_DESC') ?>" href="javascript:void(0);" class="carrot-flat-button" id="export-excel" data-format-excel="<?php echo $params->get('export_excel_format', 'xlsx') ?>">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_EXPORT_BTN') ?></a>
                    </div>
				<?php endif ?>	
		 </div>	
                 
                 <div class="control-group" style="clear:left;">
                    <div class="control-label">
                        <label id="jform_responsive_col-lbl" for="jform_responsive_col">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_RESPONSIVE_COLUMN'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChangesCol" name="jform[jform_responsive_col]" id="jform_responsive_col">                                                 
                        </select>
                    </div>
                </div>   
                    
                 <div class="control-group" style="clear:left;">
                    <div class="control-label">
                        <label id="jform_responsive_priority-lbl" for="jform_responsive_priority">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_RESPONSIVE_PRIORITY'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges" name="jform[jform_responsive_priority]" id="jform_responsive_priority">                                                  
                        </select>
                    </div>
                </div>   
                    
               <div class="control-group">
                    <div class="control-label" >
                        <label id="jform_cell_padding-lbl" for="jform_cell_padding">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_PADDINGS');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <div style="height: 170px; width: 210px; border: 1px solid #AAA; margin: 0 auto; position: relative;">
                            <div style="height: 80px; width: 80px; border: 1px dashed #CCC; margin: 45px auto; text-align: center; line-height: 80px;">Lorem Ipsum</div>
                            <div style="position: absolute; top: 70px; left: 3px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_padding_left]" id="jform_cell_padding_left" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; top: 9px; left: 85px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_padding_top]" id="jform_cell_padding_top" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; top: 70px; right: 3px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_padding_right]" id="jform_cell_padding_right" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; bottom: 0px; left: 85px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_padding_bottom]" id="jform_cell_padding_bottom" class="observeChanges" value="0">px
                            </div>
                        </div>
                    </div>
                </div>
		
		<div class="control-group">
                    <div class="control-label">
                        <label id="jform_cell_background_radius-lbl" for="jform_cell_background_radius">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CELL_BACKGROUND_RADIUS');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <div style="height: 170px; width: 210px; border: 1px solid #FFF; margin: 0 auto; position: relative;">
                            <div style="height: 80px; width: 80px; margin: 45px auto; text-align: center; line-height: 80px; border-radius: 5px; background-color: #CCC;">Lorem Ipsum</div>
                            <div style="position: absolute; top: 15px; left: 15px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_background_radius_left_top]" id="jform_cell_background_radius_left_top" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; top: 15px; right: 3px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_background_radius_right_top]" id="jform_cell_background_radius_right_top" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; bottom: 15px; right: 3px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_background_radius_right_bottom]" id="jform_cell_background_radius_right_bottom" class="observeChanges" value="0">px
                            </div>
                            <div style="position: absolute; bottom: 15px; left: 15px;">
                                <input style="width: 30px;" type="text" name="jform[jform_cell_background_radius_left_bottom]" id="jform_cell_background_radius_left_bottom" class="observeChanges" value="0">px
                            </div>
                        </div>
                    </div>
                </div>
		
		<div class="control-group">
                    <div class="control-label">
                        <label id="jform_css-lbl" for="jform_css">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CUSTOM_CSS');?> :
                        </label>
                        <a id="customCssbtn" class="btn btn-primary" href="#droptable_customCSS" title="<?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CUSTOM_CSS');?>" href="#wptm_customCSS"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_EDIT_CSS'); ?></a>
			
                    </div>
		</div>
	    </div>
            <?php
            echo JHtml::_('bootstrap.endPanel');
            echo JHtml::_('bootstrap.endPane', 'tableTab');
            ?>
        </div>
    </div>
    <div id="droptable_customCSS" class="customCssContainer" style="display:none">
        <textarea rows="10" cols="50" style="width:400px" name="jform[jform_css]" id="jform_css"></textarea>        
        <a id="saveCssbtn" class="btn btn-primary" title="<?php echo JText::_('JAPPLY'); ?>" href="javascript:void(0)"><?php echo JText::_('JAPPLY');?></a>
        <a id="cancelCssbtn" class="btn" title="<?php echo JText::_('JCANCEL'); ?>" href="javascript:void(0)"><?php echo JText::_('JCANCEL'); ?></a>
    </div>
     <div id="rightcol2" style="display: none">
        <?php if(JRequest::getBool('caninsert')): ?>
            <a id="insertChart" class="btn btn-success btn-block" href="" onclick="if (window.parent) {window.parent.jInsertEditorText(insertChart(),'<?php echo JFactory::getApplication()->input->getVar('e_name');?>');window.parent.SqueezeBox.close();}"><?php echo JText::_('COM_DROPTABLES_LAYOUT_DROPTABLES_INSERT_CHART'); ?></a>
        <?php endif; ?>
            
        <div class="<?php if(!$this->canDo->get('core.edit') && !$this->canDo->get('core.edit.own')): ?>hidden<?php endif; ?>">

            <ul class="nav nav-tabs" id="configChart">
              <li class="active"><a data-toggle="tab" href="#chart"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TAB_CHART'); ?></a></li>            
<!--              <li><a data-toggle="tab" href="#style"><?php //echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TAB_CHART_ADVANCED'); ?></a></li>-->
            </ul>
            <?php 
            echo JHtml::_('bootstrap.startPane', 'chartTab', array('active' => 'chart'));
            echo JHtml::_('bootstrap.addPanel', 'chartTab', 'chart');
            ?>
            <div>
                <div class="control-group">
                    <div class="chart-styles">
                        <ul>
                        <?php foreach ($this->chartTypes as $chartType): ?>
                            <li><a href="#" title="<?php echo $chartType->name;?>" data-id="<?php echo $chartType->id; ?>"><img alt="<?php echo $chartType->name;?>" src="<?php echo JUri::root(true).'/components/com_droptables/assets/images/charts/'.$chartType->image; ?>"/></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
               <hr/>
               <div class="control-group">
                    <div class="control-label">
                        <label id="jform_dataUsing-lbl" for="jform_dataUsing">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_DATA_USING_ROW_COLUMN');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <select class="chzn-select observeChanges2" name="jform[dataUsing]" id="jform_dataUsing">
                            <option value="row"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_DATA_USING_ROW');?></option>
                            <option value="column"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_DATA_USING_COLUMN');?></option>
                        </select>
                    </div>
                   
                     <div class="control-label">
                        <label id="jform_useFirstRowAsLabels-lbl" for="jform_useFirstRowAsLabels">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_USE_FIRST_ROW_AS_LABELS');?> :
                        </label>
                    </div>
                    <div class="controls">                        
                        <select class="chzn-select observeChanges2" name="jform[useFirstRowAsLabels]" id="jform_useFirstRowAsLabels">
                            <option value="yes"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_YES');?></option>
                            <option value="no"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_CHART_PARAM_NO');?></option>
                        </select>
                    </div>                   
                </div>
                 
               <div class="control-group">
                   <div class="control-label">
                        <label id="jform_chart_width-lbl" for="jform_chart_width">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CHART_WIDTH');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <div class="form-inline">
                            <input class="observeChanges2 input-mini" type="text" name="jform[chart_width]" id="jform_chart_width" value="" size="7" />
                        </div>
                    </div>
                   
		    <div class="control-label">
                        <label id="jform_chart_height-lbl" for="jform_chart_height">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CHART_HEIGHT');?> :
                        </label>
                    </div>
                    <div class="controls">
                        <div class="form-inline">
                            <input class="observeChanges2 input-mini" type="text" name="jform[chart_height]" id="jform_chart_height" value="" size="7" />
                        </div>
                    </div>
		 
		</div>
                
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_table_align-lbl" for="jform_chart_align">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_CHART_ALIGN'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges2" name="jform[chart_align]" id="jform_chart_align">
                            <option value="center"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_CENTER');?></option>
                            <option value="right"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_RIGHT');?></option>
                            <option value="left"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_LEFT');?></option>
                            <option value="none"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_ALIGN_NONE');?></option>
                        </select>
                    </div>
                </div> 
               <hr/>
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_table_align-lbl" for="jform_dataset_select">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_DATASET_SELECT'); ?> :
                        </label>
                    </div>
                    <div class="controls">
			<select class="chzn-select observeChanges3" name="jform[dataset_select]" id="jform_dataset_select">                         
                        </select>
                    </div>
                </div> 
                
                <div class="control-group">
                    <div class="control-label">
                        <label id="jform_dataset_color-lbl" for="jform_dataset_color">
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PARAM_DATASET_COLOR'); ?> :
                        </label>
                    </div>
                    <div class="controls">
                        <input class="minicolors minicolors-input observeChanges2"  data-position="left" data-control="hue" type="text" name="jform[dataset_color]" id="jform_dataset_color" value="" size="7" />
                    </div>
                </div>    
               
                  <br/><br/>
            </div>    
              <?php
            echo JHtml::_('bootstrap.endPanel');
           // echo JHtml::_('bootstrap.addPanel', 'chartTab', 'style');
            ?>  
                        
             <?php
           // echo JHtml::_('bootstrap.endPanel');            
            echo JHtml::_('bootstrap.endPane', 'chartTab');
            ?>  
         </div>
    </div>
    
    <div id="pwrapper">
        <div id="wpreview">
            <div id="preview">
		<span id="savedInfo" style="display:none;"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_SAVED');?></span>
                
                <ul class="nav nav-tabs" id="mainTable">
                    <li class="active"><a data-toggle="tab" href="#dataTable"><?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PREVIEW_TAB_TABLE'); ?></a></li>           
                    <li class="">
                        <a class="btn_addGraph nephritis-flat-button" href="#">
                            <i class="icon-plus"></i> 
                            <?php echo JText::_('COM_DROPTABLES_VIEW_DROPTABLES_PREVIEW_TAB_ADD_NEW_CHART'); ?>
                        </a>
                     
                    </li>           
                </ul>
            <?php 
            echo JHtml::_('bootstrap.startPane', 'mainTab', array('active' => 'dataTable'));
            echo JHtml::_('bootstrap.addPanel', 'mainTab', 'dataTable');
            ?>
                <div>
                    <h3 id="tableTitle"></h3>
                    <div id="tableContainer" style="overflow:scroll;">

                    </div>
              </div>
                
                   <?php
            echo JHtml::_('bootstrap.endPanel');
           // echo JHtml::_('bootstrap.addPanel', 'mainTab', 'action');
            ?>
<!--                <div>
                    Second data
                </div>-->
                
            <?php
           // echo JHtml::_('bootstrap.endPanel');
            echo JHtml::_('bootstrap.endPane', 'mainTab'); 
            ?>        
            </div>        
        </div>
    </div>
    
    <div id="dbtable_wrapper" class="dataSourceContainer" style="display: none">
        
    </div>
</div>
<script type="text/javascript">
    function openModal() {
       
        SqueezeBox.open('index.php?option=com_droptables&view=foldertree&layout=modal&tmpl=component', {handler: 'iframe'}); 
      
        return false;      
    }
    jQuery(document).ready(function ($){
        jQuery('.minicolors-input').minicolors('settings',{
            change : function(){
                jQuery(this).trigger('change');
            }
        }).attr('maxlength','7');                           

    });
    
    CKEDITOR.config.baseHref = "<?php echo JURI::root() ;?>";
    function jInsertEditorText( text,editor) {
                           
		if(typeof oEditor != 'undefined' ) 
                {
                                if (CKEDITOR.env.ie && CKEDITOR.env.version > 10 && oEditor.ie11_bookmarks)
                                    oEditor.setBookmarks(oEditor.ie11_bookmarks);
                                                    oEditor.insertHtml( text ); 
                }
		else
                {
                   
                    var oEditor = CKEDITOR.instances[editor];
                    if (CKEDITOR.env.ie && CKEDITOR.env.version > 10 && oEditor.ie11_bookmarks)
                        oEditor.setBookmarks(oEditor.ie11_bookmarks);
                        oEditor.insertHtml( text );
                }
                     
                var ckDialog = window.CKEDITOR.dialog.getCurrent();                   
                if(ckDialog) {                    
                     ckDialog.hide();
                }
    }
    
    var enable_autosave = true;
    <?php if( $params->get('enable_autosave',1)  == '0') : ?>
        enable_autosave = false;
   <?php endif;?>
   
 <?php
  $id_table = (int)JFactory::getApplication()->input->getInt('id_table'); ?>  
  var idTable = <?php echo $id_table;?> ;  
  var id_dbcat = <?php echo  $this->dbtable_cat;?> ;  
</script>
<?php        