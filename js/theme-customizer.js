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

			$( 'aside.featured-widget h1.widget-title' ).eq(0).css('font-size',to+'px' );
		} );
	} );

	//Featured Headline Dropshadow
	wp.customize( 'featured_text_hasshadow', function( value ) {
		value.bind( function( to ) {

			if(to==1)
				$( 'aside.featured-widget h1.widget-title' ).eq(0).css('text-shadow','rgba(81, 81, 81, 0.8) 1px 1px 1px');
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
				$( 'aside.featured-widget div.textwidget p' ).eq(0).css('text-shadow','rgba(81, 81, 81, 0.8) 1px 1px 1px');
			else
				$( 'aside.featured-widget div.textwidget p' ).eq(0).css('text-shadow','none');
		} );

	} );
	//action buttons
	wp.customize( 'feactured_action_button', function( value ) {
		value.bind( function( to ) {
				$( 'aside.featured-widget div.textwidget div#action_buttons').html(to);

		} );
	} );
	/**
	 * Logo
	 */


	wp.customize( 'theme_logo', function( value ) {
		value.bind( function( to ) {
			var html = '<div class="site-logo"><img src="'+to+'"/></h1>';
			$( '.site-banner .site-branding' ).eq(0).html(html);
		} );
	} );
	//Logo Ends

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

	//navigation action buttons
	//action buttons
	wp.customize( 'navigation-widget', function( value ) {
		value.bind( function( to ) {

			$('ul#menu-top-menu').find('[id=navigation-widget]').html(to);
		} );
	} );
	//footer navigation widget
	//action buttons
	wp.customize( 'footer-navigation-widget', function( value ) {
		value.bind( function( to ) {

			$('ul#menu-footer-menu').find('[id=footer-navigation-widget]').html(to);

		} );
	} );
	/**
	 * Navigation Ends
	 */

} )( jQuery );