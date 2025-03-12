<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsFormCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsFormCmb extends BaseController {

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

				'meta_box_id'      => 'cmb_petition_form_fields', // Unique id of meta box.
				'meta_box_heading' => 'Petition Sign Form & Result Settings', // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'normal',
				'priority'         => 'high',
				'fields'           => [

					$this->prefix . 'form_title' => [
						'title'         => __( 'Form Title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'form_title',
						'name'          => $this->prefix . 'form_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'form_sub_title' => [
						'title'         => __( 'Form Sub-title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'form_sub_title',
						'name'          => $this->prefix . 'form_sub_title',
						'type'          => 'textarea',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'result_ticker_title' => [
						'title'         => __( 'Result Ticker Heading', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'result_ticker_title',
						'name'          => $this->prefix . 'result_ticker_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => __( 'Text will display before signed ticker list.', 'bwl_ptmn' ),
					],

					$this->prefix . 'result_title' => [
						'title'         => __( 'Result Suffix Text', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'result_title',
						'name'          => $this->prefix . 'result_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => __( 'Text will display right side of total signed count.', 'bwl_ptmn' ),
					],

					$this->prefix . 'result_sub_title' => [
						'title'         => __( 'Result Sub title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'result_sub_title',
						'name'          => $this->prefix . 'result_sub_title',
						'type'          => 'textarea',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => __( 'Text will display below the total signed count.', 'bwl_ptmn' ),
					],

				],
			],

		];
	}
}
