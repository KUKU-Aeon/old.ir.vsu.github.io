(function($) {
    function posRestable(id_table) {
        var tblWidth =  $("#droptablesTbl"+id_table).width();
        var resTableWidth = $("#droptablestable" + id_table + " .restableOverflow").width();               
        var tblPos =  $("#droptablesTbl" + id_table).offset();                                                 
        if(resTableWidth > tblWidth) {           
            $("#droptablestable" + id_table+ " .restableMenu").offset( {left: tblPos.left + tblWidth - 20} );
            $("#droptablestable" + id_table+ " .restableMenu").css("right", "auto" );    
        } else {
            $("#droptablestable" + id_table+ " .restableMenu").css("left", "auto" );
            $("#droptablestable" + id_table+ " .restableMenu").css("right", "0" );                      
        } 
    }

    jQuery(document).ready(function($) {
        
        $(".droptablesresponsive.droptablestable table").each(function( index ) {
            var id_table = $(this).data('id'); 
            var hideCols= parseInt($(this).data('hidecols')); 
            if(hideCols) {
              
                 $("#droptablesTbl" + id_table ).restable({  
                    type: "hideCols", 
                    priority: $(this).data('priority')
                 });               
                 posRestable(id_table) ;  

                $(window).on("resize", function() {     
                       posRestable(id_table) ;                  
                });
            }else {
                $("#droptablesTbl" + id_table).restable();      
            }
            
        });
        
        $(".droptables_tooltip").mouseenter(function () {

            if ($(this).parent().find(".droptables_tooltipcontent_show").length == 0) {

                var curPos = $(this).position();
                $(this).parent().prepend('<span class="droptables_tooltipcontent_show" style="">' + $(this).find(".droptables_tooltipcontent").html() + '</span>');
                $curTT = $(this).parent().find(".droptables_tooltipcontent_show");
                curTT_left = (curPos.left - $curTT.width() / 2 + $(this).width() / 2);
                $curTT.stop(true, true).css("margin-top", "-" + ($curTT.height() + 15) + "px").css("left", curTT_left + "px");
            }

            $(this).parent().find(".droptables_tooltipcontent_show").fadeIn();
        });
        $(".droptables_tooltip").mouseleave(function () {
            $(this).siblings("span.droptables_tooltipcontent_show").fadeOut();
        });


        $(".droptablestable .fxdHdrCol").each(function( index ) {
            fixedRows = parseInt($(this).data('freeze-rows'));
            fixedCols =  parseInt($(this).data('freeze-cols')); 
           
            tblHeight = $(this).height() + 20;
            confgiHeight = parseInt($(this).data('table-height'));
            if(!confgiHeight) confgiHeight = 500;
            if(tblHeight > confgiHeight) {
                tblHeight = confgiHeight;
            }
            tblSort = ( $(this).hasClass('sortable'))? true: false;
            $(this).fxdHdrCol({
                fixedCols: fixedCols,
                fixedRows: fixedRows,
                width:     "100%",
                height:    tblHeight,
                sort: tblSort
            }); 
        });
        
        $(".droptablestable .filterable").each(function( index ) {
                $(this).tablesorter({
                    theme: "bootstrap",
                    widthFixed: true,
                    headerTemplate: '{content} {icon}',
                    widgets: ["uitheme", "filter", "zebra"],
                })
                if(!$(this).hasClass('disablePager')) {
                    $(this).tablesorterPager({
                        container: $(".ts-pager"),
                        cssGoto: ".pagenum",
                        size: $(this).data('pagesize'),
                        savePages: false,
                        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
                    });
                }
        });
        
        $(".droptablestable .enablePager").each(function( index ) {
           
             $(this).tablesorter({
                    theme: "bootstrap",
                    widthFixed: true,
                    headerTemplate: '{content} {icon}',
                    widgets: ["uitheme", "zebra"],
                })
               .tablesorterPager({
                        container: $(".ts-pager"),
                        cssGoto: ".pagenum",
                        size: $(this).data('pagesize'),
                        savePages: false,
                        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
                    });
        });
        
    })
    
})( jQuery );    