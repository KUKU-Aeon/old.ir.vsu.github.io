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

jQuery(document).ready(function($) {
    isSelectionProcess = false; //hack because minicolos trigger change when value modified by js
    if (typeof (Droptables) == 'undefined') {
        Droptables = {};
        Droptables.can = {};
        Droptables.can.create = false;
        Droptables.can.edit = false;
        Droptables.can.delete = false;
        Droptables.selection = {};
    }
    
    //Categories toggle button
    $('#cats-toggle').toggle(
            function () {
                $('#mycategories').animate({left: -265},50,function(){
                    $('#pwrapper').css({'margin-left':30});
                    $(this).addClass('mycategories-hide');
                      setTimeout(function(){resizeTable();},500) ;
                });
                $(this).html('<span class="icon-arrow-right-2">');
            }, 
            function () {
                
                $('#mycategories').animate({left: 15},100,function(){
                    $('#pwrapper').css({'margin-left':'320px'});
                    $(this).removeClass('mycategories-hide');
                    setTimeout(function(){resizeTable();},500) ;
                });
                $(this).html('<span class="icon-arrow-left-2">');
            }
    );
    
    
    /* init menu actions */
    initMenu();
  
    /* Load nestable */
    if (Droptables.can.edit) {
        $('.nested').nestable().on('change', function(event, e) {
            pk = $(e).data('id-category');
            if ($(e).prev('li').length === 0) {
                position = 'first-child';
                if ($(e).parents('li').length === 0) {
                    //root
                    ref = 0;
                } else {
                    ref = $(e).parents('li').data('id-category');
                }
            } else {
                position = 'after';
                ref = $(e).prev('li').data('id-category');
            }
            $.ajax({
                url: "index.php?option=com_droptables&task=categories.order&pk=" + pk + "&position=" + position + "&ref=" + ref,
                type: "POST"
            }).done(function(data) {
                result = jQuery.parseJSON(data);
                if (result.response === true) {

                } else {
                    bootbox.alert(result.response);
                }
            });
        });
        if (Droptables.collapse === true) {
            $('.nested').nestable('collapseAll');
        }
    }

    $(".droptables-tables-list").sortable({
        axis: 'y',
        revert: false,
        items: "> li.droptablestable",
        connectWith: ".droptables-tables-list",
        start: function(event, ui) {
            ui.item.addClass('sorting');             
        },
        stop: function(event, ui) {               
            setInterval(function () { ui.item.removeClass('sorting');  }, 1000);             
        },
        update: function( event, ui ) {
            
            var sortedIDs = $(this).sortable( "toArray", { attribute: "data-id-table" } ); 
            $.ajax({
                url: "index.php?option=com_droptables&task=table.reorder&order="+sortedIDs.join(),
                type: "POST"                
            }).done(function(data) {
                result = jQuery.parseJSON(data);
                if (result.response === true) {
                    //do nothing
                } else {
                    bootbox.alert(result.response);
                }
            });
        }
     });
     
     $("#categorieslist > li.dd-item > .dd-content").droppable({
            hoverClass: "dd-content-hover",
            drop: function( event, ui ) {                
                $(this).addClass( "ui-state-highlight" );
                cat_target = $(event.target).parent().data("id-category");
                id_table = $(ui.draggable).data("id-table"); 
                is_active = $(ui.draggable).hasClass('active');
                $.ajax({
                    url: "index.php?option=com_droptables&task=table.changeCategory&id="+id_table+"&category="+cat_target,                              
                }).done(function(data) {
                    result = jQuery.parseJSON(data);
                    if (result.response === true) {
                        //move to new category
                        $(event.target).parent().find("ul.droptables-tables-list").prepend( $(ui.draggable) );
                        $(ui.draggable).css('top','').css('left',''); //reset offset position
                    
                        if(is_active) {                          
                             $('#categorieslist li').removeClass('active');
                             $(event.target).parent().addClass('active');   
                             $(event.target).parent().find('ul.droptables-tables-list li:first').addClass('active');
                        }
                    } else {
                        bootbox.alert(result.response);
                    }
                });  
              
            }
        }             
    );
    
    //Check what is loaded via editor
    if (typeof (gcaninsert) !== 'undefined' && gcaninsert === true) {
        if (typeof (window.parent.tinyMCE) !== 'undefined') {
            content = window.parent.tinyMCE.get(e_name).selection.getContent();
            imgparent = window.parent.tinyMCE.get(e_name).selection.getNode().parentNode;
            exp = '<img.*data\-droptablestable="([0-9]+)".*?>';
            table = content.match(exp); 
            Droptables.selection = new Array();
            Droptables.selection.content = content;
                       
            if (table !== null) {
                $('#categorieslist .droptablestable[data-id-table=' + table[1] + ']').addClass('active');
                updatepreview(table[1]);
                
                exp2 = '<img.*data\-droptables\-chart="([0-9]+)".*?>';
                table2 = content.match(exp2); 
                if (table2 !== null) {
                    Droptables.chart_id =  table2[1] ;
                }
            }
            else {
                updatepreview();
            }
        }
        //DropEditor
        else if(typeof window.parent.CKEDITOR != 'undefined') {
            var ckEditor = window.parent.CKEDITOR.instances[e_name];  
            imgElement = ckEditor.getSelection().getSelectedElement();           
            if(typeof imgElement != "undefined" && imgElement != null ) {
                 table_id = imgElement.getAttribute('data-droptablestable');                 
                 if (table_id !== null) {
                      $('#categorieslist .droptablestable[data-id-table=' + table_id + ']').addClass('active');
                      updatepreview(table_id);
                      chart_id = imgElement.getAttribute('data-droptables-chart');
                      if (chart_id !== null) {
                            Droptables.chart_id =  chart_id ;
                      }
                 }else {
                    updatepreview();
                }
            }else{
                 updatepreview();
            }
        } //end DropEditor
    } else {
     
        /* Load table */
        if(idTable) {
            updatepreview(idTable);
        }else {
            updatepreview();
        }

    }
  
    if ($('#headMainCss').length === 0) {
        $('head').append('<style id="headMainCss"></style>');
    }
    var styleToRender = [];
    if ($('#headCss').length === 0) {
        $('head').append('<style id="headCss"></style>');
    }

    var autosaveNotification;
    var dataReadOnly;
    /**
     * Reload a category preview
     */
    function updatepreview(id, ajaxCallBack) {
        if (typeof (id) !== "undefined") {
            $('#categorieslist .dd-item').removeClass('active');
            selectedElem = $('#categorieslist ul.droptables-tables-list li[data-id-table=' + id + ']');
            selectedElem.addClass('active');
            selectedElem.parents('.dd-item').first().addClass('active');
        } else {
            id = $('#categorieslist li.active > ul.droptables-tables-list li:first').data('id-table');
            $('#categorieslist li.active > ul.droptables-tables-list li:first').addClass('active');
        }

        if (typeof (id) === 'undefined' && typeof (selectedElem) !== 'undefined' && selectedElem.length === 0) {
            $('#tableTitle,#rightcol').hide();
            $('#tableContainer').html(Joomla.JText._('COM_DROPTABLES_LAYOUT_DROPTABLES_SELECT_ONE', 'Please select a table a create a new one'));
            return;
        }
        $('#tableTitle,#rightcol').show();
        $('#tableContainer').empty();
        $('#tableContainer').handsontable('destroy');
    
	// make the Table tab active
        $('ul#mainTable li a:first').tab('show');   
            
        loading('#wpreview');
        url = "index.php?option=com_droptables&view=table&format=json&id=" + id;
        $.ajax({
            url: url,
            type: "POST",
			dataType: "json"
        }).done(function(data) {
            if (typeof (data) === 'string') {
                bootbox.alert(data);
            } else {
                Droptables.id = id;
                Droptables.container = $("#tableContainer");
                var autosaveNotification;
                cols = [];
                rows = [];

                if (data.datas === "") {
                    var tableData = [
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""],
                        ["", "", "", "", "", "", "", "", "", ""]
                    ];
                    delete Droptables.style;
                } else {
                    tableData = $.parseJSON(data.datas);
                    Droptables.style = $.parseJSON(data.style);
                    Droptables.css = data.css;
                }

                dataReadOnly = false;
                $(".dbtable_params").hide();
                $('#rightcol .table-styles').show();
                $('#rightcol .spreadsheet_sync').show();     
                
                if (data.params === "" || data.params === null || data.params.length == 0) {
                    mergeCellsSetting = true;
                } else {
                    mergeCellsSetting = $.parseJSON(data.params.mergeSetting);
                    if(mergeCellsSetting==null) mergeCellsSetting = [];  
                    if(typeof data.params.table_type != 'undefined' && data.params.table_type=='mysql') {
                        dataReadOnly = true;
                        $(".dbtable_params").show();
                        $('#rightcol .table-styles').hide();
                        $('#rightcol .spreadsheet_sync').hide();
                    }
                }

                if (typeof (Droptables.style) === 'undefined' || Droptables.style === null) {
                    $.extend(Droptables, {
                        style: {
                            table: {},
                            rows: {},
                            cols: {},
                            cells: {}
                        },
                        css: ''
                    });
                }
                
                $defaultParams = {'use_sortable':'0','table_align':'center','responsive_type':'scroll','freeze_col':0,'freeze_row':0,'enable_filters':0};
                Droptables.style.table = $.extend( {}, $defaultParams, Droptables.style.table );
                
                $('#jform_css').val(Droptables.css);
                $('#jform_css').change();
                parseCss();

                initBtnPosition();
                initHandsontable(tableData);
                
                 $(".droptables_warning").remove();                               
                $('h3#tableTitle').html(data.title);
                if(typeof Droptables.style.table.spreadsheet_url != 'undefined' &&  Droptables.style.table.spreadsheet_url != "" && typeof Droptables.style.table.auto_sync != 'undefined' &&  Droptables.style.table.auto_sync != "0") {
                    $('h3#tableTitle').after('<div class="droptables_warning"><p>'+ Joomla.JText._('COM_DROPTABLES_NOTICE_MSG_TABLE_SYNCABLE', 'This spreadsheet is currently sync with an external file, you may lose content in case of modification') +'</p></div>');                    
                }
                
                if(dataReadOnly) {
                    $('h3#tableTitle').after('<div class="droptables_warning"><p>'+ Joomla.JText._('COM_DROPTABLES_NOTICE_MSG_TABLE_SYNCABLE','Table data are from database, only the 50 first rows are displayed for performance reason.')  +'</p></div>');
                }
              
               
                //$('#tableContainer .ht_master .wtSpreader').append('<div style="height:50px;">');
                initBtnPosition();
                $(Droptables.container).handsontable('render');
                $(Droptables.container).handsontable('selectCell', 0, 0);
                resizeTable();
                
                $("#fetch_spreadsheet").unbind('click').click(function(e) {
                    e.preventDefault();
                   
                    tableId = $('li.droptablestable.active').data('id-table');
                    spreadsheet_url = $("#jform_spreadsheet_url").val();
                    if(!spreadsheet_url) return;
                    loading('#wpreview');
                    url =  "index.php?option=com_droptables&task=excel.fetchSpreadsheet&id=" + tableId ;
                    var jsonVar = {
                        spreadsheet_url: encodeURI(spreadsheet_url),
                        id: tableId
                    };
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: jsonVar 
                    }).done(function(data) {     
                        result = jQuery.parseJSON(data);                    
                        if (result.response === true) {                           
                            updatepreview(tableId);                           
                        }
                        rloading('#wpreview');
                    });
                });
                 
                switchTableDatabase(false);
                 if(typeof ajaxCallBack == "function") {
                     ajaxCallBack();
                 }
            }

            rloading('#wpreview');
        });   
        
    }

    initHandsontable = function (tableData) {
        var needSaveAfterRender = false;

        Droptables.container.handsontable({
            data: tableData,
            startRows: 5,
            startCols: 5,
            renderAllRows: true,
            colHeaders: true,
            rowHeaders: true,
            fixedRowsTop: (Droptables.style.table.responsive_type == 'scroll') ? parseInt(Droptables.style.table.freeze_row) : 0,
            fixedColumnsLeft: (Droptables.style.table.responsive_type == 'scroll') ? parseInt(Droptables.style.table.freeze_col) : 0,
            manualColumnResize: (Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author)),
            manualRowResize: (Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author)),
            outsideClickDeselects: false,
            renderer: customRenderer,
            columnSorting: false,
            undo: true,
            mergeCells: mergeCellsSetting,
            readOnly: (( (Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author)) && !dataReadOnly) ? false : true),
            contextMenu: (( (Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author)) && !dataReadOnly) ? ["row_above", "row_below", "hsep1", "col_left", "col_right", "hsep2", "remove_row", "remove_col", "hsep3", "undo", "hsep4", "mergeCells"] : false),
            editor: CustomEditor,
            beforeChange: function (changes, source) {
                for (var i = changes.length - 1; i >= 0; i--) {

                    if (!validateCharts(changes[i])) {
                        bootbox.alert("Invalid chart data");
                        return false;
                    }

                }
            },
            afterChange: function (change, source) {
                loadTableContructor();
                loadCharts();
                if (source === 'loadData' || !(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
                    return; //don't save this change
                }
                clearTimeout(autosaveNotification);
                saveChanges();

            },
            beforeKeyDown: function (e) {
                if ($("#categorieslist span.title.editable").length > 0) {
                    e.stopImmediatePropagation();
                }
            },
            afterColumnResize: function (width, col) {
                saveChanges();
            },
            afterRowResize: function (height, row) {
                saveChanges();
            },
            beforeRender: function () {
                styleToRender = '';
            },
            afterRender: function () {

                var parser = new (less.Parser);
                content = '#preview .handsontable .ht_master .htCore {' + styleToRender + '}';
                if (Droptables.style.table.responsive_type == 'scroll' && Droptables.style.table.freeze_row) {
                    content += ' #preview .handsontable .ht_clone_top .htCore {' + styleToRender + '}';
                }
                if (Droptables.style.table.responsive_type == 'scroll' && Droptables.style.table.freeze_col) {
                    content += ' #preview .handsontable .ht_clone_left .htCore {' + styleToRender + '}';
                }
                if (Droptables.style.table.responsive_type == 'scroll' && Droptables.style.table.freeze_row && Droptables.style.table.freeze_col) {
                    content += ' #preview .handsontable .ht_clone_corner .htCore {' + styleToRender + '}';
                }
                parser.parse(content, function (err, tree) {
                    if (err) {
                        //Here we can throw the erro to the user
                        return false;
                    } else {
                        Droptables.css = $('#jform_css').val();
                        if ($('#headMainCss').length === 0) {
                            $('head').append('<style id="headMainCss"></style>');
                        }
                        $('#headMainCss').text(tree.toCSS());
                        return true;
                    }
                });
                pushDims();
                if (needSaveAfterRender === true) {
                    saveChanges();
                    needSaveAfterRender = false;
                }
                initBtnPosition();
                //fix row height of overlay table
                for(i=0;i<$('#tableContainer .ht_master .htCore tr').length;i++) {
                       var h = $('#tableContainer .ht_master .htCore tr').eq(i).height() ;                         
                       $('#tableContainer .ht_clone_left .htCore tr').eq(i).height(h) ;
                }
            },
            afterCreateRow: function (index, amount) {
                selection = $(Droptables.container).handsontable('getSelected');
                if (typeof (Droptables.style.cells) !== 'undefined') {
                    newCells = {};
                    for (cell in Droptables.style.cells) {
                        if (Droptables.style.cells[cell][0] < index) {
                            //no changes to cells
                            newCells[cell] = clone(Droptables.style.cells[cell]);
                        } else if (Droptables.style.cells[cell][0] === index) {

                            if (index === selection[0]) {
                                //inserted before
                                newCells[cell] = clone(Droptables.style.cells[cell]);
                                newCells[(Droptables.style.cells[cell][0] + amount) + '!' + Droptables.style.cells[cell][1]] = [Droptables.style.cells[cell][0] + amount, Droptables.style.cells[cell][1], clone(Droptables.style.cells[(Droptables.style.cells[cell][0]) + '!' + Droptables.style.cells[cell][1]][2])];
                            } else {
                                //inserted after
                                newCells[cell] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1], clone(Droptables.style.cells[(Droptables.style.cells[cell][0] - amount) + '!' + Droptables.style.cells[cell][1]][2])];
                                newCells[(Droptables.style.cells[cell][0] + amount) + '!' + Droptables.style.cells[cell][1]] = [Droptables.style.cells[cell][0] + amount, Droptables.style.cells[cell][1], clone(Droptables.style.cells[(Droptables.style.cells[cell][0]) + '!' + Droptables.style.cells[cell][1]][2])];
                            }

                        } else {
                            newCells[(Droptables.style.cells[cell][0] + amount) + '!' + Droptables.style.cells[cell][1]] = [Droptables.style.cells[cell][0] + amount, Droptables.style.cells[cell][1], clone(Droptables.style.cells[cell][2])];
                        }
                    }
                    if ($(Droptables.container).handsontable('countRows') === index + amount) {
                        //row added at the bottom
                        for (ij = 0; ij < $(Droptables.container).handsontable('countCols'); ij++) {
                            if (typeof (Droptables.style.cells[selection[0] + '!' + ij]) !== 'undefined') {
                                newCells[index + '!' + ij] = [index, ij, clone(Droptables.style.cells[selection[0] + '!' + ij][2])];
                            }
                        }
                    }
                    Droptables.style.cells = clone(newCells);
                }
                needSaveAfterRender = true;
            },
            afterCreateCol: function (index, amount) {
                selection = $(Droptables.container).handsontable('getSelected');
                if (typeof (Droptables.style.cells) !== 'undefined') {
                    newCells = {};
                    for (cell in Droptables.style.cells) {
                        if (Droptables.style.cells[cell][1] < index) {
                            //no changes to cells
                            newCells[cell] = clone(Droptables.style.cells[cell]);
                        } else if (Droptables.style.cells[cell][1] === index) {

                            if (index === selection[1]) {
                                //inserted before
                                newCells[cell] = clone(Droptables.style.cells[cell]);
//                                    newCells[(Droptables.style.cells[cell][0]+amount)+'!'+Droptables.style.cells[cell][1]] = [Droptables.style.cells[cell][0]+amount,Droptables.style.cells[cell][1],clone(Droptables.style.cells[(Droptables.style.cells[cell][0])+'!'+Droptables.style.cells[cell][1]][2])];
                                newCells[Droptables.style.cells[cell][0] + '!' + (Droptables.style.cells[cell][1] + amount)] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1] + amount, clone(Droptables.style.cells[(Droptables.style.cells[cell][0]) + '!' + Droptables.style.cells[cell][1]][2])];
                            } else {
                                //inserted after
                                newCells[cell] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1], clone(Droptables.style.cells[Droptables.style.cells[cell][0] + '!' + (Droptables.style.cells[cell][1] - amount)][2])];
                                newCells[(Droptables.style.cells[cell][0]) + '!' + (Droptables.style.cells[cell][1] + amount)] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1] + amount, clone(Droptables.style.cells[(Droptables.style.cells[cell][0]) + '!' + Droptables.style.cells[cell][1]][2])];
                            }

                        } else {
                            newCells[(Droptables.style.cells[cell][0]) + '!' + (Droptables.style.cells[cell][1] + amount)] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1] + amount, clone(Droptables.style.cells[cell][2])];
                        }
                    }
                    if ($(Droptables.container).handsontable('countCols') === index + amount) {
                        //col added at the right
                        for (ij = 0; ij < $(Droptables.container).handsontable('countRows'); ij++) {
                            if (typeof (Droptables.style.cells[ij + '!' + selection[1]]) !== 'undefined') {
                                newCells[ij + '!' + index] = [ij, index, clone(Droptables.style.cells[ij + '!' + selection[1]][2])];
                            }
                        }
                    }
                    Droptables.style.cells = clone(newCells);
                }
                needSaveAfterRender = true;
            },
            afterRemoveRow: function (index, amount) {
                selection = $(Droptables.container).handsontable('getSelected');
                if (typeof (Droptables.style.cells) !== 'undefined') {
                    newCells = {};
                    for (cell in Droptables.style.cells) {
                        if (Droptables.style.cells[cell][0] > index) {
                            newCells[parseInt(Droptables.style.cells[cell][0] - amount) + '!' + Droptables.style.cells[cell][1]] = [Droptables.style.cells[cell][0] - amount, Droptables.style.cells[cell][1], $.extend({}, Droptables.style.cells[cell][2])];
                        } else if (Droptables.style.cells[cell][0] === index) {

                        } else {
                            newCells[Droptables.style.cells[cell][0] + '!' + Droptables.style.cells[cell][1]] = $.extend([], Droptables.style.cells[cell]);
                        }
                    }
                    Droptables.style.cells = newCells;
                }
                needSaveAfterRender = true;
            },
            afterRemoveCol: function (index, amount) {
                selection = $(Droptables.container).handsontable('getSelected');
                if (typeof (Droptables.style.cells) !== 'undefined') {
                    newCells = {};
                    for (cell in Droptables.style.cells) {
                        if (Droptables.style.cells[cell][1] > index) {
                            newCells[Droptables.style.cells[cell][0] + '!' + parseInt(Droptables.style.cells[cell][1] - amount)] = [Droptables.style.cells[cell][0], Droptables.style.cells[cell][1] - amount, $.extend({}, Droptables.style.cells[cell][2])];
                        } else if (Droptables.style.cells[cell][1] === index) {

                        } else {
                            newCells[Droptables.style.cells[cell][0] + '!' + Droptables.style.cells[cell][1]] = $.extend([], Droptables.style.cells[cell]);
                        }
                    }
                    Droptables.style.cells = newCells;
                }
                needSaveAfterRender = true;
            },
            afterSelection: function () {
                isSelectionProcess = true;
                loadSelection();
                isSelectionProcess = false;
                $('#rightcol .referCell a').trigger('click');
            },
            colWidths: function (index) {
                if (typeof (Droptables.style.cols) !== 'undefined' && typeof (Droptables.style.cols[index]) !== 'undefined' && typeof (Droptables.style.cols[index][1]) !== 'undefined' && typeof (Droptables.style.cols[index][1].width) !== 'undefined') {
                    return Droptables.style.cols[index][1].width;
                }
            },
            rowHeights: function (index) {
                if (typeof (Droptables.style.rows) !== 'undefined' && typeof (Droptables.style.rows[index]) !== 'undefined' && typeof (Droptables.style.rows[index][1]) !== 'undefined' && typeof (Droptables.style.rows[index][1].height) !== 'undefined') {
                    return Droptables.style.rows[index][1].height;
                } else {
                    return 21;
                }
            },
            undoChangeStyle: function (oldStyle) {
                //alert('after change style');
                Droptables.style = oldStyle;
                selection = $(Droptables.container).handsontable('getSelected');

                needSaveAfterRender = true;
                $(Droptables.container).handsontable('render');
                $(Droptables.container).handsontable("selectCell", selection[0], selection[1], selection[2], selection[3]);
                resizeTable();
            }
        });
    }
    
    resizeTable = function() {
        var offset = $('#tableContainer').offset();
        availableWidth = window.innerWidth  - offset.left + $(window).scrollLeft() - 328 + (getUrlVar('caninsert') && 20);
        $('#tableContainer').width(availableWidth);      
        $(window).scrollTop($(window).scrollTop()+1); //trigger window scroll event       
        resizeBtnPosition();
    };
    $(window).on('resize', function() {
        resizeTable();
    });

    initBtnPosition = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return;
        }
        if ($('#insertColBtn').length === 0) {
            btnCol = $('<a href="#" id="insertColBtn"><i class="icon-plus-circle"></i></a>');
            btnCol.insertBefore($('#tableContainer'));

            $('#insertColBtn')
                    .css('height', parseInt(parseInt($('#tableContainer').height()) - 20) + "px")
                    .css('line-height', parseInt(parseInt($('#tableContainer').height()) - 20) + "px")
                    .bind("contextmenu", function(e) {
                        e.preventDefault();
                        return false;
                    })
                    .unbind('click').bind('click', function() {
                nbCols = $(Droptables.container).handsontable('countCols');
                if (nbCols === 0) {
                    $(Droptables.container).handsontable('loadData', [[""]]);
                } else {
                    selection = $(Droptables.container).handsontable('getSelected');
                    $(Droptables.container).handsontable('selectCell', selection[0], nbCols - 1);
                    $(Droptables.container).handsontable('alter', 'insert_col', nbCols);
                }
                saveChanges();
                return false;
            });
            
        }
        if ($('#insertRowBtn').length === 0) {
            btnRow = $('<div style="height:50px;"><a href="#" id="insertRowBtn"><i class="icon-plus-circle"></i></a></div>');
            //$('#tableContainer .ht_master .wtSpreader').append(btnRow);
            btnRow.insertAfter($('#tableContainer'));
            $('#insertRowBtn').bind("contextmenu", function(e) {
                e.preventDefault();
                return false;
            })
                    .unbind('click').bind('click', function() {
                nbRows = $(Droptables.container).handsontable('countRows');
                if (nbRows === 0) {
                    $(Droptables.container).handsontable('loadData', [[""]]);
                } else {
                    selection = $(Droptables.container).handsontable('getSelected');
                    $(Droptables.container).handsontable('selectCell', nbRows - 1, selection[1]);
                    $(Droptables.container).handsontable('alter', 'insert_row', nbRows);
                }
                saveChanges();
                return false;
            });
           
        }
    };

    resizeBtnPosition = function() {
         $('#insertRowBtn')
                        .css('width', parseInt(parseInt($('#tableContainer').width()) ) + "px");
         $('#insertColBtn')
                        .css('height', parseInt(parseInt($('#tableContainer').height()) - 20) + "px")
                        .css('line-height', parseInt(parseInt($('#tableContainer').height()) - 20) + "px");
    }
    
   $("#saveTable").click(function(e) {
       e.preventDefault();    	
       saveChanges(true);
    });
    
    function saveChanges(autosave) {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return;
        }

        if(typeof autosave == 'undefined' && !enable_autosave) {
            return;
        }
        
        var ht = Droptables.container.handsontable('getInstance');
        var mergeSetting = ht.mergeCells.mergedCellInfoCollection;

        var jsonVar = {
            jform: {
                datas: (dataReadOnly)? '' : JSON.stringify(Droptables.container.handsontable('getData')),
                style: JSON.stringify(Droptables.style),
                css: Droptables.css,
                params: (dataReadOnly)? '' : {"mergeSetting": JSON.stringify(mergeSetting)}
            },
            id: Droptables.id
        };
        jsonVar[Droptables.token] = "1";
        Droptables.style = cleanStyle(Droptables.style, $(Droptables.container).handsontable('countRows'), $(Droptables.container).handsontable('countCols'));
        $.ajax({
            url: "index.php?option=com_droptables&task=table.save",
            dataType: "json",
            type: "POST",
            data: jsonVar,
            success: function(datas) {
                if (datas.response === true) {
                    autosaveNotification = setTimeout(function() {
                        $('#savedInfo').fadeIn(200).delay(2000).fadeOut(1000);
                    }, 1000);
                } else {
                    bootbox.alert(datas.response);
                }
            },
            error: function(jqxhr, textStatus, error) {
                bootbox.alert(textStatus + " : " + error);
            }
        });
    }

    /**
     * Click on new category btn
     */
    $('#newcategory a:not(.dropdown-toggle)').on('click', function(e) {
        if (!(Droptables.can.create)) {
            return;
        }
        e.preventDefault();
        $.ajax({
            url: "index.php?option=com_droptables&task=category.addCategory",
            type: 'POST',
            data: Droptables.token + '=1'
        }).done(function(data) {
            try {
                result = jQuery.parseJSON(data);
            } catch (err) {
                bootbox.alert('<div>' + data + '</div>');
            }
            if (result.response === true) {
                link = '' +
                        '<li class="dd-item dd3-item" data-id-category="' + result.datas.id_category + '">' +
                        '<div class="dd-handle dd3-handle"></div>' +
                        '<div class="dd-content dd3-content">' +
                        '<a class="edit"><i class="icon-edit"></i></a>' +
                        '<a class="trash"><i class="icon-trash"></i></a>' +
                        '<a href="" class="t">' +
                        '<span class="title">' + result.datas.name + '</span>' +
                        '</a>' +
                        '</div>' +
                        '<ul class="droptables-tables-list">' +
                        '<li><a class="newTable" href="#"><i class="icon-plus"></i> ' + Joomla.JText._('COM_DROPTABLES_VIEW_DROPTABLES_TABLE_ADD', 'Add new table') + '</a></li>' +
                        '</ul>' +
                        '</li>';
                $(link).appendTo('#categorieslist');
                initMenu();
                $('#mycategories #categorieslist li[data-id-category=' + result.datas.id_category + '] .dd-content').click();
                $('#insertcategory').show();
            } else {
                bootbox.alert(result.response);
            }
        });
    });


    /* Title edition */
    function initMenu() {
        /**
         * Click on delete category btn
         */
        $('#categorieslist .dd-content .trash').unbind('click').on('click', function() {
            if (!(Droptables.can.delete)) {
                return;
            }
            id_category = $(this).closest('li').data('id-category');
            bootbox.confirm(Joomla.JText._('COM_DROPTABLES_JS_WANT_DELETE', 'Do you really want to delete ') + "\"" + $(this).parent().find('.title').text().trim() + '"?', function(result) {
                if (result === true) {
                    $.ajax({
                        url: "index.php?option=com_droptables&task=categories.delete&id_category=" + id_category,
                        type: 'POST',
                        data: Droptables.token + '=1',
                        success: function(datas) {
                            result = jQuery.parseJSON(datas);
                            if (result.response === true) {
                                $('#mycategories #categorieslist li[data-id-category=' + id_category + ']').remove();
                                first = $('#mycategories #categorieslist li .dd-content').first();
                                if (first.length > 0) {
                                    first.click();
                                } else {
                                    $('#insertcategory').hide();
                                }
                            } else {
                                bootbox.alert(result.response);
                            }
                        },
                        error: function(jqxhr, textStatus, error) {
                            bootbox.alert(textStatus + " : " + error);
                        }
                    });
                }
            });
            return false;
        });

        (initTableNew = function() {
            $('#categorieslist a.newTable').unbind('click').click(function(e) {
                if (!(Droptables.can.create)) {
                    return;
                }
                id_category = $(this).parents('.dd-item').data('id-category');
                if(id_category==id_dbcat) {
                    e.preventDefault();
                    createDbTable();        
                    return ;
                }
                          
                that = this;
                $.ajax({
                    url: "index.php?option=com_droptables&task=table.add&id_category=" + id_category,
                    type: "POST",
                    dataType: "json",
                    success: function(datas) {
                        if (datas.response === true) {
                            $(that).parent().before('<li class="droptablestable" data-id-table="' + datas.datas.id + '"><a href="#"><i class="icon-database"></i> <span class="title">' + datas.datas.title + '</span></a><a class="edit"><i class="icon-edit"></i></a><a class="copy"><i class="icon-copy"></i></a><a class="trash"><i class="icon-trash"></i></a></li>');
                            initMenu();
                        } else {
                            bootbox.alert(datas.response);
                        }
                    },
                    error: function(jqxhr, textStatus, error) {
                        bootbox.alert(textStatus + " : " + error);
                    }
                });
                return false;
            });
        })();

        (initTableDelete = function() {
            if (!(Droptables.can.delete)) {
                return false;
            }
            $('#categorieslist .droptables-tables-list a.trash').unbind('click').click(function(e) {
                that = this;
                bootbox.confirm(Joomla.JText._('COM_DROPTABLES_JS_WANT_DELETE', 'Do you really want to delete ') + "\"" + $(this).prev().prev().prev().text().trim() + '"?', function(result) {
                    if (result === true) {
                        id = $(that).parent().data('id-table');
                        $.ajax({
                            url: "index.php?option=com_droptables&task=table.delete&id=" + id,
                            type: "POST",
                            dataType: "json",
                            success: function(datas) {
                                if (datas.response === true) {
                                    $(that).parent().remove();
                                    updatepreview();
                                } else {
                                    bootbox.alert(datas.response);
                                }
                            },
                            error: function(jqxhr, textStatus, error) {
                                bootbox.alert(textStatus);
                            }
                        });
                        return false;
                    }
                });
            });
        })();

        (initTableCopy = function() {
            $('#categorieslist .droptables-tables-list a.copy').unbind('click').click(function(e) {
                if (!(Droptables.can.create)) {
                    return false;
                }
                that = this;
                id = $(that).parent().data('id-table');
                $.ajax({
                    url: "index.php?option=com_droptables&task=table.copy&id=" + id,
                    type: "POST",
                    dataType: "json",
                    success: function(datas) {
                        if (datas.response === true) {
                            $(that).parents('.droptables-tables-list').find('li').last().before('<li class="droptablestable" data-id-table="' + datas.datas.id + '"><a href="#"><i class="icon-database"></i> <span class="title">' + datas.datas.title + '</span></a><a class="edit"><i class="icon-edit"></i></a><a class="copy"><i class="icon-copy"></i></a><a class="trash"><i class="icon-trash"></i></a></li>');
                            initMenu();
                        } else {
                            bootbox.alert(datas.response);
                        }
                    },
                    error: function(jqxhr, textStatus, error) {
                        bootbox.alert(textStatus);
                    }
                });
                return false;
            });
        })();

        (initTablesLinks = function() {
            $('#categorieslist .droptables-tables-list a:not(".newTable,.trash,.edit,.copy")').unbind('click').click(function(e) {
                id = $(this).parent().data('id-table');
                $('#categorieslist .droptables-tables-list li').removeClass('active');
                $(this).parent().addClass('active');
                updatepreview(id);

                return false;
            });
        })();

        /* Set the active category on menu click */
        (initCategoriesClick = function() {
            $('#categorieslist .dd-content').unbind('click').click(function(e) {
                $('#categorieslist li').removeClass('active');
                $(this).parent().addClass('active');
                updatepreview();

                return false;
            });
        })();

        $('#categorieslist a.edit').unbind().click(function(e) {
            e.stopPropagation();
            if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
                return false;
            }
            $this = this;
            link = $(this).parent().find('a span.title');
            oldTitle = link.text();
            $(link).attr('contentEditable', true);
            $(link).addClass('editable');
            $(link).selectText();

            $('#categorieslist a span.editable').bind('click.mm', hstop);  //let's click on the editable object
            $(link).bind('keypress.mm', hpress); //let's press enter to validate new title'
            $('*').not($(link)).bind('click.mm', houtside);

            function unbindall() {
                $('#categorieslist a span').unbind('click.mm', hstop);  //let's click on the editable object
                $(link).unbind('keypress.mm', hpress); //let's press enter to validate new title'
                $('*').not($(link)).unbind('click.mm', houtside);
            }

            //Validation       
            function hstop(event) {
                event.stopPropagation();
                return false;
            }

            //Press enter
            function hpress(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    unbindall();
                    updateTitle($(link).text());
                    $(link).removeAttr('contentEditable');
                    $(link).removeClass('editable');
                }
            }

            //click outside
            function houtside(e) {
                unbindall();
                updateTitle($(link).text());
                $(link).removeAttr('contentEditable');
                $(link).removeClass('editable');
            }


            function updateTitle(title) {
                if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
                    return false;
                }
                if ($(link).parents('.droptables-tables-list').length === 0) {
                    id = $(link).parents('li').data('id-category');
                    url = "index.php?option=com_droptables&task=category.setTitle&id_category=" + id + '&title=' + title;
                    type = 'category';
                } else {
                    id = $(link).parents('li').data('id-table');
                    url = "index.php?option=com_droptables&task=table.setTitle&id=" + id + '&title=' + title;
                    type = 'table';
                }

                if (title !== '') {
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "json",
                        success: function(datas) {
                            if (datas.response === true) {
                                if (type === 'table' && Droptables.id == id) {
                                    $('h3#tableTitle').html(title);
                                }
                            } else {
                                $(link).text(oldTitle);
                                bootbox.alert(datas.response);
                            }
                        },
                        error: function(jqxhr, textStatus, error) {
                            $(link).text(oldTitle);
                            bootbox.alert(textStatus);
                        }
                    });
                } else {
                    $(link).text(oldTitle);
                    return false;
                }
                $(link).parent().css('white-space', 'normal');
                setTimeout(function() {
                    $(link).parent().css('white-space', '');
                }, 200);

            }
        });
    }




    (initStyles = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        $('#rightcol .table-styles a').click(function() {
            id = $(this).data('id');
            cellsData = $(Droptables.container).handsontable('getData');
            var ret = true;
            nbCols = 0;
            nbRows = cellsData.length;
            $.each(cellsData, function(index, value) {
                        nbCols = value.length;
                        $.each(value, function(i, v) {                           
                            if (v && v.toString().trim() !== '') {
                                ret = false;
                                return false;
                            }
                        });             
             });
            
            if(ret==false) {
                bootbox.confirm(Joomla.JText._('COM_DROPTABLES_JS_WARNING_CHANGE_THEME', 'Warning - all data and styles will be removed & replaced on theme switch') , function(result) {
                    if (result === true) {
                        $.ajax({
                            url: "index.php?option=com_droptables&view=style&format=json&id=" + id,
                            type: 'POST',
							dataType: "json"
                        }).done(function(data) {
                            if (typeof (data) === 'object') {
                                cellsData = $(Droptables.container).handsontable('getData');
                                var ret = true;
                                nbCols = 0;
                                nbRows = cellsData.length;                                                              
                                datas = $.parseJSON(data.data);
                                $(Droptables.container).handsontable('loadData', datas);
                                
                                //backup old style
                                var oldStyle = JSON.parse(JSON.stringify(Droptables.style));

                                //Apply cols and row style to cells
                                style = $.parseJSON(data.style);
                                $('#jform_css').val(data.css);
                                $('#jform_css').change();
                                Droptables.style = {table: style.table, rows: {}, cols: {}, cells: style.cells};
                                $.each(datas, function(row, rValue) {
                                    $.each(rValue, function(col, cValue) {
                                        if (typeof (Droptables.style.cells[row + '!' + col]) === 'undefined') {
                                            Droptables.style.cells[row + '!' + col] = [row, col, {}];
                                        }
                                        if (typeof (style.cols[col]) !== 'undefined' && Object.keys(style.cols[col][1]).length !== 0) {
                                            for (attr in style.cols[col][1]) {
                                                if (typeof (Droptables.style.cells[row + '!' + col][2][attr]) === 'undefined') {
                                                    Droptables.style.cells[row + '!' + col][2][attr] = style.cols[col][1][attr];
                                                }
                                            }
                                        }
                                        if (typeof (style.rows[row]) !== 'undefined' && Object.keys(style.rows[row][1]).length !== 0) {
                                            for (attr in style.rows[row][1]) {
                                                if (typeof (Droptables.style.cells[row + '!' + col][2][attr]) === 'undefined') {
                                                    Droptables.style.cells[row + '!' + col][2][attr] = style.rows[row][1][attr];
                                                }
                                            }

                                        }
                                    });
                                });

                                //re-apply responsive parameters           
                                if(typeof oldStyle.table.responsive_type != "undefined") {
                                    Droptables.style.table.responsive_type = oldStyle.table.responsive_type;
                                }
                                for (col in style.cols) {            
                                         colIndex = style.cols[col][0];                            
                                         if (typeof oldStyle.cols[colIndex]!== "undefined" && typeof oldStyle.cols[colIndex][1]["res_priority"] !== "undefined") {
                                             if(typeof Droptables.style.cols[colIndex] == "undefined") {
                                                 Droptables.style.cols[colIndex] = [colIndex, {}];                                             
                                             }
                                             Droptables.style.cols[colIndex][1]["res_priority"] = oldStyle.cols[colIndex][1]["res_priority"];
                                         }
                                }

                                //If no content we can set our own cols and rows size
                                if (ret === true) {
                                    for (row in style.rows) {
                                        if (typeof (style.rows[row]) !== 'undefined' && (typeof (style.rows[row][1].height) !== 'undefined')) {
                                            if (typeof (Droptables.style.rows[style.rows[row][0]]) === 'undefined') {
                                                Droptables.style.rows[style.rows[row][0]] = [row, {}];
                                            }
                                            Droptables.style.rows[style.rows[row][0]][1].height = style.rows[row][1].height;
                                        }
                                    }
                                    for (col in style.cols) {
                                        if (typeof (style.cols[col]) !== 'undefined' && (typeof (style.cols[col][1].width) !== 'undefined')) {
                                            if (typeof (Droptables.style.cols[style.cols[col][0]]) === 'undefined') {
                                                Droptables.style.cols[style.cols[col][0]] = [col, {}];
                                            }
                                            Droptables.style.cols[style.cols[col][0]][1].width = style.cols[col][1].width;
                                        }
                                    }
                                    pullDims();
                                }
                                $(Droptables.container).handsontable('render');
                                parseCss();
                                saveChanges();
                            } else {
                                bootbox.alert(data);
                            }
                            $(Droptables.container).handsontable('render');
                        });
                    }
                })
            } else {
                $.ajax({
                    url: "index.php?option=com_droptables&view=style&format=json&id=" + id,
                    type: 'POST',
					dataType: "json"
                }).done(function(data) {
                    if (typeof (data) === 'object') {
                        cellsData = $(Droptables.container).handsontable('getData');
                        var ret = true;
                        nbCols = 0;
                        nbRows = cellsData.length;                       
                        if (ret === true) {
                            datas = $.parseJSON(data.data);
                            $(Droptables.container).handsontable('loadData', datas);
                        }
                        //backup old style
                        var oldStyle = JSON.parse(JSON.stringify(Droptables.style));

                        //Apply cols and row style to cells
                        style = $.parseJSON(data.style);
                        $('#jform_css').val(data.css);
                        $('#jform_css').change();
                        Droptables.style = {table: style.table, rows: {}, cols: {}, cells: style.cells};
                        $.each(datas, function(row, rValue) {
                            $.each(rValue, function(col, cValue) {
                                if (typeof (Droptables.style.cells[row + '!' + col]) === 'undefined') {
                                    Droptables.style.cells[row + '!' + col] = [row, col, {}];
                                }
                                if (typeof (style.cols[col]) !== 'undefined' && Object.keys(style.cols[col][1]).length !== 0) {
                                    for (attr in style.cols[col][1]) {
                                        if (typeof (Droptables.style.cells[row + '!' + col][2][attr]) === 'undefined') {
                                            Droptables.style.cells[row + '!' + col][2][attr] = style.cols[col][1][attr];
                                        }
                                    }
                                }
                                if (typeof (style.rows[row]) !== 'undefined' && Object.keys(style.rows[row][1]).length !== 0) {
                                    for (attr in style.rows[row][1]) {
                                        if (typeof (Droptables.style.cells[row + '!' + col][2][attr]) === 'undefined') {
                                            Droptables.style.cells[row + '!' + col][2][attr] = style.rows[row][1][attr];
                                        }
                                    }

                                }
                            });
                        });

                        //re-apply responsive parameters           
                        if(typeof oldStyle.table.responsive_type != "undefined") {
                            Droptables.style.table.responsive_type = oldStyle.table.responsive_type;
                        }
                        for (col in style.cols) {            
                                 colIndex = style.cols[col][0];                            
                                 if (typeof oldStyle.cols[colIndex]!== "undefined" && typeof oldStyle.cols[colIndex][1]["res_priority"] !== "undefined") {
                                     if(typeof Droptables.style.cols[colIndex] == "undefined") {
                                         Droptables.style.cols[colIndex] = [colIndex, {}];                                             
                                     }
                                     Droptables.style.cols[colIndex][1]["res_priority"] = oldStyle.cols[colIndex][1]["res_priority"];
                                 }
                        }

                        //If no content we can set our own cols and rows size
                        if (ret === true) {
                            for (row in style.rows) {
                                if (typeof (style.rows[row]) !== 'undefined' && (typeof (style.rows[row][1].height) !== 'undefined')) {
                                    if (typeof (Droptables.style.rows[style.rows[row][0]]) === 'undefined') {
                                        Droptables.style.rows[style.rows[row][0]] = [row, {}];
                                    }
                                    Droptables.style.rows[style.rows[row][0]][1].height = style.rows[row][1].height;
                                }
                            }
                            for (col in style.cols) {
                                if (typeof (style.cols[col]) !== 'undefined' && (typeof (style.cols[col][1].width) !== 'undefined')) {
                                    if (typeof (Droptables.style.cols[style.cols[col][0]]) === 'undefined') {
                                        Droptables.style.cols[style.cols[col][0]] = [col, {}];
                                    }
                                    Droptables.style.cols[style.cols[col][0]][1].width = style.cols[col][1].width;
                                }
                            }
                            pullDims();
                        }
                        $(Droptables.container).handsontable('render');
                        parseCss();
                        saveChanges();
                    } else {
                        bootbox.alert(data);
                    }
                    $(Droptables.container).handsontable('render');
                });
            }
                        
            return false;
        });
    })();

    (initObserver = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        
        $('.observeChangesCol').on('change click', function(e) {
           
             switch ($(this).attr('name')) {
                    case 'jform[jform_responsive_col]':
                     //populate jform_responsive_priority    
                        var col = $(this).val();
                        if (typeof (Droptables.style.cols) !== 'undefined' && typeof (Droptables.style.cols[col]) !== 'undefined' && typeof (Droptables.style.cols[col][1]) !== 'undefined' && typeof (Droptables.style.cols[col][1].res_priority) !== 'undefined') {
                            res_priority = Droptables.style.cols[col][1].res_priority;                              
                            $('#jform_responsive_priority').val(res_priority);   
                            $('#jform_responsive_priority').trigger('liszt:updated');
                        }else {
                            $('#jform_responsive_priority').val(0);   
                            $('#jform_responsive_priority').trigger('liszt:updated');
                        }
                    break;
            }
        });
        
        $('.observeChanges').on('change click', function(e) {
            if (isSelectionProcess === true) {
                return;
            }
            selection = $(Droptables.container).handsontable('getSelected');
            if (!selection) {
                return;
            }
            if (selection[0] > selection[2]) {
                selection = [selection[2], selection[3], selection[0], selection[1]];
            }

            //for undo                         
            var oldStyle = JSON.parse(JSON.stringify(Droptables.style));
            //for mergecells
            var ht = Droptables.container.handsontable('getInstance');

            switch ($(this).attr('name')) {
                case 'jform[alternate_row_even_color]':
                    Droptables.style.table.alternate_row_even_color = $(this).val();
                    break;
                case 'jform[alternate_row_odd_color]':
                    Droptables.style.table.alternate_row_odd_color = $(this).val();
                    break;
                case 'jform[jform_use_sortable]':
                    Droptables.style.table.use_sortable = $(this).val();
                    break;  
                case 'jform[jform_enable_filters]':
                    Droptables.style.table.enable_filters = $(this).val();
                    break;
                case 'jform[jform_table_align]':
                    Droptables.style.table.table_align = $(this).val();
                    break;
                case 'jform[jform_responsive_type]':
                    Droptables.style.table.responsive_type = $(this).val();
                    break;
                case 'freeze_row':
                    Droptables.style.table.freeze_row = $(this).val();
                    if(Droptables.style.table.freeze_row=="0") {
                        Droptables.style.table.table_height = "";
                        $("#jform_table_height").val("");
                        $("#table_height_container").hide();
                    }else {
                        $("#table_height_container").show();
                    }
                    break;
                 case 'freeze_col':
                    Droptables.style.table.freeze_col = $(this).val();
                    break;
                case 'jform[table_height]':
                    Droptables.style.table.table_height = $(this).val();
                    break;
                case 'jform[jform_spreadsheet_url]':
                    Droptables.style.table.spreadsheet_url = $(this).val();
                    break;
                case 'auto_sync':
                    Droptables.style.table.auto_sync = $(this).val();
                    $(".droptables_warning").remove();                                                  
                    if(typeof Droptables.style.table.spreadsheet_url != 'undefined' &&  Droptables.style.table.spreadsheet_url != "" && typeof Droptables.style.table.auto_sync != 'undefined' &&  Droptables.style.table.auto_sync != "0") {                       
                        $('h3#tableTitle').after('<div class="droptables_warning"><p>'+ Joomla.JText._('COM_DROPTABLES_NOTICE_MSG_TABLE_SYNCABLE', 'This spreadsheet is currently sync with an external file, you may lose content in case of modification') +'</p></div>');
                    }              
                    break;       
                case 'jform[jform_responsive_priority]':                          
                    var col = $('#jform_responsive_col').val();                    
                    Droptables.style.cols = fillArray(Droptables.style.cols, {res_priority: $('#jform_responsive_priority').val()}, col);                   
                    break;
                    
                case 'jform[jform_cell_type]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            if ($(this).val() === '') {
                                Droptables.style.cells = fillArray(Droptables.style.cells, {cell_type: null}, ij, ik);
                            } else {
                                Droptables.style.cells = fillArray(Droptables.style.cells, {cell_type: $(this).val()}, ij, ik);
                            }
                        }
                    }
                    break;
                case 'jform[jform_cell_background_color]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            if ($(this).val() === '') {
                                Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_color: null}, ij, ik);
                            } else {
                                Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_color: $(this).val()}, ij, ik);
                            }
                        }
                    }
                    break;
                case 'jform[jform_cell_border_top]':
                    for (ik = selection[1]; ik <= selection[3]; ik++) {
                        if ($('#jform_cell_border_width').val()) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_top: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], ik);
                        } else {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_top: null});
                        }
                    }
                    break;
                case 'jform[jform_cell_border_right]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        if ($('#jform_cell_border_width').val()) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, ij, selection[3]);
                        } else {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: null});
                        }
                    }

                    //check if selection[0], selection[1] is merged cell then fill cell_border_right                           
                    var info = ht.mergeCells.mergedCellInfoCollection.getInfo(selection[0], selection[1]);
                    if (info) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                    }

                    break;
                case 'jform[jform_cell_border_bottom]':
                    for (ik = selection[1]; ik <= selection[3]; ik++) {
                        if ($('#jform_cell_border_width').val()) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[2], ik);
                        } else {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: null});
                        }
                    }

                    //check if selection[0], selection[1] is merged cell then fill cell_border_bottom                           
                    var info = ht.mergeCells.mergedCellInfoCollection.getInfo(selection[0], selection[1]);
                    if (info) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                    }
                    break;
                case 'jform[jform_cell_border_left]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        if ($('#jform_cell_border_width').val()) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, ij, selection[1]);
                        } else {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: null});
                        }
                    }
                    break;
                case 'jform[jform_cell_border_all]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            if ($('#jform_cell_border_width').val()) {
                                val = $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val();
                            } else {
                                val = null;
                            }
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: val, cell_border_top: val, cell_border_right: val, cell_border_bottom: val}, ij, ik);
                        }
                    }
                    //check if selection[0], selection[1] is merged cell then fill cell_border_bottom, cell_border_right                              
                    var info = ht.mergeCells.mergedCellInfoCollection.getInfo(selection[0], selection[1]);
                    if (info) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                    }
                    break;
                case 'jform[jform_cell_border_inside]':
                    if ($('#jform_cell_border_width').val()) {
                        val = $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val();
                    } else {
                        val = null;
                    }
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1] + 1; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: val}, ij, ik);
                        }
                    }
                    for (ij = selection[0]; ij < selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: val}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_border_outline]':
                    if ($('#jform_cell_border_width').val()) {
                        val = $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val();
                    } else {
                        val = null;
                    }

                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: val}, ij, selection[1]);
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: val}, ij, selection[3]);

                    }
                    for (ik = selection[1]; ik <= selection[3]; ik++) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_top: val}, selection[0], ik);
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: val}, selection[2], ik);
                    }
                    //check if selection[0], selection[1] is merged cell then fill cell_border_bottom, cell_border_right                           
                    var info = ht.mergeCells.mergedCellInfoCollection.getInfo(selection[0], selection[1]);
                    if (info) {
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_right: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                        Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val()}, selection[0], selection[1]);
                    }
                    break;
                case 'jform[jform_cell_border_vertical]':
                    if ($('#jform_cell_border_width').val()) {
                        val = $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val();
                    } else {
                        val = null;
                    }
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1] + 1; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: val}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_border_horizontal]':
                    if ($('#jform_cell_border_width').val()) {
                        val = $('#jform_cell_border_width').val() + "px " + $('#jform_cell_border_type').val() + " " + $('#jform_cell_border_color').val();
                    } else {
                        val = null;
                    }
                    for (ij = selection[0]; ij < selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_bottom: val}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_border_remove]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_border_left: null, cell_border_top: null, cell_border_right: null, cell_border_bottom: null}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_font_size]':
                case 'jform[jform_cell_font_family]':
                case 'jform[jform_cell_font_color]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_font_family: $('#jform_cell_font_family').val(), cell_font_size: $('#jform_cell_font_size').val(), cell_font_color: $('#jform_cell_font_color').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_font_bold]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = toggleArray(Droptables.style.cells, {cell_font_bold: true}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_font_italic]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = toggleArray(Droptables.style.cells, {cell_font_italic: true}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_font_underline]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = toggleArray(Droptables.style.cells, {cell_font_underline: true}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_align_left]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_text_align: 'left'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_align_right]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_text_align: 'right'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_align_center]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_text_align: 'center'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_align_justify]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_text_align: 'justify'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_vertical_align_middle]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_vertical_align: 'middle'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_vertical_align_bottom]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_vertical_align: 'bottom'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_vertical_align_top]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_vertical_align: 'top'}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_padding_left]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_padding_left: $('#jform_cell_padding_left').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_padding_top]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_padding_top: $('#jform_cell_padding_top').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_padding_right]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_padding_right: $('#jform_cell_padding_right').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_padding_bottom]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_padding_bottom: $('#jform_cell_padding_bottom').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_background_radius_left_top]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_radius_left_top: $('#jform_cell_background_radius_left_top').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_background_radius_right_top]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_radius_right_top: $('#jform_cell_background_radius_right_top').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_background_radius_right_bottom]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_radius_right_bottom: $('#jform_cell_background_radius_right_bottom').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_cell_background_radius_left_bottom]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {cell_background_radius_left_bottom: $('#jform_cell_background_radius_left_bottom').val()}, ij, ik);
                        }
                    }
                    break;
                case 'jform[jform_row_height]':
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        Droptables.style.rows = fillArray(Droptables.style.rows, {height: $('#jform_row_height').val()}, ij);
                    }
                    pullDims();
                    break;
                case 'jform[jform_col_width]':
                    for (ij = selection[1]; ij <= selection[3]; ij++) {
                        Droptables.style.cols = fillArray(Droptables.style.cols, {width: $('#jform_col_width').val()}, ij);
                    }
                    pullDims();
                    break;
                    
                case 'jform[jform_tooltip_width]':                     
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {tooltip_width: $('#jform_tooltip_width').val()}, ij, ik);                  
                        }
                    } 
                    break;
                case 'tooltip_content':                    
                    for (ij = selection[0]; ij <= selection[2]; ij++) {
                        for (ik = selection[1]; ik <= selection[3]; ik++) {
                            Droptables.style.cells = fillArray(Droptables.style.cells, {tooltip_content: $('#tooltip_content').val()}, ij, ik);                  
                        }
                    }
                 
                    break;
            }
            
            if(e.type=="change" && ($(this).attr('name')=='freeze_row' || $(this).attr('name')=='freeze_col') ) {
                
                var ht = $(Droptables.container).handsontable('getInstance');
                var htContents =  ht.getData();
                var selection = $(Droptables.container).handsontable('getSelected');
                $('#tableContainer').handsontable('destroy');
                initHandsontable(htContents);
                $(Droptables.container).handsontable('render');                
                $(Droptables.container).handsontable("selectCell", selection[0], selection[1], selection[2], selection[3]);
                $('#rightcol .referTable a').trigger('click');
            }else{
                $(Droptables.container).handsontable('render');
            }
            
            saveChanges();

            //undo                       
            var ht = $(Droptables.container).handsontable('getInstance');
            
            if (JSON.stringify(Droptables.style) != JSON.stringify(oldStyle)) {
                ht.runHooks('afterChangeStyle', true, oldStyle);
            }
        });
    })();

    (initCssObserver = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        var cssChangeWait;
        $('#jform_css').bind('input propertychange', function() {
            clearTimeout(cssChangeWait);
            cssChangeWait = setTimeout(function() {
                parseCss();
                saveChanges();
            }, 1000);
        });
    })();

    parseCss = function() {
        var parser = new (less.Parser);
        content = '#preview .handsontable .ht_master .wtHider .wtSpreader .htCore tbody {' + $('#jform_css').val() + '}';
        content += '.reset {background-color: rgb(238, 238, 238);border-bottom-color: rgb(204, 204, 204);border-bottom-style: solid;border-bottom-width: 1px;border-collapse: collapse;border-left-color: rgb(204, 204, 204);border-left-style: solid;border-left-width: 1px;border-right-color: rgb(204, 204, 204);border-right-style: solid;border-right-width: 1px;border-top-color: rgb(204, 204, 204);border-top-style: solid;border-top-width: 1px;box-sizing: content-box;color: rgb(34, 34, 34);display: table-cell;empty-cells: show;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: 13px;font-weight: normal;line-height: 21px;outline-width: 0px;overflow-x: hidden;overflow-y: hidden;padding-bottom: 0px;padding-left: 4px;padding-right: 4px;padding-top: 0px;text-align: center;vertical-align: top;white-space: nowrap;position: relative;}';
        content += '#preview .handsontable .ht_master .wtHider .wtSpreader .htCore tbody tr th {.reset() !important;}'
        parser.parse(content, function(err, tree) {
            if (err) {
                //Here we can throw the erro to the user
                return false;
            } else {
                Droptables.css = $('#jform_css').val();
                if ($('#headCss').length === 0) {
                    $('head').append('<style id="headCss"></style>');
                }
                $('#headCss').text(tree.toCSS());
                return true;
            }
        });
    };

    function pullDims() {
        cols = [];
        rows = [];
        for (row in Droptables.style.rows) {
            if (typeof (Droptables.style.rows[row]) !== 'undefined' && (typeof (Droptables.style.rows[row][1].height) !== 'undefined')) {
                rows[row] = Droptables.style.rows[row][1].height;
            } else {
                rows[row] = null;
            }
        }
        for (col in Droptables.style.cols) {
            if (typeof (Droptables.style.cols[col]) !== 'undefined' && (typeof (Droptables.style.cols[col][1].width) !== 'undefined')) {
                cols[col] = Droptables.style.cols[col][1].width;
            } else {
                cols[col] = null;
            }
        }
        $(Droptables.container).handsontable('updateSettings', {colWidths: cols, rowHeights: rows});
    }

    function pushDims() {
        rows = $(Droptables.container).handsontable('countRows');
        tableHeight = 0;
        for (var ij = 0; ij < rows; ij++) {
            var h = $('#tableContainer').handsontable('getRowHeight', ij);
            if (!h) {
                if (typeof (Droptables.style.rows[ij]) !== 'undefined' && (typeof (Droptables.style.rows[ij][1].height) !== 'undefined')) {
                    h = parseInt(Droptables.style.rows[ij][1].height);
                } else {
                    h = null;
                }
            }
            if (!h) {
                h = 22;
            }
            rowHeight = h;
            tableHeight += parseInt(rowHeight);
            Droptables.style.rows = fillArray(Droptables.style.rows, {height: parseInt(rowHeight)}, ij);
        }

        cols = $(Droptables.container).handsontable('countCols');
        tableWidth = 0;
        for (var ij = 0; ij < cols; ij++) {
            colWidth = $('#preview .handsontable .ht_master .htCore colgroup col:nth-child(' + parseInt(ij + 2) + ')').outerWidth();
            tableWidth += parseInt(colWidth);
            Droptables.style.cols = fillArray(Droptables.style.cols, {width: parseInt(colWidth)}, ij);
        }
        Droptables.style.table.width = tableWidth;

        configHeight = parseInt(Droptables.style.table.table_height);
        if(configHeight > 0 && tableHeight> configHeight) {
            tableHeight = configHeight;
        }else {
            var offset = $('#tableContainer').offset();            
            availableHeight = $(window).height() - offset.top + $(window).scrollTop() - 150 ;//- (getUrlVar('caninsert') && 50);             
            if(tableHeight > availableHeight) {
                tableHeight = availableHeight;
            }
        }
        
        $('#tableContainer').height(tableHeight + 100).trigger('resize');        
        $(window).scrollTop($(window).scrollTop()-1); //trigger window scroll event
    }

    var customRenderer = function(instance, td, row, col, prop, value, cellProperties) {
        css = {};
        celltype = '';

        if (typeof (Droptables.style.cells) !== 'undefined') {
            //table rendering
            if ((row % 2) && typeof (Droptables.style.table.alternate_row_odd_color) !== 'undefined' && Droptables.style.table.alternate_row_odd_color) {
                css["background-color"] = Droptables.style.table.alternate_row_odd_color;
            }
            if (!(row % 2) && typeof (Droptables.style.table.alternate_row_even_color) !== 'undefined' && Droptables.style.table.alternate_row_even_color) {
                css["background-color"] = Droptables.style.table.alternate_row_even_color;
            }

            //Cells rendering
            if (typeof (Droptables.style.cells[row + "!" + col]) !== 'undefined') {
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_type) !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_type !== '') {
                    celltype = Droptables.style.cells[row + "!" + col][2].cell_type;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_background_color) !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_background_color !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_background_color !== null) {
                    css["background-color"] = Droptables.style.cells[row + "!" + col][2].cell_background_color;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_border_top) !== 'undefined') {
                    css["border-top"] = Droptables.style.cells[row + "!" + col][2].cell_border_top;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_border_right) !== 'undefined') {
                    css["border-right"] = Droptables.style.cells[row + "!" + col][2].cell_border_right;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_border_bottom) !== 'undefined') {
                    css["border-bottom"] = Droptables.style.cells[row + "!" + col][2].cell_border_bottom;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_border_left) !== 'undefined') {
                    css["border-left"] = Droptables.style.cells[row + "!" + col][2].cell_border_left;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_bold) !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_font_bold === true) {
                    css["font-weight"] = "bold";
                } else {
                    delete css["font-weight"];
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_italic) !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_font_italic === true) {
                    css["font-style"] = "italic";
                } else {
                    delete css["font-style"];
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_underline) !== 'undefined' && Droptables.style.cells[row + "!" + col][2].cell_font_underline === true) {
                    css["text-decoration"] = "underline";
                } else {
                    delete css["text-decoration"];
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_text_align) !== 'undefined') {
                    css["text-align"] = Droptables.style.cells[row + "!" + col][2].cell_text_align;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_vertical_align) !== 'undefined') {
                    css["vertical-align"] = Droptables.style.cells[row + "!" + col][2].cell_vertical_align;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_family) !== 'undefined') {
                    css["font-family"] = Droptables.style.cells[row + "!" + col][2].cell_font_family;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_size) !== 'undefined') {
                    css["font-size"] = Droptables.style.cells[row + "!" + col][2].cell_font_size + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_font_color) !== 'undefined') {
                    css["color"] = Droptables.style.cells[row + "!" + col][2].cell_font_color;
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_padding_left) !== 'undefined') {
                    css["padding-left"] = Droptables.style.cells[row + "!" + col][2].cell_padding_left + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_padding_top) !== 'undefined') {
                    css["padding-top"] = Droptables.style.cells[row + "!" + col][2].cell_padding_top + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_padding_right) !== 'undefined') {
                    css["padding-right"] = Droptables.style.cells[row + "!" + col][2].cell_padding_right + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_padding_bottom) !== 'undefined') {
                    css["padding-bottom"] = Droptables.style.cells[row + "!" + col][2].cell_padding_bottom + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_background_radius_left_top) !== 'undefined') {
                    css["border-top-left-radius"] = Droptables.style.cells[row + "!" + col][2].cell_background_radius_left_top + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_background_radius_right_top) !== 'undefined') {
                    css["border-top-right-radius"] = Droptables.style.cells[row + "!" + col][2].cell_background_radius_right_top + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_background_radius_right_bottom) !== 'undefined') {
                    css["border-bottom-right-radius"] = Droptables.style.cells[row + "!" + col][2].cell_background_radius_right_bottom + "px";
                }
                if (typeof (Droptables.style.cells[row + "!" + col][2].cell_background_radius_left_bottom) !== 'undefined') {
                    css["border-bottom-left-radius"] = Droptables.style.cells[row + "!" + col][2].cell_background_radius_left_bottom + "px";
                }
            }
            //$(td).css(css);
            if (Object.keys(css).length > 0) {
                styleToRender += '.dtr' + row + '.dtc' + col + '{';
                $.each(css, function(index, value) {
                    styleToRender += index + ':' + value + ';';
                });
                styleToRender += '}';
            }
        }

        switch (celltype) {
            case 'html':
                var escaped = Handsontable.helper.stringify(value);
                //escaped = strip_tags(escaped, '<div><span><img><em><b><a>'); //be sure you only allow certain HTML tags to avoid XSS threats (you should also remove unwanted HTML attributes)
                td.innerHTML = replace_all_rel_by_abs(escaped);
                $(td).addClass('isHtmlCell');
                break;
            default:
                $(td).removeClass('isHtmlCell');
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                break;
        }

        /* Calculs rendering */
        if (typeof (value) === 'string' && value[0] === '=') {
            var error = false;
            var regex = new RegExp('^=(SUM|COUNT|MIN|MAX|AVG|CONCAT|sum|count|min|max|avg|concat)\\((.*?)\\)$');
            result = regex.exec(value);
            if (result !== null) {
                var cells = result[2].split(";");
                var values = [];
                for (var ij = 0; ij < cells.length; ij++) {
                    var vals = cells[ij].split(":");
                    var regex2 = new RegExp('([a-zA-Z]+)([0-9]+)');
                    if (vals.length === 1) { //single cell
                        val1 = regex2.exec(vals[0]);
                        if (val1 !== null) {
                            var datas = $("#tableContainer").handsontable('getDataAtCell', val1[2] - 1, convertAlpha(val1[1]) - 1);
                            values.push(datas);
                        } else {
                            error = true;
                        }
                    } else { //range          
                        val1 = regex2.exec(vals[0]);
                        val2 = regex2.exec(vals[1]);
                        if (val1 !== null && val2 !== null) {
                            rCells = $("#tableContainer").handsontable('getData', val1[2] - 1, convertAlpha(val1[1]) - 1, val2[2] - 1, convertAlpha(val2[1]) - 1);
                            for (var il = 0; il < rCells.length; il++) {
                                for (var ik = 0; ik < rCells[il].length; ik++) {
                                    values.push(rCells[il][ik]);
                                }
                            }
                        } else {
                            error = true;
                        }
                    }
                }
                if (error === false) {
                    var resultCalc;
                    switch (result[1].toUpperCase()) {
                        case 'SUM':
                            resultCalc = 0;
                            values.map(function(foo) {
                                v = Number(foo);
                                if (!isNaN(v)) {
                                    resultCalc = resultCalc + v;
                                }
                            });
                            break;
                        case 'COUNT':
                            resultCalc = 0;
                            values.map(function(foo) {
                                v = Number(foo);
                                if (!isNaN(v) && foo !== '') {
                                    resultCalc = resultCalc + 1;
                                }
                            });
                            break;
                        case 'MIN':
                            resultCalc = null;
                            values.map(function(foo) {
                                v = Number(foo);
                                if (!isNaN(v) && foo !== '') {
                                    if (resultCalc === null || resultCalc > v) {
                                        resultCalc = v;
                                    }
                                }
                            });
                            break;
                        case 'MAX':
                            resultCalc = null;
                            values.map(function(foo) {
                                v = Number(foo);
                                if (!isNaN(v)) {
                                    if (resultCalc === null || resultCalc < v) {
                                        resultCalc = v;
                                    }
                                }
                            });
                            break;
                        case 'AVG':
                            resultCalc = 0;
                            var n = 0;
                            values.map(function(foo) {
                                v = Number(foo);
                                if (!isNaN(v) && foo !== '') {
                                    resultCalc = resultCalc + v;
                                    n++;
                                }
                            });
                            if (n > 0) {
                                resultCalc = resultCalc / n;
                            }
                            break;
                        case 'CONCAT':
                            resultCalc = '';
                            values.map(function(foo) {
                                resultCalc = resultCalc + foo;
                            });
                            break;
                    }
                }
            }
            if (error === false) {
                $(td).text(resultCalc);
            }
        }

        $(td).addClass('dtr' + row + ' dtc' + col);

        return td;
    };

    (loadSelection = function() {
        selection = $(Droptables.container).handsontable('getSelected');
        if (!selection || (typeof (Droptables.style) == 'undefined') ) {
            return;
        }
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.alternate_row_odd_color) !== 'undefined' && Droptables.style.table.alternate_row_odd_color) {
            $('#jform_alternate_row_odd_color').minicolors('value', Droptables.style.table.alternate_row_odd_color);
        }
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.alternate_row_even_color) !== 'undefined' && Droptables.style.table.alternate_row_even_color) {
            $('#jform_alternate_row_even_color').minicolors('value', Droptables.style.table.alternate_row_even_color);
        }
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.use_sortable) !== 'undefined') {
            $('#jform_use_sortable').val(Droptables.style.table.use_sortable);
        }
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.enable_filters) !== 'undefined') {
            $('#jform_enable_filters').val(Droptables.style.table.enable_filters);
        }else {
            $('#jform_enable_filters').val("0");
        }
        $('#jform_enable_filters').trigger('liszt:updated'); 
         
        if (typeof (Droptables.style) !== 'undefined' && typeof (Droptables.style.table) !== 'undefined' ) {
            if ( typeof (Droptables.style.table.spreadsheet_url) !== 'undefined') {
                $('#jform_spreadsheet_url').val(Droptables.style.table.spreadsheet_url );
            }else {
                $('#jform_spreadsheet_url').val( "");
            }
            if ( typeof (Droptables.style.table.auto_sync) !== 'undefined') {
                $('#jform_auto_sync').val(Droptables.style.table.auto_sync );
            }else {
                $('#jform_auto_sync').val( "0");
            }
            $('#jform_auto_sync').trigger('liszt:updated');
            
        }else {
            $('#jform_spreadsheet_url').val( "");
            $('#jform_auto_sync').val( "0");
        }
        
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.freeze_row) !== 'undefined') {
            $('#jform_freeze_row').val(  Droptables.style.table.freeze_row );          
            if(Droptables.style.table.freeze_row && Droptables.style.table.freeze_row !="0") {
                        if(typeof(Droptables.style.table.table_height) !== "undefined" && Droptables.style.table.table_height) {
                            $('#jform_table_height').val(  Droptables.style.table.table_height );                    
                        }else {
                            Droptables.style.table.table_height = 500;
                            $('#jform_table_height').val('500');
                        }
                        $("#table_height_container").show();
                    }else {
                        $('#jform_table_height').val( "");
                        $("#table_height_container").hide();
                    }
        } else {
                    $('#jform_freeze_row').val( "0");
                    $('#jform_table_height').val( "");
                    $("#table_height_container").hide();
        }
        $('#jform_freeze_row').trigger('liszt:updated');
        
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.freeze_col) !== 'undefined') {
                    $('#jform_freeze_col').val(Droptables.style.table.freeze_col );
        }else {
            $('#jform_freeze_col').val( "0");
        }
        $('#jform_freeze_col').trigger('liszt:updated');
        
        if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.table_align) !== 'undefined') {
            $('#jform_table_align').val(Droptables.style.table.table_align);
        }
        if (typeof (Droptables.style.cells) !== 'undefined') {
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_type) !== 'undefined' && Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_type !== '') {
                $('#jform_cell_type').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_type);
            } else {
                $('#jform_cell_type').val('');
            }
            $('#jform_cell_type').trigger('liszt:updated');

            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_color) !== 'undefined') {
                $('#jform_cell_background_color').minicolors('value', Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_color);
            } else {
                $('#jform_cell_background_color').minicolors('value', '');
            }

            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_size) !== 'undefined') {
                $('#jform_cell_font_size').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_size);
            } else {
                $('#jform_cell_font_size').val(13);
            }

            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_color) !== 'undefined') {
                $('#jform_cell_font_color').minicolors('value', Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_color);
            } else {
                $('#jform_cell_font_color').minicolors('value', '');
            }

            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_family) !== 'undefined' && Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_family !== '') {
                $('#jform_cell_font_family').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_font_family);
            } else {
                $('#jform_cell_font_family').val('Arial');
            }
            $('#jform_cell_font_family').trigger('liszt:updated');

            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_left) !== 'undefined') {
                $('#jform_cell_padding_left').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_left);
            } else {
                $('#jform_cell_padding_left').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_top) !== 'undefined') {
                $('#jform_cell_padding_top').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_top);
            } else {
                $('#jform_cell_padding_top').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_right) !== 'undefined') {
                $('#jform_cell_padding_right').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_right);
            } else {
                $('#jform_cell_padding_right').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_bottom) !== 'undefined') {
                $('#jform_cell_padding_bottom').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_padding_bottom);
            } else {
                $('#jform_cell_padding_bottom').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_left_top) !== 'undefined') {
                $('#jform_cell_background_radius_left_top').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_left_top);
            } else {
                $('#jform_cell_background_radius_left_top').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_right_top) !== 'undefined') {
                $('#jform_cell_background_radius_right_top').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_right_top);
            } else {
                $('#jform_cell_background_radius_right_top').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_right_bottom) !== 'undefined') {
                $('#jform_cell_background_radius_right_bottom').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_right_bottom);
            } else {
                $('#jform_cell_background_radius_right_bottom').val(0);
            }
            if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_left_bottom) !== 'undefined') {
                $('#jform_cell_background_radius_left_bottom').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].cell_background_radius_left_bottom);
            } else {
                $('#jform_cell_background_radius_left_bottom').val(0);
            }
            if (typeof (Droptables.style.rows[selection[0]]) !== 'undefined' && typeof (Droptables.style.rows[selection[0]][1].height) !== 'undefined') {
                $('#jform_row_height').val(Droptables.style.rows[selection[0]][1].height);
            }
            if (typeof (Droptables.style.cols[selection[0]]) !== 'undefined' && typeof (Droptables.style.cols[selection[0]][1].width) !== 'undefined') {
                $('#jform_col_width').val(Droptables.style.cols[selection[0]][1].width);
            }
            
            if( $('#tooltip_content').length > 0) {                
                if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].tooltip_width) !== 'undefined') {
                    $('#jform_tooltip_width').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].tooltip_width);
                } else {
                    $('#jform_tooltip_width').val(0);
                }
               
               
                if (typeof (Droptables.style.cells[selection[0] + "!" + selection[1]]) !== 'undefined' && typeof (Droptables.style.cells[selection[0] + "!" + selection[1]][2].tooltip_content) !== 'undefined') {              
                    $('#tooltip_content').val(Droptables.style.cells[selection[0] + "!" + selection[1]][2].tooltip_content);                 
                } else {
                    $('#tooltip_content').val("");                 
                }
                
                var contenNeedToset = $('#tooltip_content').val();
                if (typeof (CKEDITOR.instances.tooltip_content) === 'undefined') {
                    CKEDITOR.replace('tooltip_content');
                    CKEDITOR.instances.tooltip_content.on('instanceReady', function() {
                        CKEDITOR.instances.tooltip_content.focus();
                        var range = CKEDITOR.instances.tooltip_content.createRange();
                        range.moveToElementEditEnd(range.root);
                        CKEDITOR.instances.tooltip_content.getSelection().selectRanges([range]);   
                        
                         $("#cke_tooltip_content .cke_top.cke_reset_all").after($("#tooltip_content-xtd-buttons") );
                        $("#tooltip_content-xtd-buttons").show();
                    });                                                       
                }
                CKEDITOR.instances.tooltip_content.setData(contenNeedToset);
            }                   
            
              //populate jform_responsive_type    
            if (typeof (Droptables.style.table) !== 'undefined' && typeof (Droptables.style.table.responsive_type) !== 'undefined') {
                $('#jform_responsive_type').val(Droptables.style.table.responsive_type);
            }
            $('#jform_responsive_type').trigger('liszt:updated'); 
            
             //populate jform_responsive_col    
            $("#jform_responsive_col").html("");
            for (col in Droptables.style.cols) {                  
                  $("#jform_responsive_col").append('<option value="'+col+'">'+ Handsontable.helper.spreadsheetColumnLabel(parseInt(col)) +'</option>');
            }
                        
            $('#jform_responsive_col').trigger('liszt:updated');  
            
              //populate jform_responsive_priority 
              $("#jform_responsive_priority").html("");
              for (col in Droptables.style.cols) {                  
                  $("#jform_responsive_priority").append('<option value="'+col+'">'+ col +'</option>');
             }
              $("#jform_responsive_priority").append('<option value="persistent">Persistent</option>');
              
              var col = 0;
              if (typeof (Droptables.style.cols) !== 'undefined' && typeof (Droptables.style.cols[col]) !== 'undefined' && typeof (Droptables.style.cols[col][1]) !== 'undefined' && typeof (Droptables.style.cols[col][1].res_priority) !== 'undefined') {
                    res_priority = Droptables.style.cols[col][1].res_priority;                     
                    $('#jform_responsive_priority').val(res_priority);                    
              }     
              $('#jform_responsive_priority').trigger('liszt:updated');
        
        } 
    });

    $('#cell_border_width_incr').click(function() {
        $('#jform_cell_border_width').val((parseInt($('#jform_cell_border_width').val() || 0)) + 1);
    });
    $('#cell_border_width_decr').click(function() {
        if ($('#jform_cell_border_width').val() === '0')
            return;
        $('#jform_cell_border_width').val(Math.abs(parseInt($('#jform_cell_border_width').val() || 1) - 1));
    });

    $('#cell_font_size_incr').click(function() {
        $('#jform_cell_font_size').val((parseInt($('#jform_cell_font_size').val() || 0)) + 1).trigger('change');
    });
    $('#cell_font_size_decr').click(function() {
        if ($('#jform_cell_font_size').val() === '0')
            return;
        $('#jform_cell_font_size').val(Math.abs(parseInt($('#jform_cell_font_size').val() || 1) - 1)).trigger('change');
    });

    function loading(e) {
        $(e).addClass('dploadingcontainer');
        $(e).append('<div class="dploading"></div>');
    }
    function rloading(e) {
        $(e).removeClass('dploadingcontainer');
        $(e).find('div.dploading').remove();
    }

    function cleanStyle(style, nbRows, nbCols) {
        for (col in style.cols) {
            if (style.cols[col][0] >= nbCols) {
                delete style.cols[col];
            }
        }
        for (row in style.rows) {
            if (style.rows[row][0] >= nbRows) {
                delete style.rows[row];
            }
        }
        for (cell in style.cells) {
            if (style.cells[cell][0] >= nbRows || style.cells[cell][1] >= nbCols) {
                delete style.cells[cell];
            }
        }
        for (obj in style) {
            for (cell in style[obj]) {
                propertiesPos = style[obj][cell].length - 1;
                for (property in style[obj][cell][propertiesPos]) {
                    if (style[obj][cell][propertiesPos][property] === null) {
                        delete style[obj][cell][propertiesPos][property];
                    }
                }
            }
        }
        return style;
    }

    var CustomEditor = Handsontable.editors.TextEditor.prototype.extend();

    CustomEditor.prototype.init = function() {
        //Call the original createElements method
        Handsontable.editors.TextEditor.prototype.init.apply(this, arguments);
    };

    CustomEditor.prototype.open = function() {
        $(this.TEXTAREA).attr('id', 'editor1');
        if (typeof (Droptables.style.cells[this.row + '!' + this.col]) !== 'undefined' && typeof (Droptables.style.cells[this.row + '!' + this.col][2].cell_type) !== 'undefined' && Droptables.style.cells[this.row + '!' + this.col][2].cell_type === 'html') {
            if (typeof (CKEDITOR.instances.editor1) === 'undefined') {
                CKEDITOR.replace('editor1');
                CKEDITOR.instances.editor1.on('instanceReady', function() {
                    CKEDITOR.instances.editor1.focus();
                    var range = CKEDITOR.instances.editor1.createRange();
                    range.moveToElementEditEnd(range.root);
                    CKEDITOR.instances.editor1.getSelection().selectRanges([range]);
                    $("#cke_editor1 .cke_top.cke_reset_all").after($("#droptable-xtd-buttons") );
                    $("#droptable-xtd-buttons").show();
                   
                });
            }
           
           
        } else {
            if (typeof (CKEDITOR.instances.editor1) !== 'undefined') {
                $("#droptable-xtdbuttons-container").append( $("#droptable-xtd-buttons") );            
                CKEDITOR.instances.editor1.destroy();             
            }
            $("#droptable-xtd-buttons").hide();
        }
        Handsontable.editors.TextEditor.prototype.open.apply(this, arguments);
    };

    CustomEditor.prototype.getValue = function() {
        if (typeof (CKEDITOR.instances.editor1) !== 'undefined') {
            return CKEDITOR.instances.editor1.getData();
        } else {
            return Handsontable.editors.TextEditor.prototype.getValue.apply(this, arguments);
        }
    };

    CustomEditor.prototype.setValue = function(newValue) {
        if (typeof (CKEDITOR.instances.editor1) !== 'undefined') {
            CKEDITOR.instances.editor1.focus();
            CKEDITOR.instances.editor1.setData(newValue);
        } else {
            return Handsontable.editors.TextEditor.prototype.setValue.apply(this, arguments);
        }
    };

    CustomEditor.prototype.close = function() {
        
        if (typeof (CKEDITOR.instances.editor1) !== 'undefined') {
            $("#droptable-xtdbuttons-container").append( $("#droptable-xtd-buttons") );
            $("#droptable-xtd-buttons").hide();
            CKEDITOR.instances.editor1.destroy();
        }
        return Handsontable.editors.TextEditor.prototype.close.apply(this, arguments);
    };

    //codemirror
    var myTextArea = document.getElementById("jform_css");
    var myCssEditor = CodeMirror.fromTextArea(myTextArea, {mode: "css", lineNumbers: true, theme: '3024-night'});
      var ww = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
     var wh = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;  
     if(window.parent) {
        var ww = window.parent.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var wh = window.parent.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;  
     }
     
     myCssEditor.setSize(ww*70/100, wh-250 );
    
    $('#customCssbtn').leanModal({ top : 100, closeButton: '#cancelCssbtn', modalShow: function(){myCssEditor.refresh(); myCssEditor.focus();  }  });
    $("#saveCssbtn").click(function(){ 
        myCssEditor.save();
        $(myTextArea).trigger("propertychange");
        //close leanModal
        $("#lean_overlay").fadeOut(200);
        $("#droptable_customCSS").css({"display":"none"})
    });
    
    $("a[href='#css']").on('shown.bs.tab', function(e) {
        myCssEditor.refresh();
    });

    $(myTextArea).on('change', function() {
        myCssEditor.setValue($(myTextArea).val());
    });

    myCssEditor.on("blur", function() {
        myCssEditor.save();
        $(myTextArea).trigger("propertychange");

    });
     
    $('#editToolTip').leanModal({ top : 100,closeButton: '#cancelToolTipbtn', modalShow: function(){ } });   
    $("#saveToolTipbtn").click(function(){ 
        newTooltipContent = CKEDITOR.instances.tooltip_content.getData();
      
        $("#tooltip_content").val(newTooltipContent); 
        $("#tooltip_content").trigger("change");  
           //close leanModal
         $("#lean_overlay").fadeOut(200);
         $("#droptables_editToolTip").css({"display":"none"})
    })
     
     
    //Import Excel
    //Init call back when file is uploaded successful
    Dropzone.options.procExcel = {
        maxFiles: 1,
        //acceptedFiles: 'xls,xlsx',
        init: function() {
            //Update form action
            this.on("addedfile", function(file) {
                var dotPos = file.name.lastIndexOf('.') + 1;
                var ext = file.name.substr(dotPos, file.name.length - dotPos);

                if (ext !== 'xls' && ext !== 'xlsx') {
                    bootbox.alert('Please choose a file with type of xls or xlsx.');
                    this.options.autoProcessQueue = false;
                    this.removeFile(file);
                    //return false;
                }
                else {
                    if (this.options.autoProcessQueue === false) {
                        this.options.autoProcessQueue = true;
                    }
                }

            });

            this.on("sending", function(file, xhr, formData) {
                //Add table id to formData
                var tableId = $('li.droptablestable.active').data('id-table');
                $("#jform_id_table").val(tableId);
                formData.append('id_table', tableId);
                
                if( $("#jform_import_style").val() ) {
                     formData.append('onlydata', 0);              
                }else {
                    formData.append('onlydata', 1);
                }
                // Show the total progress bar when upload starts
                //this.options.uploadprogress(file);
                $(".progress").show();
                $(".progress-bar-success").css('width', 30 + '%');
                $(".progress-bar-success").css('opacity', 1);
                // And disable the start button
                //file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            });

            this.on("success", function(file, responseText) {
                var tableId = $('li.droptablestable.active').data('id-table');
                  $(".progress").fadeOut(1000);
                //bootbox.alert(responseText);
                responseObj = JSON.parse(responseText);                
                if (responseObj.response === true) {
                     if(typeof responseObj.datas.too_large !== 'undefined') {
                       
                          bootbox.confirm(responseObj.datas.msg, function(result) {
                            
                            if (result === true) {
                                var jsonVar = {                                   
                                    id_table: responseObj.datas.id,
                                    onlydata:  responseObj.datas.onlydata,
                                    file: encodeURI(responseObj.datas.file),
                                    ignoreCheck: 1
                                };
                                $.ajax({
                                    url: "index.php?option=com_droptables&task=excel.import",
                                    dataType: "json",
                                    type: "POST",
                                    data: jsonVar,
                                    success: function(datas) {
                                         updatepreview(tableId, updateDimession);   
                                    }                              
                                })
                            }else {
                                //do nothing
                            }
                        });
                     }else {
                         updatepreview(tableId, updateDimession);      
                     }
                }              
                else {
                    bootbox.alert(responseObj.msg);
                }

            });

            this.on('complete', function(file) {
                this.removeFile(file);
                setTimeout(function() {
                    $(".progress-bar-success").css('width', 0);
                }, 6000);
            });
            // Update the total progress bar
            this.on("uploadprogress", function(file, progress) {
                $(".progress-bar-success").css('width', progress + "%");
            });
        }
    };

    //Export-excel
    $('#export-excel').bind('click', function(e) {
        //e.preventDefault();
        var tableId = $('li.droptablestable.active').data('id-table');
        var format = $(this).data('format-excel');
        var url = 'index.php?option=com_droptables&task=excel.export&id=' + tableId + '&format_excel=' + format;
        
         if( $("#jform_import_style").val() ) {
            url = url + '&onlydata=0';
        }else {
            url = url + '&onlydata=1';               
        }     
        
        $.fileDownload(url, {
            failCallback: function(html, url) {
                bootbox.alert(html);
            }
        });
    });

// DB tables */
    createDbTable = function() {
         $.ajax({
            url: "index.php?option=com_droptables&view=dbtable&tmpl=component&format=raw",          
            type: "POST",
            success: function (datas) {               
              
               $("#dbtable_wrapper").html(datas);             
               switchTableDatabase(true);
            }
        })
    };
    
    $("#newDbtableBtn").click(function(e) {
        e.preventDefault();
        createDbTable();        
        return false;
    })
});


