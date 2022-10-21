<?php
/*
  Plugin Name: KB Addon For WPBakery Page Builder
  Plugin URI:  http://codecanyon.net/item/kb-addon-for-visual-composer/14935093
  Version: 1.0.8
  Description: Manage KB categories, tags, ask a question form, search box, tabs from WPBakery Page Builder. This addon allows you to sort categories, tags and tabs by using drag drop feature.
  Author: xenioushk
  Author URI:  http://codecanyon.net/user/xenioushk
  Text Domain: bkb_vc
  Domain Path: /languages/
 */

// If this file is called directly, abort.
if (!defined( 'WPINC' ) ) {
    die;
}

/* ----------------------------------------------------------------------------*
 * Public-Facing Functionality
 * ---------------------------------------------------------------------------- */

//Version Define For Parent Plugin And Addon.
// @Since: 1.0.1

define('BKB_VC_PARENT_PLUGIN_INSTALLED_VERSION', get_option('bwl_kb_plugin_version'));
define('BKB_VC_ADDON_PARENT_PLUGIN_TITLE', 'BWL Knowledge Base Manager Plugin');
define('BKB_VC_ADDON_TITLE', 'KB Addon For WPBakery Page Builder');
define('BKB_VC_PARENT_PLUGIN_REQUIRED_VERSION', '1.0.9'); // change plugin required version in here.
define('BKB_VC_ADDON_CURRENT_VERSION', '1.0.8'); // change plugin current version in here.

define('BKB_VC_PATH', plugin_dir_path(__FILE__));
define("BKB_VC_PLUGIN_DIR", plugins_url() . '/kb-addon-for-visual-composer/');

require_once( BKB_VC_PATH . 'public/class-kbvc-addon.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'BKB_VC', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'BKB_VC', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'BKB_VC', 'get_instance' ) );

/* ----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 * ---------------------------------------------------------------------------- */

if ( is_admin()) {

//require_once( plugin_dir_path( __FILE__ ) . 'admin/class-kbdabp-addon-admin.php' );
//add_action( 'plugins_loaded', array( 'BKB_VC_Admin', 'get_instance' ) );

}