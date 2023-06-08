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

jimport('joomla.application.component.controllerform');
jimport('joomla.filesystem.file');
class DroptablesControllerExcel extends JControllerForm {

    private $error_message = '';
    private $allowed_ext = array('xls','xlsx');
      
    public function import() {
        $app = JFactory::getApplication();
        $json = array();
        $file= $app->input->getString('file');
        
        $targetPath = JPATH_SITE . '/tmp/uploads/';        
        if($file)  {
            $file = $targetPath . $file;
        }else {
            $file = $this->_uploadFile();
        }
        
        if ($file) {

            $id = $app->input->getInt('id_table');
            $onlydata = $app->input->getInt('onlydata');
            $ignoreCheck = $app->input->getInt('ignoreCheck');
            
            $modelTable = $this->getModel('table');
            $tableContent = $modelTable->getItem($id);
            $tblStyles = json_decode($tableContent->style, true);
             
            JLoader::register('PHPExcel_IOFactory', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/phpexcel/PHPExcel/IOFactory.php');            

	   //only import data area
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheet = $objPHPExcel->getActiveSheet();
            $maxCell = $sheet->getHighestRowAndColumn();
            $datas = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
			            
            $tableContent->datas = json_encode($datas);
            if(!$ignoreCheck && ( ($maxCell['column']>=500) || ($maxCell['row']>= 500)) ) {
                  
                 $this->exit_status(true, array('too_large'=>1,'msg'=> JText::_('COM_DROPTABLES_VIEW_DROPTABLES_IMPORT_EXCEL_TOO_LARGE'),
                                    'onlydata'=> $onlydata, 'id'=> $id,'file'=> basename($file) ) );
            }
            
            if (!$onlydata) {
                $maxColIndex = PHPExcel_Cell::columnIndexFromString($maxCell['column']);
                 $ci = 0;
                $tblStyles["cols"] = array();
                foreach ($sheet->getColumnDimensions() as $cd) {
                    $tblStyles["cols"][$ci][0] = $ci;
                    $tblStyles["cols"][$ci][1]["width"] = $cd->getWidth() * 10; //Excel unit: number of characters that can be displayed with the standard font
                    $ci++;
                }
                
                $ri = 0;
                $tblStyles["rows"] = array();
                foreach ($sheet->getRowDimensions() as $rd) {
                    $tblStyles["rows"][$ri][0] = $ri;
                    $tblStyles["rows"][$ri][1]["height"] = floor($rd->getRowHeight() * 1.333333); //1 point = 1.333333 px
                    $ri++;
                }
                
                $tblStyles["cells"] = array();
                for ($ri = 0; $ri < $maxCell['row']; $ri++) {
                    for ($ci = 0; $ci < $maxColIndex; $ci++) {
                        $tblStyles["cells"][$ri . '!' . $ci] = array($ri, $ci);

                        $cellStyle = $sheet->getStyle(PHPExcel_Cell::stringFromColumnIndex($ci) . ($ri + 1));
                        $cellCss = $this->_createCSSStyle($cellStyle);
                        $tblStyles["cells"][$ri . '!' . $ci][2] = $cellCss;
                    }
                }

                $tblStyles["table"] = array();
                $tableContent->style = json_encode($tblStyles);
            }
            
            //Read Merged Cells info
            $mergeSettings =  array();
            $mergeRanges = $objPHPExcel->getActiveSheet()->getMergeCells();            
            if(count($mergeRanges)) {
                foreach ($mergeRanges as $mergeRange) {
                    list($tlCell, $rbCell) = explode(":", $mergeRange);
                    
                    list($tl_cNb, $tl_rNb) = PHPExcel_Cell::coordinateFromString($tlCell);                                      
                    list($br_cNb, $br_rNb) = PHPExcel_Cell::coordinateFromString($rbCell);    
                    $tl_cNb = PHPExcel_Cell::columnIndexFromString($tl_cNb);
                    $br_cNb = PHPExcel_Cell::columnIndexFromString($br_cNb);                  
                    
                    $mergeSetting = new stdClass();  
                    $mergeSetting->row = $tl_rNb - 1;
                    $mergeSetting->col = $tl_cNb - 1;
                    $mergeSetting->rowspan= $br_rNb- $tl_rNb + 1;
                    $mergeSetting->colspan = $br_cNb - $tl_cNb + 1;
                    $mergeSettings[]= $mergeSetting;
                }
            }
            
            $registry = new JRegistry();
            $registry->loadArray( array("mergeSetting" => json_encode($mergeSettings) ));			
            $tableContent->params = (string)$registry;
                                
            if (!$modelTable->save(JArrayHelper::fromObject($tableContent))) {
                $status = false;
                $json['msg'] = JText::_($modelTable->getError());
            } else {
                $status = true;
            }
        } else {
            $status = false;
            $json['msg'] = JText::_($this->error_message);
        }

        if(JFile::exists($file)) {
            unlink($file);
        }
        
        $this->exit_status($status, $json );
     
    }
    
     /**
     * Create CSS style
     *
     * @param	PHPExcel_Style		$pStyle			PHPExcel_Style
     * @return	array
     */
    private function _createCSSStyle(PHPExcel_Style $pStyle) {
        // Construct CSS
        $css = '';

        // Create CSS
        $css = array_merge(
                $this->_createCSSStyleAlignment($pStyle->getAlignment())
                , $this->_createCSSStyleBorders($pStyle->getBorders())
                , $this->_createCSSStyleFont($pStyle->getFont())
                , $this->_createCSSStyleFill($pStyle->getFill())
        );

        // Return
        return $css;
    }

    /**
     * Create CSS style (PHPExcel_Style_Alignment)
     *
     * @param	PHPExcel_Style_Alignment		$pStyle			PHPExcel_Style_Alignment
     * @return	array
     */
    private function _createCSSStyleAlignment(PHPExcel_Style_Alignment $pStyle) {
        // Construct CSS
        $css = array();

        // Create CSS
        $css['cell_vertical_align'] = $this->_mapVAlign($pStyle->getVertical());
        if ($textAlign = $this->_mapHAlign($pStyle->getHorizontal())) {
            $css['cell_text_align'] = $textAlign;
            if (in_array($textAlign, array('left', 'right')))
                $css['cell_padding_' . $textAlign] = (string) ((int) $pStyle->getIndent() * 9) . 'px';
        }

        // Return
        return $css;
    }

    /**
     * Create CSS style (PHPExcel_Style_Font)
     *
     * @param	PHPExcel_Style_Font		$pStyle			PHPExcel_Style_Font
     * @return	array
     */
    private function _createCSSStyleFont(PHPExcel_Style_Font $pStyle) {
        // Construct CSS
        $css = array();

        // Create CSS
        if ($pStyle->getBold()) {
            $css['cell_font_bold'] = true;
        }
        if ($pStyle->getUnderline() != PHPExcel_Style_Font::UNDERLINE_NONE && $pStyle->getStrikethrough()) {
            $css['cell_font_underline'] = true;
        } else if ($pStyle->getUnderline() != PHPExcel_Style_Font::UNDERLINE_NONE) {
            $css['cell_font_underline'] = true;
        } else if ($pStyle->getStrikethrough()) {
            $css['cell_font_underline'] = false;
        }
        if ($pStyle->getItalic()) {
            $css['cell_font_italic'] = true;
        }

        $css['cell_font_color'] = '#' . $pStyle->getColor()->getRGB();
        $css['cell_font_family'] = $pStyle->getName();
        $css['cell_font_size'] = floor($pStyle->getSize() * 96 / 72); //points = pixels * 72 / 96
        // Return
        return $css;
    }

    /**
     * Create CSS style (PHPExcel_Style_Borders)
     *
     * @param	PHPExcel_Style_Borders		$pStyle			PHPExcel_Style_Borders
     * @return	array
     */
    private function _createCSSStyleBorders(PHPExcel_Style_Borders $pStyle) {
        // Construct CSS
        $css = array();

        // Create CSS
        $css['cell_border_bottom'] = $this->_createCSSStyleBorder($pStyle->getBottom());
        $css['cell_border_top'] = $this->_createCSSStyleBorder($pStyle->getTop());
        $css['cell_border_left'] = $this->_createCSSStyleBorder($pStyle->getLeft());
        $css['cell_border_right'] = $this->_createCSSStyleBorder($pStyle->getRight());

        // Return
        return $css;
    }

    /**
     * Create CSS style (PHPExcel_Style_Border)
     *
     * @param	PHPExcel_Style_Border		$pStyle			PHPExcel_Style_Border
     * @return	string
     */
    private function _createCSSStyleBorder(PHPExcel_Style_Border $pStyle) {
        // Create CSS
//		$css = $this->_mapBorderStyle($pStyle->getBorderStyle()) . ' #' . $pStyle->getColor()->getRGB();
        //	Create CSS - add !important to non-none border styles for merged cells
        $borderStyle = $this->_mapBorderStyle($pStyle->getBorderStyle());
        if($borderStyle == 'none') {
             $css = $borderStyle ;
        }else {
             $css = $borderStyle . ' #' . $pStyle->getColor()->getRGB() .  ' !important';
        }
       
        // Return
        return $css;
    }

    /**
     * Create CSS style (PHPExcel_Style_Fill)
     *
     * @param	PHPExcel_Style_Fill		$pStyle			PHPExcel_Style_Fill
     * @return	array
     */
    private function _createCSSStyleFill(PHPExcel_Style_Fill $pStyle) {
        // Construct HTML
        $css = array();

        // Create CSS
        $value = $pStyle->getFillType() == PHPExcel_Style_Fill::FILL_NONE ?
                '' : '#' . $pStyle->getStartColor()->getRGB();
        $css['cell_background_color'] = $value;

        // Return
        return $css;
    }

    /**
     * Map VAlign
     *
     * @param	string		$vAlign		Vertical alignment
     * @return string
     */
    private function _mapVAlign($vAlign) {
        switch ($vAlign) {
            case PHPExcel_Style_Alignment::VERTICAL_BOTTOM: return 'bottom';
            case PHPExcel_Style_Alignment::VERTICAL_TOP: return 'top';
            case PHPExcel_Style_Alignment::VERTICAL_CENTER:
            case PHPExcel_Style_Alignment::VERTICAL_JUSTIFY: return 'middle';
            default: return 'baseline';
        }
    }

    /**
     * Map HAlign
     *
     * @param	string		$hAlign		Horizontal alignment
     * @return string|false
     */
    private function _mapHAlign($hAlign) {
        switch ($hAlign) {
            case PHPExcel_Style_Alignment::HORIZONTAL_GENERAL: return false;
            case PHPExcel_Style_Alignment::HORIZONTAL_LEFT: return 'left';
            case PHPExcel_Style_Alignment::HORIZONTAL_RIGHT: return 'right';
            case PHPExcel_Style_Alignment::HORIZONTAL_CENTER:
            case PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS: return 'center';
            case PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY: return 'justify';
            default: return false;
        }
    }

    /**
     * Map border style
     *
     * @param	int		$borderStyle		Sheet index
     * @return	string
     */
    private function _mapBorderStyle($borderStyle) {
        switch ($borderStyle) {
            case PHPExcel_Style_Border::BORDER_NONE: return 'none';
            case PHPExcel_Style_Border::BORDER_DASHDOT: return '1px dashed';
            case PHPExcel_Style_Border::BORDER_DASHDOTDOT: return '1px dotted';
            case PHPExcel_Style_Border::BORDER_DASHED: return '1px dashed';
            case PHPExcel_Style_Border::BORDER_DOTTED: return '1px dotted';
            case PHPExcel_Style_Border::BORDER_DOUBLE: return '3px double';
            case PHPExcel_Style_Border::BORDER_HAIR: return '1px solid';
            case PHPExcel_Style_Border::BORDER_MEDIUM: return '2px solid';
            case PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT: return '2px dashed';
            case PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT: return '2px dotted';
            case PHPExcel_Style_Border::BORDER_MEDIUMDASHED: return '2px dashed';
            case PHPExcel_Style_Border::BORDER_SLANTDASHDOT: return '2px dashed';
            case PHPExcel_Style_Border::BORDER_THICK: return '3px solid';
            case PHPExcel_Style_Border::BORDER_THIN: return '1px solid';
            default: return '1px solid'; // map others to thin
        }
    }

    
    private function _uploadFile() {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file'];
            //check file extension
            $tempFile['name'] = html_entity_decode($tempFile['name']);                
            if(!in_array(strtolower(JFile::getExt($tempFile['name'])),$this->allowed_ext)){
                    $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_WRONG_FILE_EXTENSION');
                    return false;                    
            }
                
            $targetPath = JPATH_SITE . '/tmp/uploads';
            $targetFile = $targetPath . DIRECTORY_SEPARATOR . $_FILES['file']['name'];
           
            if (JFile::upload($tempFile['tmp_name'], $targetFile)) {
                $file = $targetFile;
                return $file;
            } else {
                $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_UPLOAD_FILE_ERROR');
                return false;
            }
        } else {
            $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_UPLOAD_FILE_EMPTY');
            return false;
        }
    }

