<?php

namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionListsCb;
/**
 * Class for petition list shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionLists {


    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition lists callback.
     *
     * @var object $petition_lists_cb
     */
    private $petition_lists_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_lists_cb = new PetitionListsCb();

        // All Petitions and filter by categories.
        $shortcodes = [
            [
                'tag'      => 'petitions',
                'callback' => [ $this->petition_lists_cb, 'getThePetitions' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
