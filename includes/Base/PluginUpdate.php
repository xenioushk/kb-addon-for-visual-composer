<?php
namespace KAFWPB\Base;

use BwlPetitionsManager\Api\PluginUpdate\WpAutoUpdater;

/**
 * Class for plugin update.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PluginUpdate extends BaseController {

  	/**
     * Register the plugin text domain.
     */
	public function register() {
		add_action( 'admin_init', [ $this, 'check_for_the_update' ] );
	}

	/**
     * Check for the plugin update.
     */
	public function check_for_the_update() {

		$base          = 'https://projects.bluewindlab.net/wpplugin/zipped/plugins/';
		$notifier_file = $base . 'bptm/notifier_bptm.php';
		new WpAutoUpdater( BWL_PETITIONS_VERSION, $notifier_file, BWL_PETITIONS_PLUGIN_UPDATER_SLUG );
	}
}
