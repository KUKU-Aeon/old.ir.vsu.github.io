<?php
/** 
 * Droptables
 * 
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package Droptables
 * @copyright Copyright (C) 2013 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2013 Damien Barrère (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;
jimport('joomla.filesystem.folder');
jimport( 'joomla.filesystem.file' );

class DroptablesControllerConnector extends JControllerLegacy
{

    public function listdir(){
        $user = JFactory::getUser();
        if(!$user->authorise('core.admin')){
            return json_encode(array());
        }
        
        $path = JPATH_ROOT.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
        $dir  = trim(JRequest::getString('dir'));      
        
        //Prevent  directory traversal
        if (strpos($dir,'..') !== false){
            jexit();
        }
     
        $allowed_ext = array('xls','xlsx');
        $return = $dirs =  $fi = array();
        if( file_exists($path.$dir) ) {            
                $files = scandir($path.$dir);

                natcasesort($files);
                if( count($files) > 2 ) { // The 2 counts for . and ..
                    // All dirs
                    $baseDir = ltrim(rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $dir),'/'),'/'); 
                    if($baseDir != '') $baseDir .= '/';                    
                    foreach( $files as $file ) {			
                            if( file_exists($path . $dir . DIRECTORY_SEPARATOR . $file) && $file != '.' && $file != '..' && is_dir($path . $dir. DIRECTORY_SEPARATOR . $file) ) {                                                                    
                                    $dirs[] = array('type'=>'dir','dir'=>$dir,'file'=>$file);                                    
                            }elseif( file_exists($path . $dir . DIRECTORY_SEPARATOR . $file) && $file != '.' && $file != '..' && !is_dir($path . $dir . DIRECTORY_SEPARATOR . $file) ) {
                                $dot = strrpos($file, '.') + 1;
                                $file_ext = strtolower( substr($file, $dot) ); //var_dump($file_ext);
                                if(  in_array($file_ext, $allowed_ext) ) {
                                    $fi[] = array('type'=>'file','dir'=>$dir,'file'=>$file,'ext'=>$file_ext);
                                }
                            }
                    }
                    $return = array_merge($dirs,$fi);
                }
        }
      
        echo json_encode( $return );
        jexit();
    }
  
}