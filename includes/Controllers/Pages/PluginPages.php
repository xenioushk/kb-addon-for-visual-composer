<?php

namespace KAFWPB\Controllers\Pages;

use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Api\Pages\PluginPagesApi;
use BwlPetitionsManager\Callbacks\Pages\OptionsPanel\EmailTemplateCb;
use BwlPetitionsManager\Callbacks\Pages\OptionsPanel\ReportTemplateCb;
use BwlPetitionsManager\Callbacks\Pages\OptionsPanel\SignFormTemplateCb;

/**
 * Class for Initialize plugin pages
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class PluginPages extends BaseController {

	/**
	 * Plugin pages.
	 *
	 * @var object $plugin_pages
	 */
	public $plugin_pages;

	/**
	 * Plugin pages settings.
	 *
	 * @var array $plugin_pages_settings
	 */
	public $plugin_pages_pettings = [];

	/**
	 * Email template callback.
	 *
	 * @var object $email_template_cb
	 */
	public $email_template_cb;

	/**
	 * Sign form template callback.
	 *
	 * @var object $sign_form_template_cb
	 */
	public $sign_form_template_cb;

	/**
	 * Report template callback.
	 *
	 * @var object $report_template_cb
	 */
	public $report_template_cb;

	/**
	 * Register pages.
	 */
	public function register() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$this->plugin_pages          = new PluginPagesApi( BWL_PETITIONS_PLUGIN_POST_TYPE );
		$this->email_template_cb     = new EmailTemplateCb();
		$this->sign_form_template_cb = new SignFormTemplateCb();
		$this->report_template_cb    = new ReportTemplateCb();

		$this->plugin_pages_pettings = [
			[
				'page_title' => esc_attr__( 'Email templates settings', 'bwl_ptmn' ),
				'menu_title' => esc_attr__( 'Email Templates', 'bwl_ptmn' ),
				// Need to use that slug for do_settings_sections($this->optionSettingsPageSlug);
				// e.g /includes/Callbacks/Pages/pluginEmailTemplateCb.php
				'menu_slug'  => 'bptm-template-settings',
				'cb'         => [ $this->email_template_cb, 'get_the_view' ],
			],
			[
				'page_title' => esc_attr__( 'Sign Form templates settings', 'bwl_ptmn' ),
				'menu_title' => esc_attr__( 'Sign Form Template', 'bwl_ptmn' ),
				'menu_slug'  => 'bptm-sign-form-settings',
				'cb'         => [ $this->sign_form_template_cb, 'get_the_view' ],
			],
			[
				'page_title' => esc_html__( 'Petitions Report Manager', 'bwl_ptmn' ),
				'menu_title' => esc_html__( 'Petitions Report', 'bwl_ptmn' ),
				'menu_slug'  => 'bptm-sign-report',
				'cb'         => [ $this->report_template_cb, 'get_the_view' ],
			],
		];

		$this->plugin_pages->add_plugin_pages( $this->plugin_pages_pettings )->register();
	}
}
