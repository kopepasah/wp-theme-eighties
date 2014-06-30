<?php
/**
 * Template for displaying portfolio content.
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="project-details">
		<figure class="project-image" <?php eighties_backstretch_data( get_the_ID() ); ?>>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'portfolio-featured' ); ?></a>
		</figure>
		<div class="project-summary">
			<?php the_title( '<h2 class="project-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<div class="project-entry-meta">', _x(', ', 'Used between list items, there is a space after the comma.', 'eighties' ), '</div>' ); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->