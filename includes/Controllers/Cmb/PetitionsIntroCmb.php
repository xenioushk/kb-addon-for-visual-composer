<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsIntroCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsIntroCmb extends BaseController {

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
	 * Initialize Cmb.
	 */
	public function initialize() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Set the prefix of cmb
		$this->prefix = BWL_PETITIONS_CMB_PREFIX;

		// Set CMB data.
		$this->set_cmb_data();

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

				'meta_box_id'      => 'cmb_bwl_petition_intro', // Unique id of meta box.
				'meta_box_heading' => 'Petition Introduction', // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'normal',
				'priority'         => 'high',
				'fields'           => [

					$this->prefix . 'intro_title' => [
						'title'         => esc_attr__( 'Introduction Title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'intro_title',
						'name'          => $this->prefix . 'intro_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'intro_sub_title' => [
						'title'         => esc_attr__( 'Introduction Sub-title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'intro_sub_title',
						'name'          => $this->prefix . 'intro_sub_title',
						'type'          => 'textarea',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

				],
			],

		];
	}
}
