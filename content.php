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
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="entry-meta entry-meta-time">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="fa fa-clock-o"></i><?php echo eighties_get_time_difference( get_the_date( 'Y-m-d H:i:s' ) ); ?></a>
		<p>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'large' ); ?></a>
		</figure>
	<?php endif; ?><!-- .entry-image -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
