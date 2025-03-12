<?php
namespace KAFWPB\Base;

/**
 * Class for plucin deactivation.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class Deactivate {

	/**
	 * Deactivate the plugin.
	 */
	public static function deactivate() { // phpcs:ignore
		flush_rewrite_rules();
	}
}
