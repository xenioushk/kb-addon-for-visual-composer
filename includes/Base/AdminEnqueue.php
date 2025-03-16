<?php
namespace KAFWPB\Base;

/**
 * Class for registering the plugin admin scripts and styles.
 *
 * @package KAFWPB
 */
class AdminEnqueue extends BaseController {

	/**
	 * Admin script slug.
	 *
	 * @var string $admin_script_slug
	 */
	private $admin_script_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->admin_script_slug = 'bkb_vc-admin';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		// for admin.
		add_action( 'admin_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}
	/**
     * Load the plugin styles and scripts.
     */
	public function get_the_scripts() {
			// Register Data Table Styles.
        wp_enqueue_style( $this->admin_script_slug, BWL_PLUGIN_STYLES_ASSETS_DIR . 'admin.css', [], BWL_PLUGIN_VERSION );

        // Register Data Table & It's required codes.
        wp_enqueue_script(
            $this->admin_script_slug,
            BWL_PLUGIN_SCRIPTS_ASSETS_DIR . 'admin.js',
            [ 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-sortable' ],
            BWL_PLUGIN_VERSION, true
        );
		// Load frontend variables used by the JS files.
		$this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmAdminData.version
		wp_localize_script(
            $this->admin_script_slug,
            'KAFWPBAdminData',
            [
				'version'      => BWL_PLUGIN_VERSION,
				'ajaxurl'      => esc_url( admin_url( 'admin-ajax.php' ) ),
				'product_id'   => BWL_PRODUCT_ID,
				'installation' => get_option( BWL_PRODUCT_INSTALLATION_TAG ),
			]
		);
	}
}
