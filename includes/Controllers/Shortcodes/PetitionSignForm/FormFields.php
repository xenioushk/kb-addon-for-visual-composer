<?php
namespace KAFWPB\Controllers\Shortcodes\PetitionSignForm;

use BwlPetitionsManager\Api\Shortcodes\ShortcodesApi;
use BwlPetitionsManager\Callbacks\Shortcodes\PetitionSignForm\FormFieldsCb;
/**
 * Class for registering the form fields shortcode.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class FormFields {

    /**
     *  Instance of the shortcodes API.
     *
     * @var object $shortcodes_api
     */
    private $shortcodes_api;

    /**
     *  Instance of the form fields callback.
     *
     * @var object $form_fields_cb
     */
    private $form_fields_cb;

    /**
	 * Register form fields and shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->shortcodes_api = new ShortcodesApi();

        // Initialize callbacks.
        $this->form_fields_cb = new FormFieldsCb();

        $shortcodes = [
            [
                'tag'      => 'bpsff', // Form fields shortcode
                'callback' => [ $this->form_fields_cb, 'get_the_layout' ],
            ],
        ];

        $this->shortcodes_api->add_shortcodes( $shortcodes )->register();
    }
}
