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
<div id="mycategories">
    <div class="categories-toggle" id="cats-toggle"><span class="icon-arrow-left-2"></span></div>
   
    <?php if($this->canDo->get('core.create')): ?>
    <div id="newcategory" class="btn-group btn-categories">
        <a class="btn btn-default" href=""><i class="icon-plus"></i> <?php echo JText::_('COM_DROPTABLES_LAYOUT_DROPTABLES_NEW_CATEGORY'); ?></a>
    </div>
    <?php endif; ?>
    <div class="nested dd">
        <ol id="categorieslist" class="dd-list nav bs-docs-sidenav2 ">
            <?php
            $content = '';
            if(!empty($this->categories)){
                $previouslevel = 1;
                for ($index = 0; $index < count($this->categories); $index++) {
                    if($index+1!=count($this->categories)){
                        $nextlevel = $this->categories[$index+1]->level;
                    }else{
                        $nextlevel = 0;
                    }
                    $content .= '<li class="dd-item dd3-item '.($index?'':'active').'" data-id-category="'.$this->categories[$index]->id.'">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd-content dd3-content">';
                    if($this->canDo->get('core.edit') || $this->canDo->get('core.edit.own')){
                        $content .= '<a class="edit"><i class="icon-edit"></i></a>';
                    }
                    if($this->canDo->get('core.delete')){
                        $content .= '<a class="trash"><i class="icon-trash"></i></a>';
                    }
                    $content .= '<a href="" class="t">
                                <span class="title">'.$this->categories[$index]->title.'</span>
                            </a>
                        </div>';                    
                        $content .= '<ul class="droptables-tables-list">';
                        if(isset($this->tables[$this->categories[$index]->id])){
                            foreach ($this->tables[$this->categories[$index]->id] as $table) {
                                $content .= '<li class="droptablestable" data-id-table="'.$table->id.'">';
                                $content .= '<a href="#"><i class="icon-database"></i> <span class="title">'.$table->title.'</span></a>';
				if($this->canDo->get('core.edit') || $this->canDo->get('core.edit.own')){
				    $content .= ' <a class="edit"><i class="icon-edit"></i></a>';
				}
				if($this->canDo->get('core.create')){
				    $content .= ' <a class="copy"><i class="icon-copy"></i></a>';
				}
				if($this->canDo->get('core.delete')){
				    $content .= ' <a class="trash"><i class="icon-trash"></i></a>';
				}
                                $content .= '</li>';
                            }
                        }
			if($this->canDo->get('core.create')){
			    $content .= '<li><a class="newTable" href="#"><i class="icon-plus"></i> '.JText::_('COM_DROPTABLES_VIEW_DROPTABLES_TABLE_ADD').'</a></li>';
			}
                        $content .= '</ul>';
                    
                    if($nextlevel>$this->categories[$index]->level){
                        $content .= '<ol class="dd-list">';
                    }elseif($nextlevel==$this->categories[$index]->level){
                        $content .= '</li>';
                    }else{
                        $c = '';
                        $c .= '</li>';
                        $c .= '</ol>';
                        $content .= str_repeat($c,$this->categories[$index]->level-$nextlevel);
                    }
                    $previouslevel = $this->categories[$index]->level;                    
                }
            } 
            echo $content;
            ?>
        </ol>
    </div>
</div>
