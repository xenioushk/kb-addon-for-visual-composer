<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsLetterSubmitCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsLetterSubmitCmb extends BaseController {

	/**
	 * CMB fields.
	 *
	 * @var cmb
	 */
	public $cmb;

	/**
	 * CMB callback.
	 *
	 * @var cmb_cb
	 */
	public $cmb_cb;

	/**
	 * CMB API.
	 *
	 * @var cmb_api
	 */
	public $cmb_api;

	/**
	 * Plugin post type.
	 *
	 * @var string
	 */
	public $prefix;

	/**
	 * Register methods.
	 */
	public function register() {

		add_action( 'admin_init', [ $this, 'initialize' ] );

	}

	/**
	 * Initialize PluginNotices.
	 */
	public function initialize() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Set the prefix of cmb
		$this->prefix = BWL_PETITIONS_CMB_PREFIX;

		// Set CMB data.
		$this->set_cmb_data();

		// Initialize API.
		$this->cmb_api = new CmbApi();

		$this->cmb_api->set_post_type( $this->plugin_post_type )->add_cmb( $this->cmb )->register();
	}

	/**
	 * Set CMB data.
	 */
	private function set_cmb_data() {
		$this->cmb = [
			[

				'meta_box_id'      => 'cmb_bwl_petition_letter_submit', // Unique id of meta box.
				'meta_box_heading' => 'Petition Submitted To', // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'normal',
				'priority'         => 'high',
				'fields'           => [

					$this->prefix . 'letter_submitted_to_title' => [
						'title'         => __( 'Title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'letter_submitted_to_title',
						'name'          => $this->prefix . 'letter_submitted_to_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],
					$this->prefix . 'letter_submitted_to' => [
						'title'         => esc_attr__( 'Add members', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'letter_submitted_to',
						'name'          => $this->prefix . 'letter_submitted_to',
						'type'          => 'repeatable',
						'field_type'    => 'text',
						'sortable'      => 'true',
						'value'         => '',
						'default_value' => '',
						'placeholder'   => '',
						'desc'          => '',
						'btn_text'      => __( 'Add new row', 'bwl_ptmn' ),
						'label_text'    => __( 'Name', 'bwl_ptmn' ),
					],

				],
			],
		];

	}
}
