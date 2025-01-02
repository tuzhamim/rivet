<?php
namespace RivetCore;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) :
			self::$_instance = new self();
		endif;
		return self::$_instance;
	}

	/**
	 * registered_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function registered_scripts() {

		// FancyBox CSS
		wp_register_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), RIVET_THEME_VERSION );

		// Odometer CSS
		wp_register_style( 'jquery-odometer', plugins_url( '/assets/css/odometer.min.css', __FILE__ ), '', RIVET_THEME_VERSION );

		// Slick Slider CSS
		wp_register_style( 'rivet-slick', get_template_directory_uri() . '/assets/css/slick.min.css', array(), RIVET_THEME_VERSION );

		// Odometer JS
		wp_register_script( 'jquery-odometer', plugins_url( '/assets/js/odometer.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		// ViewPort JS
		wp_register_script( 'jquery-viewport', plugins_url( '/assets/js/isInViewport.jquery.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		// SAL JS
		wp_register_script( 'sal-js', plugins_url( '/assets/js/sal.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		// Lottie JS
		wp_register_script( 'lottie-js', plugins_url( '/assets/js/lottie.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		// Slick Slider JS
		wp_register_script( 'rivet-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

		// Rivet animation
		wp_register_script( 'rivet-animation', plugins_url( '/assets/js/rivet-animation.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		// Conterup JS
		wp_register_script( 'jquery-counterup', plugins_url( '/assets/js/jquery.counterup.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

        // Waypoints JS
        wp_register_script( 'jquery-waypoints', plugins_url( '/assets/js/jquery.waypoints.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

        // CountDown JS
        wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

        // Tilt JS
        wp_register_script( 'jquery-tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

        // imagesLoaded JS
        wp_register_script( 'jquery-imagesloaded', plugins_url( '/assets/js/imagesloaded.pkgd.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

        // Isotope JS
        wp_register_script( 'jquery-isotope', plugins_url( '/assets/js/isotope.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

        // FancyBox JS
        wp_register_script( 'jquery-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

        // Animated Text JS
        wp_register_script( 'typed-js', plugins_url( '/assets/js/typed.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );
	}

	/**
	 * enqueued_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueued_scripts() {
		wp_enqueue_style( 'rivet-core-main-css', plugins_url( '/assets/css/rivet-core-main.css', __FILE__ ), '', RIVET_THEME_VERSION );

		wp_enqueue_script( 'rivet-core-animation-js', plugins_url( '/assets/js/rivet-core-animation.min.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );

		wp_enqueue_script( 'rivet-core-init-js', plugins_url( '/assets/js/rivet-core-init.js', __FILE__ ), array( 'jquery' ), RIVET_THEME_VERSION, true );
		
		wp_localize_script( 'rivet-core-init-js', 'rivet_frontend_ajax_object',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            ) 
        );
	}

	/**
	 * editor_enqueued_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function editor_enqueued_scripts() {
		wp_enqueue_style( 'rivet-elementor-editor', get_template_directory_uri() . '/assets/css/rivet-elementor-editor.css', '', RIVET_THEME_VERSION );
	}

	private function plugin_active( $plugin ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( $plugin ) ) :
			return true;
		endif;

		return false;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		// include_once( __DIR__ . '/widgets/test.php' );
		include_once( __DIR__ . '/widgets/animation.php' );
		include_once( __DIR__ . '/widgets/button.php' );
		include_once( __DIR__ . '/widgets/contact-form-7.php' );
		include_once( __DIR__ . '/widgets/copyright.php' );
		include_once( __DIR__ . '/widgets/countdown.php' );
		include_once( __DIR__ . '/widgets/counterup.php' );
		include_once( __DIR__ . '/widgets/footer-menu.php' );
		include_once( __DIR__ . '/widgets/image-icon-box.php' );
		include_once( __DIR__ . '/widgets/mailchimp.php' );
		include_once( __DIR__ . '/widgets/nav-menu.php' );
		include_once( __DIR__ . '/widgets/site-logo.php' );
		include_once( __DIR__ . '/widgets/video-popup.php' );
		include_once( __DIR__ . '/widgets/section-title.php' );
		include_once( __DIR__ . '/widgets/services.php' );
		include_once( __DIR__ . '/widgets/testimonial.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		// \Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Test() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Animation() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Contact_Form_Seven() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\CountDown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Counter_Up() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Image_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\MailChimp() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Video_PopUp() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Copyright() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Footer_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Nav_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Site_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Section_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Services() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial() );
	}

	/**
     * 
     * Includes all Files
     * @since 1.0.0
     * @access public
     */
	public function includes() {
		require_once( __DIR__ . '/inc/copyright-shortcode.php' );
		require_once( __DIR__ . '/inc/rivet-helper-class.php' );
		require_once( __DIR__ . '/inc/rivet-icons.php' );
		require_once( __DIR__ . '/inc/rivet-mailchimp-api.php' );
		require_once( __DIR__ . '/inc/rivet-shortcodes.php' );
		require_once( __DIR__ . '/inc/rivet-widget-functions.php' );
	}

	/**
     * 
     * Includes all Traits
     * @since 1.0.0
     * @access public
     */
	public function traits() {
		require_once( __DIR__ . '/inc/Traits/Button.php' );
		require_once( __DIR__ . '/inc/Traits/Grid.php' );
		require_once( __DIR__ . '/inc/Traits/Posts.php' );
		require_once( __DIR__ . '/inc/Traits/Slider.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Arrows.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Dots.php' );
		require_once( __DIR__ . '/inc/Traits/Taxonomy.php' );
		require_once( __DIR__ . '/inc/Traits/Users.php' );
	}

	/**
     * 
     * Includes all Post Types
     * @since 1.0.0
     * @access public
     */
	public function post_types() {
		require_once( __DIR__ . '/inc/post-types/event.php' );
		require_once( __DIR__ . '/inc/post-types/header.php' );
		require_once( __DIR__ . '/inc/post-types/footer.php' );
	}

	/**
     * 
     * Includes all Widgets
     * @since 1.0.0
     * @access public
     */
	public function widgets() {
		require_once( __DIR__ . '/inc/widgets/posts.php' );
	}

	/**
     * 
     * extra entrance animation
     * @since 1.0.0
     * @access public
     */
	public function extra_entrance_animations( $animations = array() ) {
		$entrance_animations = array(
			'Rivet Extra Animations' => [
				'rivet--scale'       => __('Scale', 'rivet'),
				'rivet--fancy'       => __('Fancy', 'rivet'),
				'rivet--slide-up'    => __('Slide Up', 'rivet'),
				'rivet--slide-left'  => __('Slide Left', 'rivet'),
				'rivet--slide-right' => __('Slide Right', 'rivet'),
				'rivet--slide-down'  => __('Slide Down', 'rivet')
			]
		);
		return array_merge( $animations, $entrance_animations );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'registered_scripts' ] );
		
		// Enqueued widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueued_scripts' ] );

		// Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_enqueued_scripts' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Additional Entrance Animations
		add_filter( 'elementor/controls/animations/additional_animations', [ $this, 'extra_entrance_animations' ], 10 );


		// Load Files
		$this->includes();

		// Load Traits
		$this->traits();

		// Load Post Types
		$this->post_types();

		// Load Widgets
		$this->widgets();
	}
}

// Instantiate Plugin Class
$theme = wp_get_theme();
if ( 'Rivet' === $theme->name || 'Rivet' === $theme->parent_theme ) :
	Plugin::instance();
endif;