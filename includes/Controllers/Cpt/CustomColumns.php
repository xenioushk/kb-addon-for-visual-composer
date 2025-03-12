<?php
namespace KAFWPB\Controllers\Cpt;

use BwlPetitionsManager\Traits\SignCountTrait;

/**
 * Custom Columns
 *
 * @package BwlPetitionsManager
 */
class CustomColumns {

    use SignCountTrait;

    /**
     * Post ID.
     *
     * @var int
     */
    private $post_id;

    /**
     * Register the column filters.
     */
    public function register() {
        if ( is_admin() ) {
            add_filter( 'manage_petitions_posts_columns', [ $this, 'columns_header' ] );
            add_action( 'manage_petitions_posts_custom_column', [ $this, 'columns_content' ], 10, 1 );
        }
    }

    /**
     * Add custom columns to the petitions post type.
     *
     * @param array $columns The columns.
     *
     * @return array
     */
    public function columns_header( $columns ) {
        $columns['petitions_category']          = esc_html__( 'Category', 'bwl_ptmn' );
        $columns[ BPTM_META_USER_SIGN_TARGET ]  = esc_html__( 'Target', 'bwl_ptmn' );
        $columns[ BPTM_META_USER_SIGN_COUNT ]   = esc_html__( 'Signed', 'bwl_ptmn' );
        $columns[ BPTM_META_MANUAL_SIGN_COUNT ] = esc_html__( 'Manual Sign', 'bwl_ptmn' );
        $columns['bwl_petition_feat_stats']     = esc_html__( 'Featured', 'bwl_ptmn' );
        $columns['bwl_petition_success_stats']  = esc_html__( 'Completed', 'bwl_ptmn' );

        return $columns;
    }

    /**
     * Add content to the custom columns.
     *
     * @param string $column The column.
     */
    public function columns_content( $column ) {

        // Add A Custom Image Size For Admin Panel.

        global $post;

        $this->post_id = $post->ID;

        switch ( $column ) {

            case 'petitions_category':
                $petitions_category = '';

                $get_petitions_categories = get_the_terms( $post->ID, 'petitions_category' );

                if ( is_array( $get_petitions_categories ) && count( $get_petitions_categories ) > 0 ) {

                    foreach ( $get_petitions_categories as $category ) {

                        $petitions_category .= $category->name . ', ';
                    }

                    echo substr( $petitions_category, 0, strlen( $petitions_category ) - 2 );
                } else {

                    esc_html_e( 'Uncategorized', 'bwl_ptmn' );
                }

                break;

            case BPTM_META_USER_SIGN_TARGET:
                $target = $this->get_the_sign_target_count( $post->ID );

                echo '<div id="_cmb_bptm_sign_target-' . $post->ID . '" >' . $target . '</div>';

                break;

            case BPTM_META_USER_SIGN_COUNT:
                $total_signed = $this->get_the_total_sign_count( $post->ID );

                echo '<div id="_cmb_bptm_sign_lists-' . $post->ID . '" >' . $total_signed . '</div>';

                break;

            case BPTM_META_MANUAL_SIGN_COUNT:
                $manual_signed = $this->get_the_manual_sign_count( $post->ID );

                echo '<div id="_cmb_bptm_manual_sign-' . $post->ID . '" >' . $manual_signed . '</div>';

                break;

            case 'bwl_petition_feat_stats':
                $bwl_petition_feat_stats = ( get_post_meta( $post->ID, 'bwl_petition_feat_stats', true ) == 1 ) ? 1 : 0;

                if ( $bwl_petition_feat_stats == 1 ) {

                    $bwl_petition_feat_stats_text = esc_html__( 'Yes', 'bwl_ptmn' );
                } else {

                    $bwl_petition_feat_stats_text = esc_html__( 'No', 'bwl_ptmn' );
                }

                echo '<div id="bwl_petition_feat_stats-' . $post->ID . '" data-status_code="' . $bwl_petition_feat_stats . '">' . $bwl_petition_feat_stats_text . '</div>';

                break;

            case 'bwl_petition_success_stats':
                $bwl_petition_success_stats = ( get_post_meta( $post->ID, 'bwl_petition_success_stats', true ) == 1 ) ? 1 : 0;

                if ( $bwl_petition_success_stats == 1 ) {

                    $bwl_petition_success_stats_text = esc_html__( 'Yes', 'bwl_ptmn' );
                } else {

                    $bwl_petition_success_stats_text = esc_html__( 'No', 'bwl_ptmn' );
                }

                echo '<div id="bwl_petition_success_stats-' . $post->ID . '" data-status_code="' . $bwl_petition_success_stats . '">' . $bwl_petition_success_stats_text . '</div>';

                break;
        }
    }
}
