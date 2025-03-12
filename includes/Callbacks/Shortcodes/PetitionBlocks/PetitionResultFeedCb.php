<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Result Layout
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionResultFeedCb {

	public function getTheLayout( $atts ) {

		$atts = shortcode_atts([
			'id'                         => '',
			'result_feed_heading_status' => 1,
			'signed_user_name_color'     => '#626262',
			'signed_user_country'        => '#ff8141',
			'signed_text'                => '#ff8141',
			'petition_signed_time_ago'   => '#626262',
			'post_type'                  => 'petitions',
			'bptm_extra_class'           => '',
		], $atts);

		extract( $atts );

		if ( $id != '' ) {
			$args['p'] = $id;
		} else {
			return '';
		}

		$bwl_petition_sign_lists = bwl_get_petitions_data( $id ); // This will return only last 5 or user defiend amount of sign data.

		// Here we are going to check if  signed list is empty or not.
		if ( empty( $bwl_petition_sign_lists ) ) {

			$bwl_petition_sign_lists = [];
			$bwl_total_signed        = 0;
		} else {
			$bwl_total_signed = bwl_count_petition_sign( $id );
		}

		// Initialize Custom Styles.

		$signed_user_name_style         = '';
		$signed_user_country_style      = '';
		$signed_text_style              = '';
		$petition_signed_time_ago_style = '';

		if ( $signed_user_name_color != '' ) :
			$signed_user_name_style .= ' style="color:' . $signed_user_name_color . ';"';
		endif;

		if ( $signed_user_country != '' ) :
			$signed_user_country_style .= ' style="color:' . $signed_user_country_style . ';"';
		endif;

		if ( $signed_text != '' ) :
			$signed_text_style .= ' style="color:' . $signed_text . ';"';
		endif;

		if ( $petition_signed_time_ago != '' ) :
			$petition_signed_time_ago_style .= ' style="color:' . $petition_signed_time_ago . ';"';
		endif;

		if ( $result_feed_heading_status == 1 ) {

			$petition_result_ticker_default_title = '<h2 class="section-heading text-center"><span>Latest</span> Signature</h2>';

			$get_result_ticker_title = get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'result_ticker_title', true );

			$result_ticker_title = ( $get_result_ticker_title != '' ) ? $get_result_ticker_title : $petition_result_ticker_default_title;

			$result_ticker_title = '<h2 class="section-heading result_feed_heading text-center">' . $result_ticker_title . '</h2>';
		} else {

			$result_ticker_title = '';
		}

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : ' ' . $bptm_extra_class;

		$output = '<div class="row">';

		$signature_row = '<ul class="petition_signed_info_container">';

		foreach ( $bwl_petition_sign_lists as $list ) :

			$my_current_time = strtotime( date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) );

			$signed_date = strtotime( $list['bpt_user_sign_date_time'] );

			$signed_time_ago = human_time_diff( $signed_date, $my_current_time );

			$signature_row .= '<li>
                                              <div class="row">
                                                  <div class="col-sm-12 col-md-8">
                                                      <p>
                                                          <span class="signed_user_name" ' . $signed_user_name_style . '>' . ucfirst( $list['bpt_user_name'] ) . '</span><br>
                                                          <span class="signed_user_country" ' . $signed_user_country_style . '>' . ucfirst( $list['bpt_user_country'] ) . '</span>
                                                      </p>
                                                      </div> 
                                                      <div class="col-sm-12 col-md-4">
                                                      <p>
                                                          <span class="signed_text" ' . $signed_text_style . '>' . esc_html__( 'Signed', 'bwl_ptmn' ) . '</span><br>
                                                          <time class="" datetime="' . $list['bpt_user_sign_date_time'] . '" ' . $petition_signed_time_ago_style . '>' . $signed_time_ago . ' ' . esc_html__( 'ago', 'bwl_ptmn' ) . '</time>
                                                      </p>
                                                  </div>
                                              </div>
                                          </li>';

		endforeach;

		$signature_row .= '</ul>';

		$signature_row_string = "<div class='vticker petition-signature-ticker'>$signature_row</div>";

		$output .= "<div class='col-lg-12 col-md-12 col-sm-12'>$signature_row_string</div>";

		$output .= '</div>';

		return $output;
	}
}
