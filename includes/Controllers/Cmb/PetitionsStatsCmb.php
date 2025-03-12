<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsStatsCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsStatsCmb extends BaseController {

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

				'meta_box_id'      => 'cmb_bwl_petitions_stats', // Unique id of meta box.
				'meta_box_heading' => 'Petition status settings', // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'side',
				'priority'         => 'low',
				'fields'           => [

					'bwl_petition_feat_stats' => [
						'title'         => __( 'Featured petition?', 'bwl_ptmn' ),
						'id'            => 'bwl_petition_feat_stats',
						'name'          => 'bwl_petition_feat_stats',
						'type'          => 'select',
						'value'         => [
							'0' => __( 'No', 'bwl_ptmn' ),
							'1' => __( 'Yes', 'bwl_ptmn' ),
						],
						'default_value' => '',
						'class'         => '',
						'placeholder'   => '',
						'desc'          => '',
					],

					'bwl_petition_success_stats' => [
						'title'         => __( 'Successful petition?', 'bwl_ptmn' ),
						'id'            => 'bwl_petition_success_stats',
						'name'          => 'bwl_petition_success_stats',
						'type'          => 'select',
						'value'         => [
							'0' => __( 'No', 'bwl_ptmn' ),
							'1' => __( 'Yes', 'bwl_ptmn' ),
						],
						'default_value' => '',
						'class'         => '',
						'placeholder'   => '',
						'desc'          => '',
					],

				],
			],

		];

	}
}
