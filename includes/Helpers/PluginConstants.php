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
         * Get the relative path to the plugin root.
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
		return plugin_dir_url( self::get_plugin_path() . KAFWPB_PLUGIN_ROOT_FILE );
	}

	/**
	 * Register the plugin constants.
	 */
	public static function register() {
		self::set_paths_constants();
		self::set_base_constants();
		self::set_assets_constants();
		self::set_updater_constants();
		self::set_product_info_constants();
		self::set_product_activation_constants();
		self::set_product_dependency_constants();
	}

	/**
	 * Set the plugin base constants.
     *
	 * @example: $plugin_data = get_plugin_data( KAFWPB_PLUGIN_DIR . '/' . KAFWPB_PLUGIN_ROOT_FILE );
	 * echo '<pre>';
	 * print_r( $plugin_data );
	 * echo '</pre>';
	 * @example_param: Name,PluginURI,Description,Author,Version,AuthorURI,RequiresAtLeast,TestedUpTo,TextDomain,DomainPath
	 */
	private static function set_base_constants() {

		$plugin_data = get_plugin_data( KAFWPB_PLUGIN_DIR . '/' . KAFWPB_PLUGIN_ROOT_FILE );

		define( 'KAFWPB_PLUGIN_VERSION', $plugin_data['Version'] ?? '1.0.0' );
		define( 'KAFWPB_PLUGIN_TITLE', $plugin_data['Name'] ?? 'KB Addon For WPBakery Page Builder' );
		define( 'KAFWPB_TRANSLATION_DIR', $plugin_data['DomainPath'] ?? '/languages/' );
		define( 'KAFWPB_TEXT_DOMAIN', $plugin_data['TextDomain'] ?? '' );

		define( 'KAFWPB_PLUGIN_FOLDER', 'kb-addon-for-visual-composer' );
		define( 'KAFWPB_PLUGIN_CURRENT_VERSION', KAFWPB_PLUGIN_VERSION );
		define( 'KAFWPB_PLUGIN_POST_TYPE', 'bwl_kb' );
		define( 'KAFWPB_PLUGIN_TAXONOMY_CAT', 'bkb_category' );
		define( 'KAFWPB_PLUGIN_TAXONOMY_TAGS', 'bkb_tags' );
	}

	/**
	 * Set the plugin paths constants.
	 */
	private static function set_paths_constants() {
		define( 'KAFWPB_PLUGIN_ROOT_FILE', 'kb-addon-for-visual-composer.php' );
		define( 'KAFWPB_PLUGIN_DIR', self::get_plugin_path() );
		define( 'KAFWPB_PLUGIN_FILE_PATH', KAFWPB_PLUGIN_DIR );
		define( 'KAFWPB_PLUGIN_URL', self::get_plugin_url() );
	}

	/**
	 * Set the plugin assets constants.
	 */
	private static function set_assets_constants() {
		define( 'KAFWPB_PLUGIN_STYLES_ASSETS_DIR', KAFWPB_PLUGIN_URL . 'assets/styles/' );
		define( 'KAFWPB_PLUGIN_SCRIPTS_ASSETS_DIR', KAFWPB_PLUGIN_URL . 'assets/scripts/' );
		define( 'KAFWPB_PLUGIN_LIBS_DIR', KAFWPB_PLUGIN_URL . 'libs/' );
	}

	/**
	 * Set the updater constants.
	 */
	private static function set_updater_constants() {

		// Only change the slug.
		$slug        = 'bkbm/notifier_bkbm_kafvc.php';
		$updater_url = "https://projects.bluewindlab.net/wpplugin/zipped/plugins/{$slug}";

		define( 'KAFWPB_PLUGIN_UPDATER_URL', $updater_url ); // phpcs:ignore
		define( 'KAFWPB_PLUGIN_UPDATER_SLUG', KAFWPB_PLUGIN_FOLDER . '/' . KAFWPB_PLUGIN_ROOT_FILE ); // phpcs:ignore
		define( 'KAFWPB_PLUGIN_PATH', KAFWPB_PLUGIN_DIR );
	}

	/**
	 * Set the product info constants.
	 */
	private static function set_product_info_constants() {
		define( 'KAFWPB_PRODUCT_ID', '14935093' ); // Plugin codecanyon/themeforest Id.
		define( 'KAFWPB_PRODUCT_INSTALLATION_TAG', 'bkbm_kavc_installation_' . str_replace( '.', '_', KAFWPB_PLUGIN_VERSION ) );
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
			$purchase_status = 1;
		} elseif ( intval( get_option( 'bkbm_purchase_verified' ) ) === 1 ) {
			$purchase_status = 1;
		} else {
			$purchase_status = 0;
		}

		define( 'KAFWPB_PARENT_PLUGIN_PURCHASE_STATUS', $purchase_status );

	}

	/**
	 * Set the product dependency constants.
	 */
	private static function set_product_dependency_constants() {

		/**
		 * Dependencies Dispaly Status.
		 *
		 * @var int $status
		 * @example 0 = hide notice (all dependencies loaded), 1 = show notice (dependencies not loaded/missing)
		 */
		$status = 0;

		/**
		 * Plugin dependencies messages.
         *
		 * @var array $messages
		 *
		 * @reference: kb-addon-for-visual-composer/includes/Controllers/Notices/PluginDependenciesNotices.php
		*/
		$messages = [];

		$bkbm_url         = "<strong><a href='https://1.envato.market/bkbm-wp' target='_blank'>BWL Knowledge Base Manager</a></strong>";
		$bkbm_license_url = "<strong><a href='" . admin_url( 'edit.php?post_type=bwl_kb&page=bkb-license' ) . "'>BWL Knowledge Base Manager license</a></strong>";
		$wpb_url          = "<strong><a href='https:// 1.envato.market/VKEo3' target='_blank'>WPBakery Page Builder</a></strong>";
		$addon_title      = '<strong>' . KAFWPB_PLUGIN_TITLE . '</strong>';

		if ( ! class_exists( 'BwlKbManager\\Init' ) ) {
			$messages[] = [
				'msg' => "⚠️ Please install and activate the {$bkbm_url} plugin to use {$addon_title}.",
			];
			$status     = 1;
		}

		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			$messages[] = [
				'msg' => "⚠️ Please install and activate the {$wpb_url} plugin to use {$addon_title}.",
			];
			$status     = 1;
		}

		if ( KAFWPB_PARENT_PLUGIN_PURCHASE_STATUS === 0 ) {
			$messages[] = [
				'msg' => "🔑 Please <strong>Activate</strong> the {$bkbm_license_url} to use the {$addon_title}.",
			];
			$status     = 1;
		}

		define( 'KAFWPB_PLUGIN_DEPENDENCIES_STATUS',  $status );
		define( 'KAFWPB_PLUGIN_DEPENDENCIES_MSG', $messages );
	}
}
