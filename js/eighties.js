/**
 * Eighties JavaScript
 *
 * The main JavaScript file for Eighties. Sets up
 * the navigation and sidebar toggles.
*/
( function( $ ) {
	/**
	 * Register fitvids with a custom selector.
	 * Possibly add more selectors later, if needed.
	*/
	$( 'body' ).fitVids({
		customSelector: "iframe[src*='rd.io'], iframe[src*='rdio.com']",
	});

	/**
	 * If we've made it this far, JavaScript is working.
	 * We should set the main navigation css to display
	 * block. Don't worry, if JavaScript is not working
	 * the menu is handled a bit differently, as the
	 * toggle functionality would not work anyway.
	*/
	$( '#site-navigation, #secondary' ).css( 'display', 'block' );

	/**
	 * Set up the main navigation toggle. This sets
	 * up a toggle for navitaion to overlay the window.
	*/
	$( '.main-navigation-toggle, #mobile-menu-close' ).on( 'click', function( event ) {
		event.preventDefault();

		$( 'html' ).toggleClass( 'disable-scroll' );
		$( 'body' ).toggleClass( 'main-navigation-open' );
	});

	/**
	 * Set up the widget area toggle. This sets
	 * up a toggle for sidebar to overlay the window.
	*/
	$( '.widget-area-toggle' ).on( 'click', function( event ) {
		event.preventDefault();

		$( 'html' ).toggleClass( 'disable-scroll' );
		$( 'body' ).toggleClass( 'widget-area-open' );
	});

	/**
	 * Closes the main navigation or sidebar when
	 * the esc key is pressed.
	*/
	$( document ).keyup( function( event ) {
		if ( event.keyCode == 27 ) {
			if ( $( 'body' ).hasClass( 'main-navigation-open' ) ) {
				$( 'html' ).removeClass( 'disable-scroll' );
				$( 'body' ).removeClass( 'main-navigation-open' );
			} else if ( $( 'body' ).hasClass( 'widget-area-open' ) ) {
				$( 'html' ).removeClass( 'disable-scroll' );
				$( 'body' ).removeClass( 'widget-area-open' );
			}
		}
	});
} )( jQuery );