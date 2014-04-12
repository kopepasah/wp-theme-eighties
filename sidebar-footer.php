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
	<div id="site-supplementary" class="widget-area column-wrapper" role="complementary">
		<?php dynamic_sidebar( 'eighties-footer' ); ?>
	</div><!-- #site-supplementary -->