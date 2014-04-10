<?php
/**
 * The Footer Sidebar
 *
 * @package Listed
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'eighties-footer' ) ) {
	return;
}
?>

<section id="site-supplementary">
	<div class="footer-sidebar section-container widget-area column-wrapper" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
</section>
