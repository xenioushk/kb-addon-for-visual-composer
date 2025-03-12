<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionAboutCb;
/**
 * Class for petition about shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionAbout {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition about callback.
     *
     * @var object $petition_about_cb
     */
    private $petition_about_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_about_cb = new PetitionAboutCb();

        // Petition about shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_about',
                'callback' => [ $this->petition_about_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
