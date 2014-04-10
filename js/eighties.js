/**
 * Eighties JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	
	/**
	 * Set up the main navigation toggle. This sets
	 * up a toggle for navitaion on left side of
	 * the window.
	*/
	$( '.main-navigation-toggle' ).on( 'click', function( event ) {
		event.preventDefault();

		$( 'body' ).toggleClass( 'main-navigation-open' );

		if ( $( 'body' ).hasClass( 'main-navigation-open' ) ) {
			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				$( 'body' ).height( $( window ).height() - 32 );
			} else {
				$( 'body' ).height( $( window ).height() );
			}
		} else {
			$( 'body' ).height( 'auto' );
		}
	}).bigSlide({
		menu: '#site-navigation',
		push: '#page',
		menuWidth: '250px',
	});

	/**
	 * If we've made it this far, JavaScript is working.
	 * We should set the main navigation css to display
	 * block. Don't worry, if JavaScript is not working
	 * the menu is handled a bit differently, as the
	 * toggle functionality would not work anyway.
	*/
	$( '.main-navigation' ).css( 'display', 'block' );
} )( jQuery );