<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class AskQuestion
 *
 * Handles Petition info WPBakery page builder element.
 *
 * @package KAFWPB
 */
class AskQuestion {

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
			'name'            => esc_html__( 'Question Modal Button', 'bkb_vc' ),
			'base'            => 'bkb_ask_form',
			'icon'            => 'icon-bkb-btn-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display question modal button.','bwl_ptmn' ),
			'params'          => $this->get_params(),
		];
	}

	/**
	 * Get element parameters
	 *
	 * @return array
	 */
	private function get_params() {

		$petition_content_tags   = $this->get_content_tags();
		$petition_text_alignment = $this->get_alignment_tags();

		$boolean_tags = $this->get_boolean_tags();

			$params = [

				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Button Title', 'bkb_vc' ),
					'param_name'  => 'title',
					'value'       => __( 'Add a Question', 'bkb_vc' ),
					'description' => '',
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Button Size', 'bkb_vc' ),
					'param_name'  => 'btn_size',
					'value'       => [
						__( 'Select', 'bkb_vc' )     => '',
						__( 'Large', 'bkb_vc' )      => 'bkb_btn_lg',
						__( 'Medium', 'bkb_vc' )     => 'bkb_btn_md',
						__( 'Small', 'bkb_vc' )      => 'bkb_btn_sm',
						__( 'Full Width', 'bkb_vc' ) => 'bkb_btn_full',

					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Button Alignment', 'bkb_vc' ),
					'param_name'  => 'btn_align',
					'value'       => [
						__( 'Center', 'bkb_vc' ) => '',
						__( 'Left', 'bkb_vc' )   => 'bkb_btn_left',
						__( 'Right', 'bkb_vc' )  => 'bkb_btn_right',
					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Button Border Style', 'bkb_vc' ),
					'param_name'  => 'btn_border_style',
					'value'       => [
						__( 'Select', 'bkb_vc' )  => '',
						__( 'Square', 'bkb_vc' )  => 'bkb_btn_square',
						__( 'Rounded', 'bkb_vc' ) => 'bkb_btn_rounded',

					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Button Animation', 'bkb_vc' ),
					'param_name'  => 'btn_animate',
					'value'       => [
						__( 'Select', 'bkb_vc' )       => '',
						__( 'Animation 1', 'bkb_vc' )  => 'animated-button sandy-one',
						__( 'Animation 2', 'bkb_vc' )  => 'animated-button sandy-two',
						__( 'Animation 3', 'bkb_vc' )  => 'animated-button sandy-three',
						__( 'Animation 4', 'bkb_vc' )  => 'animated-button sandy-four',
						__( 'Animation 5', 'bkb_vc' )  => 'animated-button gibson-one',
						__( 'Animation 6', 'bkb_vc' )  => 'animated-button gibson-two',
						__( 'Animation 7', 'bkb_vc' )  => 'animated-button gibson-three',
						__( 'Animation 8', 'bkb_vc' )  => 'animated-button gibson-four',
						__( 'Animation 9', 'bkb_vc' )  => 'animated-button thar-one',
						__( 'Animation 10', 'bkb_vc' ) => 'animated-button thar-two',
						__( 'Animation 11', 'bkb_vc' ) => 'animated-button thar-three',
						__( 'Animation 12', 'bkb_vc' ) => 'animated-button thar-four',

					],
					'group'       => 'Animation',
					'description' => '',
				],

			];
			return $params;
	}
}
