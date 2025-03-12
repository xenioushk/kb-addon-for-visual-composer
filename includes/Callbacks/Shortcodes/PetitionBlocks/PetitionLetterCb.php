<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Petition Letter Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 26.07.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionLetterCb {

	public function __construct() {
	}

	public function getTheLayout( $atts ) {
		$atts = shortcode_atts([
			'id'                  => '',
			'title_text'          => '',
			'title_tag'           => 'h2',
			'title_align'         => 'center',
			'title_tag_color'     => '#2C2C2C',
			'sub_title_text'      => '',
			'sub_title_tag'       => 'h3',
			'sub_title_align'     => 'center',
			'sub_title_tag_color' => '#2B2B2B',
			'layout'              => '',
			'bptm_extra_class'    => '',
		], $atts);

		extract( $atts );

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		$petition_letter_title     = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'letter_title', true ) );
		$petition_letter_sub_title = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'letter_sub_title', true ) );

		$title_text     = ( $petition_letter_title == '' ) ? $title_text : $petition_letter_title;
		$sub_title_text = ( $petition_letter_sub_title == '' ) ? $sub_title_text : $petition_letter_sub_title;

		$petition_letter = ( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'letter', true ) );

		$col_class = 'col-sm-12';

		// Generate Dyanmic Heading & Sub-heading Tag.
		$title_tag_style     = " style='color:{$title_tag_color}; text-align:{$title_align};'";
		$sub_title_tag_style = " style='color:{$sub_title_tag_color}; text-align:{$sub_title_align};'";

		$output = "<div class='row'>";

		// Introduction content section.
		$output .= "<div class='{$col_class}'>";

		if ( $title_text != '' ) {
			$output .= "<h2 class='title' $title_tag_style>{$title_text}</h2>";
		}

		if ( $sub_title_text != '' ) {
			$output .= "<h3 class='sub-title' $sub_title_tag_style>{$sub_title_text}</h3>";
		}

		$output .= '</div>';

		$output .= "<div class='col-sm-12'><div class='petition-letter letter-font-style'>$petition_letter</div></div>";
		$output .= '</div>';

		return do_shortcode( $output );
	}
}
