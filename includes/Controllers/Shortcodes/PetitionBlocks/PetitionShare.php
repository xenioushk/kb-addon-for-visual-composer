<?php

namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionShareCb;

/**
 * Class for petition share shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionShare {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition share shortcode callback.
     *
     * @var object $petition_share_cb
     */
    private $petition_share_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_share_cb = new PetitionShareCb();

        // Petition share shortcodes
        $shortcodes = [
            [
                'tag'      => 'petition_share',
                'callback' => [ $this->petition_share_cb, 'getTheLayout' ],
            ],
            [
                'tag'      => 'share_it',
                'callback' => [ $this->petition_share_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
