<?php

namespace KAFWPB\Controllers\Cmb;

use BwlPetitionsManager\Api\Cmb\CmbApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class PetitionsAboutCmb
 *
 * This class handles the registration of the plugin admin Cmb.
 *
 * @package BwlPetitionsManager
 */
class PetitionsAboutCmb extends BaseController {

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
	 * Register PluginNotices.
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
				'meta_box_id'      => 'cmb_bwl_petition_about', // Unique id of meta box.
				'meta_box_heading' => 'Petition About', // That text will be show in meta box head section.
				'post_type'        => $this->plugin_post_type,
				'context'          => 'normal',
				'priority'         => 'high',
				'fields'           => [

					$this->prefix . 'about_title' => [
						'title'         => esc_attr__( 'About title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'about_title',
						'name'          => $this->prefix . 'about_title',
						'type'          => 'text',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'about_sub_title' => [
						'title'         => esc_attr__( 'About sub title', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'about_sub_title',
						'name'          => $this->prefix . 'about_sub_title',
						'type'          => 'textarea',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'about_desc' => [
						'title'         => esc_attr__( 'About Description', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'about_desc',
						'name'          => $this->prefix . 'about_desc',
						'type'          => 'wpeditor',
						'value'         => '',
						'default_value' => '',
						'class'         => 'wide-fat',
						'placeholder'   => '',
						'desc'          => '',
					],

					$this->prefix . 'about_feat_img'  => [
						'title'         => esc_attr__( 'About Featured Image', 'bwl_ptmn' ),
						'id'            => $this->prefix . 'about_feat_img',
						'name'          => $this->prefix . 'about_feat_img',
						'type'          => 'upload',
						'value'         => '',
						'default_value' => '',
						'placeholder'   => '',
						'desc'          => '',
					],

				],
			],

		];
	}
}
