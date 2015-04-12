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
		
		$('.headline-resize').fitText(0.6, { maxFontSize: '100px' });	
				
		$(window).load(function() {						
			
			equalheight('#sidebar-footer aside');
		
			if ( $(window).width() <= 620 ) {
				$('.tesseract-featured .entry-title, .featured-widget h1').fitText(0.6);
			} 
			
			if ( $(window).height() > $('#page').height() ) {
				
				var wheight = $(window).height(),
				hheight = parseInt( $('#masthead').not('.pos-absolute').height() ),
				fheight = parseInt( $('#colophon').height() );
				
				if ( $('body').hasClass('zero-opacity-header') ) {
					var offset = parseInt( wheight - fheight );
				} else {
					var offset = parseInt( wheight - ( hheight + fheight ) );	
				}
				
				// ]if ( self == top )[ = if content is sitting in an iframe 
				if ( ( $('body').hasClass('logged-in') ) && ( self == top ) ) {
					var offsetFinal = ( $(window).width() > 782 ) ? ( offset-32 ) : ( offset-46 ); 
				} else {
					var offsetFinal = offset;	
				}
				
				if ( $('#content').height() < offsetFinal ) {
					$('#content').animate({
						'height': offsetFinal
					}, 500 )
				}
					
			}		
		
		});
				
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