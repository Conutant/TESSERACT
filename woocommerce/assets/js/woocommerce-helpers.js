(function($) {

	$( document ).ready( function() {
		$( document ).on( 'click', '.woocart-header .cart-contents', function( e ) {
			console.log($( window ).width());
			if ( $( window ).width() >= 768 ) {
				e.preventDefault();

				$( this ).toggle( function() {
					$( this ).find( '.cart-content-details-wrap' ).fadeIn();
				}, function() {
					$( this ).find( '.cart-content-details-wrap' ).fadeOut();
				});
			}
		});
	});
})(jQuery);