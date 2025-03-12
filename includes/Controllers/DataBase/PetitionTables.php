<?php
namespace KAFWPB\Controllers\DataBase;

use BwlPetitionsManager\Api\Database\TableManagerApi;
/**
 * Class for petition about shortcode.
 *
 * @since: 1.1.6
 * @package BwlPetitionsManager
 */
class PetitionTables {

    /**
     *  Instance of the WPDB.
     *
     * @var object $wpdb
     */
    private $wpdb;

    /**
     *  Instance of the Table Manager API.
     *
     * @var object $table_manager_api
     */
    private $table_manager_api;

    /**
     * Constructor for the class.
     *
     * @param object $wpdb  Instance of the WPDB.
     */
    public function __construct( $wpdb ) {
        $this->wpdb = $wpdb;
    }

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->table_manager_api = new TableManagerApi( $this->wpdb );

        $this->table_manager_api->register_tables_info( $this->get_the_tables_info() )->register();
    }

    /**
     * Get the tables info.
     *
     * @return array $tables_info
     */
    public function get_the_tables_info() {

        $tables_info = [
            [
                'table_name' => $this->wpdb->prefix . 'bwl_petition_data',
                'schema'     => 'ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                            postid bigint(20) UNSIGNED NOT NULL,
                            bpt_user_name varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                            bpt_user_email varchar(200) NOT NULL,
                            bpt_user_country varchar(100) NOT NULL,
                            bpt_user_ip varchar(45) NOT NULL,
                            bpt_user_id bigint(42) UNSIGNED NOT NULL,
                            bpt_user_address LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                            bpt_user_msg LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                            bpt_user_sign_date DATE NULL DEFAULT NULL,
                            bpt_user_sign_date_time DATETIME NULL DEFAULT NULL,
                            bpt_user_sign_status bigint(20) NOT NULL DEFAULT 1,
                            bpt_add_fields TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
                            PRIMARY KEY (ID),
                            KEY idx_postid (postid)',
            ],
        ];
        return $tables_info;
    }
}
