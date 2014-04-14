/**
 * Eighties Blog & Archive JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	$( '.js .hentry' ).on( 'click', function() {
		window.location.href = $( this ).find( '[rel="bookmark"]').first().attr( 'href' );
	});
} )( jQuery );