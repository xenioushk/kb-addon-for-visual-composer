<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class SearchBox
 *
 * Handles Petition info WPBakery page builder element.
 *
 * @package KAFWPB
 */
class SearchBox {

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
			'name'            => esc_html__( 'KB Search', 'bkb_vc' ),
			'base'            => 'bkb_search',
			'icon'            => 'icon-bkb-search-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display kb search box.','bwl_ptmn' ),
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
					'heading'     => __( 'Placeholder Text', 'bkb_vc' ),
					'param_name'  => 'placeholder',
					'value'       => __( 'Search Keywords ..... ', 'bkb_vc' ),
					'description' => __( 'Text will display in search input box.', 'bkb_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra Class', 'bkb_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => __( 'Add additional class: bkb-sbox-layout-1, bkb-sbox-layout-1 semi-rounded-box, bkb-sbox-layout-1 rounded-box, bkb-sbox-layout-1 dark-box', 'bkb_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'animation_style',
					'heading'     => __( 'Animation', 'bkb_vc' ),
					'param_name'  => 'animation',
					'description' => __( 'Choose your animation style.', 'bkb_vc' ),
					'admin_label' => false,
					'weight'      => 0,
					'group'       => 'Animation',
				],
			];
			return $params;
	}
}
