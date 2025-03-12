<?php

namespace KAFWPB\Callbacks\AdminAjaxHandlers;

use BwlPetitionsManager\Base\BaseController;

/**
 * Class for delete sign callback.
 *
 * @package BwlPetitionsManager
 */
class DeleteSignCb extends BaseController {

	/**
	 * Delete sign data.
	 */
	public function delete_sign_data() {

		check_ajax_referer( 'bptm-sign-report-nonce', '_wpnonce_sign_report' );

		$post_data['status'] = 0;

		global $wpdb;

		$petition_table = BPTM_DATA_TABLE;
		$data_ids       = $_REQUEST['data_ids'];
		$post_id        = $_REQUEST['post_id'];
		$removeAll      = ( $_REQUEST['removeAll'] == 'true' ) ? true : false;
		$data_id_array  = explode( ',', $data_ids );

		if ( $removeAll == true ) {

			$wpdb->delete(
                $petition_table,
                [
					'postid' => $post_id,
                ],
                [ '%d' ] // Where Format
			);
			update_post_meta( $post_id, BPTM_META_MANUAL_SIGN_COUNT, 0 );
			$post_data['status'] = 1;
			wp_reset_postdata();
			bwl_recount_sign_data( $post_id );
		} else {

			foreach ( $data_id_array as $key => $row_id ) {

				$wpdb->delete(
                    $petition_table,
                    [
						'ID'     => $row_id,
						'postid' => $post_id,
                    ],
                    [ '%d', '%d' ] // Where Format
				);
				$post_data['status'] = 1;
				wp_reset_postdata();
			}
			bwl_recount_sign_data( $post_id );
		}

		echo wp_json_encode( $post_data );

		die();
	}
}
