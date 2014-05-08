/**
 * Scripts for the custom header.
*/
(function( $ ) {
	$( '#masthead' ).backstretch( $( '#masthead .screen-reader-text' ).data( 'backstretch' ) );

	// Initiate skrollr, but not on mobile devices.
	if ( ! eighties_is_mobile.any() ) {
		skrollr.init({
			forceHeight: false
		});
	}
}( jQuery ));