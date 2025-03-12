<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Petition About Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 26.07.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionAboutCb {

	public function __construct() {
	}

	public function getTheLayout( $atts ) {
		$prefix = BWL_PETITIONS_CMB_PREFIX;

		$atts = shortcode_atts(
            [
				'id'                  => '',
				'title_tag'           => 'h2',
				'title_align'         => 'center',
				'title_tag_color'     => '#000000',
				'sub_title_tag'       => 'h3',
				'sub_title_align'     => 'center',
				'sub_title_tag_color' => '#000000',
				'hide_image'          => 0, // hide the image.
				'layout'              => 'layout_1',
				'bptm_extra_class'    => '',
            ],
            $atts
		);

		extract( $atts );

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		$petition_about_title     = get_post_meta( $id, $prefix . 'about_title', true );
		$petition_about_sub_title = get_post_meta( $id, $prefix . 'about_sub_title', true );
		$petition_about_desc      = nl2br( get_post_meta( $id, $prefix . 'about_desc', true ) );

		$is_avail_about_feat_img = false;
		$abt_col_class           = 'col-sm-12';

		$petition_about_feat_img = get_post_meta( $id, $prefix . 'about_feat_img', true );

		if ( $hide_image == 0 && $petition_about_feat_img != '' ) {

			$is_avail_about_feat_img = true;
			$abt_col_class           = 'col-sm-6';
		}

		// Initialization of Custom Styling.

		$content_text_style = '';

		$title_tag_style     = ' style="color:' . $title_tag_color . ';"';
		$sub_title_tag_style = ' style="color:' . $sub_title_tag_color . ';"';

		if ( isset( $content_text_color ) && $content_text_color != '' ) {
			$content_text_style = ' style="color:' . $content_text_color . ';"';
		}

		// Layout Row Class;

		if ( $layout == 'layout_2' ) {
			$abt_style      = ' about_layout2';
			$abt_cont_class = 'col-md-8 col-md-offset-2 text-center ';
			$abt_img_class  = 'col-md-10 col-md-offset-1 text-center ';
		} elseif ( $layout == 'layout_3' ) {
			$abt_style = ' about_layout3';
		} else {
			$abt_style      = '';
			$abt_cont_class = '';
			$abt_img_class  = '';
		}

		// Conditional columns.
		// If featured image exist then column size will be col-sm-6 for both content and image.
		// other wise it will be col-sm-12.

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : ' ' . $bptm_extra_class;

		$output = '<div class="row' . $bptm_extra_class . $abt_style . '">';

		if ( $layout == 'template_two' ) {

			$output .= '<div class="col-lg-12 col-md-12 col-sm-12">';

			// About image section.
			if ( $is_avail_about_feat_img == true ) {

				$output .= '<figure class="bptm_feat_img"><img src="' . $petition_about_feat_img . '" alt="' . strip_tags( $petition_about_title ) . '" /></figure>';
			}

			if ( $petition_about_title != '' ) {
				$output .= '<h2 ' . $title_tag_style . '>' . $petition_about_title . '</h2>';
			}

			if ( $petition_about_sub_title != '' ) {
				$output .= '<h3 ' . $sub_title_tag_style . '>' . $petition_about_sub_title . '</h3>';
			}

			$output .= '<div class="petition-about-desc">' . $petition_about_desc . '</div> <!-- end .col-md-12 -->';
			$output .= '</div> <!-- end .col-md-12 -->';
		} elseif ( $layout == 'layout_3' ) {

			$output .= '<div class="col-md-4 col-sm-12 text-right">';

			if ( $petition_about_title != '' ) {
				$output .= "<h2 class='title' $title_tag_style>$petition_about_title</h2>";
			}

			if ( $petition_about_sub_title != '' ) {
				$output .= '<h3 ' . $sub_title_tag_style . '>' . $petition_about_sub_title . '</h3>';
			}

			$output .= '</div> <!-- end .col-md-4  -->

                        <div class="col-md-8 col-sm-12 text-left"' . $content_text_style . '>
                                ' . $petition_about_desc . '
                        </div> <!-- end .col-md-8  -->';

			// About image section.
			if ( $is_avail_about_feat_img == true ) {
				$output .= '<div class="col-md-12 text-center">';
				$output .= '<p><img src="' . $petition_about_feat_img . '" alt="' . strip_tags( $petition_about_title ) . '"></p>';
				$output .= '</div>';
			}
		} elseif ( $layout == 'layout_4' ) {

			// About image section.
			if ( $is_avail_about_feat_img == true ) {

				$output .= '<div class="' . $abt_img_class . $abt_col_class . '">';
				$output .= '<p><img src="' . $petition_about_feat_img . '" alt="' . strip_tags( $petition_about_title ) . '"></p>';
				$output .= '</div>';
			}

			// About content section..
			$output .= '<div class="' . $abt_cont_class . $abt_col_class . '">';

			if ( $petition_about_title != '' ) {
				$output .= '<' . $title_tag . ' ' . $title_tag_style . '>' . $petition_about_title . '</' . $title_tag . '>';
			}

			if ( $petition_about_sub_title != '' ) {
				$output .= '<' . $sub_title_tag . ' ' . $sub_title_tag_style . '>' . $petition_about_sub_title . '</' . $sub_title_tag . '>';
			}

			$output .= '<p' . $content_text_style . '>' . $petition_about_desc . '</p>';
			$output .= '</div>';
		} else {
			// About content section.
			$output .= "<div class='{$abt_cont_class} {$abt_col_class}'>";
			if ( $petition_about_title != '' ) {
				$output .= "<$title_tag {$title_tag_style} class='title'>$petition_about_title</$title_tag>";
			}

			if ( $petition_about_sub_title != '' ) {
				$output .= "<$sub_title_tag {$sub_title_tag_style} class='sub-title'>$petition_about_sub_title</$sub_title_tag>";
			}

			$output .= "<div class='description' {$content_text_style}>$petition_about_desc</div>";
			$output .= '</div>';

			// About image section.
			if ( $is_avail_about_feat_img == true ) {

				$featImgAlt = strip_tags( $petition_about_title );
				$output    .= "<div class='{$abt_img_class} {$abt_col_class}'>";
				$output    .= "<div class='featured-image'><img src='{$petition_about_feat_img}' alt='{$featImgAlt}'></div>";
				$output    .= '</div>';
			}
		}

		$output .= '</div>';

		return do_shortcode( $output );
	}
}
