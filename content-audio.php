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
		<?php if ( is_single() ) : ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'eighties' ) );
				if ( $categories_list && eighties_categorized_blog() ) :
			?>
				<div class="entry-meta entry-meta-categories"><?php echo $categories_list; ?></div>
			<?php endif; ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php else : ?>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_single() ) : ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<p class="entry-meta entry-meta-time">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="fa fa-clock-o"></i><?php echo eighties_get_time_difference( get_the_date( 'Y-m-d H:i:s' ) ); ?></a>
			</p>
		</div><!-- .entry-content -->

		<?php the_tags( '<footer class="entry-footer"><div class="entry-meta entry-meta-tags">', ' ', '</div></footer><!-- .entry-footer -->' ); ?>
	<?php else : ?>
		<figure class="entry-audio">
			<?php eighties_post_format_audio_first_audio( get_the_ID() ); ?>
		</figure><!-- .entry-audio -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php endif; ?>
</article><!-- #post-## -->