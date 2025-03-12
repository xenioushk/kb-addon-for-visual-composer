<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionLetterCb;

/**
 * Class for petition letter shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionLetter {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition letter callback.
     *
     * @var object $petition_letter_cb
     */
    private $petition_letter_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_letter_cb = new PetitionLetterCb();

        // Petition letter shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_letter',
                'callback' => [ $this->petition_letter_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
