<?php
namespace KAFWPB\Callbacks\WPBakery\Shortcodes;

/**
 * WPBakery Page Builder Callbacks for Petition Title.
 *
 * @package BwlPetitionsManager
 * @since: 1.1.5
 * @author: Mahbub Alam Khan
 */
class PetitionTitleCb {

	/**
	 * Callback for petition title field.
	 *
	 * @param array  $settings Settings.
	 * @param string $value Value.
	 *
	 * @return string
	 */
	public function cb_petition_title_field( $settings, $value ) {

		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';

		$type = isset( $settings['type'] ) ? $settings['type'] : '';

		$class = isset( $settings['class'] ) ? $settings['class'] : '';

		$output = '<input type="hidden" class="wpb_vc_param_value wpbc ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';

		return $output;
	}
}
