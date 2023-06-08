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
?>
<div class="wrap droptables-dbtable">
    
    <?php if(empty($this->id_table)) : ?>
    <h2><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_TABLE_CREATION_WIZARD');?></h2>
    <?php endif ?>
    <div class="droptables-dbtable-wrap">
        <h3><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_CHOOSE_MYSQL_TABLES') ; ?></h3>
        <table>
            <tr>
                <td style="width: 250px">
                    <label for="droptables_mysql_tables"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_TABLES_SELECTION') ;?></span></label>
                </td>
                <td>
                    <div class="uploader">

                        <select class="droptables_mysql_tables" multiple="true">
                            <?php foreach ($this->mysql_tables as $mysql_table) { ?>
                            <option value="<?php echo $mysql_table ?>" <?php if(in_array($mysql_table, $this->selected_tables)) { echo 'selected'; };?>><?php echo $mysql_table ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <label for="droptables_mysql_tables_columns"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_COLUMNS_SELECTION') ; ?></span></label>
                </td>
                <td>
                    <div class="uploader">

                        <select class="droptables_mysql_tables_columns" multiple="true">
                            <?php if(count($this->availableColumns)) {
                                  foreach ($this->availableColumns as $column) { ?>
                                    <option value="<?php echo $column ?>" <?php if(in_array($column, $this->selected_columns)) { echo 'selected'; };?>><?php echo $column ?></option>
                                  <?php }
                            }else { ?>
                                 <option value=""><?php  echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_SELECT_TABLE_FIRST') ;  ?></option>
                            <?php
                            } ?>
                                                    
                        </select>

                    </div>                   
                </td>
                <td style="width: 520px">
                     <div class="columnsTitleContainer">
                    <?php
                    if(count($this->selected_columns)) {
                        $i = 0;
                        foreach ($this->selected_columns as $column) { $column_id  = str_replace(".", "_", $column) ?>
                          <div class="droptables_row column_title" id="droptables_row_<?php echo $column_id;?>"><label><?php echo $column;?> custom title: </label><input type="text" name="" id="droptables_column_<?php echo $column_id;?>" class="" value="<?php echo $this->custom_titles[$i];?>"  /></div>                                  
                        <?php  $i++; }                       
                    }?>
                    </div>
                </td>
            </tr>
           
            <tr>
                <td>
                    <label for="droptables_mysql_default_ordering_column"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DATA_DEFAULT_ORDERING') ;  ?></span></label>
                </td>
                <td>
                    <select class="droptables_mysql_default_ordering_column" >
                        <?php if(count($this->selected_columns)) {
                                  foreach ($this->selected_columns as $column) { ?>
                                    <option value="<?php echo $column ?>" <?php if($column == $this->default_ordering_column) { echo 'selected'; };?>><?php echo $column ?></option>
                                  <?php }
                        } ?>
                    </select>
                    <select class="droptables_mysql_default_ordering_dir" >
                        <option value="asc" <?php if('asc' == $this->default_ordering_dir) { echo 'selected'; };?>> <?php echo JText::_('JGLOBAL_ORDER_ASCENDING') ;  ?></option>
                        <option value="desc" <?php if('desc' == $this->default_ordering_dir) { echo 'selected'; };?>> <?php echo JText::_('JGLOBAL_ORDER_DESCENDING') ;  ?></option>
                    </select>
                </td>
                <td>
                 
                </td>                
            </tr>
         <?php if(!$this->id_table) { ?>
            <tr>
                <td>
                    <label for="droptables_mysql_table_pagination"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_ACTIVATE_PAGINATION') ; ?></span></label>
                </td>
                <td>
                    <select class="droptables_mysql_table_pagination" >
                        <option value="1"><?php echo JText::_('JYES') ;?></option>
                        <option value="0"><?php echo JText::_('JNO') ;?></option>
                    </select>
                </td>
                <td>
                   
                </td>                
            </tr>
            
            <tr>
                <td>
                    <label for="droptables_mysql_number_of_rows"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_NUMBER_OF_ROWS') ;?> </span></label>
                </td>
                <td>
                    <select class="droptables_mysql_number_of_rows" >
                        <option value="10">10 rows</option>
                        <option value="20" selected>20 rows</option>
                        <option value="40">40 rows</option>
                        <option value="0">All rows</option>
                    </select>
                </td>
                <td>                   
                </td>                
            </tr>
        <?php } ?>    
            <tr class="droptables_handle_multiple_tables" style="display: none">
                <td>
                    <label for="droptables_table_relations"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_CHOOSE_HANDLE_TABLE_RELATIONS') ; ?></span></label>
                </td>
                <td>
                    <div class="uploader">
                        <label for="droptables_table_relations_join"><input type="radio" name="droptables_table_relations" id="droptables_table_relations_join" value="parent_child" /> <?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DEFINE_JOINING_RULE_BETWEEN_TABLES') ; ?></label><br/>
                        <label for="droptables_table_relations_outer_join"><input type="radio" name="droptables_table_relations" id="droptables_table_relations_outer_join" value="union" /> <?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DO_NOT_DEFINE_JOINING_RULE_BETWEEN_TABLES') ; ?></label><br/>
                    </div>
                </td>
                <td></td>
            </tr>
            
            <tr class="droptables_define_mysql_relations" style="<?php if(empty($this->join_rules)) { echo 'display: none';}?>">
                <td>
                    <label for="droptables_mysql_relations"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DEFINE_RELATION_BETWEEN_TABLES') ; ?></span></label>
                </td>
                <td colspan="2">
                    <div class="uploader mysqlRelationsContainer">
               <?php if(!empty($this->join_rules)) :
                    foreach ($this->join_rules as $join_rule) {   ?>
                       <div class="mysql_table_blocks">
                        <span class="relationInitiatorTable"><?php echo $join_rule['initiator_table'];?>.</span>
                        <select class="relationInitiatorColumn" data-table="<?php echo $join_rule['initiator_table'];?>">
                           <option value=""></option>
                           <?php foreach ($this->sorted_columns[$join_rule['initiator_table']] as $key => $column) { 
                               $col = str_replace($join_rule['initiator_table'].".","", $column);  ?>
                           <option value="<?php echo $col;?>"  <?php if($join_rule['initiator_column']==$col){ echo 'selected';}?> >
                               <?php echo $col;?></option>
                           <?php } ?>
                        
                        </select> 
                         =
                        <select class="relationConnectedColumn" data-table="<?php echo $join_rule['initiator_table'];?>">
                           <option value=""></option>
                           <?php foreach ($this->sorted_columns as $tbl => $columns) { 
                               if($tbl !=  $join_rule['initiator_table']) {
                                   foreach ($this->sorted_columns[$tbl] as  $column) { ?>
                                       <option value="<?php echo $column;?>" <?php if($join_rule['connected_column']==$column){ echo 'selected';}?>  ><?php echo $column;?></option>
                                   <?php
                                   }
                               }                                    
                            }?>
                                                
                        </select>
                        <input type="checkbox" <?php if($join_rule['type']!='left') { echo 'checked';}?> title="<?php  echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_INNER_JOIN_LABEL') ;  ?>" class="innerjoin" />
                       </div>
                    <?php
                    }
                 
               endif; ?>    
                        
                        
                    </div>
                </td>
             
            </tr>
            <tr class="droptables_define_mysql_conditions">
                <td>
                    <label for="droptables_mysql_conditions"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DATA_DISPLAY_CONDITION_LABEL'); ?></span></label>
                </td>
                <td colspan="2">
                    <div class="uploader mysqlConditionsContainer">
                    </div>
                    <button class="btn button-secondary droptables_mysql_add_where_condition">+</button>
                </td>
               
            </tr>
            <tr class="droptables_define_mysql_grouping">
                <td>
                    <label for="droptables_posts_grouping"><span><?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_DATA_GROUP_RULES');  ?></span></label>
                </td>
                <td colspan="2">
                    <div class="uploader mysqlGroupingContainer">
                    </div>
                    <button class="btn button-secondary droptables_mysql_add_grouping_rule">+</button>
                </td>
              
            </tr>                                                                                        

        </table>
        <br/>
        <input type="button" id="btn_preview" class="button button-primary" value="<?php echo JText::_('JGLOBAL_PREVIEW'); ?>" />
        <?php if($this->id_table) { ?>
             <input type="button" id="btn_tableUpdate" class="button button-primary" value="<?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_UPDATE_TABLE'); ?>" />
        <?php 
        }else { ?>
            <input type="button" id="btn_tableCreate" disabled class="button button-primary" value="<?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_CREATE_TABLE'); ?>" />
        <?php }?>
                
         <div class="uploader droptables_previewTable">
                                                                                                            
         </div>
    </div>
</div>    

<script type="text/javascript">
    
     droptables_ajaxurl = " index.php?option=com_droptables&";
   
 <?php if(!empty($this->selected_tables)) { ?>
     constructedTableData.id_table = <?php echo $this->id_table ;?>;
     constructedTableData.tables =<?php echo json_encode($this->selected_tables );?>;
     constructedTableData.enable_pagination = <?php echo (isset($this->params['enable_pagination'])?$this->params['enable_pagination']: 1) ;?>;
     constructedTableData.limit_rows = <?php echo (isset($this->params['limit_rows'])?$this->params['limit_rows'] : 20)  ;?>;
    <?php    
    if(!empty($this->selected_columns)) { ?>
      constructedTableData.mysql_columns =<?php echo json_encode($this->selected_columns );?>;    
   <?php   
    }
 }?>
</script>

<script type="text/x-handlebars-template" id="droptables-template-mysqlRelationBlock">
     <div class="mysql_table_blocks">
     <span class="relationInitiatorTable">{{table}}.</span>
     <select class="relationInitiatorColumn" data-table="{{table}}">
        <option value=""></option>
        {{#each columns}}
        <option value="{{this}}">{{this}}</option>
        {{/each}}
     </select> 
      =
     <select class="relationConnectedColumn" data-table="{{table}}">
        <option value=""></option>
        {{#each other_table_columns}}
        <option value="{{this}}">{{this}}</option>
        {{/each}}
     </select>
     <input type="checkbox" title="<?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_INNER_JOIN_LABEL'); ?>" class="innerjoin" />
    </div>


</script>

<script type="text/x-handlebars-template" id="whereConditionTemplate" >
    <div class="post_where_blocks">
    <select class="whereConditionColumn">
        <option value=""></option>
        {{#each post_type_columns}}
        <option value="{{this}}">{{this}}</option>
        {{/each}}
     </select>
     <select class="whereOperator">
           <option value="eq">=</option>
           <option value="gt">&gt;</option>
           <option value="gtoreq">&gt;=</option>
           <option value="lt">&lt;</option>
           <option value="ltoreq">&lt;=</option>
           <option value="neq">&lt;&gt;</option>
           <option value="like">LIKE</option>
           <option value="plikep">%LIKE%</option>
           <option value="in">IN</option>
     </select>
     
    <input type="text" />
                
    <button class="btn button-secondary deleteConditionPosts" style="line-height: 26px; font-size: 26px"><span class="dashicons dashicons-no"></span></button>
    </div>
</script>


<script type="text/x-handlebars-template"  id="groupingRuleTemplate" >
    <div class="post_grouping_rule_blocks">
    <?php echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_GROUP_BY'); ?>
        
    <select class="groupingRuleColumn">
        <option value=""></option>
        {{#each post_type_columns}}
        <option value="{{this}}">{{this}}</option>
        {{/each}}
     </select>
     
    <button class="btn button-secondary deleteGroupingRulePosts" style="line-height: 26px; font-size: 26px"><span class="dashicons dashicons-no"></span></button>
    </div>
</script>