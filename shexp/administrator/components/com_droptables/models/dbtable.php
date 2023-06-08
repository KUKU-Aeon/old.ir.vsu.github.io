<?php
/* Based on some work of wp Data Tables plugin */
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

jimport('joomla.application.component.modeladmin');
class DroptablesModelDbtable extends JModelAdmin {

    /*     * * For the WP DB type query ** */ 
    private $_select_arr = array();
    private $_where_arr = array();
    private $_group_arr = array();
    private $_from_arr = array();
    private $_inner_join_arr = array();
    private $_left_join_arr = array();
    private $_has_groups = false;

    /** Query text * */
    private $_query = '';

    public function getForm($data = array(), $loadData = true){
        $form = $this->loadForm('com_droptables.dbtable', 'dbtable', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
                return false;
        }
        return $form;
    }
    
    public function listMySQLTables() {
        $dbo = $this->getDbo();
        $tables = array();
       
        $dbo->setQuery('SHOW TABLES');
        $result = $dbo->loadRowList();

        // Formatting the result to plain array
        foreach ($result as $row) {
            $tables[] = $row[0];
        }

        return $tables;
    }

    /**
     * Return a list of columns for the selected tables
     */
    public static function listMySQLColumns($tables) {
        $columns = array('all_columns' => array(), 'sorted_columns' => array());
        if (!empty($tables)) {
            $dbo = JFactory::getDbo();           
            foreach ($tables as $table) {
                $columns['sorted_columns'][$table] = array();
                $dbo->setQuery("SHOW COLUMNS FROM {$table};");
                $table_columns = $dbo->loadRowList(); 
                foreach ($table_columns as $table_column) {
                    $columns['sorted_columns'][$table][] = "{$table}.{$table_column[0]}";
                    $columns['all_columns'][] = "{$table}.{$table_column[0]}";
                }
            }
        }

        return $columns;
    }

    /**
     * Return a build query and preview table
     */
    public function generateQueryAndPreviewdata($table_data) {
        $dbo = $this->getDbo();        
        $this->_table_data = $table_data;
        if (!isset($this->_table_data['where_conditions'])) {
            $this->_table_data['where_conditions'] = array();
        }

        if (isset($this->_table_data['grouping_rules'])) {
            $this->_has_groups = true;
        }

        if (!isset($table_data['mysql_columns'])) {
            $table_data['mysql_columns'] = array();
        }

        // Initializing structure for the SELECT part of query
        $this->_prepareMySQLSelectBlock($table_data['mysql_columns']);

        // Initializing structure for the WHERE part of query
        $this->_prepareMySQLWhereBlock();

        // Prepare the GROUP BY block
        $this->_prepareMySQLGroupByBlock();

        // Prepare the join rules
        $this->_prepareMySQLJoinedQueryStructure();

        // Prepare the query itself
        $this->_query = $this->_buildMySQLQuery();
   
        if (isset($this->_table_data['default_ordering']) && $this->_table_data['default_ordering']) {
            $this->_query .= " Order by ". $this->_table_data['default_ordering']." " . $this->_table_data['default_ordering_dir'];
        }
        
        $result = array(
				'query' => $this->_query,
				'preview' => $this->getQueryPreview()
			);
        
        return $result;
        
    }

    /**
     * Generate the sample table with 5 rows from MySQL query
     */    
    public function getQueryPreview() {

        $dbo = $this->getDbo();  
        $dbo->setQuery($this->_query . ' LIMIT 10');
        $result = $dbo->loadRowList();

        if (!empty($result)) {
           
            $headers = $this->_table_data['custom_titles'];            
            ob_start();
            include( JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'dbtable' . DIRECTORY_SEPARATOR . 'tmpl' . DIRECTORY_SEPARATOR . 'table_preview.inc.php' );
            $ret_val = ob_get_contents();
            ob_end_clean();
        } else {
            $ret_val = JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_NO_RESULTS');
        }
        return $ret_val;
    }

    /**
     * Helper function to generate the fields structure from MySQL tables
     */
    private function _prepareMySQLSelectBlock() {

        foreach ($this->_table_data['mysql_columns'] as $mysql_column) {

            $mysql_column_arr = explode('.', $mysql_column);
            if (!isset($this->_select_arr[$mysql_column_arr[0]])) {
                $this->_select_arr[$mysql_column_arr[0]] = array();
            }
            $this->_select_arr[$mysql_column_arr[0]][] = $mysql_column;

            if (!in_array($mysql_column_arr[0], $this->_from_arr)) {
                $this->_from_arr[] = $mysql_column_arr[0];
            }
        }
    }

     /**
     * Prepare a Where block for MySQL based
     */
    private function _prepareMySQLWhereBlock() {

        if (empty($this->_table_data['where_conditions'])) {
            return;
        }

        foreach ($this->_table_data['where_conditions'] as $where_condition) {

            $where_column_arr = explode('.', $where_condition['column']);

            if (!in_array($where_column_arr[0], $this->_from_arr)) {
                $this->_from_arr[] = $where_column_arr[0];
            }

            $this->_where_arr[$where_column_arr[0]][] = self::buildWhereCondition(
                            $where_condition['column'], $where_condition['operator'], $where_condition['value']
            );
        }
    }

