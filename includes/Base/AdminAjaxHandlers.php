<?php
namespace KAFWPB\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use KAFWPB\Callbacks\AdminAjaxHandlers\PluginInstallationCb;
/**
 * Class for admin ajax handlers.
 *
 * @package KAFWPB
 */
class AdminAjaxHandlers {
	/**
	 * Ajax handlers api.
	 *
	 * @var object $ajax_handlers_api
	 */
	public $ajax_handlers_api;

	/**
	 * Plugin installation callback
	 *
	 * @var object $plugin_installation_cb
	 */
	public $plugin_installation_cb;

	/**
	 * Register admin ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api      = new AjaxHandlersApi();
		$this->plugin_installation_cb = new PluginInstallationCb();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$adminAjaxRequests = [
			[
				'tag'      => 'bwl_installation_counter',
				'callback' => [ $this->plugin_installation_cb, 'save' ],
			],
		];

		$this->ajax_handlers_api->add_ajax_handlers( $adminAjaxRequests )->register();
	}
}
