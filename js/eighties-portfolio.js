/**
 * Eighties Blog & Archive JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	// Custom event for loading when using infinite scroll.
	$( document.body ).on( 'post-load', function() {
		$( '#portfolio-wrapper' ).find( '.infinite-loader' ).remove();
	});
} )( jQuery );