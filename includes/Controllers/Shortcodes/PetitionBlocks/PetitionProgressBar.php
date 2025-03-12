<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionBlocks;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionBlocks\PetitionProgressBarCb;
/**
 * Class for petition progress bar shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionProgressBar {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition progress bar shortcode callback.
     *
     * @var object $petition_progress_bar_cb
     */
    private $petition_progress_bar_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_progress_bar_cb = new PetitionProgressBarCb();

		// Petition progress bar shortcode
        $shortcodes = [
            [
                'tag'      => 'petition_progress_bar',
                'callback' => [ $this->petition_progress_bar_cb, 'getTheLayout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
