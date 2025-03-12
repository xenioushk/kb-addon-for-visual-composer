<?php
namespace BwlFaqManager\Controllers\DashboardWidgets;

use BwlFaqManager\Api\DashboardWidgets\DashboardWidgetsApi;
use BwlFaqManager\Callbacks\DashboardWidgets\DashboardWidgetsCb;

/**
 * @package BwlFaqManager
 */

class PluginDashboardWidgets {

	public $dashboardWidgets;
	public $dashboardWidgetsApi;
	public $dashboardWidgetsCb;

	public $dashboardWidgetsSettings = [];
	public $dashWidgets              = [];

	public function __construct() {
		$this->register();
	}

	public function register() {

		// Initialize API.
		$this->dashboardWidgetsApi = new DashboardWidgetsApi();

		// Initialize callbacks.

		$this->dashboardWidgetsCb = new DashboardWidgetsCb();

		// Add all the dashwidgets here.

		$this->dashboardWidgetsSettings = [
			[
				'slug'  => 'baf-plugin-summary',
				'title' => 'Summary',
				'cb'    => [ $this->dashboardWidgetsCb, 'getPluginSummary' ],
			],
		];

		$this->dashboardWidgetsApi->add_dash_widgets( $this->dashboardWidgetsSettings )->register();
	}
}
