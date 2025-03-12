<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionSubmitToCb;

/**
 * Class for petition submit to shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionSubmitTo {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition submit to callback.
     *
     * @var object $petition_submit_to_cb
     */
    private $petition_submit_to_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_submit_to_cb = new PetitionSubmitToCb();

        // Petition submit to shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_submit_to',
                'callback' => [ $this->petition_submit_to_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
