<?php
namespace KAFWPB\Base;

/**
 * Class for plugin custom theme.
 *
 * @since: 1.1.0
 * @package KAFWPB
 */
class CustomTheme {

  	/**
     * Register methods
     */
	public function register() {
		add_action( 'wp_head', [ $this, 'get_custom_theme' ] );
	}

	/**
	 * Get the custom theme.
	 */
	public function get_custom_theme() {
		// Get option panel settings.

		$custom_theme = '<style type="text/css">';

		$custom_theme .= '</style>';

		echo $custom_theme; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
