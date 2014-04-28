<?php
/**
 * eighties functions and definitions
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 760; /* pixels */
}

/**
 * Set the theme mods in a global variable. This makes it easier to
 * retrieve in templates and functions.
 */
// $GLOBALS['eighties_theme_mod'] = get_theme_mod( 'eighties' );

if ( ! function_exists( 'eighties_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eighties_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eighties, use a find and replace
	 * to change 'eighties' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'eighties', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'eighties' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	// Enable support for less.
	// REMOVE Remove less support before sending to WordPress.com.
	add_theme_support( 'less', array(
		'enable'  => true,
		'develop' => true,
		'watch'   => true,
		'minify'  => true
	) );
}
endif; // eighties_setup
add_action( 'after_setup_theme', 'eighties_setup' );

/**
 * Register a footer and interactive widget area.
 */
function eighties_widgets_init() {
	/**
	 * Set up our interactive sidebar if a user decided
	 * to enable this sidebar via the Customizer.
	*/
	register_sidebar( array(
		'name'          => __( 'Interactive Sidebar', 'eighties' ),
		'id'            => 'eighties-interactive-sidebar',
		'description'   => __( 'This sidebar opens as a toggle on the right side of a users browser window. Note that the toggle feature requires JavaScript in order to function. But no need to worry, a plain sidebar will appear if JavaScript does not work. If empty, the sidebar with not display.', 'eighties' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Footer widget area.
	register_sidebar( array(
		'name'          => __( 'Footer', 'eighties' ),
		'id'            => 'eighties-footer',
		'description'   => __( 'Widget area for the footer. If no widgets are provided, this footer will not appear.', 'eighties' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'eighties_widgets_init' );

/**
 * Register Righteous Google font for Eighties
 *
 * @since 1.0.0
 * @return string
*/
function eighties_header_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language
	 * that are not supported by Righteous, translate this to
	 * 'off'. Do not translate into your own language.
	*/
	if ( 'off' !== _x( 'on', 'Righteous font: on or off', 'eighties' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Righteous' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Register Raleway Google font for Eighties
 *
 * @since 1.0.0
 * @return string
*/
function eighties_headings_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language
	 * that are not supported by Raleway, translate this to
	 * 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'eighties' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Raleway:600' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Register Open Sans Google font for Eighties
 *
 * @since 1.0.0
 * @return string
*/
function eighties_body_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language
	 * that are not supported by Open Sans, translate this to
	 * 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'eighties' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400italic,700italic,400,700' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles.
 */
function eighties_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';

	// Add Righteous font, used in the main stylesheet.
	wp_enqueue_style( 'eighties-header', eighties_header_font_url(), array(), null );

	// Add Raleway font, used in the main stylesheet.
	wp_enqueue_style( 'eighties-headings', eighties_headings_font_url(), array(), null );

	// Add Open Sans font, used in the main stylesheet.
	wp_enqueue_style( 'eighties-body', eighties_body_font_url(), array(), null );

	// Font Awesome Icons
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/fa/font-awesome.css' );

	// Eighties Styles
	wp_enqueue_style( 'eighties', get_stylesheet_uri() );

	// Register scripts
	wp_register_script( 'backstretch', get_template_directory_uri() . '/js/jquery.backstretch.js', array( 'jquery' ), '2.0.4', true );
	wp_register_script( 'bigslide', get_template_directory_uri() . '/js/jquery.bigslide.js', array( 'jquery' ), '0.4.3', true );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.7.1', false );
	wp_register_script( 'skrollr', get_template_directory_uri() . '/js/skrollr.js', array(), '0.6.24', true );

	// Enqueue global (includes navigation and others).
	wp_enqueue_script( 'eighties', get_template_directory_uri() . '/js/eighties.js', array( 'modernizr' ), '20120206', true );

	wp_enqueue_script( 'eighties-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// NOTE Tabling this for now. See note in JS file for more information.
	// if ( is_home() || is_archive() || is_search() ) {
	// 	wp_enqueue_script( 'eighties-blog', get_template_directory_uri() . '/js/eighties-blog.js', array( 'modernizr' ), '20120206', true );
	// }

	if ( get_header_image() ) {
		wp_enqueue_script( 'eighties-header', get_template_directory_uri() . '/js/eighties-header.js', array( 'backstretch', 'skrollr' ), '20140407', true );
	}
}
add_action( 'wp_enqueue_scripts', 'eighties_scripts' );

/**
 * Enqueue Header Google fonts style to admin
 * screen for custom header display.
 *
 * @since 1.0.0
 */
function eighties_admin_fonts() {
	wp_enqueue_style( 'eighties-header', eighties_header_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'eighties_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
