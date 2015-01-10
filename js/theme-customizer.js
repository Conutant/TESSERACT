/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	/**
	 * Featured Options
	 */
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
			console.log('reflect: ' +to);
			$( 'aside.featured-widget h1.widget-title' ).eq(0).css('font-size',to+'px' );
		} );
	} );

	//Featured Headline Dropshadow
	wp.customize( 'featured_text_hasshadow', function( value ) {
		value.bind( function( to ) {
			console.log(to);
			if(to==1)
				$( 'aside.featured-widget h1.widget-title' ).eq(0).css('text-shadow','5px 3px 3px rgba(150, 150, 150, 0.79)');
			else
				$( 'aside.featured-widget h1.widget-title' ).eq(0).css('text-shadow','none');
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

	//Featured Sub Headline Dropshadow
	wp.customize( 'featured_subheadline_hasshadow', function( value ) {
		value.bind( function( to ) {
			if(to==1)
				$( 'aside.featured-widget div.textwidget p' ).eq(0).css('text-shadow','5px 3px 3px rgba(150, 150, 150, 0.79)');
			else
				$( 'aside.featured-widget div.textwidget p' ).eq(0).css('text-shadow','none');
		} );

	} );
	//action buttons
	wp.customize( 'xxxxxxxxxxxxxxxx', function( value ) {
		value.bind( function( to ) {
				alert('FFFF');
				$( 'aside.featured-widget div.textwidget div#action_buttons').eq(0).html('xxxxxxxxxxx');// #action_buttons' ).html(to);

		} );
	} );


	/**
	 * Featured Option Ends
	 */

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
			$( '.site-banner' ).css('background-color',to);
		} );
	} );
	/**
	 * Navigation Ends
	 */

} )( jQuery );