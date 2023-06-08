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

$params = JComponentHelper::getParams('com_droptables');

?>
<div>
    <div class="pull-left">  
      <div id="jao"></div>
    </div>
    <div class="pull-right">	
            <button class="btn btn-primary" type="button" onclick="selectFile()"><?php echo JText::_('JSAVE') ?></button>
            <button class="btn" type="button" onclick="window.parent.jModalClose();"><?php echo JText::_('JCANCEL') ?></button>
    </div>
</div>    
<script>

jQuery(document).ready(function($) {
   droptables_site_url ='<?php echo JUri::root();?>';
   selectFile = function() {  
        selected_file = "";
        $('#jao').find('input:checked + a').each(function(){         
            selected_file = $(this).attr('data-file');
        })
        
       window.parent.document.getElementById('jform_spreadsheet_url').value = droptables_site_url + selected_file;   
       window.parent.jQuery("#jform_spreadsheet_url").change(); 
       window.parent.jModalClose();
      
    } ;
      
   $('#jao').jaofiletree({ 
            script  : 'index.php?option=com_droptables&task=connector.listdir&tmpl=component',
              usecheckboxes : 'files',
            showroot : '/',
            oncheck: function(elem,checked,type,file){                                  
                
            }        
        });
       
})
</script>        