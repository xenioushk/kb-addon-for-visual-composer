<?php
namespace KAFWPB\Helpers;

/**
 * Class for plugin constants.
 *
 * @package KAFWPB
 */
class PluginConstants {


	/**
	 * Allowed themes.
	 *
	 * @var array
	 */
	public static $allowed_themes = [ 'knowledgedesk', 'knowledgedesk Child' ];


		/**
         * Get the absolute path to the plugin root.
         *
         * @return string
         * @example wp-content/plugins/<plugin-name>/
         */
    public static function get_plugin_path(): string {
        return dirname( dirname( __DIR__ ) ) . '/';
    }


    /**
     * Get the plugin URL.
     *
     * @return string
     * @example http://appealwp.local/wp-content/plugins/<plugin-name>/
     */
    public static function get_plugin_url(): string {
		return plugin_dir_url( self::get_plugin_path() . BWL_PLUGIN_ROOT_FILE );
	}

	/**
	 * Register the plugin constants.
	 */
	public static function register() {
		self::set_base_constants();
		self::set_paths_dir_constants();
		self::set_assets_constants();
		self::set_updater_constants();
		self::set_product_info_constants();
		self::set_product_activation_constants();
		self::set_product_dependency_constants();
	}

	/**
	 * Set the plugin base constants.
	 */
	private static function set_base_constants() {
		define( 'BWL_PLUGIN_VERSION', '1.1.5' );
		define( 'BWL_PLUGIN_TITLE', 'KB Addon For WPBakery Page Builder' );
		define( 'BWL_PLUGIN_FOLDER', 'kb-addon-for-visual-composer' );
		define( 'BWL_PLUGIN_CURRENT_VERSION', BWL_PLUGIN_VERSION );
		define( 'BWL_PLUGIN_POST_TYPE', 'bwl_kb' );
		define( 'BWL_PLUGIN_TAXONOMY_CAT', 'bkb_category' );
		define( 'BWL_PLUGIN_TAXONOMY_TAGS', 'bkb_tags' );
	}

	/**
	 * Set the plugin paths constants.
	 */
	private static function set_paths_dir_constants() {
		define( 'BWL_PLUGIN_ROOT_FILE', 'kb-addon-for-visual-composer.php' );
		define( 'BWL_PLUGIN_DIR', self::get_plugin_path() );
		define( 'BWL_PLUGIN_FILE_PATH', BWL_PLUGIN_DIR );
		define( 'BWL_PLUGIN_URL', self::get_plugin_url() );

	}

	/**
	 * Set the plugin assets constants.
	 */
	private static function set_assets_constants() {
		define( 'BWL_PLUGIN_STYLES_ASSETS_DIR', BWL_PLUGIN_URL . 'assets/styles/' );
		define( 'BWL_PLUGIN_SCRIPTS_ASSETS_DIR', BWL_PLUGIN_URL . 'assets/scripts/' );
		define( 'BWL_PLUGIN_LIBS_DIR', BWL_PLUGIN_URL . 'libs/' );
	}

	/**
	 * Set the updater constants.
	 */
	private static function set_updater_constants() {
		define( 'BWL_PLUGIN_UPDATER_SLUG', BWL_PLUGIN_FOLDER . '/' . BWL_PLUGIN_ROOT_FILE ); // phpcs:ignore
		define( 'BWL_PLUGIN_PATH', BWL_PLUGIN_DIR );
	}

	/**
	 * Set the product info constants.
	 */
	private static function set_product_info_constants() {
		define( 'BWL_PRODUCT_ID', '14935093' ); // Plugin codecanyon Id.
		define( 'BWL_PRODUCT_INSTALLATION_TAG', 'bkbm_kavc_installation_' . str_replace( '.', '_', BWL_PLUGIN_VERSION ) );
	}

	/**
	 * Set the product activation constants.
	 */
	private static function set_product_activation_constants() {
		$kdesk_bundle = 0;

		if ( function_exists( 'wp_get_theme' ) ) {
			// Get the current active theme info
			$currentTheme = \wp_get_theme();

			// Checking if current theme exists in the allowed theme list .
			if ( in_array( $currentTheme->get( 'Name' ), self::$allowed_themes, true ) ) {
				$kdesk_bundle = 1;
			}
		}

		if ( $kdesk_bundle === 1 ) {
			$purchaseVerified = 1;
		} elseif ( intval( get_option( 'bkbm_purchase_verified' ) ) === 1 ) {
			$purchaseVerified = 1;
		} else {
			$purchaseVerified = 0;
		}

		define( 'BWL_PARENT_PLUGIN_PURCHASE_STATUS', $purchaseVerified );

	}

	/**
	 * Set the product dependency constants.
	 */
	private static function set_product_dependency_constants() {

		$notice_status = 0;
		$messages      = [];

		if ( ! class_exists( 'BwlKbManager\\Init' ) ) {
			$messages[]    = 'Please install and activate the "Knowledge Base Manager" plugin to use this addon.';
			$notice_status = 1;
		}

		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			$messages[]    = 'Please install and activate the "WPBakery Page Builder" plugin to use this addon.';
			$notice_status = 1;
		}

		if ( BWL_PARENT_PLUGIN_PURCHASE_STATUS === 0 ) {
			$messages[]    = 'Please activate the "Knowledge Base Manager" plugin license to use this addon.';
			$notice_status = 1;
		}

		define( 'BWL_PLUGIN_DISPLAY_NOTICE',  $notice_status );
		define( 'BWL_PLUGIN_NOTICE_MSG', $messages );
	}
}
