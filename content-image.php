<?php
/**
 * Template for displaying video content.
 * 
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'main-featured' ); ?></a>
		</figure>
	<?php endif; ?><!-- .entry-image -->

	<div class="entry-summary" <?php eighties_backstretch_data( get_the_ID() ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->