<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use KAFWPB\Api\WPBakery\WPBakeryApi;
use KAFWPB\Traits\WPBakeryTraits;

/**
 * Class KB Posts
 *
 * Knowledgebase Posts
 *
 * @package KAFWPB
 */
class Posts {

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
			'name'            => __( 'Knowledgebase Posts', 'bkb_vc' ),
			'base'            => 'vc_bkb_posts',
			'icon'            => 'icon-bkb-posts-vc-addon',
			'category'        => 'BWL KB',
			'content_element' => true,
			'description'     => esc_html__( 'Display kb external form.','bwl_ptmn' ),
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
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'KB Type', 'bkb_vc' ),
					'param_name'  => 'kb_type',
					'value'       => [
						__( 'Recent KB', 'bkb_vc' )   => 'recent',
						__( 'Popular KB', 'bkb_vc' )  => 'popular',
						__( 'Featured KB', 'bkb_vc' ) => 'featured',
						__( 'Random KB', 'bkb_vc' )   => 'random',

					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'KB Type Title', 'bkb_vc' ),
					'param_name'  => 'kb_type_title',
					'value'       => '',
					'description' => '',
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Display KB Type Title?', 'bkb_vc' ),
					'param_name'  => 'kb_type_title_status',
					'value'       => [
						__( 'Yes', 'bkb_vc' ) => 1,
						__( 'No', 'bkb_vc' )  => 0,
					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Enable Pagination?', 'bkb_vc' ),
					'param_name'  => 'paginate',
					'value'       => [
						__( 'No', 'bkb_vc' )  => 0,
						__( 'Yes', 'bkb_vc' ) => 1,
					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Post Per Page', 'bkb_vc' ),
					'param_name'  => 'posts_per_page',
					'value'       => '5',
					'description' => __( 'Default: 5. You can add any number. Set -1 to display all the posts.', 'bkb_vc' ),
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'List Styles', 'bkb_vc' ),
					'param_name'  => 'bkb_list_type',
					'value'       => [
						__( 'Select', 'bkb_vc' )    => '',
						__( 'Rounded', 'bkb_vc' )   => 'rounded',
						__( 'Rectangle', 'bkb_vc' ) => 'rectangle',
						__( 'Iconized', 'bkb_vc' )  => 'iconized',
						__( 'None', 'bkb_vc' )      => 'none',
					],
					'group'       => 'Design',
					'description' => '',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra Class', 'bkb_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => __( 'Additional Class: bkbm-post-list-custom-layout, bkbm-posts-box-shadow', 'bkb_vc' ),
					'group'       => 'Design',
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
