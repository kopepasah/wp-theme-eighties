<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div class="site-toggles">
			<a href class="main-navigation-toggle"><i class="fa fa-bars"></i></a>
			<?php if ( is_active_sidebar( 'eighties-interactive-sidebar' ) ) : ?>
				<a href class="widget-area-toggle"><i class="fa fa-align-right"></i></a>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a href class="main-navigation-toggle"><i class="fa fa-times"></i></a>
			<h4 class="main-navigation-title"><?php _e( 'Menu', 'eighties' ); ?></h4>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->

		<header id="masthead" class="site-header" role="banner" data-0="height: 600px; overflow: hidden;" data-600="height: 0px;">
			<a class="skip-link screen-reader-text" href="#content" <?php echo ( get_header_image() ) ? 'data-backstretch="' . get_header_image() . '"' : ''; ?>><?php _e( 'Skip to content', 'eighties' ); ?></a>
			<div class="site-branding" data-0="opacity:1;" data-300="opacity:0;">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content">
