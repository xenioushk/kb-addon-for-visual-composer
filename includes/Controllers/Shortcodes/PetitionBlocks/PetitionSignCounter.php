<?php


namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionSignCounterCb;
/**
 * Class for petition sign counter shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionSignCounter {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition sign counter callback.
     *
     * @var object $petition_sign_counter_cb
     */
    public $petition_sign_counter_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_sign_counter_cb = new PetitionSignCounterCb();

		// Petition result counter
        $shortcodes = [
            [
                'tag'      => 'petition_result_counter',
                'callback' => [ $this->petition_sign_counter_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
