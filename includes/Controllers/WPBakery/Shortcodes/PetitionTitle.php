<?php
namespace KAFWPB\Controllers\WPBakery\Shortcodes;

use BwlPetitionsManager\Api\WPBakery\WPBShortcodesApi;
use BwlPetitionsManager\Callbacks\WPBakery\Shortcodes\PetitionTitleCb;
/**
 * Class for petition title field shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionTitle {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $wpb_shortcodes_api
     */
    private $wpb_shortcodes_api;

    /**
     *  Instance of the petition title field callback.
     *
     * @var object $petition_title_cb
     */
    private $petition_title_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->wpb_shortcodes_api = new WPBShortcodesApi();

        // Initialize callbacks.
        $this->petition_title_cb = new PetitionTitleCb();

        // Petition about shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_title',
                'callback' => [ $this->petition_title_cb, 'cb_petition_title_field' ],
            ],
        ];

        $this->wpb_shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
