<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionSignForm;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionSignForm\SignVerifyCb;
/**
 * Class for registering the country lists shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class SignVerify {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the country lists callback.
     *
     * @var object $sign_verify_cb
     */

    public $sign_verify_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->sign_verify_cb = new SignVerifyCb();

        $shortcodes = [
            [
                'tag'      => 'bptm_verify_sign',
                'callback' => [ $this->sign_verify_cb, 'verify_token' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
