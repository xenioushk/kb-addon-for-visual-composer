<?php
namespace KAFWPB\Controllers\Pages\OptionsPanel;

use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Api\OptionsPanel\OptionsPanelApi;
use BwlPetitionsManager\Callbacks\Pages\OptionsPanel\EmailTemplateCb;
/**
 * Class for Initialize plugin Email Template.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class EmailTemplate extends BaseController {

	/**
	 * Options panel API.
	 *
	 * @var object $options_panel_api
	 */
	public $options_panel_api;

	/**
	 * Plugin email template callback.
	 *
	 * @var object $plugin_email_template_cb
	 */
	public $plugin_email_template_cb;

	/**
     * Register email template.
     */
	public function register() {

		$this->options_panel_api        = new OptionsPanelApi();
		$this->plugin_email_template_cb = new EmailTemplateCb();

		// Gather all the options.
		// Maintain the order.
		// (Option group >> option name >> page slug >> option section >> option fields.)
		$options = [

			// This index is important and must be matched with the settings_fields('bptm_email_tpl_options_group')
			'bptm_email_tpl_options_group' => [
				// retrive data using this key. get_option('bptm_email_tpl_options')
				'option_name'        => 'bptm_email_tpl_options',
				// must be the same to do_settings_sections("bptm-template-settings");
				'page'               => 'bptm-template-settings',
				// Now, you can register multiple sections and fields here.
					'option_section' => [
						[
							'section_tag' => 'bptm_user_sign_tpl_section',
							'title'       => esc_html__( 'Sign Confirmation Email', 'bwl_ptmn' ),
							'cb'          => [ $this->plugin_email_template_cb, 'getTheSectionInfo' ],
							'fields'      => [
								'bptm_user_sign_subject_tpl' => [
									'title' => esc_html__( 'Subject', 'bwl_ptmn' ),
									'cb'    => [ $this->plugin_email_template_cb, 'getTheSubject' ],
								],
								'bptm_user_sign_header_tpl' => [
									'title' => esc_html__( 'Header', 'bwl_ptmn' ),
									'cb'    => [ $this->plugin_email_template_cb, 'getTheHeader' ],
								],
								'bptm_user_sign_tpl' => [
									'title' => esc_html__( 'Body', 'bwl_ptmn' ),
									'cb'    => [ $this->plugin_email_template_cb, 'getTheBody' ],
								],
							],
						],
					],

			],
		];

		// register all the options.
		$this->options_panel_api->add_options( $options )->register();
	}
}
