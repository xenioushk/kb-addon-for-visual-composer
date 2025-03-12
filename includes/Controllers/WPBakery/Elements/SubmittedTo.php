<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use BwlPetitionsManager\Api\WPBakery\WPBakeryApi;
use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Traits\WPBakeryTraits;

/**
 * Class SubmittedTo
 *
 * Handles Petition SubmittedTo WPBakery page builder element.
 *
 * @package BwlPetitionsManager
 */
class SubmittedTo extends BaseController {

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
				'name'                    => esc_html__( 'Petition Submitted To', 'bwl_ptmn' ),
				'base'                    => 'petition_submit_to',
				'category'                => 'Petition',
				'content_element'         => true,
				'show_settings_on_create' => true,
				'controls'                => 'full',
				'icon'                    => 'icon-bptm-vc-addon',
				'description'             => esc_html__( 'Show the names for petition forwarding.','bwl_ptmn' ),
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
		$layout                  = $this->get_layouts();

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
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Items per row', 'bwl_ptmn' ),
					'param_name' => 'items',
					'value'      => [
						'4' => '4',
						'3' => '3',
						'2' => '2',
						'1' => '1',
					],
				],
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Layout', 'bwl_ptmn' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'Settings',
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
