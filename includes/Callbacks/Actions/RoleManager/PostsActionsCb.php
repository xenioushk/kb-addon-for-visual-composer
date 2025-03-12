<?php
namespace KAFWPB\Callbacks\Actions\RoleManager;

use BwlPetitionsManager\Traits\RoleManagerTraits;

/**
 * Class for Petition Role Manager Posts Actions Callbacks.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PostsActionsCb {

	use RoleManagerTraits;

	/**
     * Action callback for disabling dashboard widgets.
     */
	public function limit_users_posts() {

		$current_user      = wp_get_current_user();
		$current_user_role = $current_user->roles[0];

		if ( $current_user_role == BWL_PETITIONS_EXTERNAL_ROLE_ID
				&& isset( $_GET['post_type'] ) &&
				$_GET['post_type'] == BWL_PETITIONS_PLUGIN_POST_TYPE ) {

			$user_post_count = $this->get_current_user_posts_count();
			$max_post_limit  = $this->get_allowed_posts_count();

			if ( $user_post_count >= $max_post_limit ) {

				$location = home_url( '/' ) . 'wp-admin/edit.php?post_type=petitions&&bptm_limit_msg=true';
				wp_safe_redirect( $location );
			}
		}
	}

	/**
	 * Send Notification Email To Petition Author.
	 *
	 * @param object $post Post Object.
	 */
	public function notify_new_petition( $post ) {

		// Send Notification Email Both Site Admin and Petition Author.
		bptm_new_petition_created_notify_email( $post );
	}

	/**
	 * Send Notification Email To Petition Author.
	 *
	 * @param object $post Post Object.
	 */
	public function notify_published_petition( $post ) {

		// Send Notification Email To Petition Author.
		bptm_new_petition_published_notify_email( $post );
	}
}
