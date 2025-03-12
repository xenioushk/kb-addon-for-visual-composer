<?php
namespace KAFWPB\Callbacks\Shortcodes\ExternalForm;

/**
 * Class for petition create form callback.
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionCreateFormCb {

	/**
	 * Get the layout of the petition create form.
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 */
	public function get_the_layout( $atts ) {

		global $post;

		$atts = shortcode_atts([
            'id'        => '',
            'title'     => esc_html__( 'Create a petition', 'bwl_ptmn' ),
            'sub_title' => esc_html__( 'Start by filling out this form, and in a few minutes, you will be ready to collect thousands of signatures.', 'bwl_ptmn' ),
            'post_type' => 'petitions',
            'orderby'   => 'ID',
            'order'     => 'ASC',
            'limit'     => -1,
            'category'  => '',
            'column'    => '3',
		], $atts);

		extract( $atts );

		if ( is_user_logged_in() ) {

			$current_user = wp_get_current_user();

			$bptm_user_role      = $current_user->roles[0];
			$bpt_user_id         = $current_user->ID;
			$bpt_user_name       = $current_user->data->display_name;
			$bptm_user_logged_in = 1;
		} else {

			$bptm_user_logged_in = 0;
		}

		if ( $bptm_user_logged_in == 0 ) {

			// We will change values later in here.

			$bptm_petition_title_min = 5;
			$bptm_petition_title_max = 300;

			$bptm_petition_desc_min = 5;
			$bptm_petition_desc_max = 1000;

			$bptm_petition_user_name_min = 3;
			$bptm_petition_user_name_max = 100;

			$bptm_external_form_output = '<div class="bptm-external-form-container">';

			$bptm_petition_form_title_field     = '<h2>' . $title . '</h2>';
			$bptm_petition_form_sub_title_field = '<h4>' . $sub_title . '</h4>';

			$bptm_external_form_wrapper_before = '<form action="' . esc_url( admin_url( 'admin-post.php' ) ) . '" method="post" enctype="multipart/form-data" name="front_end_upload" id="bptm_external_form" >';

			$bptm_petition_title_field = '<div class="form-group">
                                                            <label for="bptm_petition_title">' . esc_html__( 'Petition Title', 'bwl_ptmn' ) . '</label>
                                                            <input name="bptm_petition_title" id="bptm_petition_title" class="form-control input-lg" type="text" data-error_msg="' . esc_html__( 'Please enter petition title.', 'bwl_ptmn' ) . '" data-min_length="' . $bptm_petition_title_min . '" data-min_length_msg="' . sprintf( esc_html__( 'Title minimum length %d' ), $bptm_petition_title_min ) . '" data-max_length="' . $bptm_petition_title_max . '" data-max_length_msg="' . sprintf( esc_html__( 'Title maximum length %d' ), $bptm_petition_title_max ) . '">
                                                        </div>';

			$bptm_petition_desc_field = '<div class="form-group">
                                                            <label for="bptm_petition_desc">' . esc_html__( 'Petition Details', 'bwl_ptmn' ) . '</label>
                                                            <textarea class="form-control input-lg" id="bptm_petition_desc" name="bptm_petition_desc" rows="5" data-error_msg="' . esc_html__( 'Please enter petition details.', 'bwl_ptmn' ) . '" data-min_length="' . $bptm_petition_desc_min . '" data-min_length_msg="' . sprintf( esc_html__( 'Details minimum length %d' ), $bptm_petition_desc_min ) . '" data-max_length="' . $bptm_petition_desc_max . '" data-max_length_msg="' . sprintf( esc_html__( 'Details maximum length %d' ), $bptm_petition_desc_max ) . '"></textarea>
                                                        </div>';

			$bptm_user_name_field = '<div class="form-group">
                                                            <label for="bptm_user_name">' . esc_html__( 'Your Name', 'bwl_ptmn' ) . '</label>
                                                            <input name="bptm_user_name" id="bptm_user_name" class="form-control input-lg" type="text" data-error_msg="' . esc_html__( 'Please enter your name.', 'bwl_ptmn' ) . '" data-min_length="' . $bptm_petition_user_name_min . '" data-min_length_msg="' . sprintf( esc_html__( 'Your name minimum length %d' ), $bptm_petition_user_name_min ) . '" data-max_length="' . $bptm_petition_user_name_max . '" data-max_length_msg="' . sprintf( esc_html__( 'Title maximum length %d' ), $bptm_petition_user_name_max ) . '">
                                                        </div>';

			$bptm_user_email_field = '<div class="form-group">
                                                            <label for="bptm_user_email" data-error_msg="' . esc_html__( 'Please enter valid email.', 'bwl_ptmn' ) . '">' . esc_html__( 'Your Email', 'bwl_ptmn' ) . '</label>
                                                            <input name="bptm_user_email" id="bptm_user_email" class="form-control input-lg" type="email"  data-error_msg="' . esc_html__( 'Please enter valid email.', 'bwl_ptmn' ) . '"/>
                                                        </div>';

			$num1 = rand( 1, 15 );
			$num2 = rand( 1, 15 );

			$frontendPetitionCreateNonce = wp_nonce_field( 'bptm-frontend-petition-create-nonce', '_wpnonce_frontend_petition_create' );

			$bptm_captcha_field = '<div class="form-group">

                                                        <label for="bptm_captcha">' . esc_html__( 'Captcha', 'bwl_ptmn' ) . " ( $num1 + $num2 )  =  ?  " . '</label>

                                                        <input tabindex="6" type="text" class="form-control input-lg" placeholder="' . $num1 . '  +  ' . $num2 . '  =  ? " name="bptm_captcha" id="bptm_captcha" data-error_msg="' . esc_html__( 'Please enter correct captcha.', 'bwl_ptmn' ) . '">

                                                        <input id="bptm_num1" class="sum captcha_num" type="text" name="bptm_num1" value="' . $num1 . '" readonly="readonly">

                                                        <input id="bptm_num2" class="sum captcha_num" type="text" name="bptm_num2" value="' . $num2 . '" readonly="readonly">

                                                        <input id="captcha_status" type="hidden" name="captcha_status" value="1">

                                                    </div>';

			$bptm_agreed_field = '<div class="form-group clearfix">
                                                        <label for="bptm_agree" class="bptm_agree_label">
                                                            <input type="checkbox" name="bptm_agree" id="bptm_agree" value="1" data-error_msg="' . esc_html__( 'Please Agree.', 'bwl_ptmn' ) . '"> <span class="bptm_agree_msg">' . esc_html__( 'Please agree to our policy.', 'bwl_ptmn' ) . '</span>
                                                        </label>
                                                </div>';

			$bptm_petition_hidden_fields = '<input type="hidden" name="action" value="bptm_external_petition">';

			$bptm_petition_submit_btn = '<input type="submit" id="bptm_external_form_submit" name="Upload" value="' . esc_html__( 'Submit Petition', 'bwl_ptmn' ) . '" class="btn btn-lg btn-success">';

			$bptm_external_form_wrapper_after = '</form></div> ';

			$bptm_external_form_output .= $bptm_external_form_wrapper_before .
            $bptm_petition_form_title_field .
            $bptm_petition_form_sub_title_field .
            $bptm_petition_title_field .
            $bptm_petition_desc_field .
            $bptm_user_name_field .
            $bptm_user_email_field .
            $bptm_captcha_field .
            $bptm_agreed_field .
            $bptm_petition_hidden_fields .
            $frontendPetitionCreateNonce .
            $bptm_petition_submit_btn .
            $bptm_external_form_wrapper_after;
		} else {

			// http://wordpress.stackexchange.com/questions/165357/how-to-make-a-text-with-hyperlink-translatable-in-wordpress
			$anchor = esc_html_x( 'Add Petition', 'link text for google.com', 'bwl_ptmn' );
			$domain = esc_url( site_url( '/' ) ) . 'wp-admin/post-new.php?post_type=petitions';
			$link   = sprintf( '<a href="%s">%s</a>', $domain, $anchor );
			// translators: %1$s: user name, %2$s: link
			$bptm_external_form_output = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ' . sprintf( esc_html__( 'Dear %1$s, You can %2$s from admin panel.', 'bwl_ptmn' ), $bpt_user_name, $link ) . '</div>';
		}

		return $bptm_external_form_output;

	}
}
