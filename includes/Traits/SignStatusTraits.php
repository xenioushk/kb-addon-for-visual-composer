<?php
namespace KAFWPB\Traits;

trait SignStatusTraits {
    /**
     * Check petition signed status.
     *
     * @param int    $petition_id Petition ID.
     * @param string $bpt_user_email User Email.
     * @param string $bpt_user_ip User IP.
     * @example 0=Not signed , 1= Signed
     * @return int
     */
	public function check_petition_signed_status( $petition_id, $bpt_user_email, $bpt_user_ip ) {

		global $wpdb;

		$table = BPTM_DATA_TABLE;

		$sql = $wpdb->prepare("SELECT ID FROM {$table} 

                                            WHERE postid = %d 

                                            AND bpt_user_email = %s 

                                            AND bpt_user_ip = %s 

                                            ORDER BY ID DESC LIMIT 1", $petition_id, $bpt_user_email, $bpt_user_ip);

		$bptm_data = $wpdb->get_results( $sql, ARRAY_A ); // phpcs:ignore

        $status = ( count( $bptm_data ) > 0 ) ? 1 : 0;

		return $status;
	}

    /**
     * Create sign verification WordPress page.
     */
    public function create_sign_verification_wp_page() {
        // Setup the author, slug, and title for the post
        $author_id = 1;
        $slug      = 'bptm-sign-confirm';
        $title     = esc_html__( 'Petition Sign Verification', 'bwl_ptmn' );

        // If the page doesn't already exist, then create it
        $existing_page = get_posts([
            'name'        => $slug,
            'post_type'   => 'page',
            'post_status' => 'publish',
            'numberposts' => 1,
        ]);

        if ( empty( $existing_page ) ) {
            // Set the post ID so that we know the post was created successfully
            wp_insert_post([
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_author'    => $author_id,
                'post_name'      => $slug,
                'post_title'     => $title,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_content'   => '[bptm_verify_sign]',
            ]);
        }
    }
}
