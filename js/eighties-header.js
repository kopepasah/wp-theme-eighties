/**
 * Scripts for the custom header.
*/
(function( $ ) {
	$( '#masthead' ).backstretch( $( '#masthead .screen-reader-text' ).data( 'backstretch' ) );

	skrollr.init();
}( jQuery ));