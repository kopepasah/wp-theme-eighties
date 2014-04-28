/**
 * Scripts for the custom header.
*/
(function( $ ) {
	$( '#masthead' ).backstretch( $( '#masthead .site-branding' ).data( 'backstretch' ) );

	skrollr.init();
}( jQuery ));