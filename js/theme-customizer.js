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
	//Featured headline Font color
	wp.customize( 'featured_textcolor', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget h1.widget-title' ).eq(0).css('color',to );
		} );
	} );
	//Featured headline Font size
	wp.customize( 'featured_text_fontsize', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget h1.widget-title' ).eq(0).css('font-size',to+'px' );
		} );
	} );
	// Featured Sub Headline
	wp.customize( 'featured_subheadline_text', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget div.textwidget p' ).eq(0).text( to );
		} );
	} );
	//Featured Sub headline Font color
	wp.customize( 'featured_subheadline_textcolor', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget div.textwidget p' ).eq(0).css('color', to );
		} );
	} );
	//Featured sub headline Font size
	wp.customize( 'featured_subheadline_fontsize', function( value ) {
		value.bind( function( to ) {
			$( 'aside.featured-widget div.textwidget p' ).eq(0).css('font-size',to+'px' );
		} );
	} );


	/**
	 * Navigation Menu Customization
	 */
	//menu text color
	wp.customize( 'menu_link_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a' ).css('color',to);
		} );
	} );

	//menu link hover color
	wp.customize( 'menu_link_hovercolor', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a:hover' ).css('color',to);
		} );
	} );

	//menu background color
	wp.customize( 'menu_link_bgcolor', function( value ) {

		value.bind( function( to ) {
			//console.log($('li#accordion-section-tesseract_navigation_options ul.accordion-section-content li#customize-control-tesseract_menu_link_bgopacity label select').val());
			$( '.site-banner' ).css('background-color',to);
		} );
	} );

} )( jQuery );