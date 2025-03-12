<?php
/**
 * Plugin Name: KB Addon For WPBakery Page Builder
 * Plugin URI: https://1.envato.market/bkbm-wp
 * Description: Manage KB categories, tags, ask a question form, search box, tabs from WPBakery Page Builder.
 * Author: Mahbub Alam Khan
 * Version: 1.1.5
 * Author URI: https://bluewindlab.net
 * WP Requires at least: 6.0+
 * Text Domain: bkb_vc
 * Domain Path: /languages/
 *
 * @package KAFWPB
 * @author Mahbub Alam Khan
 * @license GPL-2.0+
 * @link https://codecanyon.net/user/xenioushk
 * @copyright 2025 BlueWindLab
 */

namespace KAFWPB;

// security check.
defined( 'ABSPATH' ) || die( 'Unauthorized access' );

// Once we get here, We have passed all validation checks so we can safely include our plugin

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use KAFWPB\Base\Activate;
use KAFWPB\Base\Deactivate;

// Version Define For Parent Plugin And Addon.
// @Since: 1.0.1

// define( 'BKB_VC_PARENT_PLUGIN_INSTALLED_VERSION', get_option( 'bwl_kb_plugin_version' ) );
// define( 'BKB_VC_ADDON_PARENT_PLUGIN_TITLE', 'BWL Knowledge Base Manager Plugin' );
// define( 'BKB_VC_ADDON_TITLE', 'KB Addon For WPBakery Page Builder' );
// define( 'BKB_VC_PARENT_PLUGIN_REQUIRED_VERSION', '1.4.2' ); // change plugin required version in here.
// define( 'BKB_VC_ADDON_CURRENT_VERSION', '1.1.5' ); // Plugin current version.
// define( 'BKB_VC_ADDON_INSTALLATION_TAG', 'bkbm_kavc_installation_' . str_replace( '.', '_', BKB_VC_ADDON_CURRENT_VERSION ) );
// define( 'BKB_VC_PATH', plugin_dir_path( __FILE__ ) );
// define( 'BKB_VC_PLUGIN_DIR', plugins_url() . '/kb-addon-for-visual-composer/' );
// define( 'BKB_VC_ADDON_UPDATER_SLUG', plugin_basename( __FILE__ ) ); // change plugin current version in here.
// define( 'BKB_VC_ADDON_CC_ID', '14935093' ); // Plugin codecanyon Id.

// // Pre activated plugin for knowledgedesk theme
// $kdeskBundle = 0;

// if ( function_exists( 'wp_get_theme' ) ) {
// Get the current active theme info
// $currentTheme = \wp_get_theme();
// Make a list of all allowed themes.
// $allowedThemes = [ 'knowledgedesk', 'knowledgedesk Child' ];
// Checking if current theme exists in the allowed theme list.
// if ( in_array( $currentTheme->get( 'Name' ), $allowedThemes, true ) ) {
// $kdeskBundle = 1;
// }
// }

// if ( $kdeskBundle == 1 ) {
// $purchaseVerified = 1;
// } elseif ( get_option( 'bkbm_purchase_verified' ) == 1 ) {
// $purchaseVerified = 1;
// } else {
// $purchaseVerified = 0;
// }

// define( 'BKB_VC_PARENT_PLUGIN_PURCHASE_STATUS', $purchaseVerified );

// require_once BKB_VC_PATH . 'public/class-kbvc-addon.php';

// register_activation_hook( __FILE__, [ 'BKB_VC', 'activate' ] );
// register_deactivation_hook( __FILE__, [ 'BKB_VC', 'deactivate' ] );

// add_action( 'plugins_loaded', [ 'BKB_VC', 'get_instance' ] );



    /**
     * Function to handle the activation of the plugin.
     *
     * @return void
     */
    function kafwpb_activate_plugin() { // phpcs:ignore

	$activate = new Activate();
	$activate->activate();
}

    /**
     * Function to handle the deactivation of the plugin.
     *
     * @return void
     */
    function kafwpb_deactivate_plugin() { // phpcs:ignore
	Deactivate::deactivate();
}

    register_activation_hook( __FILE__, __NAMESPACE__ . '\\kafwpb_activate_plugin' );
    register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\kafwpb_deactivate_plugin' );

    /**
     * Function to handle the initialization of the plugin.
     *
     * @return void
     */
function init_kafwpb() {

	if ( class_exists( 'KAFWPB\\Init' ) ) {

		Init::register_services();
	}
}

add_action( 'init', __NAMESPACE__ . '\\init_kafwpb' );
