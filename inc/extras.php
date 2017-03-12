<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function eighties_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'eighties_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function eighties_body_class( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() && has_post_thumbnail( get_the_ID() ) ) {
		$classes[] = 'single-has-thumbnail';
	}

	return $classes;
}
add_filter( 'body_class', 'eighties_body_class' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since 1.0.0
 * @param array $classes Classes for the post element.
 * @return array
 */
function eighties_post_class( $classes ) {
	// If we are in version 3.9 or below, add a has-post-thumbnail class.
	if ( version_compare( $GLOBALS['wp_version'], '3.9', '<' ) ) {
		if ( has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}
	}

	if ( ( is_home() || is_archive() || is_search() ) && has_post_thumbnail() ) {
		$classes[] = 'has-backstretch';
	}

	return $classes;
}
add_filter( 'post_class', 'eighties_post_class' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function eighties_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary...
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'eighties' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'eighties_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function eighties_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'eighties_setup_author' );

/**
 * Add search to the primary menu.
 *
 * @param params $items For the function.
 * @param params $args For the function.
 * @return string Navigation menu items.
 */
function eighties_primary_menu_items( $items, $args ) {
	if ( 'primary' != $args->theme_location ) {
		return $items;
	}

	ob_start();
	?>
		<li class="menu-item menu-item-search">
			<a href><i class="fa fa-search"></i></a>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label>
					<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'eighties' ); ?></span>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'eighties' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
				</label>
			</form>
		</li>
	<?php
	$search = ob_get_clean();

	$items .= $search;

	return $items;
}
add_action( 'wp_nav_menu_items' , 'eighties_primary_menu_items', 100, 2 );

/**
 * Filter the excerpt length for archive, blog
 * and search.
 *
 * @param string $length The current length.
 * @return string $length The filterd length.
 */
function eighties_excerpt_length( $length ) {
	if ( is_home() || is_archive() || is_search() ) {
		return 45;
	} else {
		return $length;
	}
}
add_filter( 'excerpt_length', 'eighties_excerpt_length' );

/**
 * Filter the excerpt more for archive, blog
 * and search.
 *
 * @param string $more The current more text.
 * @return string $more The filterd more text.
 */
function eighties_excerpt_more( $more ) {
	if ( is_home() || is_archive() || is_search() ) {
		return '...';
	} else {
		return $more;
	}
}
add_filter( 'excerpt_more', 'eighties_excerpt_more' );

/**
 * Filter titles for items that do not have a title.
 *
 * The WordPress.org theme review requires that a link
 * be provided to the single post page for untitled posts.
 * This is a filter on 'the_title' so that an '(Untitled)'
 * title appears in that scenario, allowing for the normal
 * method to work.
 *
 * Borrowed from Hybrid Core by Justin Tadlock
 * https://github.com/justintadlock/hybrid-core
 *
 * @since  1.0.3
 * @access public
 * @param  param $title For the function.
 * @return string
 */
function eighties_untitled_post( $title ) {
	if ( is_admin() || is_singular() ) {
		return $title;
	}

	if ( empty( $title ) && in_the_loop() ) {
		$title = __( '(Untitled)', 'eighties' );
	}

	return $title;
}
add_filter( 'the_title', 'eighties_untitled_post' );
