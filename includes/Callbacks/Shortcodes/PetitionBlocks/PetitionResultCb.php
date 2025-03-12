<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Result Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @package BwlPetitionsManager
 */
class PetitionResultCb {

	public function getTheLayout( $atts ) {

		$atts = shortcode_atts([
			'id'                       => '',
			'result_title'             => esc_html__( 'SIGNATURES', 'bwl_ptmn' ),
			'result_sub_title'         => esc_html__( 'AND COUNTING +++', 'bwl_ptmn' ),
			'title_tag'                => 'h2',
			'title_align'              => 'left',
			'title_tag_color'          => '#2C2C2C',
			'sub_title_tag'            => 'h5',
			'sub_title_align'          => 'left',
			'sub_title_tag_color'      => '#DD4F43',
			'counter_color'            => '#E9931A',
			'signed_user_name_color'   => '#626262',
			'signed_user_country'      => '#E9931A',
			'signed_text'              => '#E9931A',
			'petition_signed_time_ago' => '#626262',
			'post_type'                => 'petitions',
			'layout'                   => '',
			'bptm_extra_class'         => '',
			'limit'                    => 5,
		], $atts);

		extract( $atts );

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		$bwl_ptmn_result_title     = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'result_title', true ) );
		$bwl_ptmn_result_sub_title = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'result_sub_title', true ) );

		$result_title     = ( $bwl_ptmn_result_title == '' ) ? $result_title : $bwl_ptmn_result_title;
		$result_sub_title = ( $bwl_ptmn_result_sub_title == '' ) ? $result_sub_title : $bwl_ptmn_result_sub_title;

		$bwl_petition_sign_lists = bwl_get_petitions_data( $id, $limit ); // This will return only last 5 or user defiend amount of sign data.

		// Here we are going to check if  signed list is empty or not.
		if ( empty( $bwl_petition_sign_lists ) ) {

			$bwl_petition_sign_lists = [];
			$bwl_total_signed        = 0;
		} else {

			// We need to get total signed info.

			$bwl_total_signed = bwl_count_petition_sign( $id );
		}

		$bwl_ptmn_manual_sign = (int) get_post_meta( $id, BPTM_META_MANUAL_SIGN_COUNT, true );

		$bwl_petition_total_signed = $bwl_total_signed + $bwl_ptmn_manual_sign;

		$intro_col_class = 'col-sm-12';

		// Generate Dyanmic Heading & Sub-heading Tag.
		$title_tag_style     = ' style="color:' . $title_tag_color . '; text-align:' . $title_align . ';"';
		$sub_title_tag_style = ' style="color:' . $sub_title_tag_color . '; text-align:' . $sub_title_align . ';"';

		// Counter Style.

		$counter_color_style = '';

		if ( $counter_color != '' ) :
			$counter_color_style .= ' style="color:' . $counter_color . ';"';
		endif;

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

		$output = '<div class="row">';

		// Result section
		$output .= '<div class="col-sm-12 col-md-12">';
		$output .= "<$title_tag {$title_tag_style} class='title'><span class='counter' {$counter_color_style}>{$bwl_petition_total_signed}</span> $result_title</{$title_tag}>";
		$output .= "<$sub_title_tag {$sub_title_tag_style} class='sub-title'>$result_sub_title</{$sub_title_tag}>";
		$output .= '</div>';

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

		$signature_row_string = "<div class='petition-ticker-container'><div class='vticker petition-signature-ticker'>{$signature_row}</div></div>";

		$output .= "<div class='col-lg-12 col-md-12 col-sm-12'>$signature_row_string</div>";

		$output .= '</div>';

		return $output;
	}
}
