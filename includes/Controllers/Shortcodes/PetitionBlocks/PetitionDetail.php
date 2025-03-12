<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionDetailCb;
/**
 * Class for petition detail shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionDetail {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition detail shortcode callback.
     *
     * @var object $petition_detail_cb
     */
    private $petition_detail_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_detail_cb = new PetitionDetailCb();

        // Petition details
        $shortcodes = [
            [
                'tag'      => 'petition_detail',
                'callback' => [ $this->petition_detail_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
