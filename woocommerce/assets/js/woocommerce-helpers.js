    (function($) {
		
		var smallToggle = function() {
			if ( $(window).width() < 768 ) {
				$('.woocart-header').each(function() {
					$(this).unbind().children('.cart-contents').click(function(e) {
						e.preventDefault();	
					});	

					$(this).toggle(function() {
					  	$( this ).children( '.cart-content-details-wrap' ).fadeIn();
					}, function() {
					  	$( this ).children( '.cart-content-details-wrap' ).fadeOut();
					});					
				})
			}
		};		
        
        $(document).ready(function() {
        
            $('.woocart-header').each(function() {
                
                $(this).on({
                    mouseenter: function() {
                        $( this ).find( '.cart-content-details-wrap' ).fadeIn();
                    }, mouseleave: function() {
                        $( this ).find( '.cart-content-details-wrap' ).fadeOut();
                    }
                });
            
            })
			
			smallToggle();
        
        })
		
		$(window).resize(function() {
		
			smallToggle();
		
		})
    
    })(jQuery);