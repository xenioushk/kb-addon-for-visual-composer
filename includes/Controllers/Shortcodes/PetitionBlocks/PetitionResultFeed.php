<?php

namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionResultFeedCb;

/**
 * Class for petition result feed shortcode.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class PetitionResultFeed {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition result feed shortcode callback.
     *
     * @var object $petition_result_feed_cb
     */
    private $petition_result_feed_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_result_feed_cb = new PetitionResultFeedCb();

		// Petition result
        $shortcodes = [
            [
                'tag'      => 'petition_result_feed',
                'callback' => [ $this->petition_result_feed_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
