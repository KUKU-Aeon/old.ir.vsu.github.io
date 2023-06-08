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
(function($) {
    $(window).load(function(){
        $( window ).resize(function() {
            checkOverflow();
        });
        (checkOverflow = function(){
            $("div.droptablesresponsive").each(function(){
                if($(this).prop('offsetWidth') < $(this).prop('scrollWidth')){
                        $(this).addClass('droptablesoverflow');
                }
                else{
                  $(this).removeClass('droptablesoverflow');
                }
            });
        })();
    });

})(jQuery);
