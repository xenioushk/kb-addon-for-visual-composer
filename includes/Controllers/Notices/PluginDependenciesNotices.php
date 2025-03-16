<?php

namespace KAFWPB\Controllers\Notices;

use Xenioushk\BwlPluginApi\Api\Notices\NoticesApi;
use KAFWPB\Callbacks\Notices\NoticeCb;

/**
 * Class PluginNotices
 *
 * This class handles the registration of the plugin admin notices.
 *
 * @package BwlPetitionsManager
 */
class PluginDependenciesNotices {

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

		if ( BWL_PLUGIN_DEPENDENCIES_STATUS === 0 ) {
			return;
		}

		// Initialize API.
		$this->notices_api = new NoticesApi();

		// Initialize callbacks.
		$this->notice_cb = new NoticeCb();

		// Add notices.
		$notices = [];

		if ( ! empty( BWL_PLUGIN_DEPENDENCIES_MSG ) ) {

			foreach ( BWL_PLUGIN_DEPENDENCIES_MSG as $data ) {

					$notice = [
						'callback' => [ $this->notice_cb, 'get_the_notice' ],
						'notice'   => [
							'noticeClass'    => $data['class'] ?? 'error',
							'msg'            => $data['msg'] ?? '',
							'key'            => $data['key'] ?? '',
							'status'         => 0,
							'is_dismissable' => 0,
						],
					];

					$notices[] = $notice;

			}
		}

		$this->notices_api->add_notices( $notices )->register();
	}
}
