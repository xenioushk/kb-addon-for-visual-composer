<?php
namespace KAFWPB\Callbacks\Pages\OptionsPanel;

use BwlPetitionsManager\Base\Helpers;
use BwlPetitionsManager\Base\BaseController;

/**
 * Class for email template settings.
 *
 * @package BwlPetitionsManager
 */
class EmailTemplateCb extends BaseController {

	public $optionsData;
	public $optionGroup            = 'bptm_email_tpl_options_group'; // change here.
	public $optionKey              = 'bptm_email_tpl_options'; // change here.
	public $optionSettingsPageSlug = 'bptm-template-settings'; // change here. (page slug) check the pluginEmailTemplate.php file


	public function __construct() {
		$this->optionsData = get_option( $this->optionKey );
	}

	public function get_the_view() {
		wp_enqueue_code_editor( [ 'type' => 'text/html' ] );
		wp_enqueue_style( 'wp-codemirror' );
		?>

<div class="wrap faq-wrapper bptm-option-panel">

    <h2><?php esc_html_e( 'Email Template Settings', 'bwl_ptmn' ); ?></h2>

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


	public function getTheSubject() {
		$bptm_user_sign_subject_tpl = $this->optionsData['bptm_user_sign_subject_tpl'] ?? Helpers::BPTM_USER_SIGN_SUBJECT_TPL ?: Helpers::BPTM_USER_SIGN_SUBJECT_TPL;

		echo '<input type="text" name="bptm_email_tpl_options[bptm_user_sign_subject_tpl]" id="bptm_user_sign_subject_tpl"  class="regular-text widefat" value="' . sanitize_text_field( $bptm_user_sign_subject_tpl ) . '">';
	}

	function getTheHeader() {
		$bptm_user_sign_header_tpl = $this->optionsData['bptm_user_sign_header_tpl'] ?? Helpers::BPTM_USER_SIGN_HEADER_TPL ?: Helpers::BPTM_USER_SIGN_HEADER_TPL;

		echo '<input type="text" name="bptm_email_tpl_options[bptm_user_sign_header_tpl]" id="bptm_user_sign_header_tpl"  class="regular-text widefat" value="' . sanitize_text_field( $bptm_user_sign_header_tpl ) . '">';
	}

	/**
	 * @Description: Search Placeholder Text
	 **/
	function getTheBody() {

		$bptm_user_sign_tpl = $this->optionsData['bptm_user_sign_tpl'] ?? helpers::get_bptm_user_sign_tpl_text() ?: helpers::get_bptm_user_sign_tpl_text();

		echo '<textarea type="text" name="bptm_email_tpl_options[bptm_user_sign_tpl]" id="bptm_user_sign_tpl"  class="regular-text all-options">' . $bptm_user_sign_tpl . '</textarea>';
	}
}