//switch config pane between table and chart
function switchTableDatabase(dbtable ) {
    var $ = jQuery;
    if (dbtable) {
        $('#pwrapper').hide();              
        $('#rightcol2').hide();                
        setTimeout(function(){ $('#rightcol').hide() }, 100);         
        $("#dbtable_wrapper").show();
    } else {
        $('#pwrapper').show();  
        $("#rightcol2").hide();
        $("#rightcol").show();
        $("#dbtable_wrapper").hide();
        //$("a.btn_addGraph").show();
    }

}

function updateDimession() {
   
        rows = [];
        var i = 0;
        for (row in Droptables.style.rows) {
            var h = jQuery('#tableContainer .htCore tr').eq(i+1).height() ;
            rows[row]  = h;
            i++;            
        }
       
        jQuery(Droptables.container).handsontable('updateSettings', {rowHeights: rows});
            
        var ht = jQuery(Droptables.container).handsontable('getInstance');
        ht.runHooks('afterRowResize');                         
}
/**
 * Insert the current table into a content editor
 */
function insertTable() {
    id = jQuery('#categorieslist li.droptablestable.active').data('id-table');
    dir = decodeURIComponent(getUrlVar('path'));
    code = '<img src="' + dir + '/components/com_droptables/assets/images/t.gif"' +
            'data-droptablestable="' + id + '"' +
            'style="background: url(' + dir + '/components/com_droptables/assets/images/spreadsheet.png) no-repeat scroll center center #D6D6D6;' +
            'border: 2px dashed #888888;' +
            'height: 150px;' +
            'border-radius: 10px;' +
            'width: 99%;" />';
    return code;
}

