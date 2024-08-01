<?php
/*
  Plugin Name: KB Addon For WPBakery Page Builder
  Plugin URI:  https://1.envato.market/bkbm-wp
  Version: 1.1.4
  Description: Manage KB categories, tags, ask a question form, search box, tabs from WPBakery Page Builder. This addon allows you to sort categories, tags and tabs by using drag drop feature.
  Author: xenioushk
  Author URI:  https://bluewindlab.net
  Text Domain: bkb_vc
  Domain Path: /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

//Version Define For Parent Plugin And Addon.
// @Since: 1.0.1

define('BKB_VC_PARENT_PLUGIN_INSTALLED_VERSION', get_option('bwl_kb_plugin_version'));
define('BKB_VC_ADDON_PARENT_PLUGIN_TITLE', 'BWL Knowledge Base Manager Plugin');
define('BKB_VC_ADDON_TITLE', 'KB Addon For WPBakery Page Builder');
define('BKB_VC_PARENT_PLUGIN_REQUIRED_VERSION', '1.4.2'); // change plugin required version in here.
define('BKB_VC_ADDON_CURRENT_VERSION', '1.1.4'); //Plugin current version.
define('BKB_VC_ADDON_INSTALLATION_TAG', 'bkbm_kavc_installation_' . str_replace('.', '_', BKB_VC_ADDON_CURRENT_VERSION));
define('BKB_VC_PATH', plugin_dir_path(__FILE__));
define("BKB_VC_PLUGIN_DIR", plugins_url() . '/kb-addon-for-visual-composer/');
define('BKB_VC_ADDON_UPDATER_SLUG', plugin_basename(__FILE__)); // change plugin current version in here.
define("BKB_VC_ADDON_CC_ID", "14935093"); // Plugin codecanyon Id.
define("BKB_VC_PARENT_PLUGIN_PURCHASE_STATUS", get_option('bkbm_purchase_verified') == 1 ? 1 : 0);

require_once(BKB_VC_PATH . 'public/class-kbvc-addon.php');

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook(__FILE__, array('BKB_VC', 'activate'));
register_deactivation_hook(__FILE__, array('BKB_VC', 'deactivate'));

add_action('plugins_loaded', array('BKB_VC', 'get_instance'));