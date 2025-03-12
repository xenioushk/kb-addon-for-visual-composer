<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsTargetCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsTargetCmb extends BaseController {

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

				'meta_box_id'      => 'cmb_petition_target_result_fields', // Unique id of meta box.
				'meta_box_heading' => esc_attr__( 'Petition Sign Target Settings', 'bwl_ptmn' ), // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'normal',
				'priority'         => 'high',
				'fields'           => [

					$this->prefix . 'sign_target' => [
						'title'         => esc_attr__( 'Sign Target', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'sign_target',
						'name'          => $this->prefix . 'sign_target',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat bptm_num',
						'placeholder'   => '',
						'desc'          => '',
					],
					$this->prefix . 'manual_sign' => [
						'title'         => esc_attr__( 'Manual Signs', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'manual_sign',
						'name'          => $this->prefix . 'manual_sign',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat bptm_num',
						'placeholder'   => '',
						'desc'          => __( 'Assign fake sign counts in here, and the number will be added to the original sign counts.', 'bwl_ptmn' ),
					],

				],
			],

		];
	}
}
