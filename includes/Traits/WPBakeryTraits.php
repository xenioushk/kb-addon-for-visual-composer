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
}
