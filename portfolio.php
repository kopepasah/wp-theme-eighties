<?php
/**
 * Template Name: Portfolio
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				<?php
					/**
					 * Since this is the portfolio template, we should
					 * display some projects. We use get posts here,
					 * because we are only retreving a set amount of
					 * projects.
					*/
					$args = array(
						'post_type'      => 'jetpack-portfolio',
						'posts_per_page' => 12,
					);

					$portfolio = get_posts( $args );

					?>
						<div id="portfolio-wrapper">
							<?php foreach ( $portfolio as $post ) : setup_postdata( $post ); ?>
								<?php get_template_part( 'content', 'portfolio' ); ?>
							<?php endforeach; ?>
						</div>
					<?php

					wp_reset_postdata();
				?>

				<nav class="navigation paging-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php _e( 'Porfolio page.', 'eighties' ); ?></h1>
					<div class="nav-links">
						<a href="<?php echo get_post_type_archive_link( 'jetpack-portfolio' ); ?>" class="btn"><?php _e( 'View Portfolio', 'eighties' ); ?></a>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->

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
