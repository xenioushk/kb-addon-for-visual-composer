<?php
namespace KAFWPB\Base;

use BwlPetitionsManager\Controllers\DataBase\PetitionTables;
/**
 * Class for plucin activation.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class Activate {

	/**
	 *  Instance of the WPDB.
	 *
	 * @var object $wpdb
	 */
	private $wpdb;

	/**
	 * Constructor for the class.
	 *
	 * @param object $wpdb  Instance of the WPDB.
	 */
	public function __construct( $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * Activate the plugin.
	 */
	public function activate() { // phpcs:ignore
		flush_rewrite_rules();
		set_transient( 'bptm_activation_redirect', true, 5 );
	}

	/**
	 * Create database tables.
	 */
	public function create_db_tables() {

		$petition_tables = new PetitionTables( $this->wpdb );
		$petition_tables->register();
	}
}
