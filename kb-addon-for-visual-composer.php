<?php
/*
  Plugin Name: KB Addon For WPBakery Page Builder
  Plugin URI:  https://1.envato.market/bkbm-wp
  Version: 1.1.5
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
define('BKB_VC_ADDON_CURRENT_VERSION', '1.1.5'); //Plugin current version.
define('BKB_VC_ADDON_INSTALLATION_TAG', 'bkbm_kavc_installation_' . str_replace('.', '_', BKB_VC_ADDON_CURRENT_VERSION));
define('BKB_VC_PATH', plugin_dir_path(__FILE__));
define("BKB_VC_PLUGIN_DIR", plugins_url() . '/kb-addon-for-visual-composer/');
define('BKB_VC_ADDON_UPDATER_SLUG', plugin_basename(__FILE__)); // change plugin current version in here.
define("BKB_VC_ADDON_CC_ID", "14935093"); // Plugin codecanyon Id.

// Pre activated plugin for knowledgedesk theme
$kdeskBundle = 0;

if (function_exists('wp_get_theme')) {
  // Get the current active theme info
  $currentTheme = \wp_get_theme();
  // Make a list of all allowed themes.
  $allowedThemes = ['knowledgedesk', 'knowledgedesk Child'];
  // Checking if current theme exists in the allowed theme list.
  if (in_array($currentTheme->get('Name'), $allowedThemes, true)) {
    $kdeskBundle = 1;
  }
}

if ($kdeskBundle == 1) {
  $purchaseVerified = 1;
} else if (get_option('bkbm_purchase_verified') == 1) {
  $purchaseVerified = 1;
} else {
  $purchaseVerified = 0;
}

define("BKB_VC_PARENT_PLUGIN_PURCHASE_STATUS", $purchaseVerified);

require_once(BKB_VC_PATH . 'public/class-kbvc-addon.php');

register_activation_hook(__FILE__, array('BKB_VC', 'activate'));
register_deactivation_hook(__FILE__, array('BKB_VC', 'deactivate'));

add_action('plugins_loaded', array('BKB_VC', 'get_instance'));
