<?php

namespace KAFWPB\Callbacks\AdminAjaxHandlers;

use BwlPetitionsManager\Base\BaseController;

/**
 * Class for sign data callback.
 *
 * @package BwlPetitionsManager
 */
class SignDataCb extends BaseController {

	/**
	 * Get sign data.
	 */
	public function get_sign_data() {

		check_ajax_referer( 'bptm-sign-report-nonce', '_wpnonce_sign_report' );

		global $wpdb;

		$petition_table = BPTM_DATA_TABLE;

		$request_data = $_REQUEST;

		$columns = [
			0 => 'ID',
			1 => 'bpt_user_name',
			2 => 'bpt_user_email',
			3 => 'bpt_user_country',
			4 => 'bpt_user_ip',
			5 => 'bpt_user_sign_date_time',
		];
		// Get post ID
		$post_id = $_POST['post_id'];

		$vars = [ $post_id ];

		$bptm_custom_date_range = $request_data['bptm_custom_date_range']; // Get Custom Date range status.

		$bptm_filter_start_date = $request_data['bptm_filter_start_date']; // Starting date of filter.

		$bptm_filter_end_date = $request_data['bptm_filter_end_date']; // Ending date of filter.

		$con_mv_date_range_filters = '';

		if ( $bptm_custom_date_range == 'true' ) {

			$bptm_filter_start_date = ( $bptm_filter_start_date == '' ) ? '2010-04-01' : $bptm_filter_start_date;

			$bptm_filter_end_date = ( $bptm_filter_end_date == '' ) ? '2020-04-01' : $bptm_filter_end_date;

			$con_mv_date_range_filters .= ' AND DATE(bpt_user_sign_date) >= %s AND DATE(bpt_user_sign_date) <= %s ';

			$vars[] = $bptm_filter_start_date;

			$vars[] = $bptm_filter_end_date;
		}

		$count_sql = $wpdb->prepare("SELECT COUNT(ID) as total_count FROM {$petition_table} 
  
                  WHERE postid = %d {$con_mv_date_range_filters}", $vars);

		$bptm_total_signed = $wpdb->get_results( $count_sql, ARRAY_A );

		$totalData = ( ! empty( $bptm_total_signed[0]['total_count'] ) ) ? $bptm_total_signed[0]['total_count'] : 0;
		// when there is no search parameter then total number rows = total number filtered rows.
		$totalFiltered = $totalData;
		wp_reset_postdata();

		// Get each votes info in details. ( Details )

		$order_query = ' ORDER BY ' . $columns[ $request_data['order'][0]['column'] ] . '   ' . $request_data['order'][0]['dir'] . '  LIMIT ' . $request_data['start'] . ' ,' . $request_data['length'] . '   ';

		$sql = $wpdb->prepare("SELECT 
    ID, bpt_user_name, bpt_user_email, bpt_user_country, bpt_user_ip, bpt_user_msg,bpt_user_address, bpt_add_fields, bpt_user_sign_date_time 
    FROM {$petition_table}   
                  WHERE postid = %d {$con_mv_date_range_filters} {$order_query}", $vars);

		// Generate data from query.

		$bptm_sign_data = $wpdb->get_results( $sql, ARRAY_A );

		$bptmSignFullData = [];

		if ( ! empty( $bptm_sign_data ) ) :

			$i = 1 + $request_data['start'];

			foreach ( $bptm_sign_data as $sign_data ) :

				$row_id = $sign_data['ID'];

				$bpt_user_name = $sign_data['bpt_user_name'] ?? '-';

				$bpt_user_email = $sign_data['bpt_user_email'] ?? '-';

				$bpt_user_address = $sign_data['bpt_user_address'] ?? '';

				$bpt_user_country = $sign_data['bpt_user_country'] ?? '-';

				$bpt_user_ip = $sign_data['bpt_user_ip'] ?? '-';

				$bpt_user_msg = $sign_data['bpt_user_msg'] ?? '-';

				$bpt_user_sign_date_time = $sign_data['bpt_user_sign_date_time'] ?? '-';

				$bpvmAdditionalInfo = ( $sign_data['bpt_add_fields'] != '' ) ? bptm_generate_additional_field_data( unserialize( $sign_data['bpt_add_fields'] ) ) : '-';

				// End of backend total vote counting.

				array_push($bptmSignFullData, [

					"<input type='checkbox'  class='deleteRow' value='" . $row_id . "'  />",

					$bpt_user_name . $bpt_user_msg . '<br />' . $bpt_user_email,

					$bpt_user_address . $bpt_user_country . '<br />' . $bpt_user_ip,

					$bpt_user_sign_date_time,

					$bpvmAdditionalInfo,

				]);

				++$i;

			endforeach;

		endif;

		wp_reset_vars( $vars );

		wp_reset_postdata();

		$data = [
			'draw'            => intval( $request_data['draw'] ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			'recordsTotal'    => intval( $totalData ), // total number of records
			'recordsFiltered' => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			'data'            => $bptmSignFullData,
		];

		if ( ! in_array( 'ob_gzhandler', ob_list_handlers() ) ) {
			ob_start( 'ob_gzhandler' );
		}

		echo wp_json_encode( $data );
		die();
	}
}
