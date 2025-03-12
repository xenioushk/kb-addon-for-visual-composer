<?php
namespace KAFWPB\Controllers\TemplatesManager;

/**
 * Class to handle the petition templates.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionTemplates {

	/**
	 * Current active template path
	 *
	 * @var string $template_dir
	 */
	private $template_dir;

	/**
	 * Template sign form.
	 *
	 * @var string $template_sign_form
	 */
	private $template_sign_form;

	/**
	 * Template admin email form.
	 *
	 * @var string $template_admin_email
	 */
	private $template_admin_email;

	/**
	 * Constructor for the class.
	 */
	public function __construct() {
		$this->template_dir         = get_stylesheet_directory();
		$this->template_sign_form   = 'petition_templates/sign_form.php';
		$this->template_admin_email = 'petition_templates/email/admin_message.php';
	}
	/**
	 * Register filters.
	 */
	public function register() {
		$this->set_sign_form_template();
		$this->set_admin_email_template();
	}

	/**
	 * Check if the template exists.
	 *
	 * @param string $file_path  File path.
	 * @example if file exist to the template folder it returns 1, else 0.
	 * @return int
	 */
	private function check_template_status( $file_path = '' ) {
		if ( ! empty( locate_template( $file_path ) ) ) {
			return 1;
		} else {
			return 0;
		}

	}

	/**
	 * Set the sign form template.
	 */
	public function set_sign_form_template() {

		$template = ( $this->check_template_status( $this->template_sign_form ) ) ?
												$this->template_dir . '/' . $this->template_sign_form :
												BWL_PETITIONS_PLUGIN_FILE_PATH . '/' . $this->template_sign_form;
		include_once $template;

	}

	/**
	 * Set the admin email template.
     *
	 * @since 1.1.0
	 * @example petition_templates/email/admin_message.php
	 */
	private function set_admin_email_template() {

		$template = ( $this->check_template_status( $this->template_admin_email ) ) ?
												$this->template_dir . '/' . $this->template_admin_email :
												BWL_PETITIONS_PLUGIN_FILE_PATH . '/' . $this->template_admin_email;

		define( 'BPTM_ADMIN_NOTIFY_EMAIL', $template );

	}
}
