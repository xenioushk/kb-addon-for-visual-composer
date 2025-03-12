<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Petition Submit To Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 26.07.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionSubmitToCb {

	public function __construct() {
	}

	public function getTheLayout( $atts ) {

		$atts = shortcode_atts([
			'id'               => '',
			'title_text'       => esc_attr__( 'Where we send?', 'bwl_ptmn' ),
			'title_tag'        => 'h2',
			'title_align'      => 'center',
			'title_tag_color'  => '#000000',
			'sub_title_text'   => __( 'Lets know the destination', 'bwl_ptmn' ),
			'layout'           => 'layout_1',
			'bptm_extra_class' => '',
			'items'            => 4, // added in version 1.0.3
		], $atts);

		extract( $atts );

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		// Get All The Meta Box Data.
		$petition_letter_submitted_to = get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'letter_submitted_to', true );

		$petition_letter_submitted_to_title = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'letter_submitted_to_title', true ) );

		$title_text = ( $petition_letter_submitted_to_title == '' ) ? $title_text : $petition_letter_submitted_to_title;

		$send_to_col_class = 'col-sm-12';

		// Generate Dyanmic Heading & Sub-heading Tag.
		$title_tag_style = ' style="color:' . $title_tag_color . '; text-align:' . $title_align . ';"';

		// Layout Row Class;

		if ( $layout == 'template_two' ) {
			$sub2_style        = '';
			$heading_col_class = '';
			$content_col_class = '';
		} elseif ( $layout == 'layout_2' ) {
			$sub2_style        = ' sub_layout2 text-center';
			$heading_col_class = '';
			$content_col_class = '';
		} else {
			$sub2_style        = ' sub_layout1';
			$heading_col_class = 'col-md-4 ';
			$content_col_class = 'col-md-8 ';
		}

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : ' ' . $bptm_extra_class;

		// Now, Going to generate final output.

		$output = '';

		$output .= empty( $bptm_extra_class ) ? '' : '<div class="' . $bptm_extra_class . '">';

		$output .= '<div class="row' . $sub2_style . '">';
		$output .= '<div class="' . $heading_col_class . 'col-sm-12">';
		$output .= "<$title_tag class='title' $title_tag_style>$title_text</$title_tag>";
		$output .= '</div>';

		$output .= '<div class="' . $content_col_class . 'col-sm-12">';

		$output .= '<div class="letter-submit-carousel" data-items="' . $items . '">';

		if ( ! empty( $petition_letter_submitted_to ) ) {

			$petition_letter_submitted_to_html = '';

			foreach ( $petition_letter_submitted_to as $name ) {

				$petition_letter_submitted_to_html .= "<div class='person-name'>$name</div>";
			}

			$output .= $petition_letter_submitted_to_html;
		}

		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= empty( $bptm_extra_class ) ? '' : '</div>';

		return do_shortcode( $output );
	}
}
