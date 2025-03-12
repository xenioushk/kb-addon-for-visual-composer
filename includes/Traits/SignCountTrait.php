<?php
namespace KAFWPB\Traits;

trait SignCountTrait {
    /**
     * Get the total sign counts of a petition
     *
     * @param int $post_id Post ID.
     * @return int
     */
    public function get_the_total_sign_count( $post_id ) {

        $count = get_post_meta( $post_id, BPTM_META_USER_SIGN_COUNT, true );

        return ( empty( $count ) ) ? 0 : intval( $count );
    }

    /**
     * Get the manual sign counts of a petition
     *
     * @param int $post_id Post ID.
     * @return int
     */
    public function get_the_manual_sign_count( $post_id ) {

        $count = get_post_meta( $post_id, BPTM_META_MANUAL_SIGN_COUNT, true );

        return ( empty( $count ) ) ? 0 : intval( $count );
    }

    /**
     * Get the sign target of a petition
     *
     * @param int $post_id Post ID.
     * @return int
     */
    public function get_the_sign_target_count( $post_id ) {

        $count = get_post_meta( $post_id, BPTM_META_USER_SIGN_TARGET, true );

        return ( empty( $count ) ) ? 0 : intval( $count );
    }
}
