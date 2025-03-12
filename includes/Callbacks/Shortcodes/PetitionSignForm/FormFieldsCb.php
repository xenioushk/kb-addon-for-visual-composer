<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionSignForm;

/**
 * Class for Petition sign form fields callback.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class FormFieldsCb {

	/**
	 * Retrieves the layout for the petition sign form.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string The layout HTML for the petition sign form.
	 */
	public function get_the_layout( $atts ) {

		$errorMsg = esc_attr__( 'is required.', 'bwl_ptmn' );

		/**
		 * Attribute notes
		 *
		 *  @atts rs = row status.
		*/

		$atts = shortcode_atts([
			'rs'  => 0,
			'fri' => '', // fri = Form id
			'cli' => '', // cli = col id
			'cc'  => 2, // cc = col class
			'fi'  => '', // fi = field ID
			'fn'  => '', // fn = field name
			'fc'  => '', // fc = field class.
			'fp'  => '', // fp = field place holder.
			'ft'  => '', // ft = field type
			'fd'  => '', // fd = field default.
			'fr'  => '0', // fr = field required.
			'fer' => '', // fer = field error message
			'sts' => 0, // sts= hide status. 1=hide 0=show. // default 0
		], $atts);

		extract( $atts );

		// Initialize.
		$output = '';

		$fc  = ( isset( $fc ) && $fc == '' ) ? 'form-control' : $fc . ' form-control';
		$fer = ( $fr == 1 && empty( $fer ) ) ? $fp . ' ' . $errorMsg : $fer;

		if ( $sts == 1 ) {
			return $output;
		}

		$row_div_start = '<div class="row">';
		$row_div_end   = '</div>';

		if ( intval( $rs ) === 1 ) :
			$output .= $row_div_start;
		endif;

		$cc = bpsff_get_col_class( $cc );

		$output .= '<div class="' . $cc . '">';

		if ( $ft == 'textarea' ) {

			// Textarea Box.
			$output .= '<textarea class="' . $fc . '" placeholder="' . $fp . '" name="' . $fn . '" id="' . $fn . '" data-required="' . $fr . '" data-error_msg="' . $fer . '">' . $fd . '</textarea>';
		} elseif ( $ft == 'checkbox' ) {

			// Checkbox Box.
			$fc             = str_replace( 'form-control', '', $fc );
			$checked_status = ( isset( $fd ) && $fd == 1 ) ? ' checked' : '';

			$output .= '<p>' . $fp . '<input type="checkbox" class="' . $fc . $checked_status . '" name="' . $fn . '" id="' . $fn . '" data-required="' . $fr . '" data-error_msg="' . $fer . '" ></p>';
		} elseif ( $ft == 'select' ) {

			// Select Box.

			$select_val = explode( ',', $fd );

			$output .= '<select name="' . $fn . '" id="' . $fn . '" class="' . $cc . ' ' . $fc . '"  data-required="' . $fr . '" data-error_msg="' . $fer . '" >';

			$output .= '<option value="" selected="selected">' . $fp . '</option>';

			foreach ( $select_val as $select_key => $select_val ) {

				$output .= '<option value="' . strtolower( $select_val ) . '">' . $select_val . '</option>';
			}

			$output .= '</select>';
		} elseif ( $ft == 'captcha' ) {

			// Captcha Field.

			$num1 = rand( 1, 15 );
			$num2 = rand( 1, 15 );
			$fer  = esc_attr__( 'Invalid captcha', 'bwl_ptmn' );

			$output .= '<input type="text" class="form-control" placeholder="' . $fp . $num1 . '  +  ' . $num2 . '  =  ? " name="' . $fn . '" id="' . $fn . '" data-error_msg="' . $fer . '">
                                                <input id="num1" class="sum captcha_num" name="num1" value="' . $num1 . '">
                                                <input id="num2" class="sum captcha_num" name="num2" value="' . $num2 . '">
                                                <input id="captcha_status" type="hidden" name="captcha_status" value="1">';
		} elseif ( $ft == 'country' ) {

			$output .= do_shortcode( '[bpm_cl fn="bpt_user_country" fp="' . $fp . '" fr="' . $fr . '" fer="' . $fer . '"]' );
		} elseif ( $ft == 'submit' ) {

			// Submit Button Field.
			$output .= '<input type="submit" class="' . $fc . '" name="' . $fn . '" id="' . $fi . '" value="' . $fd . '" data-bwl_petition_form_id= "' . $fri . '">';
		} else {

			// Default Input Text Box.
			$output .= '<input type="text" class="' . $fc . '" placeholder="' . $fp . '" name="' . $fn . '" id="' . $fn . '" value="' . $fd . '" data-required="' . $fr . '" data-error_msg="' . $fer . '">';
		}

		$output .= '</div>';

		if ( intval( $rs ) === 1 ) :
			$output .= $row_div_end;
		endif;

		return $output;
	}
}
