<?php
/**
 * Plugin Name: KB Addon For WPBakery Page Builder
 * Plugin URI: https://1.envato.market/bkbm-wp
 * Description: Manage KB categories, tags, ask a question form, search box, tabs from WPBakery Page Builder.
 * Author: Mahbub Alam Khan
 * Version: 2.1.0
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

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Load the plugin constants
if ( file_exists( __DIR__ . '/includes/Helpers/DependencyManager.php' ) ) {
    require_once __DIR__ . '/includes/Helpers/DependencyManager.php';
    Helpers\DependencyManager::register();
}

use KAFWPB\Base\Activate;
use KAFWPB\Base\Deactivate;

/**
 * Function to handle the activation of the plugin.
 *
 * @return void
 */
function activate_plugin() { // phpcs:ignore
    $activate = new Activate();
    $activate->activate();
}

/**
 * Function to handle the deactivation of the plugin.
 *
 * @return void
 */
function deactivate_plugin() { // phpcs:ignore
	Deactivate::deactivate();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate_plugin' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate_plugin' );

/**
 * Function to handle the initialization of the plugin.
 *
 * @return void
 */
function init_kafwpb() {

    // Check if the parent plugin installed.
    if ( ! class_exists( 'BwlKbManager\\Init' ) ) {
        add_action( 'admin_notices', [ Helpers\DependencyManager::class, 'notice_missing_main_plugin' ] );
        return;
    }

    // Check if the wp bakery page builder plugin installed.
    if ( ! defined( 'WPB_VC_VERSION' ) ) {
        add_action( 'admin_notices', [ Helpers\DependencyManager::class, 'notice_missing_wpb_plugin' ] );
        return;
    }

    if ( class_exists( 'KAFWPB\\Init' ) ) {

        // Check the required minimum version of the parent plugin.
		if ( ! ( Helpers\DependencyManager::check_minimum_version_requirement_status() ) ) {
			add_action( 'admin_notices', [ Helpers\DependencyManager::class, 'notice_min_version_main_plugin' ] );
			return;
		}

        Init::register_services();
    }
}

add_action( 'init', __NAMESPACE__ . '\\init_kafwpb' );
