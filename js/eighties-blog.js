/**
 * Eighties Blog & Archive JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	/*
		FIXME This cause to many unexpected behaviors right now. Need to find a better way to implement or not use it at all.
	*/
	$( document ).on( 'click', '.js .hentry', function() {
		window.location.href = $( this ).find( '[rel="bookmark"]').first().attr( 'href' );
	});
} )( jQuery );