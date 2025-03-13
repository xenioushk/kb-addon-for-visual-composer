<?php


/*------------------------------  Create Custom Parameters ---------------------------------*/

// Generate param type "kb_cat"

// if ( function_exists( 'vc_add_shortcode_param' ) ) {
// vc_add_shortcode_param('kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_cat_sort.js');
// vc_add_shortcode_param( 'kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
// }

// // Function generate param type "number"
// function cb_kb_cat_field( $settings, $value ) {


// }


// Generate param type "kb_tags"

// if ( function_exists( 'vc_add_shortcode_param' ) ) {
// vc_add_shortcode_param('kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR.  '/admin/js/bkb_tags_sort.js');
// vc_add_shortcode_param( 'kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
// }

// // Function generate param type "number"
// function cb_kb_tags_field( $settings, $value ) {

// }

// Generate param type "kb_tabs"

// if ( function_exists( 'vc_add_shortcode_param' ) ) {
// vc_add_shortcode_param('kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_tabs_sort.js');
// vc_add_shortcode_param( 'kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
// }

// function cb_kb_tabs_field( $settings, $value ) {


// }


// Generate param type "kb_counter"

// if ( function_exists( 'vc_add_shortcode_param' ) ) {
// vc_add_shortcode_param('kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_counter_sort.js');
// vc_add_shortcode_param( 'kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
// }

// function cb_kb_counter_field( $settings, $value ) {


// }

/*----- Animation Class ----*/

// For Button.
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_BKB_VC_Animation extends WPBakeryShortCode {

    }
}
