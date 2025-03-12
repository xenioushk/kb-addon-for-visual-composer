<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Petition Featured Image Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 26.07.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionFeaturedImageCb {

	public function __construct() {
	}

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
			'posts_per_page' => 1,
		];

		$args['p'] = $id;

		$loop = new \WP_Query( $args );

		$output = '';

		if ( $loop->have_posts() ) :

			while ( $loop->have_posts() ) :

				$loop->the_post();

				$post_id = get_the_ID();
				$output .= get_the_post_thumbnail( $post_id );

			endwhile;

		else :

			// Regular View.
			$output .= '';

		endif;

		wp_reset_query();

		return do_shortcode( $output );
	}
}
