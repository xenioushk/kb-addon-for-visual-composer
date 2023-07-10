<?php

if (!function_exists('vc_bkb_tabs')) {

    add_shortcode('vc_bkb_tabs', 'vc_bkb_tabs');

    function vc_bkb_tabs($atts)
    {

        $atts = shortcode_atts(array(
            'tabs' => 'featured,popular,recent',
            'feat_tab_title' => __('Featured', 'bkb_vc'),
            'popular_tab_title' => __('Popular', 'bkb_vc'),
            'recent_tab_title' => __('Recent', 'bkb_vc'),
            'limit' => 5,
            'bkb_list_type' => 'rounded',
            'vertical' => 0,
            'rtl' => 0,
            'cont_ext_class' => ''
        ), $atts);

        extract($atts);

        $bkb_tabs = explode(',', $tabs);
        $limit = isset($limit) ? (int) $limit : 5;

        $bkb_tab_shortcode_string = '[bkb_tabs vertical=' . $vertical . ' rtl=' . $rtl . ' cont_ext_class=' . $cont_ext_class . ' ]';

        foreach ($bkb_tabs as $tab_key => $tab_title) {

            switch ($tab_title) {

                case 'featured':
                    $bkb_tab_shortcode_string .= '[bkb_tab title="' . $feat_tab_title . '"][bwl_kb bkb_tabify="1" meta_key="bkb_featured_status" meta_value="1" orderby="meta_value_num" order="DESC" limit="' . $limit . '" bkb_list_type="' . $bkb_list_type . '"][/bkb_tab]';
                    break;
                case 'popular':
                    $bkb_tab_shortcode_string .= '[bkb_tab title="' . $popular_tab_title . '"][bwl_kb bkb_tabify="1" meta_key="bkbm_post_views" orderby="meta_value_num" order="DESC" limit="' . $limit . '" bkb_list_type="' . $bkb_list_type . '"][/bkb_tab]';
                    break;
                case 'recent':
                    $bkb_tab_shortcode_string .= '[bkb_tab title="' . $recent_tab_title . '"] [bwl_kb bkb_tabify="1" orderby="ID" order="DESC" limit="' . $limit . '" bkb_list_type="' . $bkb_list_type . '"][/bkb_tab]';
                    break;

                default:
                    break;
            }
        }

        $bkb_tab_shortcode_string .= '[/bkb_tabs]';

        return do_shortcode($bkb_tab_shortcode_string);
    }
}

/*------------------------------ Counter Shortcode ---------------------------------*/

add_shortcode('vc_bkb_counter', 'vc_bkb_counter');

