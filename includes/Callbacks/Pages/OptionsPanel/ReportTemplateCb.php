<?php
namespace KAFWPB\Callbacks\Pages\OptionsPanel;

use BwlPetitionsManager\Base\BaseController;
/**
 * This is the report page for the plugin.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class ReportTemplateCb extends BaseController {

	/**
	 * Get the view of the report page.
	 */
	public function get_the_view() {
			require_once "{$this->plugin_template_path}admin/sign_report/report.php";
	}
}
