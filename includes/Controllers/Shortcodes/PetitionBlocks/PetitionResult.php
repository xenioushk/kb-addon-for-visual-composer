<?php

namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionResultCb;

/**
 * Class for petition result shortcode.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class PetitionResult {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the PetitionResultCb.
     *
     * @var object $petition_result_cb
     */
    private $petition_result_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_result_cb = new PetitionResultCb();

        // Petition result
        $shortcodes = [
            [
                'tag'      => 'petition_result',
                'callback' => [ $this->petition_result_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
