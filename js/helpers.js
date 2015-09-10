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

		var sourceVal = ( $('#site-banner-right > *:not(script):not(.woocart-header)').length > 0 ) ? '#site-navigation, #site-banner-right > *:not(script):not(.woocart-header)' : '#site-navigation';

		$('#mobile-menu-trigger').sidr({
			source: sourceVal,
			name: 'sidr-main'
		});

		$(window).load(function() {
			// WATERMARK
			var watermark = 'Search …';

			//init, set watermark text and class
			$('.search-field, .sidr-class-search-field').val(watermark).addClass('watermark');

			//if blur and no value inside, set watermark text and class again.
			$('.search-field, .sidr-class-search-field').blur(function(){
				if ($(this).val().length == 0){
					$(this).val(watermark).addClass('watermark');
				}
			});

			//if focus and text is watermrk, set it to empty and remove the watermark class
			$('.search-field, .sidr-class-search-field').focus(function(){
				if ($(this).val() == watermark){
					$(this).val('').removeClass('watermark');
				}
			});
			// EOF WATERMARK

			// ]if ( self == top )[ = if content is sitting in an iframe
			if ( $('#site-navigation').hasClass('showit') && ( self !== top ) ) {

				$.sidr('open', 'sidr-main');

			}

			equalheight('#sidebar-footer aside');

			if ( $(window).width() <= 768 ) {
				$('.tesseract-featured .entry-title').fitText(1, { maxFontSize: '75px' });
				$('.featured-widget h1').fitText(1, { maxFontSize: '100px' });
				$('.headline-resize').fitText(1, { maxFontSize: '100px' });
			}

			if ( $(window).height() > $('#page').height() ) {

				var wheight = $(window).height(),
				hheight = parseInt( $('#masthead').not('.pos-absolute').height() ),
				fheight = parseInt( $('#colophon').height() );

				hpad = tesseract_vars.hpad ? tesseract_vars.hpad : 10;
				fpad = tesseract_vars.fpad ? tesseract_vars.fpad : 10;

				if ( $('body').hasClass('transparent-header') ) {
					var offset = parseInt( wheight - ( fheight + 2*fpad ) );
				} else {
					var offset = parseInt( wheight - ( (hheight + 2*hpad) + (fheight + 2*fpad) ) );
				}

				// ]if ( self !== top )[ = if content is sitting in an iframe
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

			if ( $(window).width() <= 768 ) {
				$('.tesseract-featured .entry-title').fitText(1, { maxFontSize: '75px' });
				$('.featured-widget h1').fitText(1, { maxFontSize: '100px' });
				$('.headline-resize').fitText(1, { maxFontSize: '100px' });
			}

		});

	});
})(jQuery);