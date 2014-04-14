<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses eighties_header_style()
 * @uses eighties_admin_header_style()
 * @uses eighties_admin_header_image()
 */
function eighties_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'eighties_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header-default.jpg',
		'default-text-color'     => 'ffffff',
		'height'                 => 600,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'eighties_header_style',
		'admin-head-callback'    => 'eighties_admin_header_style',
		'admin-preview-callback' => 'eighties_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'eighties_custom_header_setup' );

if ( ! function_exists( 'eighties_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see eighties_custom_header_setup().
 */
function eighties_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();
	$header = get_custom_header();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( ( HEADER_TEXTCOLOR == $header_text_color ) && ! $header_image ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>

	<?php
		// We have a header image, let's do something with it.
		if ( $header_image ) :
	?>
		#masthead {
			background-image: url('<?php echo $header_image ?>');
			background-position: center center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	<?php endif; ?>

	<?php
		// If the header height is different than 600, let's calculate a padding.
		if ( 600 != $header->height ) :
	?>
		.site-branding {
			padding: <?php echo ( $header->height / 4 / 16 ) ?>em 0;
		}
	<?php endif; ?>

	</style>
	<?php
}
endif; // eighties_header_style

if ( ! function_exists( 'eighties_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see eighties_custom_header_setup().
 */
function eighties_admin_header_style() {
	$header = get_custom_header();  

?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			overflow: hidden;
			position: relative;
			background-color: #2D2D2D;
			border: none;
			font-size: 16px;
			<?php if ( get_header_image() ) : ?>
				background-image: url('<?php header_image(); ?>');
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center center;
			<?php endif; ?>
		}
		.appearance_page_custom-header #headimg img {
			max-width: 100%;
		}
		#headimg .displaying-header-text {
			width: 100%;
			text-align: center;
			<?php
				// If the header height is different than 600, let's calculate a padding.
				if ( 600 != $header->height ) :
			?>
				padding: <?php echo ( $header->height / 4 / 16 ); ?>em 0;
			<?php else : ?>
				padding: 5em 0;
			<?php endif; ?>

		}
		#headimg .displaying-header-text a {
			text-decoration: none;
		}
		#headimg h1 {
			font-size: 5em;
			margin: 0 0 16px;
		}
	</style>
<?php
}
endif; // eighties_admin_header_style

if ( ! function_exists( 'eighties_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see eighties_custom_header_setup().
 */
function eighties_admin_header_image() {
	$style = sprintf( 'style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( 'blank' != get_header_textcolor() ) : ?>
			<div class="displaying-header-text">
				<h1><a id="name" <?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<div id="desc" <?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( 'blank' != get_header_textcolor() ) : ?>
		<p><?php _e( 'This is just an example of what your text may look like. Actual fonts may differ on the public side.', 'eighties' ); ?></p>
	<?php endif; ?>
<?php
}
endif; // eighties_admin_header_image
