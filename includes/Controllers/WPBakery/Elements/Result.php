<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use BwlPetitionsManager\Api\WPBakery\WPBakeryApi;
use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Traits\WPBakeryTraits;

/**
 * Class Result
 *
 * Handles Petition Result WPBakery page builder element.
 *
 * @package BwlPetitionsManager
 */
class Result extends BaseController {

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

		$this->wpb_elem = [
			'name'                    => esc_html__( 'Petition Result', 'bwl_ptmn' ),
			'base'                    => 'petition_result',
			'category'                => 'Petition',
			'content_element'         => true,
			'show_settings_on_create' => true,
			'controls'                => 'full',
			'icon'                    => 'icon-bptm-vc-addon',
			'description'             => esc_html__( 'Display petition result.','bwl_ptmn' ),
			'params'                  => $this->get_params(),
		];
	}

	/**
	 * Get element parameters
	 *
	 * @return array
	 */
	private function get_params() {

		$petition_lists          = $this->get_petitions_dropdown();
		$petition_content_tags   = $this->get_content_tags();
		$petition_text_alignment = $this->get_alignment_tags();

			$params = [
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Petition', 'bwl_ptmn' ),
					'param_name'  => 'id',
					'class'       => 'p_id',
					'value'       => $petition_lists,
					'admin_label' => true,
					'group'       => 'General',
				],
				[
					'type'       => 'petition_title',
					'heading'    => '',
					'param_name' => 'p_title',
					'class'      => 'p_title',
					'value'      => '',
					'group'      => 'General',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Counter Text Color', 'bwl_ptmn' ),
					'param_name'  => 'counter_color',
					'value'       => '',
					'group'       => 'Counter',
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

				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Display Limit', 'bwl_ptmn' ),
					'param_name'  => 'limit',
					'value'       => '',
					'group'       => 'Result Scroll',
					'description' => '',
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Title Tag', 'bwl_ptmn' ),
					'param_name'  => 'title_tag',
					'value'       => $petition_content_tags,
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Title Alignment', 'bwl_ptmn' ),
					'param_name'  => 'title_align',
					'value'       => $petition_text_alignment,
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Title Tag Color', 'bwl_ptmn' ),
					'param_name'  => 'title_tag_color',
					'value'       => '',
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Sub Title Tag', 'bwl_ptmn' ),
					'param_name'  => 'sub_title_tag',
					'value'       => $petition_content_tags,
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Sub Title Alignment', 'bwl_ptmn' ),
					'param_name'  => 'sub_title_align',
					'value'       => $petition_text_alignment,
					'group'       => 'Settings',
					'description' => '',
				],
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Sub Title Tag Color', 'bwl_ptmn' ),
					'param_name'  => 'sub_title_tag_color',
					'value'       => '',
					'group'       => 'Settings',
					'description' => '',
				],
			];
			return $params;
	}
}
