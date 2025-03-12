<?php
namespace KAFWPB\Callbacks\Actions\RoleManager;

/**
 * Class for Petition Role Manager Actions Callbacks.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class AccessActionsCb {

	/**
     * Action callback for disabling dashboard widgets.
     */
	public function disable_dashboard_widgets() {

		if ( current_user_can( BWL_PETITIONS_EXTERNAL_ROLE_ID ) ) {

			global $wp_meta_boxes;

			unset( $wp_meta_boxes['dashboard'] );
		}
	}

	/**
	 * Action callback for removing menu pages.
	 */
	public function bptm_remove_menu_pages() {

		if ( current_user_can( BWL_PETITIONS_EXTERNAL_ROLE_ID ) && ! current_user_can( 'update_core' ) ) {

			// remove_menu_page('tools.php');
			// remove_menu_page('edit.php');

			// Remove unnecessary menus
			$menus_to_stay = [
				// Dashboard
				'index.php',
				// Users
				'profile.php',
				'edit.php?post_type=petitions',
			];

			foreach ( $GLOBALS['menu'] as $key => $value ) {
				if ( ! in_array( $value[2], $menus_to_stay,true ) ) {
					remove_menu_page( $value[2] );
				}
			}

			$bptm_allowed_access = [
				'/appeal/wp-admin/edit.php',
			];

			foreach ( $bptm_allowed_access as $allowed_access ) {

				if ( $_SERVER['PHP_SELF'] != $allowed_access ) {
					// wp_redirect(admin_url().'edit.php?post_type=petitions');
					// exit;
				}
			}
		}
	}

	/**
	 * Action callback for restricting access.
	 *
	 * @param object $query WP_Query object.
	 */
	public function bptm_restrict_access( $query ) { // phpcs:ignore

		if ( is_admin() ) {

			if ( current_user_can( BWL_PETITIONS_EXTERNAL_ROLE_ID ) && ! current_user_can( 'update_core' ) ) {
				require_once ABSPATH . 'wp-admin/includes/screen.php';
				$screen = get_current_screen();

				$bptm_disallowed_access = [
					'post',
					'edit-post',
				];

				if ( in_array( $screen->id, $bptm_disallowed_access,true ) ) {
					wp_safe_redirect( admin_url( 'edit.php?post_type=petitions' ) );
					exit;
				}
			}
		}
	}
}
