/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Featured Headline
	wp.customize( 'featured_text', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget h1.widget-title' ).eq(0).text( to );
		} );
	} );


} )( jQuery );