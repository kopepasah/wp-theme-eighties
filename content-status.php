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
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-image" <?php eighties_backstretch_data( get_the_ID() ); ?>>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'large' ); ?></a>
		</figure>
	<?php endif; ?><!-- .entry-image -->

	<div class="entry-summary" <?php eighties_backstretch_data( get_the_ID() ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<p class="entry-meta entry-meta-time">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="fa fa-clock-o"></i><?php echo eighties_get_time_difference( get_the_date( 'Y-m-d H:i:s' ) ); ?></a>
	</p>
</article><!-- #post-## -->
