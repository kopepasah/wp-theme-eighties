<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function eighties_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',
		'container'      => 'main',
		'footer_widgets' => false,
		'wrapper'        => false,
	) );

	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'eighties_jetpack_setup' );

/**
 * Dequeue Jetpack Infinite Scroll Styles
 */
function eighties_jetpack_enqueue_scripts() {
	wp_dequeue_style( 'the-neverending-homepage' );
}
add_action( 'wp_enqueue_scripts', 'eighties_jetpack_enqueue_scripts' );

/**
 * Change Jetpack's Infinite Scroll text.
 *
 * @param array $settings for the function.
 */
function eighties_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'eighties' );

	/**
	 * For the portfolio, we need to change the id and,
	 * just for fun, switch the type to scroll.
	*/
	if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		$settings['id'] = 'portfolio-wrapper';
		$settings['type'] = 'scroll';
	}

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'eighties_infinite_scroll_js_settings' );

/**
 * Change the render if we are on the portfolio
 * archive or page template.
 */
function eighties_infinite_scroll_render() {
	if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'content', 'portfolio' );
		}
	}
}
add_action( 'infinite_scroll_render', 'eighties_infinite_scroll_render' );
