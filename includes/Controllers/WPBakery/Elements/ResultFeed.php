<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use BwlPetitionsManager\Api\WPBakery\WPBakeryApi;
use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Traits\WPBakeryTraits;

/**
 * Class ResultFeed
 *
 * Handles Petition ResultFeed WPBakery page builder element.
 *
 * @package BwlPetitionsManager
 */
class ResultFeed extends BaseController {

	use WPBakeryTraits;

	/**
	 * WPB fields.
	 *
	 * @var wpb_elem
	 */
	public $wpb_elem;

	/**
	 * WPB API.
	 *
	 * @var wpb_api
	 */
	public $wpb_api;

	/**
	 * Register methods.
	 */
	public function register() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Set WPB elem.
		$this->set_wpb_elem();

		// Initialize API.
		$this->wpb_api = new WPBakeryApi();

		$this->wpb_api->add_wpb_elem( $this->wpb_elem )->register();

	}

	/**
	 * Set WPB data.
	 */
	private function set_wpb_elem() {

		$this->wpb_elem =
			[
				'name'                    => esc_html__( 'Petition Result Feed', 'bwl_ptmn' ),
				'base'                    => 'petition_result_feed',
				'category'                => 'Petition',
				'content_element'         => true,
				'show_settings_on_create' => true,
				'controls'                => 'full',
				'icon'                    => 'icon-bptm-vc-addon',
				'description'             => esc_html__( 'Display petition result feed.','bwl_ptmn' ),
				'params'                  => $this->get_params(),
			];
	}

	/**
	 * Get element parameters
	 *
	 * @return array
	 */
	private function get_params() {

		$petition_lists = $this->get_petitions_dropdown();
		$boolean_tag    = $this->get_boolean_tags();

			$params = [
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Petition', 'bwl_ptmn' ),
					'param_name'  => 'id',
					'class'       => 'p_id',
					'value'       => $petition_lists,
					'admin_label' => true,
				],
				[
					'type'       => 'petition_title',
					'heading'    => '',
					'param_name' => 'p_title',
					'class'      => 'p_title',
					'value'      => '',
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Display Result Feed Heading', 'bwl_ptmn' ),
					'param_name'  => 'result_feed_heading_status',
					'value'       => $boolean_tag,
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Display Limit', 'bwl_ptmn' ),
					'param_name'  => 'limit',
					'value'       => '',
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'User Name Color', 'bwl_ptmn' ),
					'param_name'  => 'signed_user_name_color',
					'value'       => '',
					'group'       => 'Result Scroll',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'User Country Color', 'bwl_ptmn' ),
					'param_name'  => 'signed_user_country',
					'value'       => '',
					'group'       => 'Result Scroll',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Signed Text Color', 'bwl_ptmn' ),
					'param_name'  => 'signed_text',
					'value'       => '',
					'group'       => 'Result Scroll',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Time Ago Color', 'bwl_ptmn' ),
					'param_name'  => 'petition_signed_time_ago',
					'value'       => '',
					'group'       => 'Result Scroll',
					'description' => '',
				],
			];
			return $params;
	}
}
