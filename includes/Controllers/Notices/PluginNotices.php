<?php

namespace KAFWPB\Controllers\Notices;

use KAFWPB\Api\Notices\NoticesApi;
use KAFWPB\Callbacks\Notices\NoticeCb;

/**
 * Class PluginNotices
 *
 * This class handles the registration of the plugin admin notices.
 *
 * @package BwlPetitionsManager
 */
class PluginNotices {

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

		if ( BWL_PLUGIN_DISPLAY_NOTICE === 0 ) {
			return;
		}

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
					'msg'            => 'hello',
					'key'            => 'bptm_post_create_limit',
					'status'         => (int) get_option( 'bptm_post_create_limit' ),
					'is_dismissable' => 0,
				],
			],
		];

		$this->notices_api->add_notices( $notices )->register();
	}
}
