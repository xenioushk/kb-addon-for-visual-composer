<?php

use BwlKbManager\Base\BaseController;


/*------------------------------  Create Custom Parameters ---------------------------------*/

// Generate param type "kb_cat"

if ( function_exists( 'vc_add_shortcode_param' ) ) {
    // vc_add_shortcode_param('kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_cat_sort.js');
    vc_add_shortcode_param( 'kb_cat', 'cb_kb_cat_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
}

// Function generate param type "number"
function cb_kb_cat_field( $settings, $value ) {

    $baseController = new BaseController();

    // $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = isset( $settings['class'] ) ? $settings['class'] : '';

    if ( ! empty( $value ) ) {

        $explode_value = explode( ',', $value );
    } else {

        $explode_value = [];
    }

    $bkb_category_args = [
        'post_type'        => $baseController->plugin_post_type,
        'taxonomy'         => $baseController->plugin_cpt_tax_category,
        'hide_empty'       => 1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'suppress_filters' => false,
    ];

    if ( defined( 'BKB_WP_POST' ) ) {

        $bkb_category_args['post_type'] = 'post';
        $bkb_category_args['taxonomy']  = 'category';
    }

    $bkb_categories = get_categories( $bkb_category_args );

    $parent_list = [];

    foreach ( $bkb_categories as $category ) :

        $parent_list[ $category->slug ] = $category->name;

    endforeach;

    $selected_list = [];

    // Now we pick those array data which index is cat-1 and cat-2

    if ( count( $explode_value ) > 0 ) {

        foreach ( $explode_value as $key => $value ) {

            if ( in_array( $value, array_keys( $parent_list ) ) ) {
                // echo $parent_list[$value];
                $selected_list[ $value ] = $parent_list[ $value ];
                // echo "<br>";
                unset( $parent_list[ $value ] );
            }
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list">';

    foreach ( $parent_list as $key => $value ) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';

    $selected_list_string = '<ul id="sortable2" class="connectedSortable bkb_connected list bkb_cat">';

    foreach ( $selected_list as $key => $value ) :
        $selected_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $selected_list_string .= '</ul>';
    $output                = '';

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                        ' . $selected_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}


// Generate param type "kb_tags"

if ( function_exists( 'vc_add_shortcode_param' ) ) {
    // vc_add_shortcode_param('kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR.  '/admin/js/bkb_tags_sort.js');
    vc_add_shortcode_param( 'kb_tags', 'cb_kb_tags_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
}

// Function generate param type "number"
function cb_kb_tags_field( $settings, $value ) {

    $baseController = new BaseController();

    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = isset( $settings['class'] ) ? $settings['class'] : '';

    if ( ! empty( $value ) ) {

        $explode_value = explode( ',', $value );
    } else {

        $explode_value = [];
    }

    $bkb_tags_args = [
        'post_type'        => $baseController->plugin_post_type,
        'taxonomy'         => $baseController->plugin_cpt_tax_tags,
        'hide_empty'       => 1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'suppress_filters' => false,
    ];

    if ( defined( 'BKB_WP_POST' ) ) {

        $bkb_tags_args['post_type'] = 'post';
        $bkb_tags_args['taxonomy']  = 'post_tag';
    }

    $bkb_tags = get_categories( $bkb_tags_args );

    $parent_list = [];

    foreach ( $bkb_tags as $tags ) :

        $parent_list[ $tags->slug ] = $tags->name;

    endforeach;

    $selected_list = [];

    // Now we pick those array data which index is cat-1 and cat-2

    if ( count( $explode_value ) > 0 ) {

        foreach ( $explode_value as $key => $value ) {

            if ( in_array( $value, array_keys( $parent_list ) ) ) {

                $selected_list[ $value ] = $parent_list[ $value ];

                unset( $parent_list[ $value ] );
            }
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list">';

    foreach ( $parent_list as $key => $value ) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';

    $selected_list_string = '<ul id="sortable2" class="connectedSortable bkb_connected list bkb_tags">';

    foreach ( $selected_list as $key => $value ) :
        $selected_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $selected_list_string .= '</ul>';
    $output                = '';

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                        ' . $selected_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}

// Generate param type "kb_tabs"

if ( function_exists( 'vc_add_shortcode_param' ) ) {
    // vc_add_shortcode_param('kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_tabs_sort.js');
    vc_add_shortcode_param( 'kb_tabs', 'cb_kb_tabs_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
}

function cb_kb_tabs_field( $settings, $value ) {

    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = isset( $settings['class'] ) ? $settings['class'] : '';

    if ( ! empty( $value ) ) {

        $explode_value = explode( ',', $value );
    } else {

        $explode_value = [ 'featured', 'popular', 'recent' ];
    }

    // Now we pick those array data which index is cat-1 and cat-2
    $parent_list = [];

    if ( count( $explode_value ) > 0 ) {

        foreach ( $explode_value as $key => $value ) {

            $parent_list[ $value ] = ucfirst( $value );
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list bkb_tabs">';

    foreach ( $parent_list as $key => $value ) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';
    $output              = '';

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}


// Generate param type "kb_counter"

if ( function_exists( 'vc_add_shortcode_param' ) ) {
    // vc_add_shortcode_param('kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR .  '/admin/js/bkb_counter_sort.js');
    vc_add_shortcode_param( 'kb_counter', 'cb_kb_counter_field', BKB_VC_PLUGIN_DIR . '/assets/scripts/admin.js' );
}

function cb_kb_counter_field( $settings, $value ) {

    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = isset( $settings['class'] ) ? $settings['class'] : '';

    if ( ! empty( $value ) ) {

        $explode_value = explode( ',', $value );
    } else {

        $explode_value = [ 'total_kb', 'total_cat', 'total_tag', 'total_likes' ];
    }

    // Now we pick those array data which index is cat-1 and cat-2
    $parent_list = [];

    if ( count( $explode_value ) > 0 ) {

        foreach ( $explode_value as $key => $value ) {

            $parent_list[ $value ] = ucfirst( str_replace( '_', ' ', $value ) );
        }
    }

    $parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list bkb_counter">';

    foreach ( $parent_list as $key => $value ) :
        $parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

    $parent_list_string .= '</ul>';
    $output              = '';

    $output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                   </section>';

    $output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

    return $output;
}

/*----- Animation Class ----*/

// For Button.
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_BKB_VC_Animation extends WPBakeryShortCode {

    }
}
