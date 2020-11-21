<?php
namespace ElementorCustomSlider;

use ElementorCustomSlider\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		
	}

	/* yohann */
	public function override_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->unregister_widget_type( 'slides' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Custom_Slider() );	
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/custom-slider.php' );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		//add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		/* yohann */
		// Override widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'override_widgets' ], 15 );

		// Register editor scripts
		//add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		
	}
}

// Instantiate Plugin Class
Plugin::instance();
