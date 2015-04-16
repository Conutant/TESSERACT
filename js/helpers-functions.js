(function($) {
	
		// Equal height blocks
		// See @ http://css-tricks.com/equal-height-blocks-in-rows/
		
		equalheight = function(container){
		
			var currentTallest = 0,
				 currentRowStart = 0,
				 rowDivs = new Array(),
				 $el,
				 topPosition = 0;
			 $(container).each(function() {
			
			   $el = $(this);
			   $($el).height('auto')
			   topPostion = $el.position().top;
			
			   if (currentRowStart != topPostion) {
				 for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				   rowDivs[currentDiv].height(currentTallest);
				 }
				 rowDivs.length = 0; // empty the array
				 currentRowStart = topPostion;
				 currentTallest = $el.height();
				 rowDivs.push($el);
			   } else {
				 rowDivs.push($el);
				 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			  }
			   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				 rowDivs[currentDiv].height(currentTallest);
			   }
			 });
		} //EOF function equalheight
		
		mobMenu = function() {
			
			if ( $(window).width() <= 620 ) {
			
				$('.menu-open, .menu-close').remove();
				
				$('#page').prepend( '<span class="menu-open dashicons dashicons-menu"></span><span class="menu-close dashicons dashicons-no"></span>' );
				
				if ( $('#masthead').hasClass('is-right') ) {
					$('#page > .dashicons').addClass('is-right');	
				}
				
				if ( $('#masthead').hasClass('no-right') && $('#masthead').hasClass('is-woo') ) {
					$('#page > .dashicons').addClass('no-right is-woo');	
				}
					
				$('#mobile-navigation').attr('id', 'mobile-navigation-jquery');
				$('.menu-open').attr('href', '#mobile-navigation-jquery').on( 'click', function() { 
					
					$(this).hide();
					$('.menu-close').show();
					
					$('#mobile-navigation-jquery').addClass('target').animate({
						'width': '40%'	
					}, 150);
					
					$('#mobile-navigation-jquery > div > ul').fadeIn();
					
					$('#page').animate({
						'width': '60%'	
					}, 300, function () {
						
						$('#page').click(function() {				
							$('.menu-close').hide();
							$('.menu-open').show();
							
							$('#mobile-navigation-jquery').removeClass('target').animate({
								'width': '0'	
							}, 150);
							
							$('#mobile-navigation-jquery > div > ul').fadeOut();
							
							$('#page').animate({
								'width': '100%'	
							}, 150);	
						})
						
						$(".menu-open").click(function(e) {
							e.stopPropagation();
							return false;
						})
						
					});			
			
				});	
			
				$('.menu-close').attr('href', '#mobile-navigation-jquery').on( 'click', function() {
	
					$(this).hide();
					$('.menu-open').show();
					
					$('#mobile-navigation-jquery').removeClass('target').animate({
						'width': '0'	
					}, 150);
					
					$('#mobile-navigation-jquery > div > ul').fadeOut();
					
					$('#page').animate({
						'width': '100%'	
					}, 150);	
				
				});
				
			} else {
				
				$('.menu-open, .menu-close').hide();
			
			}
		
		} // EOF function mobMenu		
			

})(jQuery);