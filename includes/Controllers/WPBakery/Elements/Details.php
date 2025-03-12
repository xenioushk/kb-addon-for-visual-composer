<?php

namespace KAFWPB\Controllers\WPBakery\Elements;

use BwlPetitionsManager\Api\WPBakery\WPBakeryApi;
use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Traits\WPBakeryTraits;

/**
 * Class Details
 *
 * Handles Petition Details WPBakery page builder element.
 *
 * @package BwlPetitionsManager
 */
class Details extends BaseController {

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
				'name'                    => esc_html__( 'Petition Description', 'bwl_ptmn' ),
				'base'                    => 'petition_detail',
				'category'                => 'Petition',
				'content_element'         => true,
				'show_settings_on_create' => true,
				'controls'                => 'full',
				'icon'                    => 'icon-bptm-vc-addon',
				'description'             => esc_html__( 'Display petition description.','bwl_ptmn' ),
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
			];
			return $params;
	}
}
