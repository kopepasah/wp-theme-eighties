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
*/
function eighties_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'eighties' );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'eighties_infinite_scroll_js_settings' );

/**
 * Change the render if we are on the portfolio
 * archive or page template.
*/
function eighties_infinite_scroll_render() {
	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'content', 'portfolio' );
		}
	}
}
add_action( 'infinite_scroll_render', 'eighties_infinite_scroll_render' );

/**
 * Filter query object to filter the infinite
 * scroll settings.
*/
function eighties_infinite_scroll_query_object( $query ) {
	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		add_filter( 'infinite_scroll_settings', 'eighties_portfolio_infinite_scroll_settings' );
	}

	return $query;
}
add_filter( 'infinite_scroll_query_object', 'eighties_infinite_scroll_query_object' );

/**
 * Filter for the infinite scroll settings.
*/
function eighties_portfolio_infinite_scroll_settings( $settings ) {
	$settings['wrapper'] = false;
	$settings['container'] = 'portfolio-wrapper';

	return $settings;
}