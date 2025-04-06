<?php
namespace KAFWPB\Helpers;

/**
 * Class for plugin dependency constants.
 *
 * @package KAFWPB
 */
class DependencyConstants {

	/**
	 * Plugin parent BKBM URL.
	 *
	 * @var string
	 */
	public static $bkbm_url;
	/**
	 * Plugin parent BKBM license URL.
	 *
	 * @var string
	 */
	public static $bkbm_license_url;
	/**
     * Plugin parent WPBakery Page Builder URL.
     *
     * @var string
     */
	public static $wpb_url;

	/**
	 * Plugin addon title.
	 *
	 * @var string
	 */
	public static $addon_title;

	/**
	 * Register the plugin constants.
	 */
	public static function register() {
		self::set_dependency_constants();
		self::set_urls();
	}

	/**
	 * Set the plugin dependency URLs.
	 */
	private static function set_urls() {
		self::$bkbm_url         = "<strong><a href='https://1.envato.market/bkbm-wp' target='_blank'>BWL Knowledge Base Manager</a></strong>";
		self::$bkbm_license_url = "<strong><a href='" . admin_url( 'edit.php?post_type=bwl_kb&page=bkb-license' ) . "'>BWL Knowledge Base Manager license</a></strong>";
		self::$wpb_url          = "<strong><a href='https:// 1.envato.market/VKEo3' target='_blank'>WPBakery Page Builder</a></strong>";
		self::$addon_title      = '<strong>KB Addon For WPBakery Page Builder</strong>';
	}

	/**
	 * Set the plugin dependency constants.
	 */
	private static function set_dependency_constants() {
		define( 'KAFWPB_MIN_BKBM_VERSION', '1.5.5' );
		define( 'KAFWPB_MIN_PHP_VERSION', '7.0' );
	}

	/**
     * Function to handle the missing plugin notice.
     *
     * @return void
     */
	public static function notice_missing_main_plugin() {

		$message = sprintf(
						/* translators: 1: Addon title 2: Elementor */
            esc_html__( '⚠️ %1$s requires %2$s to be installed and activated.', 'bkb_vc' ),
            self::$addon_title,
            self::$bkbm_url
		);

	printf( '<div class="notice notice-error"><p>%1$s</p></div>', $message ); // phpcs:ignore
	}
}
