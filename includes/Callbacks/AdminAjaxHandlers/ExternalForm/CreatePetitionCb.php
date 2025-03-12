<?php

namespace KAFWPB\Callbacks\AdminAjaxHandlers\ExternalForm;

use BwlPetitionsManager\Base\BaseController;

/**
 * Class for delete sign callback.
 *
 * @package BwlPetitionsManager
 */
class CreatePetitionCb extends BaseController {

	/**
	 * Delete sign data.
	 */
	public function save() {

		check_ajax_referer( 'bptm-frontend-petition-create-nonce', '_wpnonce_frontend_petition_create' );

		if ( isset( $_POST['action'] ) && $_POST['action'] == 'bptm_external_petition' ) {

			// Do Everything inside this condition.

			$email_address  = $_REQUEST['bptm_user_email'];
			$bptm_user_name = $_REQUEST['bptm_user_name'];

			if ( null == username_exists( $email_address ) ) {

				// Generate the password and create the user
				$password = wp_generate_password( 12, false );
				$user_id  = wp_create_user( $email_address, $password, $email_address );

				// Set the nickname
				wp_update_user(
                    [
						'ID'       => $user_id,
						'nickname' => $bptm_user_name,
                    ]
				);

				// Set the role
				$user = new WP_User( $user_id );
				$user->set_role( 'bwl_ptmn_external' ); // External Petition Creator Custom User Role.
				// A new user registration notification is also sent to admin email.
				wp_new_user_notification( $user_id );

				// Email the user

				bptm_sent_login_info( $bptm_user_name, $email_address, $password );

				$post_type        = 'petitions';
				$hierarchical_tax = [ 6, 23 ]; // Array of tax ids.
				$post             = [
					'post_title'  => wp_filter_post_kses( $_REQUEST['bptm_petition_title'] ),
					'post_status' => 'pending', // Choose: publish, preview, future, etc.
					'post_type'   => $post_type, // Use a custom post type if you want to
					'post_author' => $user_id,
				];

				$post_id = wp_insert_post( $post );

				// Update Few Post Meta.
				// Added in version 1.0.3

				$intro_title = BWL_PETITIONS_CMB_PREFIX . 'intro_title';
				$about_desc  = BWL_PETITIONS_CMB_PREFIX . 'about_desc';
				$sign_target = BPTM_META_USER_SIGN_TARGET;

				update_post_meta( $post_id, $intro_title, wp_filter_post_kses( $_REQUEST['bptm_petition_title'] ) );
				update_post_meta( $post_id, $about_desc, wp_filter_post_kses( $_REQUEST['bptm_petition_desc'] ) );
				update_post_meta( $post_id, $sign_target, 1 );

				// Send Notification Email Both Site Admin and Petition Author.
				bptm_new_petition_created_notify_email( $post_id );

				// Redirect user to newly created petition edit page.
				$redirect_url = site_url( '/' ) . 'wp-admin/post.php?post=' . $post_id . '&action=edit&bptm_msg=true';
				wp_safe_redirect( $redirect_url );
				exit;
			} // end if
		} else {

			// Something is going wrong.

		}
	}
}
