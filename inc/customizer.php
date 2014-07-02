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

	/**
	 * Singular Header Options
	 *
	 * Add a options for using the featured image in lieu
	 * of the header image and the item title in lieu of the
	 * site tite for singular items. But only if the current
	 * theme supports the custom header (child themes can
	 * remove this support).
	 *
	 * @since 1.1.0
	 */
	if ( get_theme_support( 'custom-header' ) ) {

		// Add the new section just below the Header Image section.
		$wp_customize->add_section( 'eighties_singular_header', array(
			'title'       => __( 'Singular Header', 'eighties' ),
			'description' => __( 'For singular items (e.g. posts, pages) you can select to display the default header image or the featured image of the item.', 'eighties' ),
			'priority'    => 61,
		) );

		// Add setting for the singular header image control.
		$wp_customize->add_setting( 'eighties_singular_header_image', array(
			'default'   => 'header',
			'transport' => 'postMessage'
		) );

		// Add control for the singulare header image.
		$wp_customize->add_control( 'eighties_singular_header_image', array(
			'label'   => __( 'Image Displays:', 'eighties' ),
			'section' => 'eighties_singular_header',
			'type'    => 'radio',
			'choices' => array(
				'header'         => __( 'Header Image', 'eighties' ),
				'featured_image' => __( 'Featured Image', 'eighties' ),
			),
		) );
	}
}
add_action( 'customize_register', 'eighties_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eighties_customize_preview_js() {
	wp_enqueue_script( 'eighties-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20140410', true );
}
add_action( 'customize_preview_init', 'eighties_customize_preview_js' );