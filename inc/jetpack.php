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
 *
 * @since 1.0.0
*/
function eighties_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'eighties' );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'eighties_infinite_scroll_js_settings' );