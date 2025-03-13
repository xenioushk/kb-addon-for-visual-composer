<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class Tabs
 *
 * Knowledgebase Tabs.
 *
 * @package KAFWPB
 */
class Tabs {

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
			'name'            => __( 'KB Tabs', 'bkb_vc' ),
			'base'            => 'vc_bkb_tabs',
			'icon'            => 'icon-bkb-tab-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display KB Tabs.','bwl_ptmn' ),
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
					'type'        => 'kb_tabs',
					'value'       => '',
					'heading'     => __( 'Tab Items', 'bkb_vc' ),
					'param_name'  => 'tabs',
					'description' => __( 'You can use drag & drop to re-order tab position.', 'bkb_vc' ),
					'group'       => 'Tabs',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Tab Style', 'bkb_vc' ),
					'param_name'  => 'vertical',
					'value'       => [
						__( 'Horizontal Tab', 'bkb_vc' ) => 0,
						__( 'Vertical Tab', 'bkb_vc' )   => 1,
					],
					'group'       => 'Tabs',
					'description' => '',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Tab Item Style', 'bkb_vc' ),
					'param_name'  => 'bkb_list_type',
					'value'       => [
						__( 'Rounded', 'bkb_vc' )   => 'rounded',
						__( 'Rectangle', 'bkb_vc' ) => 'rectangle',
						__( 'Iconized', 'bkb_vc' )  => 'iconized',
						__( 'None', 'bkb_vc' )      => 'none',
					],
					'group'       => 'Tabs',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'No of Items', 'bkb_vc' ),
					'param_name'  => 'limit',
					'value'       => '',
					'description' => '',
					'group'       => 'Tabs',
				],

				// Tab Title Settings.

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Featured Tab Title', 'bkb_vc' ),
					'param_name'  => 'feat_tab_title',
					'value'       => '',
					'description' => __( 'Set custom title for Featured KB Tab', 'bkb_vc' ),
					'group'       => 'Tabs Title',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Popular Tab Title', 'bkb_vc' ),
					'param_name'  => 'popular_tab_title',
					'value'       => '',
					'description' => __( 'Set custom title for Popular KB Tab', 'bkb_vc' ),
					'group'       => 'Tabs Title',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Recent Tab Title', 'bkb_vc' ),
					'param_name'  => 'recent_tab_title',
					'value'       => '',
					'description' => __( 'Set custom title for Recent KB Tab', 'bkb_vc' ),
					'group'       => 'Tabs Title',
				],

				// add params same as with any other content element

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Enable RTL Mode?', 'bkb_vc' ),
					'param_name'  => 'rtl',
					'value'       => [
						__( 'No', 'bkb_vc' )  => 0,
						__( 'Yes', 'bkb_vc' ) => 1,
					],
					'group'       => 'Settings',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra Class', 'bkb_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => __( 'Add additional class of tabs.', 'bkb_vc' ),
					'group'       => 'Settings',
				],

			];
			return $params;
	}
}
