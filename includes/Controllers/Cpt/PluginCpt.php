<?php
namespace KAFWPB\Controllers\Cpt;

use BwlPetitionsManager\Api\Cpt\CptApi;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class for custom post type API.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PluginCpt extends BaseController {

	/**
	 *  Instance of the CPT API.
	 *
	 * @var object $cpt_api
	 */
	public $cpt_api;

	/**
	 * CPT settings.
	 *
	 * @var array
	 */
	public $cpt_settings = [];


	/**
	 * Taxonomy settings.
	 *
	 * @var array
	 */
	public $tax_settings = [];

	/**
	 * Register custom post type.
	 */
	public function register() {

		$this->cpt_api      = new CptApi();
		$this->cpt_settings = [
			[
				'post_type'     => $this->plugin_post_type, // keep it unique
				'menu_name'     => $this->plugin_cpt_menu_name,
				'singular_name' => $this->plugin_cpt_label_singular_name,
				'query_var'     => $this->plugin_query_var,
				'slug'          => $this->plugin_cpt_custom_slug,
				'show_in_rest'  => $this->plugin_cpt_show_in_rest,
				'supports'      => $this->get_cpt_supports(),
				'menu_icon'     => BWL_PETITIONS_PLUGIN_LIBS_DIR . 'images/bwl_petitions_menu_icon.png',
				'has_archive'   => true,
				'hierarchical'  => true,
				'rewrite'       => [
					'slug'       => false,
					'with_front' => false,
				],
			],
		];

		$this->tax_settings = [
			[
				'tax_title'       => esc_html__( 'Petitions Category', 'bwl_ptmn' ),
				'tax_slug'        => $this->plugin_cpt_tax_category,
				'show_in_rest'    => $this->plugin_cpt_show_in_rest,
				'custom_tax_slug' => $this->plugin_tax_cat_custom_slug,
			],
		];
		$this->cpt_api->add_cpt( $this->cpt_settings )->with_taxonomy( $this->tax_settings )->register();
	}


	/**
	 * Get CPT supports.
	 *
	 * @return array
	 */
	private function get_cpt_supports() {

		$cptSupports = [ 'title', 'thumbnail', 'comments', 'author', 'editor' ];

		return $cptSupports;
	}
}