//From http://stackoverflow.com/questions/7544550/javascript-regex-to-change-all-relative-urls-to-absolute
function rel_to_abs(url){
    /* Only accept commonly trusted protocols:
     * Only data-image URLs are accepted, Exotic flavours (escaped slash,
     * html-entitied characters) are not supported to keep the function fast */
  if(/^(https?|file|ftps?|mailto|javascript):/i.test(url) || /^(data:image\/[^;]{2,9};)/i.test(url) ) {
         return url; //Url is already absolute
    }

    var base_url = location.href.match(/^(.+)\/?(?:#.+)?$/)[0]+"/";
    base_url = base_url.replace("/administrator","");
    if(url.substring(0,2) == "//")
        return location.protocol + url;
    else if(url.charAt(0) == "/")
        return location.protocol + "//" + location.host + url;
    else if(url.substring(0,2) == "./")
        url = "." + url;
    else if(/^\s*$/.test(url))
        return ""; //Empty = Return nothing
    else url = "../" + url;

    url = base_url + url;
    var i=0
    while(/\/\.\.\//.test(url = url.replace(/[^\/]+\/+\.\.\//g,"")));

    /* Escape certain characters to prevent XSS */
    url = url.replace(/\.$/,"").replace(/\/\./g,"").replace(/"/g,"%22")
            .replace(/'/g,"%27").replace(/</g,"%3C").replace(/>/g,"%3E");
    return url;
}

function replace_all_rel_by_abs(html){
    /*HTML/XML Attribute may not be prefixed by these characters (common 
       attribute chars.  This list is not complete, but will be sufficient
       for this function (see http://www.w3.org/TR/REC-xml/#NT-NameChar). */
    var att = "[^-a-z0-9:._]";

    var entityEnd = "(?:;|(?!\\d))";
    var ents = {" ":"(?:\\s|&nbsp;?|&#0*32"+entityEnd+"|&#x0*20"+entityEnd+")",
                "(":"(?:\\(|&#0*40"+entityEnd+"|&#x0*28"+entityEnd+")",
                ")":"(?:\\)|&#0*41"+entityEnd+"|&#x0*29"+entityEnd+")",
                ".":"(?:\\.|&#0*46"+entityEnd+"|&#x0*2e"+entityEnd+")"};
                /* Placeholders to filter obfuscations */
    var charMap = {};
    var s = ents[" "]+"*"; //Short-hand for common use
    var any = "(?:[^>\"']*(?:\"[^\"]*\"|'[^']*'))*?[^>]*";
    /* ^ Important: Must be pre- and postfixed by < and >.
     *   This RE should match anything within a tag!  */

    /*
      @name ae
      @description  Converts a given string in a sequence of the original
                      input and the HTML entity
      @param String string  String to convert
      */
    function ae(string){
        var all_chars_lowercase = string.toLowerCase();
        if(ents[string]) return ents[string];
        var all_chars_uppercase = string.toUpperCase();
        var RE_res = "";
        for(var i=0; i<string.length; i++){
            var char_lowercase = all_chars_lowercase.charAt(i);
            if(charMap[char_lowercase]){
                RE_res += charMap[char_lowercase];
                continue;
            }
            var char_uppercase = all_chars_uppercase.charAt(i);
            var RE_sub = [char_lowercase];
            RE_sub.push("&#0*" + char_lowercase.charCodeAt(0) + entityEnd);
            RE_sub.push("&#x0*" + char_lowercase.charCodeAt(0).toString(16) + entityEnd);
            if(char_lowercase != char_uppercase){
                /* Note: RE ignorecase flag has already been activated */
                RE_sub.push("&#0*" + char_uppercase.charCodeAt(0) + entityEnd);   
                RE_sub.push("&#x0*" + char_uppercase.charCodeAt(0).toString(16) + entityEnd);
            }
            RE_sub = "(?:" + RE_sub.join("|") + ")";
            RE_res += (charMap[char_lowercase] = RE_sub);
        }
        return(ents[string] = RE_res);
    }

    /*
      @name by
      @description  2nd argument for replace().
      */
    function by(match, group1, group2, group3){
        /* Note that this function can also be used to remove links:
         * return group1 + "javascript://" + group3; */
        return group1 + rel_to_abs(group2) + group3;
    }
    /*
      @name by2
      @description  2nd argument for replace(). Parses relevant HTML entities
      */
    var slashRE = new RegExp(ae("/"), 'g');
    var dotRE = new RegExp(ae("."), 'g');
    function by2(match, group1, group2, group3){
        /*Note that this function can also be used to remove links:
         * return group1 + "javascript://" + group3; */
        group2 = group2.replace(slashRE, "/").replace(dotRE, ".");
        return group1 + rel_to_abs(group2) + group3;
    }
    /*
      @name cr
      @description            Selects a HTML element and performs a
                                search-and-replace on attributes
      @param String selector  HTML substring to match
      @param String attribute RegExp-escaped; HTML element attribute to match
      @param String marker    Optional RegExp-escaped; marks the prefix
      @param String delimiter Optional RegExp escaped; non-quote delimiters
      @param String end       Optional RegExp-escaped; forces the match to end
                              before an occurence of <end>
     */
    function cr(selector, attribute, marker, delimiter, end){
        if(typeof selector == "string") selector = new RegExp(selector, "gi");
        attribute = att + attribute;
        marker = typeof marker == "string" ? marker : "\\s*=\\s*";
        delimiter = typeof delimiter == "string" ? delimiter : "";
        end = typeof end == "string" ? "?)("+end : ")(";
        var re1 = new RegExp('('+attribute+marker+'")([^"'+delimiter+']+'+end+')', 'gi');
        var re2 = new RegExp("("+attribute+marker+"')([^'"+delimiter+"]+"+end+")", 'gi');
        var re3 = new RegExp('('+attribute+marker+')([^"\'][^\\s>'+delimiter+']*'+end+')', 'gi');
        html = html.replace(selector, function(match){
            return match.replace(re1, by).replace(re2, by).replace(re3, by);
        });
    }
    /* 
      @name cri
      @description            Selects an attribute of a HTML element, and
                                performs a search-and-replace on certain values
      @param String selector  HTML element to match
      @param String attribute RegExp-escaped; HTML element attribute to match
      @param String front     RegExp-escaped; attribute value, prefix to match
      @param String flags     Optional RegExp flags, default "gi"
      @param String delimiter Optional RegExp-escaped; non-quote delimiters
      @param String end       Optional RegExp-escaped; forces the match to end
                                before an occurence of <end>
     */
    function cri(selector, attribute, front, flags, delimiter, end){
        if(typeof selector == "string") selector = new RegExp(selector, "gi");
        attribute = att + attribute;
        flags = typeof flags == "string" ? flags : "gi";
        var re1 = new RegExp('('+attribute+'\\s*=\\s*")([^"]*)', 'gi');
        var re2 = new RegExp("("+attribute+"\\s*=\\s*')([^']+)", 'gi');
        var at1 = new RegExp('('+front+')([^"]+)(")', flags);
        var at2 = new RegExp("("+front+")([^']+)(')", flags);
        if(typeof delimiter == "string"){
            end = typeof end == "string" ? end : "";
            var at3 = new RegExp("("+front+")([^\"'][^"+delimiter+"]*" + (end?"?)("+end+")":")()"), flags);
            var handleAttr = function(match, g1, g2){return g1+g2.replace(at1, by2).replace(at2, by2).replace(at3, by2)};
        } else {
            var handleAttr = function(match, g1, g2){return g1+g2.replace(at1, by2).replace(at2, by2)};
    }
        html = html.replace(selector, function(match){
             return match.replace(re1, handleAttr).replace(re2, handleAttr);
        });
    }

    /* <meta http-equiv=refresh content="  ; url= " > */
    cri("<meta"+any+att+"http-equiv\\s*=\\s*(?:\""+ae("refresh")+"\""+any+">|'"+ae("refresh")+"'"+any+">|"+ae("refresh")+"(?:"+ae(" ")+any+">|>))", "content", ae("url")+s+ae("=")+s, "i");

    cr("<"+any+att+"href\\s*="+any+">", "href"); /* Linked elements */
    cr("<"+any+att+"src\\s*="+any+">", "src"); /* Embedded elements */

    cr("<object"+any+att+"data\\s*="+any+">", "data"); /* <object data= > */
    cr("<applet"+any+att+"codebase\\s*="+any+">", "codebase"); /* <applet codebase= > */

    /* <param name=movie value= >*/
    cr("<param"+any+att+"name\\s*=\\s*(?:\""+ae("movie")+"\""+any+">|'"+ae("movie")+"'"+any+">|"+ae("movie")+"(?:"+ae(" ")+any+">|>))", "value");

    cr(/<style[^>]*>(?:[^"']*(?:"[^"]*"|'[^']*'))*?[^'"]*(?:<\/style|$)/gi, "url", "\\s*\\(\\s*", "", "\\s*\\)"); /* <style> */
    cri("<"+any+att+"style\\s*="+any+">", "style", ae("url")+s+ae("(")+s, 0, s+ae(")"), ae(")")); /*< style=" url(...) " > */
    return html;
}

//From http://jquery-howto.blogspot.fr/2009/09/get-url-parameters-values-with-jquery.html
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getUrlVar(v) {
    if (typeof (getUrlVars()[v]) !== "undefined") {
        return getUrlVars()[v];
    }
    return null;
}

function preg_replace(array_pattern, array_pattern_replace, my_string) {
    var new_string = String(my_string);
    for (i = 0; i < array_pattern.length; i++) {
        var reg_exp = RegExp(array_pattern[i], "gi");
        var val_to_replace = array_pattern_replace[i];
        new_string = new_string.replace(reg_exp, val_to_replace);
    }
    return new_string;
}

//https://gist.github.com/ncr/399624
jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
    return this.each(function() {
        var clicks = 0, self = this;
        jQuery(this).click(function(event) {
            clicks++;
            if (clicks == 1) {
                setTimeout(function() {
                    if (clicks == 1) {
                        single_click_callback.call(self, event);
                    } else {
                        double_click_callback.call(self, event);
                    }
                    clicks = 0;
                }, timeout || 300);
            }
        });
    });
}


function fillArray(array, val, val1, val2) {
    if (typeof (val2) === 'undefined') {
        if (typeof (array[val1]) !== 'undefined') {
            array[val1][1] = jQuery.extend(array[val1][1], val);
        } else {
            array[val1] = [val1, {}];
            array[val1][1] = val;
        }
    } else {
        if (typeof (array[val1 + "!" + val2]) !== 'undefined') {
            array[val1 + "!" + val2][2] = jQuery.extend(array[val1 + "!" + val2][2], val);
        } else {
            array[val1 + "!" + val2] = [val1, val2, {}];
            array[val1 + "!" + val2][2] = val;
        }
    }
    return array;
}

function toggleArray(array, val, val1, val2) {
    if (typeof (val2) === 'undefined') {
        if (typeof (array[val1]) !== 'undefined') {
            if (typeof (val) === 'object') {
                for (key in val) {
                    if (typeof (array[val1][1][key] !== 'undefined')) {
                        array[val1][1][key] = !array[val1][1][key];
                    } else {
                        array[val1][1][key] = val[key];
                    }
                }
            } else {
                array[val1][1] = jQuery.extend(array[val1][1], val);
            }
        } else {
            array[val1] = [val1, {}];
            array[val1][1] = val;
        }
    } else {
        if (typeof (array[val1 + "!" + val2]) !== 'undefined') {
            if (typeof (val) === 'object') {
                for (key in val) {
                    if (typeof (array[val1 + "!" + val2][2][key] !== 'undefined')) {
                        array[val1 + "!" + val2][2][key] = !array[val1 + "!" + val2][2][key];
                    } else {
                        array[val1 + "!" + val2][2][key] = val[key];
                    }
                }
            } else {
                array[val1 + "!" + val2][2] = jQuery.extend(array[val1 + "!" + val2][2], val);
            }
        } else {
            array[val1 + "!" + val2] = [val1, val2, {}];
            array[val1 + "!" + val2][2] = val;
        }
    }

    return array;
}

//Code from http://stackoverflow.com/questions/9905533/convert-excel-column-alphabet-e-g-aa-to-number-e-g-25
var convertAlpha = function(val) {
    var base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', i, j, result = 0;

    for (i = 0, j = val.length - 1; i < val.length; i += 1, j -= 1) {
        result += Math.pow(base.length, j) * (base.indexOf(val[i]) + 1);
    }

    return result;
};

function strip_tags(input, allowed) {
    //  discuss at: http://phpjs.org/functions/strip_tags/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Luke Godfrey
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    allowed = (((allowed || '') + '')
            .toLowerCase()
            .match(/<[a-z][a-z0-9]*>/g) || [])
            .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
            commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '')
            .replace(tags, function($0, $1) {
                return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
}

clone = function(v) {
    return JSON.parse(JSON.stringify(v));
}

/* Chart functions */
var DropChart = {};
DropChart.default = {"dataUsing": "row", "switchDataUsing": true, "useFirstRowAsLabels": false, "width": 500, "height": 375, "chart_align": "center", "scaleShowGridLines": false};
DropChart.default.colors = "#DCDCDC,#97BBCD,#4C839E";
DropChart.default.pieColors = "#F7464A,#46BFBD,#FDB45C,#949FB1,#4D5360";
var doNotSave = false;

jQuery(document).ready(function($) {
    Chart.defaults.global.multiTooltipTemplate = "<%= datasetLabel %>: <%= value %>";
    
    $('#mainTable .btn_addGraph').click(function(e){
            btnAdd = this ;
            e.preventDefault();
            var selection = validateChartData();
            if(selection) {
                          
                var id_table = $('#mycategories li.droptablestable.active').data('id-table');
   
                //create new chart & insert into db            
                $.ajax({
                    url :   "index.php?option=com_droptables&task=chart.add&id_table=" + id_table,
                    type    :   "POST",
                    dataType :  "json",
                    data: {datas : JSON.stringify(selection)},
                    success :   function(datas){
                       
                        if(datas.response===true){                           
                            addChart(datas.datas);
                        }else{
                            bootbox.alert(datas.response);                            
                        }
                    },
                    error : function(jqxhr, textStatus, error){
                        bootbox.alert(textStatus+" : "+error);
                    }
                });
             
              
            }else {
                   bootbox.alert("Invalid data. Please choose other cell range which have got at least one row or one column with only numeric data");
            }                      
    });
        
    (initChartStyles = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        $('#rightcol2 .chart-styles a').click(function() {
            id = $(this).data('id');
            
            //add active class
            $('#rightcol2 .chart-styles a').each(function(index,e) {
                $(e).removeClass("active");
            });
            $(this).addClass("active");
            
            $.ajax({
                url: "index.php?option=com_droptables&view=charttyle&format=json&id=" + id,
                type: 'POST',
				dataType: "json"
            }).done(function(data) {
                
                if (typeof (data) === 'object') {

                    DropChart.type = data.name;
                    $.extend(DropChart.config, $.parseJSON(data.config));                  
                    
                    //local save
                    $("#chart_" + DropChart.id).data("configs", DropChart.config);
                    var datas = $("#chart_" + DropChart.id).data("datas");
                    datas.type = DropChart.type;
                    $("#chart_" + DropChart.id).data("datas", datas);
                    
                    populateChartConfig(DropChart.id) ;
                    
                    //re - draw
                    DropChart.render();
                    //save change
                    DropChart.save();

                }
            });
            return false;
        });
    })();

    (initChartObserver = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        $('.observeChanges2').on('change click', function(e) {

            var chartConfig = $("#chart_" + DropChart.id).data("configs");

            switch ($(this).attr('name')) {
                case 'jform[dataUsing]':                    
                    chartConfig.dataUsing = $(this).val();
                    var dataSets = getDataSets( DropChart.cells, chartConfig.dataUsing);
                    DropChart.datasets = addChartStyles( dataSets[0], chartConfig.colors);  // dataSets[0];
                    if(chartConfig.useFirstRowAsLabels) {
                        DropChart.labels = dataSets[1];
                    }else {
                        DropChart.labels = DropChart.helper.getEmptyArray(dataSets[1].length) ;
                    }
                    
                    break;
                case 'jform[useFirstRowAsLabels]':
                    chartConfig.useFirstRowAsLabels = ($(this).val() == "yes") ? true : false;
                    var dataSets = getDataSets( DropChart.cells, chartConfig.dataUsing);                    
                    if(chartConfig.useFirstRowAsLabels) {
                        DropChart.labels = dataSets[1];
                    }else {
                        DropChart.labels = DropChart.helper.getEmptyArray(dataSets[1].length) ;
                    }
                    
                    break;
                case 'jform[chart_width]':
                    chartConfig.width = $(this).val();
                    break;
                case 'jform[chart_height]':
                    chartConfig.height = $(this).val();
                    break;
                    
                case 'jform[chart_align]':
                    chartConfig.chart_align = $(this).val();
                    break;
                
                case 'jform[dataset_color]':
                     var index = parseInt($("#jform_dataset_select").val() ); 
                     if(DropChart.type=="Line" || DropChart.type=="Bar" || DropChart.type=="Radar") {
                        var colors = chartConfig.colors.split(",");
                        if(colors.length> index) {
                            colors[index] = $(this).val();
                        }
                       chartConfig.colors = colors.join(",");
                       var dataSets = getDataSets( DropChart.cells, chartConfig.dataUsing);
                       DropChart.datasets = addChartStyles( dataSets[0], chartConfig.colors);  
                    }else {
                        var pieColors = chartConfig.pieColors.split(",");
                        if(pieColors.length> index) {
                            pieColors[index] = $(this).val();
                        }
                       chartConfig.pieColors = pieColors.join(",");                      
                    }
                    
                    break;
            }
           
            //local save
            $("#chart_" + DropChart.id).data("configs", chartConfig);            
            DropChart.config = chartConfig;
            //re - draw
            DropChart.render();
            // save change
            DropChart.save();

        });
        
         $('.observeChanges3').on('change click', function(e) {

            var chartConfig = $("#chart_" + DropChart.id).data("configs");            
            switch ($(this).attr('name')) {
                case 'jform[dataset_select]':                    
                    var index = parseInt($(this).val());   
                    if(DropChart.type=="Line" || DropChart.type=="Bar" || DropChart.type=="Radar") {
                        if( chartConfig.colors.split(",").length > index) {
                            $('#jform_dataset_color').minicolors('value', chartConfig.colors.split(",")[index]);
                        }else {
                            $('#jform_dataset_color').minicolors('value', "");
                        }
                    }else {
                        if( chartConfig.pieColors.split(",").length > index) {
                            $('#jform_dataset_color').minicolors('value', chartConfig.pieColors.split(",")[index]);
                        }else {
                            $('#jform_dataset_color').minicolors('value', "");
                        }
                    }
                    
                    break;               
            }
          
        });

    })();

    DropChart.render = function() {
        
        var containerID = "chart_" + DropChart.id;
        var chartConfig = DropChart.config;

        //destroy old chart version
        if (DropChart.chart) {
            DropChart.chart.clear();
            DropChart.chart.destroy();
        }
        //re-create cavans
        $("#" + containerID + " .canvas").remove();
        $("#" + containerID + " .chartContainer").append('<canvas class="canvas" width="' + chartConfig.width + '" height="' + chartConfig.height + '"   ><canvas>');
        var ctx = $("#" + containerID + " .canvas").get(0).getContext("2d");
        var chartData = {};
        chartData.labels = DropChart.labels;
        chartData.datasets = DropChart.datasets;        
        
        if(chartData.datasets.length == 0) {
            return false;
        }

        switch (DropChart.type) {
            case 'PolarArea':
                DropChart.chart = new Chart(ctx).PolarArea(convertForPie(chartData, chartConfig.pieColors), chartConfig);
                break;

            case 'Pie':
                DropChart.chart = new Chart(ctx).Pie(convertForPie(chartData,chartConfig.pieColors), chartConfig);
                break;

            case 'Doughnut':
                DropChart.chart = new Chart(ctx).Doughnut(convertForPie(chartData,chartConfig.pieColors), chartConfig);
                break;

            case 'Bar':
                DropChart.chart = new Chart(ctx).Bar(chartData, chartConfig);
                break;

            case 'Radar':
                DropChart.chart = new Chart(ctx).Radar(chartData, chartConfig);
                break;

            case 'Line':
            default:
                DropChart.chart = new Chart(ctx).Line(chartData, chartConfig);
                break;
        }
     
    };

    DropChart.save = function() {
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return;
        }
        if(doNotSave) {
            return;
        }
        var $ = jQuery;
        var jsonVar = {
            jform: {
                type: DropChart.type,
                config: JSON.stringify(DropChart.config)
            },
            id: DropChart.id
        };
        jsonVar[Droptables.token] = "1";

        $.ajax({
            url: "index.php?option=com_droptables&task=chart.save",
            dataType: "json",
            type: "POST",
            data: jsonVar,
            success: function(datas) {
                
                if (datas.response === true) {
                    autosaveNotification = setTimeout(function() {
                        $('#savedInfo').fadeIn(200).delay(2000).fadeOut(1000);
                    }, 1000);
                } else {
                    bootbox.alert(datas.response);
                }
            },
            error: function(jqxhr, textStatus, error) {
                bootbox.alert(textStatus + " : " + error);
            }
        });
    }
});



/**
 * Insert the current table into a content editor
 */
function insertChart() {
   
    table_id = jQuery('#categorieslist li.droptablestable.active').data('id-table');
    chart_id = jQuery('ul#mainTable li.active').data('id-chart');
    dir = decodeURIComponent(getUrlVar('path'));
    code = '<img src="' + dir + '/components/com_droptables/assets/images/t.gif"' +
            ' data-droptablestable="' + table_id + '"' +
            ' data-droptables-chart="' + chart_id + '"' +
            'style="background: url(' + dir + '/components/com_droptables/assets/images/chart.png) no-repeat scroll center center #D6D6D6;' +
            'border: 2px dashed #888888;' +
            'height: 150px;' +
            'border-radius: 10px;' +
            'width: 99%;" />';
   
    return code;
}

//switch config pane between table and chart
function switchConfigPane(e) {
    var $ = jQuery;
    if($(e).attr("href").indexOf("dataSource")> -1) {
       
        $("#rightcol").hide();
        $("a.btn_addGraph").hide();
        $("#rightcol2").hide();
        return;
    }
    if ($(e).attr("href") != "#dataTable") {
        $(Droptables.container).handsontable('deselectCell');  
        $("#rightcol").hide();
        $("a.btn_addGraph").hide();
        $("#rightcol2").show();
        DropChart.id = $(e).parent().data('id-chart');
        doNotSave = true;
        populateChartConfig(DropChart.id);
        doNotSave = false;
    } else {
        $(window).trigger('resize');
        $("#rightcol2").hide();
        $("#rightcol").show();
        $("a.btn_addGraph").show();
    }

}

//populate chart config data for current (active) tab
function populateChartConfig(chart_id) {
    var $ = jQuery;    
    var chartConfig = $("#chart_" + chart_id).data("configs");
        
    if (chartConfig.dataUsing !== undefined) {
        $("#jform_dataUsing").val(chartConfig.dataUsing);
    }
    
    if (chartConfig.switchDataUsing === undefined || chartConfig.switchDataUsing == false) { 
        $("#jform_dataUsing").prop('disabled', true);        
    }else {
        $("#jform_dataUsing").prop('disabled', false);        
    }        
    $('#jform_dataUsing').trigger('liszt:updated');
    

    if (chartConfig.useFirstRowAsLabels !== undefined && chartConfig.useFirstRowAsLabels == true) {
        $("#jform_useFirstRowAsLabels").val("yes");
    } else {
        $("#jform_useFirstRowAsLabels").val("no");       
    }
    $('#jform_useFirstRowAsLabels').trigger('liszt:updated');

    $("#jform_chart_width").val(chartConfig.width);
    $("#jform_chart_height").val(chartConfig.height);

    if (chartConfig.chart_align !== undefined) {
        $("#jform_chart_align").val(chartConfig.chart_align);
    }
    $('#jform_chart_align').trigger('liszt:updated');

    var data = $("#chart_" + DropChart.id).data("datas");
    var cells = $.parseJSON(data.datas);
    
    $("#rightcol2 .chart-styles li a").each(function(index,e) {               
        if( $(e).attr("title") ==  data.type ) {
            $(e).addClass("active") ;
        }else {
            $(e).removeClass("active") ;
        }
    });

    DropChart.cells = cells;
    DropChart.type = data.type;
    
     var dataSets = getDataSets( DropChart.cells, chartConfig.dataUsing);
     if(dataSets.length < 3) {
         return false;
     }
     DropChart.datasets = addChartStyles( dataSets[0], chartConfig.colors); 
          
     if(chartConfig.useFirstRowAsLabels) {
          DropChart.labels = dataSets[1];
     }else {
          DropChart.labels = DropChart.helper.getEmptyArray(dataSets[1].length) ;
     }   
     
    // dataset_select
     $("#jform_dataset_select").html("");
     if(DropChart.type=="Line" || DropChart.type=="Bar" || DropChart.type=="Radar") {
        for(var i =0; i< DropChart.datasets.length; i++) {            
           $("#jform_dataset_select").append('<option value="'+i+'">'+ DropChart.datasets[i].label +'</option>');
        }     
        $('#jform_dataset_select').trigger('liszt:updated');     
        $('#jform_dataset_color').minicolors('value', chartConfig.colors.split(",")[0]);     
    }else {
        var chartData = {};
        chartData.datasets = DropChart.datasets;
        chartData.labels = dataSets[1];
        var pieDatas = convertForPie( chartData, chartConfig.pieColors);
        
         for(var i =0; i< pieDatas.length; i++) {                   
           $("#jform_dataset_select").append('<option value="'+i+'">'+ pieDatas[i].label +'</option>');
        }     
        $('#jform_dataset_select').trigger('liszt:updated');     
        $('#jform_dataset_color').minicolors('value', pieDatas[0].color) ;
    }
    
    DropChart.config = chartConfig;
    
}

//active some function for elements in tab content
function activeTabs() {
    
    var $ = jQuery;
    $('#mainTable a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        switchConfigPane(e.target);
    });

    $('#mainTabContent a.edit').unbind().click(function(e) {
        e.stopPropagation();
        if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
            return false;
        }
        $this = this;
        link = $(this).parent().find('span.chartTitle');
        oldTitle = link.text();
        $(link).attr('contentEditable', true);
        $(link).addClass('editable');
        $(link).selectText();

        $('#mainTabContent span.editable').bind('click.mm', hstop);  //let's click on the editable object
        $(link).bind('keypress.mm', hpress); //let's press enter to validate new title'
        $('*').not($(link)).bind('click.mm', houtside);

        function unbindall() {
            $('#mainTabContent span.editable').unbind('click.mm', hstop);  //let's click on the editable object
            $(link).unbind('keypress.mm', hpress); //let's press enter to validate new title'
            $('*').not($(link)).unbind('click.mm', houtside);
        }

        //Validation       
        function hstop(event) {
            event.stopPropagation();
            return false;
        }

        //Press enter
        function hpress(e) {
            if (e.which == 13) {
                e.preventDefault();
                unbindall();
                updateTitle($(link).text());
                $(link).removeAttr('contentEditable');
                $(link).removeClass('editable');
            }
        }

        //click outside
        function houtside(e) {
            unbindall();
            updateTitle($(link).text());
            $(link).removeAttr('contentEditable');
            $(link).removeClass('editable');
        }


        function updateTitle(title) {
            if (!(Droptables.can.edit || (Droptables.can.editown && data.author === Droptables.author))) {
                return false;
            }

            if (title.trim() !== '' ) {
                id = $(link).parents('div.tab-pane.active').data('id-chart');
                url = "index.php?option=com_droptables&task=chart.setTitle&id=" + id + '&title=' + title;

                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    success: function(datas) {
                        if (datas.response === true) {                           
                            $("#tabChart" + id).text(title);
                        } else {
                            $(link).text(oldTitle);
                            bootbox.alert(datas.response);
                        }
                    },
                    error: function(jqxhr, textStatus, error) {
                        $(link).text(oldTitle);
                        bootbox.alert(textStatus);
                    }
                });
            } else {
                $(link).text(oldTitle);
                return false;
            }
            $(link).parent().css('white-space', 'normal');
            setTimeout(function() {
                $(link).parent().css('white-space', '');
            }, 200);

        }
    });

    $('#mainTabContent  a.trash').unbind('click').click(function(e) {
        that = this;
        bootbox.confirm(Joomla.JText._('COM_DROPTABLES_JS_WANT_DELETE', 'Do you really want to delete ') + "\"" + $(this).prev().prev().text().trim() + '"?', function(result) {
            if (result === true) {

                id = $(that).parents('div.tab-pane.active').data('id-chart');
                $.ajax({
                    url: "index.php?option=com_droptables&task=chart.delete&id=" + id,
                    type: "POST",
                    dataType: "json",
                    success: function(datas) {
                        if (datas.response === true) {
                            $(that).parent().remove();
                            $("#mainTable li.active").remove();
                            // back to the table tab 
                            $('#mainTable li a:first').tab('show');
                        } else {
                            bootbox.alert(datas.response);
                        }
                    },
                    error: function(jqxhr, textStatus, error) {
                        bootbox.alert(textStatus);
                    }
                });
                return false;
            }
        });
    });
  
}


function loadTableContructor(){
    var $ = jQuery;
    var id_table = $('li.droptablestable.active').data('id-table');
    var table_type = $('li.droptablestable.active').data('table-type');
    
    $("#mainTable .tabDataSource").hide();
    $("#mainTable .groupTable" + id_table).show();
    if(table_type=='mysql') {
        if ($("#tabDataSource_" + id_table).length == 0) {
            var firstTab = $('#mainTable li').get(0);
            $(firstTab).after('<li><a data-toggle="tab" id="tabDataSource_'+id_table+'" class="tabDataSource groupTable' + id_table + '" href="#dataSource_' + id_table+ '">Data Source</a></li>');
            $('#mainTabContent.tab-content').append('<div class="tab-pane dataSourceContainer" id="dataSource_' + id_table + '">' +               
                    '</div>');

            $.ajax({
                url: "index.php?option=com_droptables&view=dbtable&tmpl=component&format=raw&id_table=" + id_table,
                type: "GET"          
            }).done(function(data) {
                $("#dataSource_"+id_table ).html (data);
            });
        }       
    }
    //do nothing
}

function loadCharts() {
    
    var $ = jQuery;
    var id_table = $('li.droptablestable.active').data('id-table');
    $("#mainTable .graphTab").hide();
    $("#mainTable .groupTable" + id_table).show();
    url = "index.php?option=com_droptables&view=charts&format=json&id_table=" + id_table;
    $.ajax({
        url: url,
        type: "POST",
		dataType: "json"
    }).done(function(data) {
        if (typeof (data) === 'string') {
            bootbox.alert(data);
        } else {
            for (var i = 0; i < data.length; i++) {
                initChart(data[i]);
            }

            activeTabs();           
            if( typeof(Droptables.chart_id) !== 'undefined' ) {                  
                  $('a#tabChart'+ Droptables.chart_id).tab('show');                        
                  Droptables.chart_id = 0;                  
            }
        }
    });

   
}

function initChart(data) {    
    initTabChart(data);
     
    drawChart(data);
    
}

function initTabChart(data) {
  
    var $ = jQuery;
    var btnAdd = $('#mainTable .btn_addGraph').get(0);
    var id_table = $('li.droptablestable.active').data('id-table');
    var chartConfig = $.extend({}, DropChart.default, $.parseJSON(data.config));
    var canSwitch = DropChart.helper.canSwitchRowCol($.parseJSON(data.datas));
    if(canSwitch==3) { //both row and col data valid
        chartConfig.switchDataUsing = true;
    }else {
        chartConfig.switchDataUsing = false;
        if(canSwitch==2) {  //only row data valid
            chartConfig.dataUsing = "row" ;
        }else { //only row data valid
            chartConfig.dataUsing = "column" ;
        }
    }  
    
    if ($("#tabChart" + data.id).length == 0) {
        $(btnAdd).closest('li').before('<li data-id-chart="' + data.id + '"><a data-toggle="tab" id="tabChart' + data.id + '" class="graphTab groupTable' + id_table + '" href="#chart_' + data.id + '">' + data.title + '</a></li>');
        $('#mainTabContent.tab-content').append('<div class="tab-pane" data-id-chart="' + data.id + '" id="chart_' + data.id + '">' +
                '<div style="padding-top:10px" ><div class="span9"><span class="chartTitle">' + data.title + '</span>'
                + '<a class="edit"><i class="icon-edit"></i></a>'
                + '<a class="trash"><i class="icon-trash"></i></a></div>'
                + '<div class="span3" style="text-align:center"><label>Data - Selected Range</label>'
                + '<input type="type" name="selectedCells" readOnly="true" class="observeChanges2 input-mini selectedCells" size="8" value="" /></div>'
                + '</div>'
                + '<div class="chartContainer"><canvas class="canvas" height="' + chartConfig.height + '" width="' + chartConfig.width + '"></canvas></div></div>');
    }

    $("#chart_" + data.id).data("configs", chartConfig);
    $("#chart_" + data.id).data("datas", data);
       
}

function addChart(data) {    
  
    //init tab
    initTabChart(data);

    //draw chart
    drawChart(data);
         
    activeTabs();    
    // make the new tab active
    jQuery('#mainTable a.graphTab:last').tab('show');    
        
    //save change
    DropChart.save();
   
}

//Draw new chart
function drawChart(data) {
   
    var $ = jQuery;
    var containerID = "chart_" + data.id;
    var cells = $.parseJSON(data.datas);

    if ($.isArray(cells) == false || cells.length == 0)
        return;

    DropChart.cells = cells;

    var chartConfig = $.extend({}, DropChart.default, $.parseJSON(data.config));
    DropChart.config = chartConfig;

    var chartData = {};    
    var dataSets = getDataSets(cells, DropChart.config.dataUsing);
    if(dataSets.length ==0) {
        return false;
    }
    
    chartData.datasets = addChartStyles( dataSets[0], chartConfig.colors);   
    
    if( DropChart.config.useFirstRowAsLabels) {
        chartData.labels =  dataSets[1];
    }else {
        chartData.labels = DropChart.helper.getEmptyArray(dataSets[1].length);
    }

    selectedCellsLabels = DropChart.helper.getCellRangeLabel(cells);
    $("#" + containerID + " .selectedCells").val(selectedCellsLabels);

    // Get the context of the canvas element we want to select
    // Get context with jQuery - using jQuery's .get() method.
    var ctx = $("#" + containerID + " .canvas").get(0).getContext("2d");
    DropChart.labels = chartData.labels;
    DropChart.datasets = chartData.datasets;
    DropChart.type = data.type;
       
    switch (DropChart.type) {
        case 'PolarArea':
            DropChart.chart = new Chart(ctx).PolarArea(convertForPie(chartData, DropChart.config.pieColors), DropChart.config);
            break;

        case 'Pie':
            DropChart.chart = new Chart(ctx).Pie(convertForPie(chartData, DropChart.config.pieColors), DropChart.config);
            break;

        case 'Doughnut':
            DropChart.chart = new Chart(ctx).Doughnut(convertForPie(chartData, DropChart.config.pieColors), DropChart.config);
            break;

        case 'Bar':
            DropChart.chart = new Chart(ctx).Bar(chartData, DropChart.config);
            break;

        case 'Radar':
            DropChart.chart = new Chart(ctx).Radar(chartData, DropChart.config);
            break;

        case 'Line':
        default:
            DropChart.chart = new Chart(ctx).Line(chartData, DropChart.config);
            break;
    }


}

function addChartStyles(dataSets, colors) {
    
    var result = [];
    for(var i=0; i <  dataSets.length; i++) {
         dataset = dataSets[i];
         styleSet = getStyleSet(i, colors);
         jQuery.extend(dataset, styleSet);         
         result.push(dataset);
    }
    
    return result;
}

function getDataSets(cells, dataUsing) {    
    
    var datasets = [];
    var axisLabels = [];
    var grapLabels = [];
    
    if (!dataUsing) {
        dataUsing = "row";
    }

    var cellsData = DropChart.helper.getRangeData(cells);
    if(cellsData.length == 0) {
        return false;
    }
    
     //Check row & column to remove labels
    var rValid = DropChart.helper.hasNumbericRow(cellsData);
    rCellsData = DropChart.helper.transposeArr(cellsData);
    var cValid = DropChart.helper.hasNumbericRow(rCellsData);
     
    if (!rValid && !cValid) { //remove first row and column
        axisLabels = cellsData.shift();
        axisLabels.shift();
        
        rCellsData = DropChart.helper.transposeArr(cellsData);    
        grapLabels = rCellsData.shift();
        cellsData = DropChart.helper.transposeArr(rCellsData);        
        
        if(dataUsing != "row") {
            cellsData = DropChart.helper.transposeArr(cellsData);  
            var temp = axisLabels;
            axisLabels = grapLabels;
            grapLabels = temp;
        }
        
    } else if(!rValid && cValid) { // remove first column
        axisLabels = rCellsData[0];
        grapLabels = cellsData[0];
      
        if(!DropChart.helper.isNumbericArray(rCellsData[0]) ) {
            rCellsData.shift();            
            grapLabels.shift();
        }         
        cellsData = rCellsData;  
        
    } else if(!cValid && rValid) { //remove first row
        axisLabels = cellsData[0];
        grapLabels = rCellsData[0];
        if(!DropChart.helper.isNumbericArray(cellsData[0]) ) {
            cellsData.shift();              
            grapLabels.shift();
        }
        
    } else {
        //do nothing yet
        axisLabels = cellsData[0];
        grapLabels = rCellsData[0];
        if(!DropChart.helper.isNumbericArray(cellsData[0]) ) {
            cellsData.shift();              
            grapLabels.shift();
        }
       
        if(dataUsing != "row") {
            cellsData = DropChart.helper.transposeArr(cellsData);  
            var temp = axisLabels;
            axisLabels = grapLabels;
            grapLabels = temp;
        }
    }    
    
       
    for (var i = 0; i < cellsData.length; i++) {
                
        if (DropChart.helper.isNumbericArray(cellsData[i])) {            
            var dataset = {};
            dataset.data = cellsData[i];      
            dataset.label = grapLabels[i];             
            datasets.push(dataset);
        }
    }

    if (datasets.length == 0) {
        cellsData = DropChart.helper.transposeArr(cellsData);
        for (var i = 0; i < cellsData.length; i++) {
                        
            if (DropChart.helper.isNumbericArray(cellsData[i])) {                
                var dataset = {};
                dataset.data = cellsData[i];  
                dataset.label = grapLabels[i];                
                datasets.push(dataset);
            }
        }
    }
      
    return new Array(datasets,axisLabels,grapLabels );
}

function getCellData(cellPos) {
    
    var pos = cellPos.split(":");
    var value = jQuery("#tableContainer").handsontable('getDataAtCell', parseInt(pos[0]), parseInt(pos[1]));
    
    return value;
}


//We need at least 1 row or 1 column is numberic
function validateChartData() {
    
    var rValid = true;
    var cValid = true;
    var $ = jQuery;

    var selection = $(Droptables.container).handsontable('getSelected');
   
    if (typeof selection == "undefined" || selection.length < 2) {
        return false;
    }
    var iMin = selection[0] < selection[2] ? selection[0] : selection[2];
    var iMax = selection[0] > selection[2] ? selection[0] : selection[2];
    var jMin = selection[1] < selection[3] ? selection[1] : selection[3];
    var jMax = selection[1] > selection[3] ? selection[1] : selection[3];
        
    //no cell selected or only one cell
    if (selection.length == 0 || (iMin == iMax && jMin == jMax) ) {
        return false;
    }
    
    var cellRange = new Array();
    Cells = $(Droptables.container).handsontable('getData', iMin, jMin, iMax, jMax);   
    
    //Check row
    rValid = DropChart.helper.hasNumbericRow(Cells);     
    if (!rValid) {
        //check column         
        rCells = DropChart.helper.transposeArr(Cells);
        cValid = DropChart.helper.hasNumbericRow(rCells);
          
        if(!cValid) { //ignore first row and column
          
            subCells = DropChart.helper.removeFirstRowColumn(rCells);           
            if(subCells.length <=0) return false;
            
            rValid =  DropChart.helper.hasNumbericRow(subCells);
            if (!rValid) {
                rsubCells = DropChart.helper.transposeArr(subCells);
                cValid = DropChart.helper.hasNumbericRow(rsubCells);
            }
        }
    }

  
    if (rValid || cValid) {
        //read data         
        for (var r = 0; r < Cells.length; r++) {
            cellRange[r] = new Array();
            for (var c = 0; c < Cells[r].length; c++) {
                cellRange[r][c] = (iMin + r) + ":" + (jMin + c);
            }
        }

        return cellRange;
    } else {
        return false;
    }
  
}

function validateCharts(change) {
    
    var result = true;
    var $ = jQuery;
    var id_table = $('li.droptablestable.active').data('id-table');
    var editCell = change[0]+":"+change[1];
  
    $('ul#mainTable a.groupTable'+id_table).each( function(index,e) {
         chart_id = $(this).parent().data('id-chart');
         
         if(chart_id) {             
            var data = $("#chart_"+chart_id).data("datas");            
            var cells = $.parseJSON(data.datas);  
            if( DropChart.helper.inArrays(editCell,cells) ) {
                var cellsData = [];
                for(var i=0; i< cells.length; i++) {
                    var rowData = [];
                    for (var j = 0; j < cells[i].length; j++) {
                        if(cells[i][j] != editCell) {
                            rowData[j] = getCellData(cells[i][j]);
                        }else {
                            rowData[j] = change[3];//new value
                        }
                    }
                    cellsData[i] = rowData;
                }                
                
                if( !validateDataForChart(cellsData) ) {
                    result = false;
                }
            }
         }
    });
   
    return result;
}

function validateDataForChart(Cells) {
     //Check row
    rValid = DropChart.helper.hasNumbericRow(Cells);      
    if (!rValid) {
        //check column         
        rCells = DropChart.helper.transposeArr(Cells);
        cValid = DropChart.helper.hasNumbericRow(rCells);          
        if(!cValid) { //ignore first row and column
          
            subCells = DropChart.helper.removeFirstRowColumn(rCells);           
            if(subCells.length <=0) return false;
            
            rValid =  DropChart.helper.hasNumbericRow(subCells);
            if (!rValid) {
                rsubCells = DropChart.helper.transposeArr(subCells);
                cValid = DropChart.helper.hasNumbericRow(rsubCells);
            }
        }
    }
       
    return (rValid || cValid) ;
}
function convertForPie(lineChartData, colors) {
        
    if(lineChartData.datasets.length==0) {
        return false;
    }
    var datas = [];
    var dataset = lineChartData.datasets[0].data;
   
    
    for (var i = 0; i < dataset.length; i++) {
        var data = {};
        data.value = Number(dataset[i]);
        data.label = lineChartData.labels[i];
        data.color = getColor(i,colors);
        data.highlight =  DropChart.helper.ColorLuminance(data.color, 0.3);        
        datas[i] = data;
    }
   
    return datas;
}

function getColor(i,colors) {
   var result ="";
   var arrColors = colors.split(",");  
   var len = arrColors.length ;
   if(len >0 ) {
        result = arrColors[i % len];
   }
    
   return result;    
}

function getStyleSet(i, colors) {
    var styleSet = {};
    
    var color = getColor(i,colors);
    if(color != "" ) {      
        styleSet.fillColor =  DropChart.helper.convertHex(color,20);
        styleSet.strokeColor =  DropChart.helper.convertHex(color,50);
        styleSet.pointColor =  DropChart.helper.convertHex(color,100);
        styleSet.pointColor = "#fff" ;
        styleSet.pointHighlightFill = "#fff" ;
        styleSet.pointColor =  DropChart.helper.convertHex(color,100);
    }
    
    return styleSet;
}


DropChart.helper = {}
DropChart.helper.isNumbericArray = function(arr) {

    var valid = true;
    for (var c = 0; c < arr.length; c++) {
        if (isNaN(arr[c])) {
            valid = false;
        }
    }

    return valid;
};


DropChart.helper.transposeArr = function(arr) {
    if(typeof arr =="undefined" || arr.length == 0) {
        return [];
    }
    return Object.keys(arr[0]).map(function(c) {
        return arr.map(function(r) {
            return r[c];
        });
    });
}
DropChart.helper.inArrays = function(c, cells) {
    var result = false;
    for (var r = 0; r < cells.length; r++) {
        if( cells[r].indexOf(c) > -1 ) {
            result  =true;
        }        
    }
    
    return result;
}

DropChart.helper.hasNumbericRow = function(Cells) {
    var rValid = true;
    var rNaN = 0;
    if(typeof Cells == "undefined") {
        return false;
    }
    for (var r = 0; r < Cells.length; r++) {

        var valid = true;
        for (var c = 0; c < Cells[r].length; c++) {           
            if (Cells[r].length == 1 || isNaN(Cells[r][c]) || isNaN(parseInt(Cells[r][c])) ) {
                valid = false;
            }
        }

        if (!valid) {
            rNaN++;
        }
    }
  
    if (rNaN == Cells.length ) {
        rValid = false;
    }

    return rValid;
}

DropChart.helper.getRowData = function(row) {
    var data = [] ;
     for (var j = 0; j < row.length; j++) {
            data[j] = getCellData(row[j]);
    }
    
    return data;
}

DropChart.helper.getRangeData = function(cells) {
    var datas = [];
    for(var i=0; i< cells.length; i++) {
        datas[i] = DropChart.helper.getRowData(cells[i]);
    }
    
    return datas;
}

DropChart.helper.getCellRangeLabel = function(cells) {

    var result = "";
    var firstCell = cells[0][0];
    var lastRow = cells[cells.length - 1];
    var lastCell = lastRow[lastRow.length - 1];

    var pos = firstCell.split(":");
    result += Handsontable.helper.spreadsheetColumnLabel(parseInt(pos[1])) + '' + (parseInt(pos[0]) + 1);

    pos = lastCell.split(":");
    result += ":" + Handsontable.helper.spreadsheetColumnLabel(parseInt(pos[1])) + '' + (parseInt(pos[0]) + 1);
    return result;
}

DropChart.helper.canSwitchRowCol = function(cells) {   
   
    var result = -1;
    var rValid = false;
    var cValid = false;
    
    var $ = jQuery;
    var firstCell = cells[0][0];
    var lastRow = cells[cells.length - 1];
    var lastCell = lastRow[lastRow.length - 1];
    var cellsData = $(Droptables.container).handsontable('getData', firstCell.split(":")[0], firstCell.split(":")[1], lastCell.split(":")[0], lastCell.split(":")[1]);   
    if (DropChart.helper.hasNumbericRow(cellsData) ) {
        rValid = true;
    }
    
    rCellsData = DropChart.helper.transposeArr(cellsData);    
    if (DropChart.helper.hasNumbericRow(rCellsData) ) {
        cValid = true;
    }
   
    if(rValid && cValid) {
        result = 3 ;
    }else if(rValid) {
        result = 2 ;
    }else if(cValid) {
        result = 1 ;
    }else { // try again with sub cells (ignore first row and column)
        
        rCellsData.shift();
       
        if(rCellsData.length > 0) {
            cellsData = DropChart.helper.transposeArr(rCellsData);
            cellsData.shift();
        } else {
            return false;
        }
        
        if (DropChart.helper.hasNumbericRow(cellsData) ) {
            rValid = true;
        }
        
        if(cellsData.length>0) {
            cellsData = DropChart.helper.transposeArr(cellsData);
            if (DropChart.helper.hasNumbericRow(cellsData) ) {
                cValid = true;
            }
        }else {
             return false;
        }
        
        if(rValid && cValid) {
            result = 3 ;
        } else if(rValid) {
            result = 2 ;
        } else if(cValid) {
            result = 1 ;
        }
    }
          
    return result;
}

DropChart.helper.removeFirstRowColumn = function (cells) {
      cells.shift();
      if(cells.length > 0) {
        cells = DropChart.helper.transposeArr(cells);
        cells.shift();
      }
      
      return cells;
}
DropChart.helper.getEmptyArray = function (len) {
    var result = [];
    for(var i=0; i< len; i++) {
        result[i] = "    ";
    }
    return result;
}

DropChart.helper.convertHex = function(hex,opacity){
    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}

DropChart.helper.ColorLuminance = function(hex, lum) {

	// validate hex string
	hex = String(hex).replace(/[^0-9a-f]/gi, '');
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	lum = lum || 0;

	// convert to decimal and change luminosity
	var rgb = "#", c, i;
	for (i = 0; i < 3; i++) {
		c = parseInt(hex.substr(i*2,2), 16);
		c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
		rgb += ("00"+c).substr(c.length);
	}

	return rgb;
}
