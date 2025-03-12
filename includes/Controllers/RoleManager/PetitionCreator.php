<?php
namespace KAFWPB\Controllers\RoleManager;

/**
 * Class to handle the petition creator role.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionCreator {

	/**
	 * Role ID.
	 *
	 * @var string $role_id
	 */
	private static $role_id = BWL_PETITIONS_EXTERNAL_ROLE_ID;

	/**
	 * Role name.
	 *
	 * @var string $role_name
	 */
	private static $role_name = 'External Petition Creator';

	/**
	 * Register filters.
	 */
	public function register() {
		$this->add_petition_creator_role();
	}


	/**
	 * Add petition creator role.
	 */
	public function add_petition_creator_role() {

		// Get subscriber capabilities as a base
		$role_data    = get_role( 'subscriber' );
		$capabilities = [];
		if ( $role_data ) {
			$capabilities = $role_data->capabilities;
		}

		// Define base capabilities
		$capabilities = array_merge($capabilities, [
			'read'              => true,
			'create_posts'      => true,
			'edit_posts'        => true,
			'edit_others_posts' => false,
			'publish_posts'     => true,
			'manage_categories' => false,
		]);

		add_role( self::$role_id, self::$role_name, $capabilities );

	}

		/**
		 * Add petition creator extra capabilities .
		 */
	private function add_extra_capabilities() {
		$role = get_role( self::$role_id );

		if ( $role ) {
				$role->add_cap( 'upload_files' );
				$role->add_cap( 'edit_published_posts' );
				$role->add_cap( 'edit_posts' );
				$role->add_cap( 'delete_posts' );
				$role->add_cap( 'level_0' );
		}
	}
}
