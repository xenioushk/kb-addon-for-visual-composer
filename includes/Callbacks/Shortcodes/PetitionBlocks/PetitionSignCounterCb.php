<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Petition Sign Counter
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 02.08.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionSignCounterCb {

	public function __construct() {
	}

	public function getTheLayout( $atts ) {
		$atts = shortcode_atts([
			'id'                  => '',
			'title_tag'           => 'h2',
			'title_align'         => 'left',
			'title_tag_color'     => '#2C2C2C',
			'sub_title_tag'       => 'h5',
			'sub_title_align'     => 'left',
			'sub_title_tag_color' => '#DD4F43',
			'counter_color'       => '#E9931A',
			'post_type'           => 'petitions',
			'bptm_extra_class'    => '',
		], $atts);

		extract( $atts );

		if ( $id != '' ) {
			$args['p'] = $id;
		} else {
			return '';
		}
		// @Description: Load Custom Scripts & Styles.
		// @Since: Version 1.0.0

		$result_title     = get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'result_title', true );
		$result_sub_title = get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'result_sub_title', true );

		// This will return only last 5 or user defined amount of sign data.
		$bwl_petition_sign_lists = bwl_get_petitions_data( $id );

		// Here we are going to check if  signed list is empty or not.
		if ( empty( $bwl_petition_sign_lists ) ) {

			$bwl_petition_sign_lists = [];
			$bwl_total_signed        = 0;
		} else {
			$bwl_total_signed = bwl_count_petition_sign( $id );
		}

		// Here we're going to amplify no of signed.
		// It's fake data only for demo purpose.

		$bwl_ptmn_manual_sign = (int) get_post_meta( $id, BPTM_META_MANUAL_SIGN_COUNT, true );

		$bwl_petition_total_signed = $bwl_total_signed + $bwl_ptmn_manual_sign;

		// Generate Dyanmic Heading & Sub-heading Tag.
		$title_tag_style     = ' style="color:' . $title_tag_color . '; text-align:' . $title_align . ';"';
		$sub_title_tag_style = ' style="color:' . $sub_title_tag_color . '; text-align:' . $sub_title_align . ';"';

		// Counter Style.

		$counter_color_style = '';

		if ( $counter_color != '' ) :
			$counter_color_style .= ' style="color:' . $counter_color . ';"';
		endif;

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : ' ' . $bptm_extra_class;

		$output = '<div class="row' . $bptm_extra_class . '">';

		// About content section..
		$output .= '<div class="col-md-10 col-md-offset-1">';
		$output .= '<div class="sign-counter-wrapper">';
		$output .= '<' . $title_tag . ' ' . $title_tag_style . '><span class="counter" ' . $counter_color_style . '>' . $bwl_petition_total_signed . '</span> ' . $result_title . '</' . $title_tag . '>';

		$output .= '<' . $sub_title_tag . ' ' . $sub_title_tag_style . '>' . $result_sub_title . '</' . $sub_title_tag . '>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '</div>';

		return $output;
	}
}
