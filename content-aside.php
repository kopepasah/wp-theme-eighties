<?php
/**
 * Template for displaying content. This is the
 * default content tempalte.
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