    public function export() {
        if ($file = $this->_makeFile() and is_readable($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

            if(JFile::exists($file)) {
                unlink($file);
            }
            
        } else {
            echo $this->error_message;
        }

        $app = JFactory::getApplication();
        $app->close();
    }
    
    private function _makeFile() {
        $app = JFactory::getApplication();
        $stdFormat = array('xlsx' => 'Excel2007', 'xls' => 'Excel5');
        $format_excel = $app->input->getCmd('format_excel', 'xlsx');
        $id = $app->input->getInt('id');
        $onlydata = $app->input->getInt('onlydata');
       
        $modelTable = $this->getModel('table');
        $tableContent = $modelTable->getItem($id);
        $datas = json_decode($tableContent->datas, 1);

        if (!is_array($datas)) {
            $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_EXPORT_TABLE_NOT_FOUND');
            return false;
        } else {
            
            JLoader::register('PHPExcel', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/phpexcel/PHPExcel.php');            
            $objPHPExcel = new PHPExcel();
            $activeSheet = $objPHPExcel->getActiveSheet();
            $activeSheet->fromArray($datas);

            if (!$onlydata) {

                $tblStyles = json_decode($tableContent->style, true);
                if (isset($tblStyles['rows'])) {
                    $rowStyles = $tblStyles['rows'];
                    if (!empty($rowStyles)) {
                        $rI = 0;
                        foreach ($rowStyles as $row) {
                            $rI++;
                            if (isset($row[1]) && isset($row[1]['height']) && $row[1]['height']) {
                                $activeSheet->getRowDimension($rI)->setRowHeight(floor($row[1]['height'] / 1.333333)); //px 2 pt
                            }
                        }
                    }
                }

                if (isset($tblStyles['cols'])) {
                    $colStyles = $tblStyles['cols'];
                    if (!empty($colStyles)) {
                        $cI = 0;
                        foreach ($colStyles as $col) {
                            if (isset($col[1]) && isset($col[1]['width']) && $col[1]['width']) {
                                $activeSheet->getColumnDimensionByColumn($cI)->setWidth(floor($col[1]['width'] / 10)); //Excel unit: number of characters that can be displayed with the standard font
                            }
                            $cI++;
                        }
                    }
                }

                if (isset($tblStyles['cells'])) {
                    $cellStyles = $tblStyles['cells'];
                    if (!empty($cellStyles)) { 
                        foreach ($cellStyles as $key => $cellCss) {
                            $activeSheet = $this->setCellStyle($activeSheet, $cellCss[1], $cellCss[0] + 1, $cellCss[2]);
                        }
                    }
                }

                $tableParams = $tableContent->params;
                $mergeSettings = array();
                if (isset($tableParams['mergeSetting'])) {
                    if(is_array($tableParams['mergeSetting']) ) {
                        $mergeSettings = $tableParams['mergeSetting'];
                    }else if(is_string($tableParams['mergeSetting']) ){
                        $mergeSettings = json_decode($tableParams['mergeSetting'], true);
                    }                    
                }
                
                if (!empty($mergeSettings)) {
                    foreach ($mergeSettings as $mergeSetting) {
                        $activeSheet->mergeCellsByColumnAndRow($mergeSetting['col'], $mergeSetting['row'] + 1, $mergeSetting['col'] + $mergeSetting['colspan'] - 1, $mergeSetting['row'] + $mergeSetting['rowspan']);
                    }
                }
            }
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $stdFormat[$format_excel]);
            
            jimport('joomla.filesystem.folder');
            if (!JFolder::exists($upload_dir = JPATH_SITE . '/tmp/uploads')) {
                JFolder::create($upload_dir);
            }

            $tableContent->title = strtolower(preg_replace('/[^a-z0-9_]+/i', '_', $tableContent->title));
            $file = $upload_dir . '/' . $tableContent->title . '.' . $format_excel;

            try {                
                @$objWriter->save($file);
            } catch (Exception $e) {
                $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_EXPORT_CREATE_FILE_ERROR');
            }

            if (!JFile::exists($file) or !is_readable($file)) {                
                    $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_EXPORT_CREATE_FILE_ERROR');                
                return false;
            }
        }

        return $file;
    }
    
    public function setCellStyle($activeSheet, $col, $row, $css) {
        //font
        if (isset($css['cell_font_bold']) && $css['cell_font_bold']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
        }
        if (isset($css['cell_font_underline']) && $css['cell_font_underline']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->setUnderline(true);
        }
        if (isset($css['cell_font_italic']) && $css['cell_font_italic']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->setItalic(true);
        }
        if (isset($css['cell_font_color']) && $css['cell_font_color']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->getColor()->setRGB(str_replace("#", "", $css['cell_font_color']));
        }
        if (isset($css['cell_font_family']) && $css['cell_font_family']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->setName($css['cell_font_family']);
        }
        if (isset($css['cell_font_size']) && $css['cell_font_size']) {
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFont()->setSize($css['cell_font_size'] * 72 / 96); //points = pixels * 72 / 96
        }

        //Alignment
        if (isset($css['cell_vertical_align']) && $css['cell_vertical_align']) {
            if ($css['cell_vertical_align'] == 'middle') {
                $vertical = 'center';
            } else {
                $vertical = $css['cell_vertical_align'];
            }
            $activeSheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setVertical($vertical);
        }
        if (isset($css['cell_text_align']) && $css['cell_text_align']) {
            $horizontal = $css['cell_text_align'];
            $activeSheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal($horizontal);
        }

        //Fill
        if (isset($css['cell_background_color']) && $css['cell_background_color']) {
            $fill_color = str_replace("#", "", $css['cell_background_color']);
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $activeSheet->getStyleByColumnAndRow($col, $row)->getFill()->getStartColor()->setRGB($fill_color);
        }

        //Border
        if (isset($css['cell_border_bottom']) && $css['cell_border_bottom'] ) {
            if($css['cell_border_bottom'] != 'none') {
                list($bWidth, $bStyle, $bColor) = explode(" ", $css['cell_border_bottom']);
                $borderStyle = $this->getBorderStyle($bWidth, $bStyle);
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getBottom()->setBorderStyle($borderStyle);
                $bColor = str_replace("#", "", trim($bColor));
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getBottom()->getColor()->setRGB($bColor);
            }else {
                 $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getBottom()->setBorderStyle(); //none as default
            }
        }

        if (isset($css['cell_border_top']) && $css['cell_border_top']) {
            if($css['cell_border_top'] != 'none') {
                list($bWidth, $bStyle, $bColor) = explode(" ", $css['cell_border_top']);
                $borderStyle = $this->getBorderStyle($bWidth, $bStyle);
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getTop()->setBorderStyle($borderStyle);
                $bColor = str_replace("#", "", trim($bColor));
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getTop()->getColor()->setRGB($bColor);
            }else {
                 $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getTop()->setBorderStyle(); //none as default
            }
        }

        if (isset($css['cell_border_left']) && $css['cell_border_left']) {
            if($css['cell_border_left'] != 'none') {
                list($bWidth, $bStyle, $bColor) = explode(" ", $css['cell_border_left']);
                $borderStyle = $this->getBorderStyle($bWidth, $bStyle);
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getLeft()->setBorderStyle($borderStyle);
                $bColor = str_replace("#", "", trim($bColor));
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getLeft()->getColor()->setRGB($bColor);
            }else {
                 $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getLeft()->setBorderStyle(); //none as default
            }
        }

        if (isset($css['cell_border_right']) && $css['cell_border_right']) {
             if($css['cell_border_right'] != 'none') {
                list($bWidth, $bStyle, $bColor) = explode(" ", $css['cell_border_right']);
                $borderStyle = $this->getBorderStyle($bWidth, $bStyle);
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getRight()->setBorderStyle($borderStyle);
                $bColor = str_replace("#", "", trim($bColor));
                $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getRight()->getColor()->setRGB($bColor);
             }else {
                 $activeSheet->getStyleByColumnAndRow($col, $row)->getBorders()->getRight()->setBorderStyle(); //none as default
             }
        }

        return $activeSheet;
    }
    
    function getBorderStyle($bWidth, $bStyle) {
        $borderStyle = PHPExcel_Style_Border::BORDER_NONE;
        $bStyle = trim($bStyle);
        $bWidth = (int) $bWidth;
        if ($bWidth > 1) {
            switch ($bStyle) {
                case 'solid':
                    $borderStyle = PHPExcel_Style_Border::BORDER_MEDIUM;
                    break;
                case 'dashed':
                    $borderStyle = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                    break;
                case 'dotted':
                    $borderStyle = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                    break;
            }
        } else if ((int) $bWidth == 1) {
            switch ($bStyle) {
                case 'solid':
                    $borderStyle = PHPExcel_Style_Border::BORDER_HAIR;
                    break;
                case 'dashed':
                    $borderStyle = PHPExcel_Style_Border::BORDER_DASHED;
                    break;
                case 'dotted':
                    $borderStyle = PHPExcel_Style_Border::BORDER_DOTTED;
                    break;
            }
        } else {
            $borderStyle = PHPExcel_Style_Border::BORDER_NONE;
        }

        return $borderStyle;
    }
    
    function syncSpreadsheet() {

        $db		= JFactory::getDbo();
	
        $query = 'SELECT c.* FROM #__droptables_tables as c ORDER BY c.id_category ASC, c.position ASC ';
        $db->setQuery($query);
        $tables = $db->loadObjectList();
        if (empty($tables) ) {
            return false;
        }
     
        $count = 0;
        foreach ($tables as $table) {
            $tblStyles = json_decode($table->style, true);

            if (isset($tblStyles['table']) && isset($tblStyles['table']['spreadsheet_url']) && $tblStyles['table']['spreadsheet_url']) {
                $spreadsheet_url = $tblStyles['table']['spreadsheet_url'];
                $auto_sync = (int)$tblStyles['table']['auto_sync'];
                if($auto_sync) {
                    if ($this->updateTableFromSpreadsheet($table->id, $spreadsheet_url)) {
                        $count++;
                    }
                }
            }
        }
        
        $this->exit_status(true);
       // return $count; //number of table synced
    }
    
    function fetchSpreadsheet() {
        
        $app = JFactory::getApplication();
        $id_table =  $app->input->getInt('id');
        $spreadsheet_url = $app->input->getString('spreadsheet_url');
        
        if ($id_table && $spreadsheet_url) {
            $update = $this->updateTableFromSpreadsheet($id_table, $spreadsheet_url);
            if (!$update) {
                $this->exit_status( JText::_('COM_DROPTABLES_CTRL_EXCEL_SAVE_TABLE_ERROR') );
            } else {
                $this->exit_status(true);
            }
        }

        $this->exit_status(true);
    }

    function updateTableFromSpreadsheet($id_table, $spreadsheet_url) {
        $modelTable = $this->getModel('table');   
        $tableContent = JArrayHelper::fromObject( $modelTable->getItem($id_table) );
        $doUpdate = false;

        if (strpos($spreadsheet_url, 'docs.google.com/spreadsheet') !== false) {
            //convert to url export csv
            $url_arr = explode('/', $spreadsheet_url);
            $spreadsheet_id = $url_arr[count($url_arr) - 2];
            $csv_url = "https://docs.google.com/spreadsheets/d/{$spreadsheet_id}/pub?hl=en_US&hl=en_US&single=true&output=csv";
            $url_query = parse_url($spreadsheet_url, PHP_URL_QUERY);
            if (!empty($url_query)) {
                parse_str($url_query, $url_query_params);
                if (!empty($url_query_params['gid'])) {
                    $csv_url .= '&gid=' . $url_query_params['gid'];
                }
            }

            $csv_data = $this->getDataFromUrl($csv_url);
            if (!is_null($csv_data)) {
                $csv_array = $this->csvToArray($csv_data);
            } else {
                $csv_array = array();
            }

            $tableContent['datas'] = json_encode($csv_array, JSON_UNESCAPED_UNICODE);

            $doUpdate = true;
        } else {
            //download file
            $file = $this->_downloadFile($spreadsheet_url);
            if ($file) {
               
                JLoader::register('PHPExcel_IOFactory', JPATH_ADMINISTRATOR.'/components/com_droptables/classes/phpexcel/PHPExcel/IOFactory.php');            

                //only import data area
                $objPHPExcel = PHPExcel_IOFactory::load($file);
                $sheet = $objPHPExcel->getActiveSheet();
                $maxCell = $sheet->getHighestRowAndColumn();
                $datas = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row'], "");

                $tableContent['datas'] = json_encode($datas, JSON_UNESCAPED_UNICODE);

                //Read Merged Cells info
                $mergeSettings = array();
                $mergeRanges = $objPHPExcel->getActiveSheet()->getMergeCells();
                if (count($mergeRanges)) {
                    foreach ($mergeRanges as $mergeRange) {
                        list($tlCell, $rbCell) = explode(":", $mergeRange);

                        list($tl_cNb, $tl_rNb) = PHPExcel_Cell::coordinateFromString($tlCell);
                        list($br_cNb, $br_rNb) = PHPExcel_Cell::coordinateFromString($rbCell);
                        $tl_cNb = PHPExcel_Cell::columnIndexFromString($tl_cNb);
                        $br_cNb = PHPExcel_Cell::columnIndexFromString($br_cNb);

                        $mergeSetting = new stdClass();
                        $mergeSetting->row = $tl_rNb - 1;
                        $mergeSetting->col = $tl_cNb - 1;
                        $mergeSetting->rowspan = $br_rNb - $tl_rNb + 1;
                        $mergeSetting->colspan = $br_cNb - $tl_cNb + 1;
                        $mergeSettings[] = $mergeSetting;
                    }
                }

                $tableContent['params'] = array("mergeSetting" => json_encode($mergeSettings));
                $doUpdate = true;
                unlink($file);
            }
        }

        $updated = false;
        if ($doUpdate) {
            if ($modelTable->save($tableContent)) {
                $updated = true;
            }
        }
      
        return $updated;
    }
    
      public function _downloadFile($url) {

        //check file extension
        $ext = strtolower(pathinfo($url, PATHINFO_EXTENSION));
        $newname = uniqid() . '.' . $ext;
        if (!in_array($ext, $this->allowed_ext)) {
            $this->error_message = JText::_('COM_DROPTABLES_CTRL_EXCEL_WRONG_FILE_EXTENSION');
            return false;
        }

       
        $targetPath = JFactory::getApplication()->get('tmp_path');
        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0777, true);
            $data = '<html><body bgcolor="#FFFFFF"></body></html>';
            $file = fopen($targetPath . 'index.html', 'w');
            fwrite($file, $data);
            fclose($file);
        }

        $targetFile = $targetPath . $newname;
        $data = $this->getDataFromUrl($url);
        $file = fopen($targetFile, 'w');
        fwrite($file, $data);
        fclose($file);

        return $targetFile;
    }
    
    public function getDataFromUrl($url) {
        $ch = curl_init();
        $timeout = 5;
        $agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER, JUri::root());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        if (curl_error($ch)) {
            $error = curl_error($ch);
            curl_close($ch);

            throw new Exception($error);
        }
        $info = curl_getinfo($ch);
        curl_close($ch);
        if ($info['http_code'] !== 404) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function csvToArray($csv) {
        $arr = array();
        $lines = explode("\n", $csv);
        foreach ($lines as $row) {
            $arr[] = str_getcsv($row, ",");
        }

        return $arr;
    }

       /**
     * Return a json response
     * @param $status
     * @param array $datas array of datas to return with the json string
     * 
     */
    private function exit_status($status,$datas=array()){
            $response = array('response'=>$status,'datas'=>$datas);            
            echo json_encode($response);
            JFactory::getApplication()->close();
    }

}