function vc_bkb_counter($atts)
{

    $atts = shortcode_atts(array(
        'counter_delay' => 5,
        'counter_time' => 1000,
        'counter' => 'total_kb,total_cat,total_tag,total_likes',
        'counter_icon_size' => '54',
        'counter_icon_color' => '#0074A2',
        'counter_text_size' => '32',
        'counter_text_color' => '#2C2C2C',
        'counter_title_size' => '14',
        'counter_title_color' => '#525252',
        'title_total_kb' => __('KB Posts', 'bkb_vc'),
        'icon_total_kb' => 'fa fa-home',
        'title_total_cat' => __('KB Categories', 'bkb_vc'),
        'icon_total_cat' => 'fa fa-list',
        'title_total_tag' => __('KB Tags', 'bkb_vc'),
        'icon_total_tag' => 'fa fa-home',
        'title_total_likes' => __('KB Likes', 'bkb_vc'),
        'icon_total_likes' => 'fa fa-thumbs-o-up'
    ), $atts);

    extract($atts);



    $counter_explode = explode(',', $counter);

    // Custom Styleing.

    $counter_icon_style = 'style="font-size:' . $counter_icon_size . 'px; color: ' . $counter_icon_color . ';"';
    $counter_text_style = 'style="font-size:' . $counter_text_size . 'px; color: ' . $counter_text_color . ';"';
    $counter_title_style = 'style="font-size:' . $counter_title_size . 'px; color: ' . $counter_title_color . ';"';


    $output = '<div class="bkbm-grid bkbm-grid-pad text-center bkb-counter-container" data-delay="' . $counter_delay . '" data-time="' . $counter_time . '">';

    foreach ($counter_explode as $type) {

        $title =  ${"title_$type"};
        $icon =  ${"icon_$type"};
        $counter_value =  0;

        if ($type == "total_cat") {

            $counter_value =  wp_count_terms('bkb_category');
        } else if ($type == "total_tag") {

            $counter_value = wp_count_terms('bkb_tags');
        } else if ($type == "total_likes") {

            global $wpdb;
            //    bkb_like_votes_count


            $meta_key = 'bkb_like_votes_count'; //set this to your custom field meta key
            $bkb_total_likes = $wpdb->get_col($wpdb->prepare("
                                                  SELECT sum(meta_value) as total_likes
                                                  FROM $wpdb->postmeta
                                                  WHERE meta_key = %s", $meta_key));

            $counter_value = array_sum($bkb_total_likes);
        } else {

            $count_pages = wp_count_posts('bwl_kb');
            $counter_value = $count_pages->publish;
        }

        $output .= '<div class="bkbcol-1-4">
                           <div class="content">
                               <span class="bkb_counter_icon" ' . $counter_icon_style . '><i class="' . $icon . '"></i></span>
                               <p><span class="bkb_counter_value" ' . $counter_text_style . '>' . $counter_value . '</span><span class="db bkb_counter_title" ' . $counter_title_style . '>' . $title . '</span></p>
                           </div>
                        </div>';
    }

    $output .= '</div>';

    wp_reset_query();


    return $output;
}


function vc_custom_style()
{


    $output = '<style type="text/css">.bkb-counter-container{margin: 48px 0 ;}.bkb_counter_icon{font-size: 54px; }.bkb_counter_value{font-size: 32px; line-height: 24px; display: block; margin: 12px 0 0 0; font-weight: bold;}.bkb_counter_title{font-size: 14px; line-height: 48px; text-transform: uppercase;}</style>';

    echo $output;
}

add_action('wp_head', 'vc_custom_style');


// KB Posts.

add_shortcode('vc_bkb_posts', 'vc_bkb_posts');

function vc_bkb_posts($atts)
{

    $atts = shortcode_atts(array(
        'kb_type' => 'recent', //recent,popular,featured,random
        'kb_type_title' => '',
        'kb_type_title_status' => 1,
        'meta_key'         => '',
        'meta_value'         => '',
        'orderby'         => 'ID',
        'order'            => 'DESC',
        'limit'              => -1,
        'bkb_tabify'    => 0,
        'bkb_list_type' => '', // rectangle/iconized/rounded/none
        'suppress_filters' => 0,
        'show_title' => 1,
        'paginate' => 0, // Pagination introduced in version 1.0.1 of Templify Addon default is 0
        'posts_per_page' => 5,
        'paged' => 1,
        'animation' => '',
        'cont_ext_class' => ''
    ), $atts);

    extract($atts);

    $output = "";
    $bkb_posts_wrapper_start = "";
    $bkb_posts_wrapper_end = "";

    // Added in version 1.0.7

    $bkb_post_column_animation = "";

    $cont_ext_class = (isset($cont_ext_class) && $cont_ext_class != "") ?  " " . $cont_ext_class : '';

    $wrapper_div_status = 0;

    if (isset($cont_ext_class) && $cont_ext_class != "") {

        $wrapper_div_status = 1;
    }

    if (isset($animation) && $animation != "" && defined('WPB_VC_VERSION')) {

        $wrapper_div_status = 1;

        if (isset($animation) && $animation != "") {
            $animate_class = new WPBakeryShortCode_BKB_VC_Animation(array('base' => 'vc_bkb_posts'));
            $bkb_post_column_animation = " " . $animate_class->getCSSAnimation($animation);
        }
    }

    if ($wrapper_div_status == 1) {

        $bkb_posts_wrapper_start .= '<div class="' . $bkb_post_column_animation . $cont_ext_class . '">';
    }

    // Start Inner Code.

    if ("popular" == trim($kb_type)) {

        $kb_type_title = ($kb_type_title == "") ? __('Popular KB', 'bkb_vc') : $kb_type_title;

        $output .= do_shortcode('[bwl_kb bkb_tabify="1" bkb_list_type="' . $bkb_list_type . '" meta_key="bkbm_post_views" orderby="meta_value_num" order="DESC" limit="' . $posts_per_page . '" paginate="' . $paginate . '" posts_per_page="' . $posts_per_page . '"]');
    } else if ("featured" == trim($kb_type)) {

        $kb_type_title = ($kb_type_title == "") ? __('Featured KB', 'bkb_vc') : $kb_type_title;

        $output .= do_shortcode('[bwl_kb bkb_tabify="1" bkb_list_type="' . $bkb_list_type . '" meta_key="bkb_featured_status" meta_value="1" orderby="meta_value_num" order="DESC" limit="' . $posts_per_page . '" paginate="' . $paginate . '" posts_per_page="' . $posts_per_page . '"]');
    } else if ("random" == trim($kb_type)) {

        $kb_type_title = ($kb_type_title == "") ? __('Random KB', 'bkb_vc') : $kb_type_title;

        $output .= do_shortcode('[bwl_kb bkb_tabify="1" bkb_list_type="' . $bkb_list_type . '" orderby="rand" limit="' . $posts_per_page . '" paginate="' . $paginate . '" posts_per_page="' . $posts_per_page . '"]');
    } else {

        $kb_type_title = ($kb_type_title == "") ? __('Recent KB', 'bkb_vc') : $kb_type_title;

        $output .= do_shortcode('[bwl_kb bkb_tabify="1" bkb_list_type="' . $bkb_list_type . '" orderby="ID" order="DESC" limit="' . $posts_per_page . '" paginate="' . $paginate . '" posts_per_page="' . $posts_per_page . '"]');
    }


    if ($kb_type_title_status == 1) {

        $kb_type_title_string = '<h2 class="bwl-kb-type-title">' . $kb_type_title . '</h2>';

        $output = $kb_type_title_string . $output;
    }


    // Finish Wrapper Div.

    if ($wrapper_div_status == 1) {

        $bkb_posts_wrapper_end .= '</div>';
    }

    return $bkb_posts_wrapper_start . $output . $bkb_posts_wrapper_end;
}
