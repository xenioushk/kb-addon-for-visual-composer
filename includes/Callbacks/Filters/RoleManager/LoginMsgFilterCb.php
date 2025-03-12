<?php
namespace KAFWPB\Callbacks\Filters\RoleManager;

/**
 * Class for Role Manager login message filters callbacks.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class LoginMsgFilterCb {

	/**
	 * Get the login message.
	 *
	 * @param string $message login message.
	 */
	public function get_login_message( $message ) {

		if ( empty( $message ) && isset( $_REQUEST['redirect_to'] )
				&& ( strpos( $_REQUEST['redirect_to'], 'bptm_msg' ) !== false ) ) {
			$msg          = esc_html__( 'We sent username and password to your email address. Please check inbox/spam/junk folder and thank you !', 'bwl_ptmn' );
			$custom_style = 'border: 1px solid #CCCCCC; padding: 5px; text-align: center; background: #fafafa;';
			return "<p class='bwl_ptmn_login_msg' style='{$custom_style}'>{$msg}</p>";
		} else {
			return $message;
		}
	}
}
