<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Progress bar layout
 *
 * @package BwlPetitionsManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PetitionProgressBarCb {

	/**
	 * Get the layout of the petition progress bar.
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string
	 */
	public function getTheLayout( $atts ) {

		extract(shortcode_atts([
			'id'                  => '',
			'hide_title'          => 0,
			'title_tag'           => 'h2',
			'title_align'         => 'center',
			'title_tag_color'     => '#2C2C2C',
			'sub_title_tag'       => 'h5',
			'sub_title_align'     => 'center',
			'sub_title_tag_color' => '#DD4F43',
		], $atts));

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) { return '';
		}

		// Target.
		$bwl_petition_sign_target = get_post_meta( $id, BPTM_META_USER_SIGN_TARGET, true );

		$bwl_petition_sign_target = ( $bwl_petition_sign_target == '' ) ? '0' : $bwl_petition_sign_target;

		// Sign Collected.
		$bwl_total_signed_count = get_post_meta( $id, BPTM_META_USER_SIGN_COUNT, true );
		$bwl_total_signed       = ( $bwl_total_signed_count == '' ) ? '0' : $bwl_total_signed_count;

		if ( $bwl_petition_sign_target != 0 && $bwl_total_signed != 0 && $bwl_total_signed >= $bwl_petition_sign_target ) {

			$petition_complete_percentage = 100;
		} else {

			$petition_complete_percentage = ceil( ( $bwl_total_signed * 100 ) / $bwl_petition_sign_target );
		}

		// Output

		ob_start();

		?>

<div class="row">
    <div class="col-sm-12 text-center">
    <section class="target-section">

        <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="row">

            <div class="target-wrapper">

                <div class="col-sm-12 text-left">
                <div class="sign-item-text">
                    <span
                    class="sign-raised-text"><?php esc_html_e( 'Signed', 'bwl_ptmn' ) . ': ' . $bwl_total_signed; ?></span><span
                    class="sign-goal-text"><?php esc_html_e( 'Target', 'bwl_ptmn' ) . ': ' . $bwl_petition_sign_target; ?></span>
                </div>
                <div class="progress sign_progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                    aria-valuenow="<?php echo $petition_complete_percentage; ?>" role="progressbar"
                    class="progress-bar progress-sign"></div>
                    <span data-raised_percentage="<?php echo $petition_complete_percentage; ?>" class="sign-raised"
                    style="display:none;"><?php echo $petition_complete_percentage; ?>%</span>
                </div>
                </div>

            </div>

            </div>

        </div>

        </div>

    </section>
    </div>
</div>

		<?php
		return ob_get_clean();
	}
}
