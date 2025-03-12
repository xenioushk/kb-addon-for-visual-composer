<?php

namespace KAFWPB\Callbacks\AdminAjaxHandlers\ExternalForm;

use BwlPetitionsManager\Base\BaseController;

/**
 * Class for delete sign callback.
 *
 * @package BwlPetitionsManager
 */
class CheckUserEmail extends BaseController {

	/**
	 * Delete sign data.
	 */
	public function get_the_status() {
		global $wpdb; // this is how you get access to the database
		if ( email_exists( $_POST['bptm_user_email'] ) ) {
			echo json_encode( __( 'Email already registered.', 'bwl_ptmn' ) );
		} else {
			echo json_encode( 'true' );
		}
		die();
	}
}
