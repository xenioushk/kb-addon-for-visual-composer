<?php
namespace KAFWPB\Controllers\Pages\OptionsPanel;

use BwlPetitionsManager\Base\BaseController;

/**
 * This is the main options panel for the plugin.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class CoreOptionsPanel extends BaseController {

	/**
	 * Register options panel.
	 */
	public function register() {
		$this->add_options_panel();
	}

	/**
     * Add options panel view template.
     */
	public function add_options_panel() {
		if ( is_admin() ) {
			require_once "{$this->plugin_template_path}admin/option-panel/options-panel-settings.php";
		}
	}
}
