<?php
/**
 * Plugin Name: KB Addon For WPBakery Page Builder
 * Plugin URI: https://1.envato.market/bkbm-wp
 * Description: Manage KB categories, tags, ask a question form, search box, tabs from WPBakery Page Builder.
 * Author: Mahbub Alam Khan
 * Version: 1.1.6
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

    if ( class_exists( 'KAFWPB\\Init' ) ) {

        Init::register_services();
    }
}

add_action( 'init', __NAMESPACE__ . '\\init_kafwpb' );
