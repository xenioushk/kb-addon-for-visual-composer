<?php

namespace KAFWPB\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;

/**
 * Class for frontend ajax handlers.
 *
 * @package KAFWPB
 * @since: 1.1.0
 * @author: Mahbub Alam Khan
 */
class FrontendAjaxHandlers {

	/**
	 * Instance of the ajax handlers API.
	 *
	 * @var object $ajax_handlers_api AjaxHandlersApi.
	 */
	public $ajax_handlers_api;

	/**
	 * Register frontend ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api = new AjaxHandlersApi();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$ajax_requests = [];

		$this->ajax_handlers_api->add_ajax_handlers( $ajax_requests )->register();
	}
}
