<?php
namespace KAFWPB\Callbacks\FrontendAjaxHandlers;

use BwlPetitionsManager\Base\Helpers;
use BwlPetitionsManager\Base\BaseController;

use BwlPetitionsManager\Traits\QueryTraits;
use BwlPetitionsManager\Traits\EmailTraits;
use BwlPetitionsManager\Traits\SignCountTrait;
use BwlPetitionsManager\Traits\SignStatusTraits;

/**
 * Save petition sign data.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class SaveSignCb extends BaseController {

	use QueryTraits;
	use EmailTraits;
	use SignCountTrait;
	use SignStatusTraits;

	/**
	 * Petition ID.
	 *
	 * @var int
	 */
	private $petition_id;

	/**
	 * Sender Name.
	 *
	 * @var string
	 */
	private $bpt_user_name;

	/**
	 * Sender Email.
	 *
	 * @var string
	 */
	private $bpt_user_email;

	/**
	 * Sender country.
	 *
	 * @var string
	 */
	private $bpt_user_country;

	/**
	 * Sender Message.
	 *
	 * @var string
	 */
	private $bpt_user_msg;

	/**
	 * User Address.
	 *
	 * @var string
	 */
	private $bpt_user_address;

	/**
	 * Additional fields.
	 *
	 * @var array
	 */
	private $bpt_add_fields;

	/**
	 * User IP.
	 *
	 * @var string
	 */
	private $bpt_user_ip;

	/**
	 * Sign Date.
	 *
	 * @var string
	 */
	private $bpt_user_sign_date;

	/**
	 * Sign Date & Time.
	 *
	 * @var string
	 */
	private $bpt_user_sign_date_time;

	/**
	 * Options.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * User ID.
	 *
	 * @var int
	 */
	private $bpt_user_id;

	/**
	 * Sign Verify Status.
	 *
	 * @var int
	 */
	private $bptm_sign_verify_status;

	/**
	 * Send mail to user status.
	 *
	 * @var bool
	 */
	private $bpt_send_mail_to_user_status = true;

	/**
	 * Send mail to admin status.
	 *
	 * @var bool
	 */
	private $bpt_send_mail_to_admin_status;

	/**
	 * User Sign Verify Template.
	 *
	 * @var string
	 */
	private $bptm_user_sign_verify_tpl;

	/**
	 * Status with verify key.
	 *
	 * @var int|string
	 */
	private $bptm_status_with_verify_key;

	/**
	 * User Sign Status.
	 * If $bptm_status_with_verify_key is enabled then it will be the verify key.
	 * Other wise default value is 1
     *
	 * @var int
	 */
	private $bpt_user_sign_status;

	/**
	 * Admin Email address.
	 * We will use this email address to send sign receive email to admin.
	 *
	 * @var string
	 */
	private $to;

	/**
	 * Petition Add Status.
	 *
	 * @var int
	 * @default 0
	 */
	private $bwl_petition_add_status = 0;

	/**
	 * Petition Signed Receive/Reject Message.
	 *
	 * @var string
	 */
	private $msg;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->options = get_option( 'petitions_options' );
		$this->set_admin_email();
		$this->set_admin_email_send_status();
		$this->set_user_id();
		$this->set_sign_verify_status();
	}

	/**
	 * Set admin email.
	 */
	private function set_admin_email() {
		$this->to = ( isset( $this->options['bptm_admin_email'] ) && ! empty( $this->options['bptm_admin_email'] ) ) ?
											$this->options['bptm_admin_email'] : get_bloginfo( 'admin_email' );
	}

	/**
	 * Set admin email send status.
	 */
	private function set_admin_email_send_status() {
		// If options panel value is set to 1 then email sending option is disabled.
		$this->bpt_send_mail_to_admin_status = ( isset( $this->options['bpt_send_mail_to_admin_status'] ) && intval( $this->options['bpt_send_mail_to_admin_status'] ) === 1 ) ? 0 : 1; //phpcs:ignore
	}
	/**
	 * Set user id.
	 */
	private function set_user_id() {

		$this->bpt_user_id = 0;

		if ( is_user_logged_in() ) {

			$current_user = wp_get_current_user();

			$this->bpt_user_id = $current_user->ID;
		}
	}

	/**
	 * Set sign verify status.
	 */
	private function set_sign_verify_status() {
		$this->bptm_sign_verify_status = ( isset( $this->options['bptm_sign_verify_status'] ) && intval( $this->options['bptm_sign_verify_status'] ) === 1 ) ? 1 : 0; //phpcs:ignore
		$this->bptm_status_with_verify_key = substr( time(), 0, BPTM_VERIFY_TOKEN_LENGTH );
		$this->bpt_user_sign_status        = ( $this->bptm_sign_verify_status === 1 ) ? $this->bptm_status_with_verify_key : 1;
	}

	/**
	 * Set Sign Form Fields.
	 */
	private function set_sign_form_fields() {

		// Petition ID.
			$this->petition_id = intval( $_REQUEST['bwl_petition_id'] ); //phpcs:ignore

			// Sender Name.
			$this->bpt_user_name = sanitize_text_field( $_REQUEST['bpt_user_name'] );//phpcs:ignore

			// Sender Email.
			$this->bpt_user_email = sanitize_email( $_REQUEST['bpt_user_email'] );//phpcs:ignore

			// Sender country.
			$this->bpt_user_country = $_REQUEST['bpt_user_country'];//phpcs:ignore

			// Sender Message.
			$this->bpt_user_msg = sanitize_textarea_field( $_REQUEST['bpt_user_msg'] );//phpcs:ignore

			// User Address.
			$this->bpt_user_address = sanitize_text_field( $_REQUEST['bpt_user_address'] );//phpcs:ignore

			// Additional fields
			$this->bpt_add_fields = isset( $_REQUEST['bpt_add_fields'] ) ? $_REQUEST['bpt_add_fields'] : [];//phpcs:ignore

			// User IP
			$this->bpt_user_ip = $_SERVER['REMOTE_ADDR'];//phpcs:ignore

			// Sign Date.
			$this->bpt_user_sign_date = date( 'Y-m-d' );

			// Sign Date & Time.
			$this->bpt_user_sign_date_time = date( 'Y-m-d H:i:s', \current_time( 'timestamp' ) );//phpcs:ignore

	}

	/**
	 * Save petition sign data.
	 */
	public function save_data() {

		check_ajax_referer( 'bptm-frontend-sign-nonce', '_wpnonce_frontend_sign' );

		if ( empty( $_REQUEST ) || empty( $_REQUEST['bwl_petition_id'] ) ) {

			$status = [

				'bwl_petition_add_status' => $this->bwl_petition_add_status,

			];
		} else {

			$options = get_option( 'petitions_options' );

			$this->set_sign_form_fields();

			$bwl_total_signed = $this->get_the_total_sign_count( $this->petition_id );

			if ( $this->bptm_sign_verify_status === 0 ) {
				// Increase the sign count to 1;
				$bwl_total_signed = $bwl_total_signed + 1; //phpcs:ignore

			}

				// Checking Petition Target

				$bwl_petition_sign_target_count = $this->get_the_sign_target_count( $this->petition_id );
				$has_user_signed                = $this->check_petition_signed_status( $this->petition_id, $this->bpt_user_email, $this->bpt_user_ip );
				$is_target_reached              = ( $bwl_total_signed > $bwl_petition_sign_target_count ) ? 1 : 0;

			if ( $is_target_reached ) {

				$this->msg = esc_attr__( 'Petition sign target has been completed. Thanks !', 'bwl_ptmn' );
			} elseif ( $has_user_signed ) {

				$this->msg = esc_attr__( 'You already signed this petition. Thanks !', 'bwl_ptmn' );
			} else {

				if ( $this->bptm_sign_verify_status === 1 ) {

					$this->set_sign_verification_components();

					$this->msg = esc_html__( 'Sign count is waiting for verification!', 'bwl_ptmn' );

				} else {

					update_post_meta( $this->petition_id, BPTM_META_USER_SIGN_COUNT, $bwl_total_signed );

					$this->msg = esc_html__( 'Sign counted successfully!', 'bwl_ptmn' );
				}

				// Insert Data to database.
				$this->add_sign_data_to_db();

				$this->bwl_petition_add_status = 1;

				// Send Email To User.

				$this->send_email_to_user();

				$this->send_email_to_admin();
			}

			$status = [
				'bwl_petition_add_status' => $this->bwl_petition_add_status,
				'msg'                     => $this->msg,

			];
		}

		echo wp_json_encode( $status );

		die();
	}

	/**
	 * Add sign data to database.
	 */
	private function add_sign_data_to_db() {

		$table_data = [
			'postid'                  => $this->petition_id,
			'bpt_user_name'           => $this->bpt_user_name,
			'bpt_user_email'          => $this->bpt_user_email,
			'bpt_user_country'        => $this->bpt_user_country,
			'bpt_user_msg'            => $this->bpt_user_msg,
			'bpt_user_address'        => $this->bpt_user_address,
			'bpt_user_ip'             => $this->bpt_user_ip,
			'bpt_user_id'             => $this->bpt_user_id,
			'bpt_user_sign_date'      => $this->bpt_user_sign_date,
			'bpt_user_sign_date_time' => $this->bpt_user_sign_date_time,
			'bpt_user_sign_status'    => $this->bpt_user_sign_status,
			'bpt_add_fields'          => maybe_serialize( $this->bpt_add_fields ),
		];

		$table_data_type = [
			'%d',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%d',
			'%s',
			'%s',
			'%d',
			'%s',
		];

		$this->bwl_wp_insert_query( BPTM_DATA_TABLE, $table_data, $table_data_type );
	}


	/**
	 * Set sign verification components.
	 */
	private function set_sign_verification_components() {

		$this->create_sign_verification_wp_page();

		$this->set_verify_sign_template();

	}

	/**
	 * Set sign verification template.
	 */
	private function set_verify_sign_template() {

		$token_url = home_url( BPTM_SIGN_CONFIRM_PAGE_SLUG ) . '?token=' . $this->bptm_status_with_verify_key;

		$link = "<a href='{$token_url}'>Verify Now</a>";

		$this->bptm_user_sign_verify_tpl = "<p> In order to verify your sign you need to click on the link . {$link}</p>";
	}


	/**
	 * Send email to admin.
	 */
	private function send_email_to_admin() {

		if ( $this->bpt_send_mail_to_admin_status === 0 ) {
			return;
		}

		$email = apply_filters( 'bptm_sender_no_reply_email', 'no-reply@' . $this->get_site_domain() );

		$subject = esc_html__( 'New petition sign received!', 'bwl_ptmn' );

		ob_start();

		require_once BPTM_ADMIN_NOTIFY_EMAIL;

		$body = ob_get_contents();

		ob_end_clean();

		$headers[] = "From: Petition Signed <$email>";

		add_filter( 'wp_mail_content_type', [ 'BwlPetitionsManager\Helpers\EmailContentType', 'setHTMLType' ] );

		wp_mail( $this->to, $subject, $body, $headers );

		remove_filter( 'wp_mail_content_type', [ 'BwlPetitionsManager\Helpers\EmailContentType', 'setHTMLType' ] );
	}

	/**
	 * Send email to user.
	 */
	private function send_email_to_user() {

				$bptm_email_tpl_options = get_option( 'bptm_email_tpl_options' );

				$bptm_user_sign_subject_tpl = isset( $bptm_email_tpl_options['bptm_user_sign_subject_tpl'] ) && ! empty( $bptm_email_tpl_options['bptm_user_sign_subject_tpl'] ) ? $bptm_email_tpl_options['bptm_user_sign_subject_tpl'] : Helpers::BPTM_USER_SIGN_SUBJECT_TPL;
				$bptm_user_sign_tpl         = isset( $bptm_email_tpl_options['bptm_user_sign_tpl'] ) && ! empty( $bptm_email_tpl_options['bptm_user_sign_tpl'] ) ? $bptm_email_tpl_options['bptm_user_sign_tpl'] : Helpers::get_bptm_user_sign_tpl_text();
				$bptm_user_sign_tpl        .= $this->bptm_user_sign_verify_tpl;

				$search = [
					'{bptm_user_name}' => $this->bpt_user_name,
				];
				foreach ( $search as $key => $value ) {
					$bptm_user_sign_tpl = str_ireplace( $key, $value, $bptm_user_sign_tpl );
				}

				$email = apply_filters( 'bptm_sender_no_reply_email', 'no-reply@' . $this->get_site_domain() );

				$bptm_user_sign_header_tpl = isset( $bptm_email_tpl_options['bptm_user_sign_header_tpl'] ) && ! empty( $bptm_email_tpl_options['bptm_user_sign_header_tpl'] ) ? $bptm_email_tpl_options['bptm_user_sign_header_tpl'] : Helpers::BPTM_USER_SIGN_HEADER_TPL;

				$headers[] = "From: $bptm_user_sign_header_tpl <$email>";

				add_filter( 'wp_mail_content_type', [ 'BwlPetitionsManager\Helpers\EmailContentType', 'setHTMLType' ] );

				wp_mail( $this->bpt_user_email, $bptm_user_sign_subject_tpl, $bptm_user_sign_tpl, $headers );

				remove_filter( 'wp_mail_content_type', [ 'BwlPetitionsManager\Helpers\EmailContentType', 'setHTMLType' ] );
	}
}