    /**
     * Prepare a GROUP BY block for MySQL based
     */
    private function _prepareMySQLGroupByBlock() {
        if (!$this->_has_groups) {
            return;
        }

        foreach ($this->_table_data['grouping_rules'] as $grouping_rule) {
            if (empty($grouping_rule)) {
                continue;
            }
            $this->_group_arr[] = $grouping_rule;
        }
    }

    /**
     * Prepares the structure of the JOIN rules for MySQL based tables
     */
    private function _prepareMySQLJoinedQueryStructure() {
        if (!isset($this->_table_data['join_rules'])) {
            return;
        }

        foreach ($this->_table_data['join_rules'] as $join_rule) {
            if (empty($join_rule['initiator_column']) || empty($join_rule['connected_column'])) {
                continue;
            }

            $connected_column_arr = explode('.', $join_rule['connected_column']);

            if (in_array($connected_column_arr[0], $this->_from_arr) && count($this->_from_arr) > 1) {
                if ($join_rule['type'] == 'left') {
                    $this->_left_join_arr[$connected_column_arr[0]] = $connected_column_arr[0];
                } else {
                    $this->_inner_join_arr[$connected_column_arr[0]] = $connected_column_arr[0];
                }
                unset($this->_from_arr[array_search($connected_column_arr[0], $this->_from_arr)]);
            } else {
                if ($join_rule['type'] == 'left') {
                    $this->_left_join_arr[$connected_column_arr[0]] = $connected_column_arr[0];
                } else {
                    $this->_inner_join_arr[$connected_column_arr[0]] = $connected_column_arr[0];
                }
            }

            $this->_where_arr[$connected_column_arr[0]][] = self::buildWhereCondition(
                            $join_rule['initiator_table'] . '.' . $join_rule['initiator_column'], 'eq', $join_rule['connected_column'], false
            );
        }
    }

    /**
     * Prepares the query text for MySQL based table
     */
    private function _buildMySQLQuery() {

        // Build the final output
        $query = "SELECT ";
        $i = 0;
        foreach ($this->_select_arr as $table_alias => $select_block) {
            $new_select_block = array();
            foreach ($select_block as $select_element) {
                $new_select_block[] = $select_element." AS ". str_replace(".", "_", $select_element);
            }
            $query .= implode(",\n       ", $new_select_block);
            $i++;
            if ($i < count($this->_select_arr)) {
                $query .= ",\n       ";
            }
        }
        $query .= "\nFROM ";
        $query .= implode(', ', $this->_from_arr) . "\n";
        if (!empty($this->_inner_join_arr)) {
            $i = 0;
            foreach ($this->_inner_join_arr as $table_alias => $inner_join_block) {
                $query .= "  INNER JOIN " . $inner_join_block . "\n";
                if (!empty($this->_where_arr[$table_alias])) {
                    $query .= "     ON " . implode("\n     AND ", $this->_where_arr[$table_alias]) . "\n";
                    unset($this->_where_arr[$table_alias]);
                }
            }
        }
        if (!empty($this->_left_join_arr)) {

            foreach ($this->_left_join_arr as $table_alias => $left_join_block) {
                $query .= "  LEFT JOIN " . $left_join_block . "\n";
                if (!empty($this->_where_arr[$table_alias])) {
                    $query .= "     ON " . implode("\n     AND ", $this->_where_arr[$table_alias]) . "\n";
                    unset($this->_where_arr[$table_alias]);
                }
            }
        }
        if (!empty($this->_where_arr)) {
            $query .= "WHERE 1=1 \n   AND ";
            $i = 0;
            foreach ($this->_where_arr as $table_alias => $where_block) {
                $query .= implode("\n   AND ", $where_block);
                $i++;
                if ($i < count($this->_where_arr)) {
                    $query .= "\n   AND ";
                }
            }
        }
        if (!empty($this->_group_arr)) {
            $query .= "\nGROUP BY " . implode(', ', $this->_group_arr);
        }
        return $query;
    }

    
     /**
     * Prepares the structure of the WHERE rules for MySQL based tables
     */
    public static function buildWhereCondition($leftOperand, $operator, $rightOperand, $isValue = true) {
        $rightOperand = stripslashes($rightOperand); //stripslashes_deep
        $wrap = $isValue ? "'" : "";
        switch ($operator) {
            case 'eq':
                return "{$leftOperand} = {$wrap}{$rightOperand}{$wrap}";
            case 'neq':
                return "{$leftOperand} != {$wrap}{$rightOperand}{$wrap}";
            case 'gt':
                return "{$leftOperand} > {$wrap}{$rightOperand}{$wrap}";
            case 'gtoreq':
                return "{$leftOperand} >= {$wrap}{$rightOperand}{$wrap}";
            case 'lt':
                return "{$leftOperand} < {$wrap}{$rightOperand}{$wrap}";
            case 'ltoreq':
                return "{$leftOperand} <= {$wrap}{$rightOperand}{$wrap}";
            case 'in':
                return "{$leftOperand} IN ({$rightOperand})";
            case 'like':
                return "{$leftOperand} LIKE {$wrap}{$rightOperand}{$wrap}";
            case 'plikep':
                return "{$leftOperand} LIKE {$wrap}%{$rightOperand}%{$wrap}";
        }
    }

