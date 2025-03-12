<?php
namespace KAFWPB\Traits;

trait WPBakeryTraits {
    /**
     * Get the wpbakery content tags
     *
     * @example h1, h2, h3, h4, h5, h6, p
     * @return array
     */
    public function get_content_tags() {

        $tags = [
            'Select' => '',
            'h1'     => 'h1',
            'h2'     => 'h2',
            'h3'     => 'h3',
            'h4'     => 'h4',
            'h5'     => 'h5',
            'h6'     => 'h6',
            'p'      => 'p',
        ];

        return $tags;
    }

    /**
     * Get the wpbakery boolean tags
     *
     * @example Yes, No
     * @return array
     */
    public function get_boolean_tags() {

        $tags = [
            'Select' => '',
			'Yes'    => '1',
			'No'     => '0',
        ];

        return $tags;
    }

    /**
     * Get the wpbakery alignment tags
     *
     * @example Left, Center, Right, Justify
     * @return array
     */
    public function get_alignment_tags() {

        $tags = [
            'Select'  => '',
			'Left'    => 'left',
			'Center'  => 'center',
			'Right'   => 'right',
			'Justify' => 'justify',
        ];

        return $tags;
    }

    /**
     * Get the layouts for the wpbakery.
     *
     * @return array
     */
    public function get_layouts() {

        $layout = [
            'Select'    => '',
            'Layout 01' => 'layout_1',
            'Layout 02' => 'layout_2',
            'Layout 03' => 'layout_3',
            'Layout 04' => 'layout_4',
        ];
        return $layout;
    }

    /**
     * Get the petitions dropdown.
     *
     * @return array
     */
    public function get_petitions_dropdown() {

        $args = [
            'post_status'    => 'publish',
            'post_type'      => 'petitions',
            'orderby'        => 'title',
            'order'          => 'ASC',
            'posts_per_page' => -1,
        ];

        $loop = new \WP_Query( $args );

        $petition_lists = [];

        $petition_lists['Select petition'] = '';

        if ( $loop->have_posts() ) :

            while ( $loop->have_posts() ) :

                $loop->the_post();

                $postTitle = html_entity_decode( get_the_title(), ENT_QUOTES | ENT_HTML5, 'UTF-8' );

                $petition_lists[ $postTitle ] = get_the_ID();

            endwhile;

        endif;
        return $petition_lists;
    }
}
