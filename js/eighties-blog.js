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
	// $( document ).on( 'click', '.js .hentry', function() {
	// 	window.location.href = $( this ).find( '[rel="bookmark"]').first().attr( 'href' );
	// });

	$( '.hentry' ).each( function( index, element ) {
		var id = '#' + element.id;

		if ( $( id ).hasClass( 'has-post-thumbnail' ) ) {
			$( id ).backstretch( $( id + ' .entry-summary' ).data( 'backstretch' ) );
		}
	});

	// Custom event for loading fitvids when using infinite scroll.
	$( document.body ).on( 'post-load', function() {
		$( '.hentry' ).each( function( index, element ) {
			var id = '#' + element.id;

			if ( $( id ).hasClass( 'has-post-thumbnail' ) ) {
				$( id ).backstretch( $( id + ' .entry-summary' ).data( 'backstretch' ) );
			}
		});
	});
} )( jQuery );