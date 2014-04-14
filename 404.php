<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( '404', 'eighties' ); ?></h1>
					<div class="taxonomy-description">
						<p><?php _e( 'Your request was not found.', 'eighties' ); ?></p>
					</div>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'Perhaps try a search?', 'eighties' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>