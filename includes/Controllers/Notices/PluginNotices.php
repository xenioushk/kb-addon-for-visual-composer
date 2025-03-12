<?php

namespace KAFWPB\Controllers\Notices;

use BwlPetitionsManager\Api\Notices\NoticesApi;
use BwlPetitionsManager\Callbacks\Notices\NoticeCb;
use BwlPetitionsManager\Traits\RoleManagerTraits;

/**
 * Class PluginNotices
 *
 * This class handles the registration of the plugin admin notices.
 *
 * @package BwlPetitionsManager
 */
class PluginNotices {

	use RoleManagerTraits;

	/**
	 * Notice callback.
	 *
	 * @var notice_cb
	 */
	public $notice_cb;

	/**
	 * Notices API.
	 *
	 * @var notices_api
	 */
	public $notices_api;

	/**
	 * Register notices.
	 */
	public function register() {

		add_action( 'admin_init', [ $this, 'initialize' ] );

	}

	/**
	 * Initialize Plugin Notices.
	 */
	public function initialize() {

		// Initialize API.
		$this->notices_api = new NoticesApi();

		// Initialize callbacks.
		$this->notice_cb = new NoticeCb();

		// Add notices.
		$notices = [
			[
				'callback' => [ $this->notice_cb, 'get_the_notice' ],
				'notice'   => [
					'noticeClass'    => 'error',
					'msg'            => $this->get_the_post_limit_create_msg(),
					'key'            => 'bptm_post_create_limit',
					'status'         => (int) get_option( 'bptm_post_create_limit' ),
					'is_dismissable' => 0,
					'user_roles'     => [ BWL_PETITIONS_EXTERNAL_ROLE_ID ],
				],
			],
		];

		$this->notices_api->add_notices( $notices )->register();
	}

	/**
	 * Get the post limit create message.
	 *
	 * @return string
	 */
	private function get_the_post_limit_create_msg() {

		$current_user_roles = wp_get_current_user()->roles;

		if ( ! in_array( BWL_PETITIONS_EXTERNAL_ROLE_ID, $current_user_roles, true ) ) {
			return '';
		}
		$user_post_count = $this->get_current_user_posts_count();
		$max_post_limit  = $this->get_allowed_posts_count();
		$current_screen  = get_current_screen();
		if ( $user_post_count >= $max_post_limit ) {
			// translators: %1$d is the maximum number of petitions.
			$msg = sprintf( esc_html__( 'You are allowed to create maximum %1$d petition(s).', 'bwl_ptmn' ), $max_post_limit );
			return "<span class='dashicons dashicons-megaphone bwl_plugins_notice_text--error'></span>  {$msg}";
		} else {
			return '';
		}

	}
}
