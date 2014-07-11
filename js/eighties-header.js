/**
 * Scripts for the custom header.
*/
(function( $ ) {
	// Set backstretch, because it's more browser friendly for setting a background image.
	$( '#masthead' ).backstretch( $( '#masthead .screen-reader-text' ).data( 'backstretch' ) );

	// Set the height of the masthead. We use this height below.
	$( '#masthead' ).data( 'height', $( '#masthead' ).outerHeight() );

	$( window ).scroll( function( event ) {

		if ( $( window ).width() > 800 ) {
			var position = window.scrollY,
				bottom   = window.innerHeight - document.getElementById( 'colophon' ).offsetHeight,
				height   = $( '#masthead' ).data( 'height' ),
				content  = $( '#content' ).offset().top,
				footer   = $( '#colophon' ).offset().top - position;

			if ( position > 0 && content > position && footer > bottom ) {
				if ( position < height ) {
					$( '#masthead' ).css({
						'height' : height - position + 'px',
						'overflow' : 'hidden'
					});

					$( '.site-branding' ).css({
						'opacity' : ( 1 - position / height * 2 )
					});
				} else {
					$( '#masthead' ).css({
						'height' : '0px'
					});
				}
			} else if ( position <= 0 ) {
				$( '#masthead' ).css({
					'height' : height
				});

				$( '.site-branding' ).css({
					'opacity' : 1
				});
			}

		} else {
			$( '#masthead' ).css({
				'height' : height + "px",
			});

			$( '.site-branding' ).css({
				'opacity' : 1
			});
        }
    });

}( jQuery ));