<?php

/**
 * @package BwlPetitionsManager
 */

/**
 * Get all the petitions and filter by categories.
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @created: 01.06.2016
 * @updated: 26.07.2024
 */

namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

class PetitionListsCb {

	public function __construct() {
	}

	public function getThePetitions( $atts ) {

		$prefix = BWL_PETITIONS_CMB_PREFIX; // prefix of the custom meta box. _cmb_bptm_

		$atts = shortcode_atts([
			'id'          => '',
			'post_type'   => 'petitions',
			'meta_key'    => '', // featured
			'meta_value'  => '',
			'orderby'     => 'ID',
			'order'       => 'ASC',
			'limit'       => -1,
			'category'    => '',
			'posts_count' => 0,
			'column'      => '3',
			'currency'    => '$',
			'desc_length' => 30,
			'layout'      => 'layout_1',
		], $atts);

		extract( $atts );

		$output = '<div class="row">';

		$args = [
			'post_status'        => 'publish',
			'post_type'          => $post_type,
			'orderby'            => $orderby,
			'order'              => $order,
			'posts_per_page'     => $limit,
			'petitions_category' => $category,
		];

		$bpm_get_column_class = bpm_get_column_class( $column );

		$petition_layout = $layout;

		$loop = new \WP_Query( $args );

		if ( $loop->have_posts() ) :

			while ( $loop->have_posts() ) :

				$loop->the_post();

				$post_id = get_the_ID();

				$bwl_petition_url = get_the_permalink();

				$bwl_petition_total_signed = bwl_count_petition_sign( $post_id );

				$bwl_petition_title = '<a href="' . $bwl_petition_url . '">' . get_the_title() . '</a>';

				$bwl_petition_about = get_post_meta( $post_id, $prefix . 'about_desc', true );

				if ( $desc_length > 0 ) {
					$petition_content = wp_trim_words( $bwl_petition_about, $desc_length );
				} else {
					$petition_content = $bwl_petition_about;
				}

				if ( has_post_thumbnail() && $petition_layout == 'layout_2' ) {
					$post_thumb = get_the_post_thumbnail( $post_id, 'full' );
				} elseif ( has_post_thumbnail() && $petition_layout == 'layout_1' ) {
					$post_thumb = get_the_post_thumbnail( $post_id, 'full' );
				} else {
					$post_thumb = '';
				}

				if ( $petition_layout == 'layout_2' ) {

					$bpm_get_column_class = 'col-sm-12';

					$output .= '<div class="' . $bpm_get_column_class . '">';

					$output .= '<div class="pet_' . $petition_layout . '">'; // layout container.

					$output .= '<div class="row"><!-- inner_row  -->';

					$output .= '<div class="col-md-4 col-sm-12 text-center">';

					$output .= '<div class="petition-img">' . $post_thumb . '</div>';

					$output .= '</div> <!-- end .col-md-2  -->';

					$output .= '<div class="col-md-8 col-sm-12">';

					$output .= '<div class="petition-content">';

					$output .= '<div class="petition-header">';
					$output .= '<span class="counter bold" style="color:#e9931a;">' . $bwl_petition_total_signed . '</span> ' . __( 'signed this petition', 'bwl_ptmn' );
					$output .= '</div>';

					$output .= '<div class="petition-text">';
					$output .= '<h5>' . $bwl_petition_title . '</h5>';
					$output .= '<div class="petition-about">' . $petition_content . ' &nbsp; <a href="' . $bwl_petition_url . '">' . __( 'Read More', 'bwl_ptmn' ) . '</a></div>';
					$output .= '</div><!-- end .petition-text  -->';

					$output .= '<div class="petition-footer">';
					$output .= ' <a href="' . $bwl_petition_url . '#petition_form" class="">Sign Petition <i class="fa fa-pencil-square"></i></a> ';
					$output .= '</div>';

					$output .= '</div><!-- end .petition-content  -->';

					$output .= '</div> <!-- end .col-md-10 -->';

					$output .= '</div><!--  end .row(inner_row) -->';

					$output .= '</div><!--  end .layout_2  -->';

					$output .= '</div> <!-- end .bwl_petition_container  -->';
				} else {

					$output .= '<div class="bwl_petition_container ' . $bpm_get_column_class . '">';
					$output .= '<div class="pet_' . $petition_layout . '">'; // layout container.
					$output .= '<div class="">' . $post_thumb . '</div>';

					$output .= '<div class="petition-content">';

					$output .= '<div class="petition-header">';
					$output .= '<span class="counter bold" style="color:#e9931a;">' . $bwl_petition_total_signed . '</span> ' . __( 'signed this petition', 'bwl_ptmn' );
					$output .= '</div>';

					$output .= '<div class="petition-text">';
					$output .= '<h5>' . $bwl_petition_title . '</h5>';
					$output .= '<div class="petition-about">' . $petition_content . '</div>';
					$output .= '</div><!-- end .petition-text  -->';

					$output .= '<div class="petition-footer">';
					$output .= '<a href="' . $bwl_petition_url . '#petition_form" class="btn">Sign Petition <i class="fa fa-pencil-square"></i></a> | <a href="' . $bwl_petition_url . '" class="btn" >Read More <i class="fa fa-mail-forward"></i></a> ';
					$output .= '</div>';

					$output .= '</div><!-- end .petition-content  -->';

					$output .= '</div><!--  end .layout_1  -->';
					$output .= '</div> <!-- end .bwl_petition_container  -->';
				}

			endwhile;

		else :

			// Regular View.
			$output .= '<p>' . __( 'Sorry, No Petition Item Available!', 'bwl_ptmn' ) . '</p>';

		endif;

		wp_reset_query();

		$output .= '</div>';

		return $output;
	}
}
