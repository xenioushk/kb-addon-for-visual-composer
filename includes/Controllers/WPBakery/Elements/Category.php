<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class Category
 *
 * Handles Petition info WPBakery page builder element.
 *
 * @package KAFWPB
 */
class Category {

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
			'name'            => esc_html__( 'KB Category', 'bkb_vc' ),
			'base'            => 'bkb_category',
			'icon'            => 'icon-bkb-cat-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display KB Categories.','bwl_ptmn' ),
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
					'type'        => 'kb_cat',
					'value'       => '',
					'heading'     => __( 'Categories', 'bkb_vc' ),
					'param_name'  => 'categories',
					'description' => __( 'Just drag and drop your required categories in to right box.', 'bkb_vc' ),
					'group'       => 'Categories',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra Class', 'bkb_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => __( 'Additional classes: bkbm-custom-layout-1, bkbm-box-shadow', 'bkb_vc' ),
					'group'       => 'Categories',
				],

				// add params same as with any other content element

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Layout Type', 'bkb_vc' ),
					'param_name'  => 'box_view',
					'value'       => [
						__( 'Lists View', 'bkb_vc' ) => 0,
						__( 'Boxed View', 'bkb_vc' ) => 1,
					],
					'group'       => 'Settings',
					'description' => '',
				],

				// Carousel.

				[
					'admin_label' => true,
					'type'        => 'checkbox',
					'class'       => '',
					'heading'     => __( 'Enable Carousel?', 'bkb_vc' ),
					'param_name'  => 'carousel',
					'value'       => [ __( 'Yes', 'bkb_vc' ) => '1' ],
					'description' => '',
					'group'       => 'Settings',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Hide Carousel Navigation Arrow?', 'bkb_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => [
						__( 'Yes', 'bkb_vc' ) => 1,
						__( 'No', 'bkb_vc' )  => 0,
					],
					'description' => __( 'You can show/hide two arrow will display beside the carousel items.', 'bkb_vc' ),
					'group'       => 'Settings',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Hide Carousel Dots ?', 'bkb_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => $boolean_tags,
					'description' => __( 'You can show/hide bottom will display below the carousel items.', 'bkb_vc' ),
					'group'       => 'Settings',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Auto Play Time Out', 'bkb_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => [
						'Select'     => '',
						'3 Seconds'  => '3000',
						'5 Seconds'  => '5000',
						'10 Seconds' => '10000',
						'20 Seconds' => '20000',
						'30 Seconds' => '30000',
					],
					'group'       => 'Settings',
					'description' => __( 'Select scroll speed.', 'bkb_vc' ),
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				// List Style Type.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'List Styles', 'bkb_vc' ),
					'param_name'  => 'bkb_list_type',
					'value'       => [
						__( 'Select', 'bkb_vc' )    => '',
						__( 'Rounded', 'bkb_vc' )   => 'rounded',
						__( 'Rectangle', 'bkb_vc' ) => 'rectangle',
						__( 'Iconized', 'bkb_vc' )  => 'iconized',
						__( 'Accordion', 'bkb_vc' ) => 'accordion',
						__( 'None', 'bkb_vc' )      => 'none',
					],
					'group'       => 'Settings',
					'description' => '',
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '0' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Show Category Title?', 'bkb_vc' ),
					'param_name'  => 'show_title',
					'value'       => $boolean_tags,
					'group'       => 'Settings',
					'description' => '',
					'dependency'  => [
						'element' => 'box_view',
						'value'   => [ '1' ],
					],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Column Settings', 'bkb_vc' ),
					'param_name'  => 'cols',
					'value'       => [
						__( 'Select', 'bkb_vc' )        => '',
						__( 'One Column', 'bkb_vc' )    => 1,
						__( 'Two Columns', 'bkb_vc' )   => 2,
						__( 'Three Columns', 'bkb_vc' ) => 3,
					],
					'group'       => 'Settings',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Display Category Description?', 'bkb_vc' ),
					'param_name'  => 'bkb_desc',
					'value'       => $boolean_tags,
					'group'       => 'Settings',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'No of items to display', 'bkb_vc' ),
					'param_name'  => 'limit',
					'value'       => '',
					'description' => '',
					'group'       => 'Settings',
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '0' ] ],
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Order By Settings', 'bkb_vc' ),
					'param_name'  => 'orderby',
					'value'       => [
						__( 'ID', 'bkb_vc' )              => 'ID',
						__( 'Title', 'bkb_vc' )           => 'title',
						__( 'Date', 'bkb_vc' )            => 'date',
						__( 'Recent Modified', 'bkb_vc' ) => 'modified',
						__( 'Random', 'bkb_vc' )          => 'rand',
						__( 'Custom Sort', 'bkb_vc' )     => 'custom_order',
					],
					'group'       => 'Settings',
					'description' => '',
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '0' ] ],
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Order Type Settings', 'bkb_vc' ),
					'param_name'  => 'order',
					'value'       => [
						__( 'Ascending', 'bkb_vc' )  => 'ASC',
						__( 'Descending', 'bkb_vc' ) => 'DESC',
					],
					'group'       => 'Settings',
					'description' => '',
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '0' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Display Post Count?', 'bkb_vc' ),
					'param_name'  => 'posts_count',
					'value'       => $boolean_tags,
					'group'       => 'Settings',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Display Post Count Info?', 'bkb_vc' ),
					'param_name'  => 'count_info',
					'value'       => $boolean_tags,
					'group'       => 'Settings',
					'description' => __( 'Display total number of posts below the list.', 'bkb_vc' ),
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '0' ] ],
				],

				// New Code.

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => __( 'Icon Type', 'bkb_vc' ),
					'param_name' => 'box_view_icon',
					'value'      => [
						__( 'Font Awesome Icon', 'bkb_vc' ) => '',
						__( 'Image Icon', 'bkb_vc' ) => 'img_icon',
					],
					'group'      => 'Settings',
					'dependency' => [ 'element' => 'box_view', 'value' => [ '1' ] ],
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => __( 'Icon Size', 'bkb_vc' ),
					'param_name' => 'box_view_icon',
					'value'      => [
						__( 'Option Panel Size', 'bkb_vc' ) => '',
						__( 'Auto Size', 'bkb_vc' ) => 'img_icon',
					],
					'group'      => 'Settings',
					'dependency' => [ 'element' => 'box_view', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Box View Extra Class', 'bkb_vc' ),
					'param_name'  => 'box_view_class',
					'value'       => '',
					'description' => __( 'Additional classes: box-left-align, box-right-align, no-icon, no-separator, no-view-more-link', 'bkb_vc' ),
					'group'       => 'Settings',
					'dependency'  => [ 'element' => 'box_view', 'value' => [ '1' ] ],
				],

				// End New Code.

				// Animation.

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
