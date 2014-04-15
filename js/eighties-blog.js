/**
 * Eighties Blog & Archive JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	$( document ).on( 'click', '.js .hentry', function() {
		window.location.href = $( this ).find( '[rel="bookmark"]').first().attr( 'href' );
	});
} )( jQuery );