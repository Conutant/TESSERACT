(function($) {
	var smallToggle = function() {
		if ( $( window ).width() < 768 ) {
			$( '.woocart-header' ).each( function() {
				$( this ).unbind();
			});
		}
		else {
			$( '.woocart-header, .cart-contents' ).unbind();
			$( '.woocart-header' ).each( function() {
				$( this ).on({
					mouseenter: function() {
						$( this ).find( '.cart-content-details-wrap' ).stop().fadeIn();
					}, mouseleave: function() {
						$( this ).find( '.cart-content-details-wrap' ).stop().fadeOut();
					}
				});
			});
		}
	};

	$( document ).ready( function() {
		smallToggle();
	});

	$( window ).resize( function() {
		smallToggle();
	});
})(jQuery);
