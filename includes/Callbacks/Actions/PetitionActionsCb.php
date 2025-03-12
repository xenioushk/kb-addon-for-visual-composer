<?php
namespace KAFWPB\Callbacks\Actions;

/**
 * Class for Petition Actions Callbacks.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionActionsCb {

	/**
     * Action callback for displaying the intro box.
     */
	public function cb_intro_box() {

		global $post;

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating Intro block shortcode.
		// @Since: Version 1.0.0

		$bptm_intro_block_status = ( isset( $petitions_options['bptm_intro_block_status'] ) && $petitions_options['bptm_intro_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_intro_block_status == 0 ) {

			$petition_intro_string = do_shortcode( '[petition_intro id="' . get_the_ID() . '"/]' );
		}

		if ( $bptm_intro_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_intro_string ) );

		endif;
	}


	/**
     * Action callback for displaying the about box.
     */
	public function cb_about_box() {

		global $post;

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating About block shortcode.
		// @Since: Version 1.0.0

		$bptm_about_block_status = ( isset( $petitions_options['bptm_about_block_status'] ) && $petitions_options['bptm_about_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_about_block_status == 0 ) {

			$petition_about_string = do_shortcode( '[petition_about id="' . get_the_ID() . '" layout="template_two" bptm_extra_class="bptm_about_box"/]' );
		}

		if ( $bptm_about_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_about_string ) );

		endif;
	}

	/**
     * Action callback for displaying the send to box.
     */
	public function cb_send_to_box() {

		global $post;

		$id = get_the_ID();

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating Send To block shortcode.
		// @Since: Version 1.0.0

		$bptm_send_to_block_status = ( isset( $petitions_options['bptm_send_to_block_status'] ) && $petitions_options['bptm_send_to_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_send_to_block_status == 0 ) {

			$petition_send_to_string = do_shortcode( '[petition_submit_to id="' . $id . '" layout="template_two" items=3 bptm_extra_class="bptm_send_to_box"/]' );
		}

		if ( $bptm_send_to_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_send_to_string ) );

		endif;
	}

  	/**
     * Action callback for displaying the letter box.
     */
	public function cb_letter_box() {

		global $post;

		$id = get_the_ID();

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating Letter block shortcode.
		// @Since: Version 1.0.0

		$bptm_letter_block_status = ( isset( $petitions_options['bptm_letter_block_status'] ) && $petitions_options['bptm_letter_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_letter_block_status == 0 ) {

			$petition_letter_string = do_shortcode( '[petition_letter id="' . get_the_ID() . '" layout="template_two"/]' );
		}

		if ( $bptm_letter_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_letter_string ) );

		endif;
	}


	/**
     * Action callback for displaying the sign box.
     */
	public function cb_sign_box() {

		global $post;

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating Letter block shortcode.
		// @Since: Version 1.0.0

		$bptm_sign_block_status = ( isset( $petitions_options['bptm_sign_block_status'] ) && $petitions_options['bptm_sign_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_sign_block_status == 0 ) {

			// Signed Form Settings.

			$petition_form_string = do_shortcode( '[petition_form id="' . get_the_ID() . '" layout="template_two" extra_class="bptm_sign_form_box"/]' );
		}

		if ( $bptm_sign_block_status == 0 ) :
			echo html_entity_decode( esc_attr( $petition_form_string ) );
		endif;
	}


	/**
     * Action callback for displaying the sign result.
     */
	public function cb_sign_result() {

		global $post;

		$petitions_options = get_option( 'petitions_options' );

		// @Description: Generating Letter block shortcode.
		// @Since: Version 1.0.0

		$bptm_sign_block_status = ( isset( $petitions_options['bptm_sign_block_status'] ) && $petitions_options['bptm_sign_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_sign_block_status == 0 ) {

			// Signed Result Settings.
			$petition_result_string = do_shortcode( '[petition_result id="' . get_the_ID() . '" layout="template_two"/]' );
		}

		if ( $bptm_sign_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_result_string ) );

		endif;
	}

	/**
     * Action callback for displaying the share box.
     */
	public function cb_share_box() {

		global $post;

		$petitions_options = get_option( 'petitions_options' );

		$bptm_share_block_status = ( isset( $petitions_options['bptm_share_block_status'] ) && $petitions_options['bptm_share_block_status'] == 1 ) ? 1 : '0';

		if ( $bptm_share_block_status == 0 ) {

			$petition_share_string = do_shortcode( '[petition_share id="' . get_the_ID() . '" hide_title=0 bptm_extra_class="bptm_sp_share_box"/]' );
		}

		if ( $bptm_share_block_status == 0 ) :

			echo html_entity_decode( esc_attr( $petition_share_string ) );

		endif;
	}
}
