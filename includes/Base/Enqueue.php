<?php
namespace KAFWPB\Base;

/**
 * Class for registering the plugin scripts and styles.
 *
 * @package KAFWPB
 */
class Enqueue extends BaseController {

	/**
	 * Frontend script slug.
	 *
	 * @var string $frontend_script_slug
	 */
	private $frontend_script_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->frontend_script_slug = 'bptm-frontend';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'get_the_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}

	/**
	 * Load the plugin styles.
	 */
	public function get_the_styles() {

		// Register Styles.

		wp_enqueue_style(
            'bootstrap-social',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . ' bootstrap/styles/bootstrap-social.css',
            [],
        BWL_PETITIONS_VERSION );

			wp_enqueue_style(
                'bptm-carousel',
                BWL_PETITIONS_PLUGIN_LIBS_DIR . 'owl.carousel/styles/owl.carousel.css',
                [],
            BWL_PETITIONS_VERSION );
		wp_enqueue_style(
			$this->frontend_script_slug,
            BWL_PETITIONS_PLUGIN_STYLES_ASSETS_DIR . 'frontend.css',
            [],
		BWL_PETITIONS_VERSION );

		if ( is_rtl() ) {

			wp_enqueue_style(
				'bptm-frontend-rtl',
                BWL_PETITIONS_PLUGIN_STYLES_ASSETS_DIR . 'frontend_rtl.css',
                [],
			BWL_PETITIONS_VERSION );
		}
	}

	/**
	 * Load the plugin scripts.
	 */
	public function get_the_scripts() {

		// Register JS
		wp_enqueue_script(
			'jquery-validate',
			BWL_PETITIONS_PLUGIN_LIBS_DIR . 'jquery.validate/scripts/jquery.validate.min.js',
			[ 'jquery' ],
		BWL_PETITIONS_VERSION, true );
		wp_enqueue_script(
            'jquery-easing',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . 'easyticker/scripts/jquery.easing.min.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );
		wp_enqueue_script(
            'jquery-easy-ticker',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . 'easyticker/scripts/jquery.easy-ticker.min.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );
		wp_enqueue_script(
            'waypoints.js',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . 'waypoints/scripts/waypoints.min.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );
		wp_enqueue_script(
            'jquery-counterup',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . 'jquery.counterup/scripts/jquery.counterup.min.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );
		wp_enqueue_script(
            'owl.carousel.js',
            BWL_PETITIONS_PLUGIN_LIBS_DIR . 'owl.carousel/scripts/owl.carousel.min.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );
		wp_enqueue_script(
            $this->frontend_script_slug,
            BWL_PETITIONS_PLUGIN_SCRIPTS_ASSETS_DIR . 'frontend.js',
            [ 'jquery' ],
        BWL_PETITIONS_VERSION, true  );

		// Load frontend variables used by the JS files.
		$this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmFrontendData.version
		wp_localize_script(
            $this->frontend_script_slug,
            'BptmFrontendData',
            [
				'version' => BWL_PETITIONS_VERSION,
            ]
		);
	}
}
