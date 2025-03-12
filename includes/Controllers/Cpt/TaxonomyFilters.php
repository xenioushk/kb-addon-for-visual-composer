<?php
namespace KAFWPB\Controllers\Cpt;

use BwlPetitionsManager\Base\BaseController;
/**
 * Class for filtering petition categories
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class TaxonomyFilters extends BaseController {

    /**
     * Register the taxonomy filters.
     */
    public function register() {

        if ( is_admin() ) {
            add_action( 'restrict_manage_posts', [ $this, 'taxonomy_filters_dropdown' ] );
            add_filter( 'parse_query', [ $this, 'taxonomy_filters_query' ] );
        }
    }

    /**
     * Generates and displays a dropdown menu for taxonomy filters.
     *
     * @return void
     */
    public function taxonomy_filters_dropdown() {

        global $typenow;
        $args       = [ 'public' => true, '_builtin' => false ];
        $post_types = get_post_types( $args );
        if ( $typenow === $this->plugin_post_type ) {

            $filters = get_object_taxonomies( $typenow );
            foreach ( $filters as $tax_slug ) {
                $tax_obj = get_taxonomy( $tax_slug );

                if ( isset( $_GET[ $tax_obj->query_var ] ) ) {
                    $selected_value = sanitize_text_field( $_GET[ $tax_obj->query_var ] );
                } else {
                    $selected_value = '';
                }

                wp_dropdown_categories([
                    'show_option_none' => $tax_obj->label,
                    'taxonomy'         => $tax_slug,
                    'name'             => $tax_obj->name,
                    'orderby'          => 'term_order',
                    'selected'         => $selected_value,
                    'hierarchical'     => $tax_obj->hierarchical,
                    'show_count'       => true,
                    'hide_empty'       => false,
                ]);
            }
        }
    }


    /**
     * Modifies the main query to filter posts by selected taxonomy terms.
     *
     * @param WP_Query $query The current WP_Query instance, passed by reference.
     */
    public function taxonomy_filters_query( $query ) {
        global $pagenow;
        global $typenow;
        if ( $pagenow === 'edit.php' && $typenow === $this->plugin_post_type ) {
            $filters = get_object_taxonomies( $typenow );
            foreach ( $filters as $tax_slug ) {
                $var = &$query->query_vars[ $tax_slug ];
                if ( isset( $var ) ) {
                    $term = get_term_by( 'id', $var, $tax_slug );
                    if ( isset( $term->slug ) ) {
                        $var = $term->slug;
                    } else {
                        $var = '';
                    }
                }
            }
        }
    }
}
