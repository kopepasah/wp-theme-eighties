<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( in_array( get_post_format(), array( 'aside', 'status', 'link', 'video', 'audio' ) ) ) : ?>
				<?php get_template_part( 'content',  get_post_format() ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'single' ); ?>
			<?php endif; ?>

			<?php eighties_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>