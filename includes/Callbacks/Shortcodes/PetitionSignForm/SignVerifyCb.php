<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionSignForm;

use BwlPetitionsManager\Traits\SignCountTrait;

/**
 * Class for Sign verify callback.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class SignVerifyCb {

	use SignCountTrait;

	/**
	 * Token.
	 *
	 * @var int $token
	 */
	private $token;

	/**
	 * Success message.
	 *
	 * @var string $success_message
	 */
	private $success_message;

	/**
	 * Error message.
	 *
	 * @var string $error_message
	 */
	private $error_message;

	/**
	 * Constructor for the class.
	 */
	public function __construct() {

		$this->set_verify_messages();

	}

	/**
	 * Set the verify messages.
	 */
	private function set_verify_messages() {
		$this->success_message = esc_html__( 'The signature has been successfully verified.', 'bwl_ptmn' );
		$this->error_message   = esc_html__( 'Invalid token provided.', 'bwl_ptmn' );
	}

	/**
	 * Get the verfication message html.
	 *
	 * @param int $status Status.
	 * @return string
	 */
	private function get_the_message( $status = 1 ) {

		if ( $status ) {
			$class = 'alert-success';
			$msg   = $this->success_message;
		} else {
			$class = 'alert-danger';
			$msg   = $this->error_message;
		}

		return "<div class='alert {$class}' role='alert'>{$msg}</div>";
	}

	/**
     * Check the verify token.
     *
     * @param array $atts Shortcode attributes.
     * @return string verification status message.
     */
	public function verify_token( $atts ) {

		$atts = shortcode_atts([
            'id' => '',
		], $atts);

		extract( $atts ); // phpcs:ignore

		// Get The Token ID from the URL
		// match it to the database.

		if ( isset( $_GET['token'] ) && ! empty( $_GET['token'] ) ) {

			$this->token = sanitize_text_field( trim( $_GET['token'] ) );

			$status = $this->verify_token_status();

		} else {
			$status = 0;
		}

		return $this->get_the_message( $status );
	}

	/**
	 * Verify the token status.
	 *
	 * @return int
	 */
	private function verify_token_status() {

		$status = 0;

		if ( empty( $this->token ) || strlen( $this->token ) !== BPTM_VERIFY_TOKEN_LENGTH ) {
			return $status;
		}

		global $wpdb;

		$wp_bwl_petition_data_table = BPTM_DATA_TABLE;

		$bptm_data = $wpdb->get_row( "SELECT id, postid FROM $wp_bwl_petition_data_table WHERE bpt_user_sign_status = '{$this->token}' ", ARRAY_A );

		if ( ! empty( $bptm_data ) && count( $bptm_data ) > 0 ) {

			$row_id           = $bptm_data['id'];
			$petition_id      = $bptm_data['postid'];
			$bwl_total_signed = $this->get_the_total_sign_count( $petition_id ) + 1;

			update_post_meta( $petition_id, BPTM_META_USER_SIGN_COUNT, $bwl_total_signed );

			$wpdb->update(
                $wp_bwl_petition_data_table,
                [
					'bpt_user_sign_status' => 1,
                ],
                [ 'id' => $row_id ],
                [
					'%d',
                ]
			);
			$status = 1;
		}

		return $status;
	}
}
