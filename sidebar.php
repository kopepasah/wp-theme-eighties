<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package eighties
 */

if ( ! is_active_sidebar( 'eighties-interactive-sidebar' ) ) {
	return;
}
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'eighties-interactive-sidebar' ); ?>
	</div><!-- #secondary -->
