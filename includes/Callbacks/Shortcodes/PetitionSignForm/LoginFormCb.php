<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionSignForm;

/**
 * Class for Petition login form callback.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class LoginFormCb {

	/**
     * Retrieves the layout for the login form
     *
     * @param array $atts Shortcode attributes.
     * @return string The layout of login form
     */
	public function get_the_layout( $atts ) {

		$atts = shortcode_atts([
			'redirect' => '',
		], $atts);

		extract( $atts ); // phpcs:ignore

		$form = '';

		if ( ! is_user_logged_in() ) {

			if ( $redirect ) {

					$redirect_url = $redirect;
			} else {

				$redirect_url = get_permalink();
			}

			$args = [
				'echo'           => false,
				'redirect'       => esc_url( $redirect_url ),
				'form_id'        => 'bptm_login_form',
				'label_username' => esc_html__( 'Username', 'bwl_ptmn' ),
				'label_password' => esc_html__( 'Password', 'bwl_ptmn' ),
				'label_remember' => esc_html__( 'Remember Me', 'bwl_ptmn' ),
				'label_log_in'   => esc_html__( 'Log In', 'bwl_ptmn' ),
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'remember'       => true,
				'value_username' => null,
				'value_remember' => false,
			];

			$form = wp_login_form( $args );
		}

		return $form;
	}
}
