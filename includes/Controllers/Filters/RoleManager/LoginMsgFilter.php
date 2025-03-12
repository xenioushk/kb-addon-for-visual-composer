<?php
namespace KAFWPB\Controllers\Filters\RoleManager;

use BwlPetitionsManager\Api\Filters\FiltersApi;
use BwlPetitionsManager\Callbacks\Filters\RoleManager\LoginMsgFilterCb;

/**
 * Class for registering the login message filter.
 *
 * @since: 1.1.5
 * @package BwlPetitionsManager
 */
class LoginMsgFilter {

    /**
     *  Instance of the Filter API.
     *
     * @var object $filters_api
     */
    private $filters_api;

    /**
     *  Instance of the login message filter callback.
     *
     * @var object $login_msg_filter_cb
     */
    private $login_msg_filter_cb;

    /**
	 * Register filters.
	 */
    public function register() {

        // Initialize API.
        $this->filters_api = new FiltersApi();

        // Initialize callbacks.
        $this->login_msg_filter_cb = new LoginMsgFilterCb();

        // Add filters.
        $filters = [
            [
                'tag'      => 'login_message',
                'callback' => [ $this->login_msg_filter_cb, 'get_login_message' ],
            ],
        ];

        $this->filters_api->add_filters( $filters )->register();
    }
}
