<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionSignForm;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionSignForm\LoginFormCb;
/**
 * Class for registering the login form shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class LoginForm {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the login form callback.
     *
     * @var object $login_form_cb
     */

    public $login_form_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->login_form_cb = new LoginFormCb();

        $shortcodes = [
            [
                'tag'      => 'bptm_login_form',
                'callback' => [ $this->login_form_cb, 'get_the_layout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
