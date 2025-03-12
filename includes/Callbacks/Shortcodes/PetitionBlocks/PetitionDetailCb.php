<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Detail Layout
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionDetailCb {

	/**
	 * Get the layout of the petition detail.
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string
	 */
	public function getTheLayout( $atts ) {
		extract(shortcode_atts([
			'id'                => '',
			'post_type'         => 'petitions',
			'meta_key'          => '',
			'meta_value'        => '',
			'orderby'           => 'ID',
			'order'             => 'ASC',
			'limit'             => -1,
			'petition_category' => '',
			'posts_count'       => 0,
			'column'            => '3',
			'currency'          => '$',
			'desc_length'       => 12,
		], $atts));

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		$args = [
			'post_status'    => 'publish',
			'post_type'      => $post_type,
			'orderby'        => $orderby,
			'order'          => $order,
			'posts_per_page' => $limit,
		];

		$args['p'] = $id;

		$loop = new \WP_Query( $args );

		$output = '<div class="row">';

		if ( $loop->have_posts() ) :

			while ( $loop->have_posts() ) :

				$loop->the_post();
				$output .= nl2br( get_the_content() );

			endwhile;

		else :

			$noItemMsg = esc_html__( 'Sorry, no petition item is available!', 'bwl_ptmn' );
			$output   .= "<p>{$noItemMsg}</p>";

		endif;

		wp_reset_postdata();

		return do_shortcode( $output );
	}
}
