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

	<div class="entry-summary">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<?php the_tags( '<footer class="entry-footer"><div class="entry-meta entry-meta-tags">', ' ', '</div></footer><!-- .entry-footer -->' ); ?>
	<?php endif; ?>
</article><!-- #post-## -->
