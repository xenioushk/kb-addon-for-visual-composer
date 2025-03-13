<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class Counter
 *
 * Knowledgebase Counter.
 *
 * @package KAFWPB
 */
class Counter {

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
			'name'            => __( 'KB counter', 'bkb_vc' ),
			'base'            => 'vc_bkb_counter',
			'icon'            => 'icon-bkb-counter-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display kb counter.','bkb_vc' ),
			'params'          => $this->get_params(),
		];
	}

	/**
	 * Get element parameters
	 *
	 * @return array
	 */
	private function get_params() {

		$counter_delay  = $this->get_counter_delay();
		$delay_interval = $this->get_delay_interval();

			$params = [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'kb_counter',
					'value'       => '',
					'heading'     => __( 'Elements', 'bkb_vc' ),
					'param_name'  => 'counter',
					'description' => __( 'You can use drag & drop to re-order tab position.', 'bkb_vc' ),
					'group'       => 'Counter',
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => __( 'Counter Delay', 'bkb_vc' ),
					'param_name' => 'counter_delay',
					'value'      => $counter_delay,
					'group'      => 'Counter',
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => __( 'Counter Time', 'bkb_vc' ),
					'param_name' => 'counter_time',
					'value'      => $delay_interval,
					'group'      => 'Counter',
				],

				[
					'type'        => 'colorpicker',
					'heading'     => __( 'Counter Icon Color', 'bkb_vc' ),
					'param_name'  => 'counter_icon_color',
					'value'       => '#0074A2',
					'description' => __( 'Set counter icon color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],
				[
					'type'        => 'textfield',
					'heading'     => __( 'Icon Font Size', 'bkb_vc' ),
					'param_name'  => 'counter_icon_size',
					'value'       => '54',
					'description' => __( 'Set counter icon color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],

				[
					'type'        => 'colorpicker',
					'heading'     => __( 'Counter Text Color', 'bkb_vc' ),
					'param_name'  => 'counter_text_color',
					'value'       => '#2C2C2C',
					'description' => __( 'Set counter text color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],
				[
					'type'        => 'textfield',
					'heading'     => __( 'Text Font Size', 'bkb_vc' ),
					'param_name'  => 'counter_text_size',
					'value'       => '32',
					'description' => __( 'Set counter icon color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],

				[
					'type'        => 'colorpicker',
					'heading'     => __( 'Counter Title Color', 'bkb_vc' ),
					'param_name'  => 'counter_title_color',
					'value'       => '#525252',
					'description' => __( 'Set counter title color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],

				[
					'type'        => 'textfield',
					'heading'     => __( 'Title Font Size', 'bkb_vc' ),
					'param_name'  => 'counter_title_size',
					'value'       => '14',
					'description' => __( 'Set counter icon color.', 'bkb_vc' ),
					'group'       => 'Settings',
				],

				// add params same as with any other content element

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Total Kb Title', 'bkb_vc' ),
					'param_name'  => 'title_total_kb',
					'value'       => __( 'KB Posts', 'bkb_vc' ),
					'description' => '',
					'group'       => 'Total KB',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => __( 'Total KB Icon', 'bkb_vc' ),
					'param_name'  => 'icon_total_kb',
					'settings'    => [
						'emptyIcon'    => true, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Total KB',
					'description' => __( 'Select icon from library.', 'bkb_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Total Category Title', 'bkb_vc' ),
					'param_name'  => 'title_total_cat',
					'value'       => __( 'KB Categories', 'bkb_vc' ),
					'description' => '',
					'group'       => 'Total Category',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => __( 'Total Category Icon', 'bkb_vc' ),
					'param_name'  => 'icon_total_cat',
					'settings'    => [
						'emptyIcon'    => true, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Total Category',
					'description' => __( 'Select icon from library.', 'bkb_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Total Tag Title', 'bkb_vc' ),
					'param_name'  => 'title_total_tag',
					'value'       => __( 'KB Tags', 'bkb_vc' ),
					'description' => '',
					'group'       => 'Total Tag',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => __( 'Total Tag Icon', 'bkb_vc' ),
					'param_name'  => 'icon_total_tag',
					'settings'    => [
						'emptyIcon'    => true, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Total Tag',
					'description' => __( 'Select icon from library.', 'bkb_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Total Like Title', 'bkb_vc' ),
					'param_name'  => 'title_total_likes',
					'value'       => __( 'KB Likes', 'bkb_vc' ),
					'description' => '',
					'group'       => 'Total Like',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => __( 'Total Like Icon', 'bkb_vc' ),
					'param_name'  => 'icon_total_likes',
					'settings'    => [
						'emptyIcon'    => true, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Total Like',
					'description' => __( 'Select icon from library.', 'bkb_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra Class', 'bkb_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'group'       => 'Counter',
					'description' => __( 'Additional Class: bkbm-post-list-custom-layout, bkbm-posts-box-shadow', 'bkb_vc' ),
				],

			];
			return $params;
	}
}
