<?php
/**
 * eighties Theme Customizer
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eighties_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'eighties_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eighties_customize_preview_js() {
	wp_enqueue_script( 'eighties-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20140410', true );
}
add_action( 'customize_preview_init', 'eighties_customize_preview_js' );