<?php
/**
 * Rivet functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Rivet
 * @since Rivet 1.0.0
 */

define( 'RIVET_THEME_VERSION', wp_get_theme()->get( 'Version') );

if ( ! defined( 'LP_COURSE_CPT' ) ) define( 'LP_COURSE_CPT', 'lp_course' );

if ( ! function_exists( 'rivet_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rivet_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rivet_, use a find and replace
		 * to change 'rivet' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rivet', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

		/*
		 * Adding Images size.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		$height = rivet_set_value( 'featured_image_height', 430 );
		$width  = rivet_set_value( 'featured_image_width', 590 );
		add_image_size( 'rivet-post-thumb', $width, $height, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'rivet' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rivet_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		) );  

		/**
		 * Registers an editor stylesheet for the theme.
		 * @link https://developer.wordpress.org/reference/functions/add_editor_style
		 * followed twentyseventeen theme and the link above
		 */
		add_editor_style( array( 'assets/css/style-editor.css', rivet_main_fonts_url() ) );

		remove_theme_support( 'widgets-block-editor' );
	}
endif;
add_action( 'after_setup_theme', 'rivet_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rivet_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rivet_content_width', 640 );
}
add_action( 'after_setup_theme', 'rivet_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rivet_widgets_init() {

	register_sidebar( 
		apply_filters(
			'rivet_default_sidebar_params',
			array(
				'name'          => __( 'Sidebar Default', 'rivet' ),
				'id'            => 'sidebar-default',
				'description'   => __( 'Add widgets here.', 'rivet' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>'
			)
		)
	);

	register_sidebar( 
		apply_filters(
			'rivet_blog_sidebar_params',
			array(
				'name'          => __( 'Blog Sidebar', 'rivet' ),
				'id'            => 'blog-sidebar',
				'description'   => __( 'Add widgets here.', 'rivet' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>'
			)
		)
	);
}
add_action( 'widgets_init', 'rivet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rivet_scripts() {
	wp_enqueue_style( 'rivet-style', get_stylesheet_uri() );

	wp_enqueue_style( 'remixicon', get_template_directory_uri() . '/assets/css/remixicon.css', array(), RIVET_THEME_VERSION );

	$box_icon_enable = apply_filters( 'rivet_box_icon_enable', false );
	if ( $box_icon_enable ) :
		wp_enqueue_style( 'boxicons', get_template_directory_uri() . '/assets/css/boxicons.min.css', array(), RIVET_THEME_VERSION );
	endif;

	wp_enqueue_style( 'metismenu', get_template_directory_uri() . '/assets/css/metisMenu.min.css', array(), RIVET_THEME_VERSION );

	wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assets/css/nice-select.css', array(), RIVET_THEME_VERSION );

	wp_enqueue_style( 'swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.css', array(), RIVET_THEME_VERSION );
	
	wp_enqueue_style( 'rivet-main', get_template_directory_uri() . '/assets/css/main.css', array(), RIVET_THEME_VERSION );

	wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

	wp_enqueue_script( 'metismenu', get_template_directory_uri() . '/assets/js/metisMenu.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

	wp_enqueue_script( 'rivet-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rivet-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	if ( rivet_is_woocommerce_activated() ) :
		if ( is_woocommerce() ) :
			wp_enqueue_script( 'jquery-tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );
		endif;
	endif;

	wp_register_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), RIVET_THEME_VERSION );

	wp_register_script( 'jquery-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

	wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

	
	wp_enqueue_script( 'swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array( 'jquery' ), RIVET_THEME_VERSION, true );
	

	if ( ( function_exists( 'is_product' ) && is_product() ) ) :
		wp_enqueue_style( 'rivet-slick', get_template_directory_uri() . '/assets/css/slick.min.css', array(), RIVET_THEME_VERSION );

		wp_enqueue_script( 'rivet-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );
	endif;

	if ( rivet_set_value( 'scroll_to_top', true ) ) :
		wp_enqueue_script( 'rivet-back-to-top', get_template_directory_uri() . '/assets/js/back-to-top.js', array(), RIVET_THEME_VERSION, true );
	endif;

	if ( rivet_set_value( 'smooth_scroll', false ) ) :
		wp_enqueue_script( 'rivet-smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.min.js', array(), RIVET_THEME_VERSION, true );
	endif;

	wp_enqueue_script( 'svg-inject', get_template_directory_uri() . '/assets/js/svg-inject.min.js', array( 'jquery' ), RIVET_THEME_VERSION, true );

	wp_enqueue_script( 'rivet-init', get_template_directory_uri() . '/assets/js/init.js', array( 'jquery' ), RIVET_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'rivet_scripts' );


/**
 * rivet Core Functions
 */
require_once get_template_directory() . '/inc/rivet-core-functions.php';

/**
 * rivet colors
 */
require_once get_template_directory() . '/inc/color.php';

/**
 * Load CMB2 metabox file.
 */
require_once get_template_directory() . '/inc/vendors/cmb2/functions.php';

/**
 * Load Redux file.
 */
require_once get_template_directory() . '/inc/vendors/redux/functions.php';

/**
 * Load Once Click Demo Import File.
 */
require_once get_template_directory() . '/inc/vendors/one-click-demo-import/functions.php';

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Bootstrap Nav Walker Class
 */
require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) :
	require_once get_template_directory() . '/inc/jetpack.php';
endif;

/**
 * WooCommerce Essentials.
 */
if ( rivet_is_woocommerce_activated() ) :
	require_once get_template_directory() . '/woocommerce/custom/functions.php';
endif;

/**
 * Elementor Essentials
 */
require_once get_template_directory() . '/inc/vendors/elementor/functions.php';


/**
 * Admin Script
 */
require_once get_template_directory() . '/inc/admin-scripts.php';

/**
 * TGM Plugin Installer
 */
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) :
	require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
endif;