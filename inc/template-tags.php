<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

if ( ! function_exists( 'eighties_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function eighties_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'eighties' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'eighties' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eighties' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'eighties_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function eighties_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'eighties' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'eighties' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'eighties' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'eighties_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function eighties_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'eighties' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function eighties_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'eighties_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'eighties_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so eighties_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so eighties_categorized_blog should return false.
		return false;
	}
}

/**
 * Return a time difference of a given time in
 * days, hours or minutes depending on the time
 * difference.
 *
 * @since 1.0.0
 *
 * @param $time (required)
*/
function eighties_get_time_difference( $time ) {
	$current_time = new DateTime( current_time( 'mysql' ) );
	$previous_time = new DateTime( $time );
	$difference = $current_time->diff( $previous_time );
	$timestamp = '';

	if ( 0 < $difference->y ) {
		/**
		 * If we've passed one year, let's show the full
		 * date.
		*/
		 $timestamp = get_the_date( 'F j, Y' );
	} else if ( 12 >= $difference->m && 1 <= $difference->m ) {
		/**
		 * If we've made it here, we know that we have not
		 * yet passed one year, but have made it passed one
		 * month. As such, let's remove the year from the 
		 * output, but keep the date style format.
		*/
		$timestamp .= get_the_date( 'F j' );
	} else if ( 0 < $difference->d ) {
		/**
		 * If we've made it here, we know that we have not
		 * yet passed one month, but have made it passed one
		 * day. As such, let's show just the number of days
		 * that have passed.
		*/
		$timestamp .= sprintf( translate_nooped_plural( _n_noop( '%s Day Ago', '%s Days Ago' ), $difference->days ), $difference->days );
	} else if ( 0 < $difference->h ) {
		/**
		 * If we've made it here, we know that we have not
		 * yet passed one day, but have made it passed one
		 * hour. As such, let's show just the number of hours
		 * that have passed.
		*/
		$timestamp .= sprintf( translate_nooped_plural( _n_noop( '%s Hour Ago', '%s Hours Ago', 'listed' ), $difference->h, 'listed' ), $difference->h );
	} else if ( 0 < $difference->i ) {
		/**
		 * If we've made it here, we know that we have not
		 * yet passed one hour, but have made it passed one
		 * minute. As such, let's show just the number of
		 * minutes that have passed.
		*/
		$timestamp .= sprintf( translate_nooped_plural( _n_noop( '%s Minute Ago', '%s Minutes Ago', 'listed' ), $difference->i, 'listed' ), $difference->i );
	} else {
		/**
		 * If we've made it here, that this post is fresh
		 * off the press. Let's show how fresh it is.
		*/
		$timestamp = __( 'Just now', 'listed' );
	}

	return $timestamp;
}

/**
 * Flush out the transients used in eighties_categorized_blog.
 */
function eighties_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'eighties_categories' );
}
add_action( 'edit_category', 'eighties_category_transient_flusher' );
add_action( 'save_post',     'eighties_category_transient_flusher' );
