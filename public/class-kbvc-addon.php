<?php

class BKB_VC {


    const VERSION = BKB_VC_ADDON_CURRENT_VERSION;

    protected $plugin_slug     = 'bkb_vc';
    protected static $instance = null;

    private function __construct() {

        if ( class_exists( 'BwlKbManager\\Init' ) && defined( 'WPB_VC_VERSION' ) && BKB_VC_PARENT_PLUGIN_PURCHASE_STATUS == 1 ) {

            add_action( 'init', [ $this, 'load_plugin_textdomain' ] );
            add_action( 'init', 'bkb_vc_addon_function' );

            // add_action( 'wp_enqueue_scripts', [ $this, 'bkb_vc_enqueue_styles' ] );
            // add_action( 'wp_enqueue_scripts', [ $this, 'bkb_vc_enqueue_scripts' ] );
            // add_action( 'admin_enqueue_scripts', [ $this, 'bkb_admin_vc_addon_style' ] );

            $this->included_files();
        }

        if ( is_admin() ) {

            if ( ! class_exists( 'BwlKbManager\\Init' ) || ! defined( 'WPB_VC_VERSION' ) ) {
                add_action( 'admin_notices', [ $this, 'kbvcVersionUpdateAdminNotice' ] );
                return false;
            }

            if ( BKB_VC_PARENT_PLUGIN_PURCHASE_STATUS == 0 ) {
                add_action( 'admin_notices', [ $this, 'kbvcPurchaseVerificationNotice' ] );
                return false;
            }
        }
    }

    public function kbvcVersionUpdateAdminNotice() {

        echo '<div class="updated"><p>You need to download & install both '
            . '<b><a href="https://1.envato.market/VKEo3" target="_blank">WPBakery Page Builder</a></b> && '
            . '<b><a href="https://1.envato.market/bkbm-wp" target="_blank">' . BKB_VC_ADDON_PARENT_PLUGIN_TITLE . '</a></b> '
            . 'to use <b>' . BKB_VC_ADDON_TITLE . '</b>. </p></div>';
    }

    public function kbvcPurchaseVerificationNotice() {
        $licensePage = admin_url( 'edit.php?post_type=bwl_kb&page=bkb-license' );

        echo '<div class="updated"><p>You need to <a href="' . $licensePage . '">activate</a> '
            . '<b>' . BKB_VC_ADDON_PARENT_PLUGIN_TITLE . '</b> '
            . 'to use <b>' . BKB_VC_ADDON_TITLE . '</b>.</p></div>';
    }

    function included_files() {
        include_once BKB_VC_PATH . 'includes/autoupdater/WpAutoUpdater.php';
        include_once BKB_VC_PATH . 'includes/autoupdater/installer.php';
        include_once BKB_VC_PATH . 'includes/autoupdater/updater.php';
    }

    // public function bkb_vc_enqueue_styles() {

    // wp_enqueue_style( $this->plugin_slug . '-frontend', BKB_VC_PLUGIN_DIR . 'assets/styles/frontend.css', [], self::VERSION );
    // }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */
    // public function bkb_vc_enqueue_scripts() {
    // wp_enqueue_script( $this->plugin_slug . '-waypoint', BKB_VC_PLUGIN_DIR . 'libs/jquery-counterup/jquery.counterup.min.js', [ 'jquery' ], self::VERSION, true );
    // wp_enqueue_script( $this->plugin_slug . '-counter-up', BKB_VC_PLUGIN_DIR . 'libs/jquery-waypoint/waypoints.min.js', [ 'jquery' ], self::VERSION, true );
    // wp_enqueue_script( $this->plugin_slug . '-frontend', BKB_VC_PLUGIN_DIR . 'assets/scripts/frontend.js', [ 'jquery', $this->plugin_slug . '-counter-up', $this->plugin_slug . '-waypoint' ], self::VERSION, true );
    // }

    // function bkb_admin_vc_addon_style() {

    // wp_enqueue_style( 'bkb-vc-admin', BKB_VC_PLUGIN_DIR . 'assets/styles/admin.css', false, BKB_VC_ADDON_CURRENT_VERSION, false );
    // wp_enqueue_script( 'bkb-admin-vc-addon', BKB_VC_PLUGIN_DIR . 'assets/scripts/admin.js', [ 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-sortable' ], BKB_VC_ADDON_CURRENT_VERSION, true );
    // wp_localize_script(
    // 'bkb-admin-vc-addon',
    // 'BkbmKavcAdminData',
    // [
    // 'product_id'   => BKB_VC_ADDON_CC_ID,
    // 'installation' => get_option( BKB_VC_ADDON_INSTALLATION_TAG ),
    // ]
    // );
    // }

    public function get_plugin_slug() {
        return $this->plugin_slug;
    }

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function activate( $network_wide ) {

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_activate();
                }

                restore_current_blog();
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
    }

    public static function deactivate( $network_wide ) {

        if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {

                    switch_to_blog( $blog_id );
                    self::single_deactivate();
                }

                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    public function activate_new_site( $blog_id ) {

        if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
            return;
        }

        switch_to_blog( $blog_id );
        self::single_activate();
        restore_current_blog();
    }

    private static function get_blog_ids() {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col( $sql );
    }

    private static function single_activate() {
        // @TODO: Define activation functionality here
    }

    private static function single_deactivate() {
        // @TODO: Define deactivation functionality here
    }

    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;

        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
    }
}
