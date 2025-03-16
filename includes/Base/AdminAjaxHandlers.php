<?php
namespace KAFWPB\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
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
	 * Register admin ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api = new AjaxHandlersApi();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$adminAjaxRequests = [];

		$this->ajax_handlers_api->add_ajax_handlers( $adminAjaxRequests )->register();
	}
}
