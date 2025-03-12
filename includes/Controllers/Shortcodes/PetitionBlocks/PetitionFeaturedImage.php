<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionFeaturedImageCb;

/**
 * Class for petition featured image shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionFeaturedImage {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the peatured image callback.
     *
     * @var object $petition_featured_image_cb
     */

    private $petition_featured_image_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_featured_image_cb = new PetitionFeaturedImageCb();

        // Petition featured image shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_image',
                'callback' => [ $this->petition_featured_image_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
