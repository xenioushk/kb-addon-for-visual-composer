<?php
namespace KAFWPB\Controllers\Pages\OptionsPanel;

use BwlPetitionsManager\Base\BaseController;
/**
 * Download sign report in CSV format.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class ReportDownload extends BaseController {

	/**
	 * Register the report download.
	 */
	public function register() {
		$this->generate_csv();
	}

	/**
	 * Generate CSV file for sign report.
	 */
	public function generate_csv() {

		if ( isset( $_POST['pvm_download_report'] ) ) {

			check_admin_referer( 'bptm-sign-report-nonce', '_wpnonce_sign_report' );

			global $wpdb;

			$petitions_table = BPTM_DATA_TABLE;

			$post_id = $_POST['bptm_post_title']; // Get post ID
			// Get Custom Date range status.
			$bptm_custom_date_range = isset( $_POST['bptm_custom_date_range'] ) ? $_POST['bptm_custom_date_range'] : '';
			// Starting date of filter.
			$bptm_filter_start_date = isset( $_POST['bptm_filter_start_date'] ) ? $_POST['bptm_filter_start_date'] : '';
			// Ending date of filter.
			$bptm_filter_end_date = isset( $_POST['bptm_filter_end_date'] ) ? $_POST['bptm_filter_end_date'] : '';

			$vars = [ $post_id ];

			$date_filters = '';

			if ( $bptm_custom_date_range === 'on' ) {

				$bptm_filter_start_date = ( empty( $bptm_filter_start_date ) ) ? '2010-04-01' : $bptm_filter_start_date;

				$bptm_filter_end_date = ( empty( $bptm_filter_end_date ) ) ? date( 'Y-m-d' ) : $bptm_filter_end_date;

				$date_filters .= ' AND DATE(bpt_user_sign_date) >= %s AND DATE(bpt_user_sign_date) <= %s ';

				$vars[] = $bptm_filter_start_date;

				$vars[] = $bptm_filter_end_date;
			}

			// Get each votes info in details. ( Details )

			$sql = $wpdb->prepare("SELECT ID, postid, bpt_user_name, bpt_user_email, bpt_user_country, bpt_user_ip,bpt_user_msg, bpt_user_address, bpt_user_sign_date_time FROM {$petitions_table} 
  
                  WHERE postid = %d 
  
                  " . $date_filters . '
  
                  ORDER BY ID DESC', $vars);

			// Generate data from query.

			$bptm_sign_data = $wpdb->get_results( $sql, ARRAY_A );

			$bpvm_full_sign_data = [];

			if ( count( $bptm_sign_data ) > 0 ) :

				foreach ( $bptm_sign_data as $sign_data ) :

					$post_id = $sign_data['postid'];

					$row_id = $sign_data['ID'];

					$bpt_user_name = $sign_data['bpt_user_name'];

					$bpt_user_email = $sign_data['bpt_user_email'];

					$bpt_user_address = ( ! empty( $sign_data['bpt_user_address'] ) ) ? $sign_data['bpt_user_address'] . ', ' : '';

					$bpt_user_country = $sign_data['bpt_user_country'];

					$bpt_user_ip = $sign_data['bpt_user_ip'];

					$bpt_user_msg = ( ! empty( $sign_data['bpt_user_msg'] ) ) ? '' : $sign_data['bpt_user_msg'];

					$bpt_user_sign_date_time = $sign_data['bpt_user_sign_date_time'];

					// End of backend total vote counting.

					array_push($bpvm_full_sign_data, [

						$bpt_user_name,

						$bpt_user_email,

						$bpt_user_address . $bpt_user_country,

						$bpt_user_ip,

						$bpt_user_msg,

						$bpt_user_sign_date_time,

					]);

					endforeach;

			endif;

			wp_reset_postdata();

			$output_file = 'petition_data_' . date( 'Y-m-d-H-i-s' ) . '.csv';

			header( 'Content-Description: File Transfer' );

			header( 'Content-Disposition: attachment; filename=' . $output_file );

			header( 'Content-Type: text/csv; charset=' . get_option( 'blog_charset' ), true );

			$input_array = $bpvm_full_sign_data;

			$delimiter = ',';

			/** Open raw memory as file, no need for temp files, be careful not to run out of memory thought */

			$f = fopen( 'php://memory', 'w' );

			foreach ( $input_array as $line ) {

				/** Default php csv handler */

				fputcsv( $f, $line, $delimiter );
			}

			fseek( $f, 0 );

			/** Modify header to be downloadable csv file */

			header( 'Content-Type: application/csv' );

			header( 'Content-Disposition: attachement; filename="' . $output_file . '";' );

			/** Send file to browser for download */

			fpassthru( $f );

			exit;
		}
	}
}
