<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionIntroCb;

/**
 * Class for petition intro shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionIntro {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition intro callback.
     *
     * @var object $petition_intro_cb
     */
    private $petition_intro_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_intro_cb = new PetitionIntroCb();

        // Petition introduction shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_intro',
                'callback' => [ $this->petition_intro_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
