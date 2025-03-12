<?php

function vc_custom_style() {

    $output = '<style type="text/css">.bkb-counter-container{margin: 48px 0 ;}.bkb_counter_icon{font-size: 54px; }.bkb_counter_value{font-size: 32px; line-height: 24px; display: block; margin: 12px 0 0 0; font-weight: bold;}.bkb_counter_title{font-size: 14px; line-height: 48px; text-transform: uppercase;}</style>';

    echo $output;
}

add_action( 'wp_head', 'vc_custom_style' );
