<?php

namespace KAFWPB\Callbacks\Pages\OptionsPanel;

use BwlPetitionsManager\Base\Helpers;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class for sign form template settings.
 *
 * @package BwlPetitionsManager
 */
class SignFormTemplateCb extends BaseController {


	public $optionsData;
	public $optionGroup            = 'bptm_sign_form_tpl_options_group'; // change here.
	public $optionKey              = 'bptm_sign_form_tpl_options'; // change here.
	public $optionSettingsPageSlug = 'bptm-sign-form-settings'; // change here. (page slug) check the pluginEmailTemplate.php file

	public function __construct() {
		$this->optionsData = get_option( $this->optionKey );
	}

	public function get_the_view() {
		wp_enqueue_code_editor( [ 'type' => 'text/html' ] );
		wp_enqueue_style( 'wp-codemirror' );
		?>

<div class="wrap faq-wrapper bptm-option-panel">

    <h2><?php esc_html_e( 'Sign Form Template Settings', 'bwl_ptmn' ); ?></h2>

		<?php if ( isset( $_GET['settings-updated'] ) ) { ?>
    <div id="message" class="updated">
    <p><strong><?php esc_html_e( 'Settings saved.', 'bwl_ptmn' ); ?></strong></p>
    </div>
    <?php } ?>

    <form action="options.php" method="post">
		<?php
        settings_fields( $this->optionGroup );
        do_settings_sections( $this->optionSettingsPageSlug );
        ?>

    <p class="submit">
        <input name="submit" type="submit" class="button-primary"
        value="<?php esc_html_e( 'Save Settings', 'bwl_ptmn' ); ?>">
    </p>
    </form>

</div>

		<?php

	}

	public function getTheSectionInfo() {
		// echo "hello world from the section";
	}

	function getSignFormStatus() {

		$option = get_option( 'bptm_sign_form_tpl_options' );

		$status = $option['bptm_custom_sign_form_status'] ?? 0 ?: 0;

		if ( $status == 1 ) {
			$show_status = 'selected=selected';
			$hide_status = '';
		} else {

			$show_status = '';
			$hide_status = 'selected=selected';
		}

		echo '<select name="bptm_sign_form_tpl_options[bptm_custom_sign_form_status]">	 
     <option value="0" ' . $hide_status . '>' . esc_html__( 'No', 'bwl_ptmn' ) . '</option>
     <option value="1" ' . $show_status . '>' . esc_html__( 'Yes', 'bwl_ptmn' ) . '</option>	 
  </select>';
	}

	function signFormShortcode() {

		$option = get_option( 'bptm_sign_form_tpl_options' );

		$bptm_sign_form_template_shortcode = $option['bptm_sign_form_template_shortcode'] ?? Helpers::getDefaultSignFormShortcode() ?: Helpers::getDefaultSignFormShortcode();

		echo "<textarea type='text' name='bptm_sign_form_tpl_options[bptm_sign_form_template_shortcode]' id='bptm_sign_form_template_shortcode'  class='regular-text all-options'>{$bptm_sign_form_template_shortcode}</textarea>";
		echo "Note: Check the <a href='https://xenioushk.github.io/docs-wp-themes/appeal/petitions_manager/index.html#plugin_template_section' target='_blank'>documentation</a> for more examples.";
	}
}
