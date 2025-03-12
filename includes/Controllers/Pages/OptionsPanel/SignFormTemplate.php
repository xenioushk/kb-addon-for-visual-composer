<?php
namespace KAFWPB\Controllers\Pages\OptionsPanel;

use BwlPetitionsManager\Base\BaseController;
use BwlPetitionsManager\Api\OptionsPanel\OptionsPanelApi;
use BwlPetitionsManager\Callbacks\Pages\OptionsPanel\SignFormTemplateCb;
/**
 * Class for Initialize plugin Sign Form Template.
 *
 * @package BwlPetitionsManager
 */
class SignFormTemplate extends BaseController {

	/**
	 * Options panel API.
	 *
	 * @var object $options_panel_api
	 */
	public $options_panel_api;

	/**
	 * Sign form template callback.
	 *
	 * @var object $signFormTemplateCb
	 */
	public $sign_form_template_cb;

	/**
     * Register sign form template.
     */
	public function register() {

		$this->options_panel_api     = new OptionsPanelApi();
		$this->sign_form_template_cb = new SignFormTemplateCb();

		// Gather all the options.
		// Maintain the order.
		// (Option group >> option name >> page slug >> option section >> option fields.)
		$options = [

			// This index is important and must be matched with the settings_fields('bptm_email_tpl_options_group')
			'bptm_sign_form_tpl_options_group' => [
				// retrive data using this key. get_option('bptm_email_tpl_options')
				'option_name'        => 'bptm_sign_form_tpl_options',
				// must be the same to do_settings_sections("bptm-template-settings");
				'page'               => 'bptm-sign-form-settings',
				// Now, you can register multiple sections and fields here.
					'option_section' => [
						[
							'section_tag' => 'bptm_user_sign_tpl_section',
							'title'       => esc_html__( 'Sign Form', 'bwl_ptmn' ),
							'cb'          => [ $this->sign_form_template_cb, 'getTheSectionInfo' ],
							'fields'      => [
								'bptm_custom_sign_form_status' => [
									'title' => esc_html__( 'Enable Custom Form?', 'bwl_ptmn' ),
									'cb'    => [ $this->sign_form_template_cb, 'getSignFormStatus' ],
								],
								'bptm_sign_form_template_shortcode' => [
									'title' => esc_html__( 'Shortcode', 'bwl_ptmn' ),
									'cb'    => [ $this->sign_form_template_cb, 'signFormShortcode' ],
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
