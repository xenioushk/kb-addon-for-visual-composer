/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function ($) {

    $(function () {

        if ($(".bkb-counter-container").length > 0) {
            
            var $bkb_counter_container = $('.bkb-counter-container');
            
            var $delay = $bkb_counter_container.data('delay'),
                   $time = $bkb_counter_container.data('time');
            
            $('.bkb_counter_value').counterUp({
                delay: $delay,
                time: $time
            });
            
        }

    });
    
});