<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'eighties-interactive-sidebar' ) ) {
	return;
}
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'eighties-interactive-sidebar' ); ?>
	</div><!-- #secondary -->
