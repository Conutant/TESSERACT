(function($) {


	
	$(document).ready(function() {

		// Functions --------------------------------------------------------------------------------
		
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
		
		tesseract_watermark = function(){
			
			var isHeaderMenu = tesseract_vars.mobmenu_locToUse ? 'true' : 'false';
			
			//WATERMARK
			var watermark = 'Search …',
			watermarkable = ( isHeaderMenu == 'true' ) ? $('.search-field, .sidr-class-search-field') : $('.search-field');	
			//init, set watermark text and class
			$( watermarkable ).val(watermark).addClass('watermark');
			
			//if blur and no value inside, set watermark text and class again.
			$( watermarkable ).blur(function(){
				if ($(this).val().length == 0){
					$(this).val(watermark).addClass('watermark');
				}
			});
			
			//if focus and text is watermark, set it to empty and remove the watermark class
			$( watermarkable ).focus(function(){
				if ($(this).val() == watermark){
					$(this).val('').removeClass('watermark');
				}
			});	
			
		}		
		
		// EOF Functions --------------------------------------------------------------------------------
				
		/*
		 * Comment placeholders
		 * (Localized via wp_localize_script in functions file)
		 */
		$( '#author' ).attr( 'placeholder','Your Name' );
		$( '#email' ).attr( 'placeholder','E-mail' );
		$( '#url' ).attr( 'placeholder','Website' );
		$( '#comment' ).attr( 'placeholder','Your Comment' );	
				
		var isHeaderMenu = tesseract_vars.mobmenu_locToUse ? 'true' : 'false';			
				
		$(window).load(function() {
			
			//EOF additional classes					
			
			if( ( isHeaderMenu == 'true' ) && ( tesseract_vars.mobmenu_locToUse !== 'sidr-conflict' ) ) {				
			
				var mobmenu2def = ( tesseract_vars.mobmenu_toDefault == 1 ) ? true : false,
				mobmenuBase = tesseract_vars.mobmenu_locToUse,
				sidrSide = mobmenu2def ? 'right' : 'left';
				
				var sourceVal_type1 = '#site-navigation';
				if ( $('#site-banner-right > .woocart-header').siblings('*:not("script")').length )
					var sourceVal_type2 = '#site-navigation, #site-banner-right > *:not(".woocart-header")';
				else if ( !$('#site-banner-right > .woocart-header').siblings('*:not("script")').length ) {
					var sourceVal_type2 = '#site-navigation';
				};				
				var sourceVal_type3 = '#header-right-menu',
				sourceVal_type4 = '#header-right-menu, #site-navigation';
				
				if ( !mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#site-banner-right > *:not(".woocart-header")').length == 0 ) ) {
					var sourceVal = sourceVal_type1; 
				} else if ( mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) ) {
					
					if ( $(window).width() <= 768 ) {
						var sourceVal = sourceVal_type2,
						sidrSide = 'left';
					} else {
						var sourceVal = sourceVal_type1,
						sidrSide = 'right';	
					};
				
				} else if ( !mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#site-navigation').length == 0 ) ) {
					var sourceVal = sourceVal_type3; 
				} else if ( mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) ) {

					if ( $(window).width() <= 768 ) {
						var sourceVal = sourceVal_type4,
						sidrSide = 'left';
					} else {
						var sourceVal = sourceVal_type3,
						sidrSide = 'right';	
					};

				} else if ( !mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#site-banner-right > *:not(".woocart-header")').length > 0 ) ) {
					var sourceVal = sourceVal_type2;
				} else if ( !mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#site-navigation').length > 0 ) ) {
					var sourceVal = sourceVal_type4;
				}
				
				$('#mobile-menu-trigger, #mobile-menu-trigger-right').sidr({
					source: sourceVal,
					name: 'sidr-main',
					side: sidrSide,
					onOpen: function() {
						$('.sidr-inner').each(function() {
							if ( $(this).children('.sidr-class-nav-menu').length && $(this).prev().hasClass('sidr-inner') ) {
								$(this).addClass('second-menu-wrap');
							}
						})
						tesseract_watermark();																		
					}
				});					
				
			}
			
			tesseract_watermark();
			
			// EOF WATERMARK					
			
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
		
			var mobmenu2def = ( tesseract_vars.mobmenu_toDefault == 1 ) ? true : false,
			mobmenuBase = tesseract_vars.mobmenu_locToUse,
			sidrSide = mobmenu2def ? 'right' : 'left';	
									
			var sourceVal_type1 = '#site-navigation';
			if ( $('#site-banner-right > .woocart-header').siblings('*:not("script")').length )
				var sourceVal_type2 = '#site-navigation, #site-banner-right > *:not(".woocart-header")';
			else if ( !$('#site-banner-right > .woocart-header').siblings('*:not("script")').length ) {
				var sourceVal_type2 = '#site-navigation';
			};				
			var sourceVal_type3 = '#header-right-menu',
			sourceVal_type4 = '#header-right-menu, #site-navigation';
			
			if ( $(window).width() <= 768 ) {								

				if ( mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#sidr-main.right').length ) ) var sourceVal = sourceVal_type2;
				if ( mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#sidr-main.right').length ) ) var sourceVal = sourceVal_type4;			

				if ( ( mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#sidr-main.right').length ) ) ||
				( mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#sidr-main.right').length ) ) ) {
					
					$('#mobile-menu-trigger').sidr({
						source: sourceVal,
						name: 'sidr-main',
						side: 'left',
						onOpen: function() {
							$('.sidr-inner').each(function() {
								if ( $(this).children('.sidr-class-nav-menu').length && $(this).prev().hasClass('sidr-inner') ) {
									$(this).addClass('second-menu-wrap');
								}
							})	
							tesseract_watermark();					
						}						
					});													
				
				}
				
				$('.tesseract-featured .entry-title').fitText(1, { maxFontSize: '75px' });
				$('.featured-widget h1').fitText(1, { maxFontSize: '100px' });
				$('.headline-resize').fitText(1, { maxFontSize: '100px' });						
			
			} else {

				if ( $('#sidr-main').is(':visible') ) {
					$.sidr('close', 'sidr-main');
				}	

				if ( mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#sidr-main.left').length ) ) var sourceVal = sourceVal_type1
				if ( mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#sidr-main.left').length ) ) var sourceVal = sourceVal_type3
				
				if ( ( mobmenu2def && ( mobmenuBase == 'leftmenu-to-sidr' ) && ( $('#sidr-main.left').length ) ) ||
				( mobmenu2def && ( mobmenuBase == 'rightmenu-to-sidr' ) && ( $('#sidr-main.left').length ) ) ) {
					
					$.sidr('close', 'sidr-main');
					$('#sidr-main.left').remove();
					
					$('#mobile-menu-trigger-right').sidr({
						source: sourceVal,
						name: 'sidr-main',
						side: 'right',
						onOpen: function() {
							$('.sidr-inner').each(function() {
								if ( $(this).children('.sidr-class-nav-menu').length && $(this).prev().hasClass('sidr-inner') ) {
									$(this).addClass('second-menu-wrap');
								}
							})		
							tesseract_watermark();				
						}						
					});
					
				}			
								
			}
			
		});	
				
	});
})(jQuery);