    //create new table for selected mysql tables
    public function createTable($table_data) {
        
        $dbo = $this->getDbo();
        $id_category = $this->getCategoryId();
        $query = 'SELECT MAX(c.position) AS lastPos FROM #__droptables_tables as c WHERE c.id_category='.(int)$id_category;  
        $dbo->setQuery($query);
        $lastPos = (int)$dbo->getResult();
        $lastPos++;      
        $style =  json_decode('{   "table":{      "alternate_row_even_color":"#fafafa",      "use_sortable":"1"   },   "rows":{      "0":[         0,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_family":"Arial",            "cell_font_size":"13",            "cell_font_color":"#333333",            "cell_border_bottom":"2px solid #707070",            "cell_background_color":"#ffffff",            "cell_font_bold":true,            "cell_vertical_align":"middle"         }      ],      "1":[         1,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "2":[         2,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "3":[         3,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "4":[         4,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "5":[         5,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "6":[         6,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "7":[         7,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ],      "8":[         8,         {            "height":30,            "cell_padding_top":"3",            "cell_padding_right":"3",            "cell_padding_bottom":"3",            "cell_padding_left":"3",            "cell_font_color":"#333333",            "cell_border_bottom":"1px solid #d6d6d6",            "cell_vertical_align":"middle"         }      ]   },   "cols":{      "0":[         0,         {            "width":50,            "cell_text_align":"center",            "cell_font_bold":true         }      ],      "1":[         1,         {            "width":122,"cell_text_align":"center"         }      ],      "2":[         2,         {            "width":137,"cell_text_align":"center"         }      ],      "3":[         3,         {            "width":133,"cell_text_align":"center"         }      ],      "4":[         4,         {            "width":150,"cell_text_align":"center"         }      ],      "5":[         5,         {            "width":50,"cell_text_align":"center"         }      ]   },   "cells":{         }}');
        $style->table->enable_pagination = $table_data['enable_pagination'];
        $style->table->limit_rows = $table_data['limit_rows'];
                
        $params = $table_data;
        $params['table_type'] = 'mysql';
        $user = JFactory::getUser();
        $query  = sprintf(       
                            "
                                    INSERT INTO #__droptables_tables (id_category, title, datas, style, params, created_time, modified_time, author, position) VALUES 
                                    ( %d,%s,%s,%s,%s,%s,%s,%d,%d)
				",
				$id_category, $dbo->quote(Jtext::_('COM_DROPTABLES_MODEL_TABLE_DEFAULT_TITLE')),  $dbo->quote($table_data['query']), $dbo->quote(json_encode($style)), $dbo->quote(json_encode($params)), $dbo->quote(date("Y-m-d H:i:s")), $dbo->quote(date("Y-m-d H:i:s")), $user->id, $lastPos
			) ;
        $dbo->setQuery($query);
      
        if(!$dbo->query()){
            return false;
        }
        return $dbo->insertid();     
    }
    
     //update table with new change
    public function updateTable($id_table, $table_data) {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
         
        $params = $table_data;
        $params['table_type'] = 'mysql';
        // Fields to update.
        $fields = array(
            $db->quoteName('datas') . ' = ' . $db->quote( $table_data['query']),
            $db->quoteName('params') . ' = '. $db->quote( json_encode($params)),
            $db->quoteName('modified_time') . ' = '. $db->quote( date("Y-m-d H:i:s"))
        );

        // Conditions for which records should be updated.
        $conditions = array(
            $db->quoteName('id') . ' = ' . $db->quote($id_table)       
        );

        $query->update($db->quoteName('#__droptables_tables'))->set($fields)->where($conditions);

        $db->setQuery($query);
        $ret = $db->execute();                              
        return $ret;
    }
    
    //getID of special category for database tables.
    public function getCategoryId() {
                
        $config_dbtable_cat = (int)JComponentHelper::getParams('com_droptables')->get('dbtable_cat',0);        
        $modelCategory = JModelLegacy::getInstance('Category', 'DroptablesModel'); 
       
        if(!$config_dbtable_cat || !$modelCategory->isCategoryExist($config_dbtable_cat)) {           
           
            $cat_id = $modelCategory->addCategory('DB tables'); 
          
            $helper = new droptablesComponentHelper();
            $helper->setParams(array('dbtable_cat'=> $cat_id));
            
            return $cat_id;
        }
        
        return (int)$config_dbtable_cat;
    }
 

}
