<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionSignForm;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionSignForm\CountryListsCb;
/**
 * Class for registering the country lists shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class CountryLists {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the country lists callback.
     *
     * @var object $country_lists_cb
     */

    public $country_lists_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->country_lists_cb = new CountryListsCb();

        $shortcodes = [
            [
                'tag'      => 'bpm_cl',
                'callback' => [ $this->country_lists_cb, 'get_the_layout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
