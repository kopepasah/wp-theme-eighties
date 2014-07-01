<?php
/**
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( get_theme_mod( 'eighties_singular_header_image' ) !== 'featured_image' && has_post_thumbnail() ) : ?>
		<figure class="entry-image">
			<?php the_post_thumbnail( 'main-featured' ); ?>
		</figure><!-- .entry-image -->
	<?php endif; ?>

	<header class="entry-header">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', false, ', ', false );
			if ( $categories_list ) :
		?>
			<span class="entry-meta entry-meta-categories"><?php echo $categories_list; ?></span>
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'eighties' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta entry-meta-tags">
			<?php echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', false, false, false ) ?>
		</div>
	</footer>
</article><!-- #post-## -->
