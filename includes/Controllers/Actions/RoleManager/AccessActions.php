<?php
namespace KAFWPB\Controllers\Actions\RoleManager;

use BwlPetitionsManager\Api\Actions\ActionsApi;
use BwlPetitionsManager\Callbacks\Actions\RoleManager\AccessActionsCb;

/**
 * Class for Role manager access actions.
 *
 * @since: 1.1.5
 * @package BwlPetitionsManager
 */
class AccessActions {

    /**
     *  Instance of the actions API.
     *
     * @var object $actions_api
     */
    private $actions_api;

    /**
     *  Instance of the access actions callback.
     *
     * @var object $access_actions_cb
     */
    private $access_actions_cb;

    /**
	 * Register actions.
	 */
    public function register() {

        // Initialize API.
        $this->actions_api = new ActionsApi();

        // Initialize callbacks.
        $this->access_actions_cb = new AccessActionsCb();

        // Add actions.
        $actions = [
            [
                'tag'      => 'wp_dashboard_setup',
                'callback' => [ $this->access_actions_cb, 'disable_dashboard_widgets' ],
            ],
            [
                'tag'      => 'admin_init',
                'callback' => [ $this->access_actions_cb, 'bptm_remove_menu_pages' ],
            ],
            [
                'tag'      => 'current_screen',
                'callback' => [ $this->access_actions_cb, 'bptm_restrict_access' ],
            ],
        ];

        $this->actions_api->add_actions( $actions )->register();
    }
}
