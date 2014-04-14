<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Eighties
 * @author Justin Kopepasah
 * @since 1.0.0
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.com/', 'eighties' ) ); ?>"><?php printf( __( 'Blog at %s', 'eighties' ), 'WordPress.com' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'eighties' ), 'Eighties', '<a href="http://kopepasah.com/" rel="designer">Kopepasah</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
