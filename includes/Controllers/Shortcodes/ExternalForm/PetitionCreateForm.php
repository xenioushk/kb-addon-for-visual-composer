<?php
namespace KAFWPB\Controllers\Shortcodes\ExternalForm;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\ExternalForm\PetitionCreateFormCb;
/**
 * Class for petition create form shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionCreateForm {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the petition create form callback.
     *
     * @var object $petition_create_form_cb
     */
    private $petition_create_form_cb;

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->petition_create_form_cb = new PetitionCreateFormCb();

        // Petition about shortcode
        $shortcodes = [
            [
                'tag'      => 'bptm_external_form',
                'callback' => [ $this->petition_create_form_cb, 'get_the_layout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
