<?php

namespace KAFWPB\Callbacks\WPBakery\Shortcodes;

/**
 * Get all the kb and filter by tags.
 *
 * @package KAFWPB
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class TagsShortcodeParamCb {

	/**
	 * Get the output.
	 *
	 * @param array  $settings Settings.
	 * @param string $value Values.
	 *
	 * @return string
	 */
	public function get_the_output( $settings, $value ) {

		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';

		if ( ! empty( $value ) ) {

			$explode_value = explode( ',', $value );
		} else {

			$explode_value = [];
		}

		$bkb_tags_args = [
			'post_type'        => BWL_PLUGIN_POST_TYPE,
			'taxonomy'         => BWL_PLUGIN_TAXONOMY_TAGS,
			'hide_empty'       => 1,
			'orderby'          => 'title',
			'order'            => 'ASC',
			'suppress_filters' => false,
		];

		if ( defined( 'BKB_WP_POST' ) ) {

			$bkb_tags_args['post_type'] = 'post';
			$bkb_tags_args['taxonomy']  = 'post_tag';
		}

		$bkb_tags = get_categories( $bkb_tags_args );

		$parent_list = [];

		foreach ( $bkb_tags as $tags ) :

			$parent_list[ $tags->slug ] = $tags->name;

    endforeach;

		$selected_list = [];

		// Now we pick those array data which index is cat-1 and cat-2

		if ( count( $explode_value ) > 0 ) {

			foreach ( $explode_value as $key => $value ) {

				if ( in_array( $value, array_keys( $parent_list ), true ) ) {

					$selected_list[ $value ] = $parent_list[ $value ];

					unset( $parent_list[ $value ] );
				}
			}
		}

		$parent_list_string = '<ul id="sortable1" class="connectedSortable bkb_connected list">';

		foreach ( $parent_list as $key => $value ) :
			$parent_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

		$parent_list_string .= '</ul>';

		$selected_list_string = '<ul id="sortable2" class="connectedSortable bkb_connected list bkb_tags">';

		foreach ( $selected_list as $key => $value ) :
			$selected_list_string .= '<li data-value="' . $key . '">' . $value . '</li>';
    endforeach;

		$selected_list_string .= '</ul>';
		$output                = '';

		$output .= '<section id="bkb_connected">
                        ' . $parent_list_string . '
                        ' . $selected_list_string . '
                   </section>';

		$output .= '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';

		return $output;

	}
}
