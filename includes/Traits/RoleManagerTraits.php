<?php
namespace KAFWPB\Traits;

trait RoleManagerTraits {
	/**
	 * Get allowed posts count.
     *
	 * @return int
	 */
	public function get_allowed_posts_count() {

		$petitions_options  = get_option( 'petitions_options' );
			$max_post_limit = isset( $petitions_options['bptm_petition_limit'] ) && ! empty( $petitions_options['bptm_petition_limit'] )
																		? $petitions_options['bptm_petition_limit'] : BWL_PETITIONS_EXTERNAL_MAX_POSTS;

																		return intval( $max_post_limit );
	}

	/**
	 * Get user posts count.
	 *
	 * @return int
	 */
	public function get_current_user_posts_count() {
		$current_user = wp_get_current_user();
		$args         = [
			'author'         => $current_user->ID, // user ID here
			'posts_per_page' => -1, // retrieve all
			'post_type'      => BWL_PETITIONS_PLUGIN_POST_TYPE, // post type (change to your PT)
			'post_status'    => [ 'publish', 'pending', 'draft', 'trash' ],
		];

		$posts = get_posts( $args );
		return count( $posts );
	}
}
