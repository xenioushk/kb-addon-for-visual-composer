<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Introduction Layout
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionIntroCb {

	/**
	 * Retrieves the layout for the petition intro block.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string The layout HTML.
	 */
	public function getTheLayout( $atts ) {
		global $post;

		extract(shortcode_atts(
            [
				'id'                  => '',
				'title_text'          => get_the_title(),
				'title_tag'           => 'h2',
				'title_align'         => 'center',
				'title_tag_color'     => '#FFFFFF',
				'sub_title_tag'       => 'p',
				'sub_title_align'     => 'center',
				'sub_title_tag_color' => '#FFFFFF',
				'bptm_extra_class'    => '',
            ],
            $atts
		));

		// If there is no Id, shortcode returns empty string.
		if ( empty( $id ) ) {  return '';}

		// Get the INTRODUCTION title & sub title meta value.

		$petition_intro_title = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'intro_title', true ) );

		$title_text = ( $petition_intro_title != '' ) ? $petition_intro_title : $title_text;

		$petition_intro_sub_title = get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'intro_sub_title', true );

		$intro_col_class = 'col-sm-12';

		// Custom Styling.

		$title_tag_style     = ' style="color:' . $title_tag_color . '; text-align:' . $title_align . ';"';
		$sub_title_tag_style = ' style="color:' . $sub_title_tag_color . '; text-align:' . $sub_title_align . ';"';

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : ' ' . $bptm_extra_class;

		$output = '<div class="row' . $bptm_extra_class . '">';

		// Introduction content section..
		$output .= '<div class="' . $intro_col_class . ' bptm_intro_heading_block">';
		if ( $title_text != '' ) {

			$output .= '<h1' . $title_tag_style . '>' . $title_text . '</h1>';
		}

		if ( $petition_intro_sub_title != '' ) {
			$output .= '<h2 ' . $sub_title_tag_style . '>' . $petition_intro_sub_title . '</h2>';
		}
		$output .= '</div>';

		$output .= '</div>';

		return $output;
	}
}
