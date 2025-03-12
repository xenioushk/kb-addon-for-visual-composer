<?php
namespace KAFWPB\Controllers\Actions;

use BwlPetitionsManager\Api\Actions\ActionsApi;
use BwlPetitionsManager\Callbacks\Actions\PetitionActionsCb;

/**
 * Class for petition actions.
 *
 * @since: 1.1.5
 * @package BwlPetitionsManager
 */
class PetitionActions {

    /**
     *  Instance of the actions API.
     *
     * @var object $actions_api
     */
    private $actions_api;

    /**
     *  Instance of the petition actions callback.
     *
     * @var object $petition_actions_cb
     */
    private $petition_actions_cb;

    /**
	 * Register actions.
	 */
    public function register() {

        // Initialize API.
        $this->actions_api = new ActionsApi();

        // Initialize callbacks.
        $this->petition_actions_cb = new PetitionActionsCb();

        // Add actions.
        $actions = [
            [
                'tag'      => 'bptm_intro_box',
                'callback' => [ $this->petition_actions_cb, 'cb_intro_box' ],
            ],
            [
                'tag'      => 'bptm_about_box',
                'callback' => [ $this->petition_actions_cb, 'cb_about_box' ],
            ],
            [
                'tag'      => 'bptm_send_to_box',
                'callback' => [ $this->petition_actions_cb, 'cb_send_to_box' ],
            ],
            [
                'tag'      => 'bptm_letter_box',
                'callback' => [ $this->petition_actions_cb, 'cb_letter_box' ],
            ],
            [
                'tag'      => 'bptm_sign_box',
                'callback' => [ $this->petition_actions_cb, 'cb_sign_box' ],
            ],
            [
                'tag'      => 'bptm_sign_result',
                'callback' => [ $this->petition_actions_cb, 'cb_sign_result' ],
            ],
            [
                'tag'      => 'bptm_share_box',
                'callback' => [ $this->petition_actions_cb, 'cb_share_box' ],
            ],
        ];

        $this->actions_api->add_actions( $actions )->register();
    }
}
