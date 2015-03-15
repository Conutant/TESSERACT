(function($) {
	
	$(document).ready(function() {
		/*
		 * Comment placeholders
		 * (Localized via wp_localize_script in functions file)
		 */
		$( '#author' ).attr( 'placeholder','Your Name' );
		$( '#email' ).attr( 'placeholder','E-mail' );
		$( '#url' ).attr( 'placeholder','Website' );
		$( '#comment' ).attr( 'placeholder','Your Comment' );
		
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
		}
		
		mobMenu = function() {
			
			if ( $(window).width() <= 620 ) {
			
				$('.menu-open, .menu-close').remove();
				
				$('#page').prepend( '<span class="menu-open dashicons dashicons-menu"></span><span class="menu-close dashicons dashicons-no"></span>' );
					
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
		
		}		
		
		$(window).load(function() {			
			
			equalheight('#sidebar-footer aside');
		
			if ( $(window).width() <= 620 ) {
				$('.tesseract-featured .entry-title, .featured-widget h1').fitText(0.6);
			} 
			
			if ( $(window).height() > $('#page').height() ) {
				
				var wheight = $(window).height(),
				hheight = parseInt( $('#masthead').height() ),
				fheight = parseInt( $('#colophon').height() ),
				offset = parseInt( wheight - ( hheight + fheight ) );					
				
				if ( $('body').hasClass('logged-in') ) {
					var offsetFinal = ( $(window).width() > 782 ) ? ( offset-32 ) : ( offset-46 ); 
				} else {
					var offsetFinal = offset;	
				}
				
				if ( $('#page').height() < offsetFinal ) {
					$('#content').animate({
						'height': offsetFinal
					}, 500 )
				}
					
			}		
		
		});

		$('.headline-resize').fitText(0.6, { maxFontSize: '100px' });	
		
		
		$(window).resize(function(){
		
		 	equalheight('#sidebar-footer aside');
			mobMenu();	
			
			if ( $(window).width() <= 620 ) {
				$('.tesseract-featured .entry-title').fitText(0.6, { maxFontSize: '75px' });
				$('.featured-widget h1').fitText(0.6, { maxFontSize: '100px' });
				$('.headline-resize').fitText(0.6, { maxFontSize: '100px' });		
			}
			
		});	
				
	});
})(jQuery);
