/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	
	$('#content').unbind('load');	
	
	function hexToRgb(hex) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
	}	
	
	HTMLElement.prototype.alpha = function(a) {
		current_color = getComputedStyle(this).getPropertyValue("background-color");
		match = /rgba?\((\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*(,\s*\d+[\.\d+]*)*\)/g.exec(current_color)
		a = a > 1 ? (a / 100) : a;
		this.style.backgroundColor = "rgba(" + [match[1],match[2],match[3],a].join(',') +")";
	}		
	
	wp.customize( 'tesseract_tho_header_colors_bck_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css('background-color', to);
		} );
	} );
	
	wp.customize('tesseract_tho_header_colors_bck_color_opacity', function(value){ 									
		value.bind(function( to ){ 	
						
			var bg = $('.site-header').css('background-color');
			if (bg.indexOf('a') == -1){
				var result = bg.replace(')', ', ' + to/100 + ')').replace('rgb', 'rgba');
			} else if( bg.indexOf('a') > 0 ) {
				
				var colorString = bg,
					colorsOnly = colorString.substring(colorString.indexOf('(') + 1, colorString.lastIndexOf(')')).split(/,\s*/),
					red = colorsOnly[0],
					green = colorsOnly[1],
					blue = colorsOnly[2],
					opacity = colorsOnly[3];
					
				var result = $('.site-header').css('background-color', 'rgba(' + colorsOnly[0] + ', ' + colorsOnly[1] + ', ' + colorsOnly[2] + ', ' + to/100 + ')');				
			}
			$('.site-header').css( 'background-color', result);
			
			if ( ( $('body.home').length > 0 ) && ( to < 100 ) ) {
				$('#masthead').css({
					position: 'absolute',
					top: 0,
					left: 0	
				});	
			} else {
				$('#masthead').css({
					position: 'relative',
					top: 'auto',
					left: 'auto'							
				});	
			}
								
		});
	});		
	
	wp.customize( 'tesseract_tho_header_colors_text_color', function( value ) {
		value.bind( function( to ) {				
			$( '.site-header, .site-header h1, .site-header h2, .site-header h3, .site-header h4, .site-header h5, .site-header h6' ).css('color', to);				
		} );
	} );	
	
	wp.customize( 'tesseract_tho_header_colors_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header a, .main-navigation ul ul a' ).not('a.button').css('color', to);		
		} );
	} );
	
	wp.customize( 'tesseract_tho_header_colors_link_hover_color', function( value ) {
		value.bind( function( to ) {
			var origColor = $( '.site-header a' ).css('color');
			$( '.site-header a' ).not('.a.button').hover(
				function() {
					$(this).css('color', to);
				}, function() {
					$(this).css('color', origColor);					
				}
			)							
		} );
	} );
	
	wp.customize( 'tesseract_tho_header_content_if_button', function( value ) {
		value.bind( function( to ) {
			$( '#header-button-container' ).html(to);		
		} );
	} );		
			
	wp.customize( 'tesseract_tfo_footer_colors_bck_color', function( value ) {
		value.bind( function( to ) {
			$( '#colophon' ).css('background-color', to);
		} );
	} );
	
	wp.customize( 'tesseract_tfo_footer_colors_text_color', function( value ) {
		value.bind( function( to ) {				
			$( '#colophon' ).css('color', to);
		} );
	} );
	
	wp.customize( 'tesseract_tfo_footer_colors_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '#colophon h1, #colophon h2, #colophon h3, #colophon h4, #colophon h5,#colophon h6' ).css('color', to);
		} );
	} );		
	
	wp.customize( 'tesseract_tfo_footer_colors_link_color', function( value ) {
		value.bind( function( to ) {
			var red = hexToRgb(to).r,
			green = hexToRgb(to).g,
			blue = hexToRgb(to).b,
			rgbArray = red + ', ' + green + ', ' + blue; 
				
			$( '#colophon a' ).css('color', to);
			
			if ( $('#horizontal-menu-before').length > 0 ) { 
				$( '#horizontal-menu-before' ).css('border-right', 'rgba(' + rgbArray + ', 0.25) solid 1px');
			}
			if ( $('#horizontal-menu-after').length > 0 ) {
				$( '#horizontal-menu-after' ).css('border-left', 'rgba(' + rgbArray + ', 0.25) solid 1px');
			}
			$('#footer-banner.footbar-active').css('border-top', 'rgba(' + rgbArray + ', 0.15) solid 1px');			
		} );
	} );
	
	wp.customize( 'tesseract_tfo_footer_colors_link_hover_color', function( value ) {
		value.bind( function( to ) {
			var origColor = $( '#colophon a' ).css('color');
			$( '#colophon a' ).hover(
				function() {
					$(this).css('color', to);
				}, function() {
					$(this).css('color', origColor);
				}
			)
		} );
	} );
	
	wp.customize( 'tesseract_tho_mobmenu_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr' ).css('background-color', to);
		} );
	} );
	
	wp.customize( 'tesseract_tho_mobmenu_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css('color', to);
		} );
	} );
	
	wp.customize( 'tesseract_tho_mobmenu_link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).each(function() {
				var origColor = $( this ).css('color');
				$( this ).hover(
					function() {
						$(this).css('color', to);
					}, function() {
						$(this).css('color', origColor);
					}
				)				
			})
		} );
	} );
	
	wp.customize( 'tesseract_tho_mobmenu_link_hover_background_color', function( value ) {
		value.bind( function( to ) {
			switch(to) {
				case 'dark':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', 'rgba(0, 0, 0, .2)' );
				case 'light':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', 'rgba(255, 255, 255, .1)' );
				case 'custom':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', tesseract_vars.mobmenu_link_hover_background_color_custom );					
			}
		} );
	} );	
	
	wp.customize( 'tesseract_tho_mobmenu_link_hover_background_color_custom', function( value ) {
		value.bind( function( to ) {
			$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).each(function() {
				var origBck = $( this ).css('background');
				$( this ).hover(
					function() {
						$(this).css('background', to);
					}, function() {
						$(this).css('background', origBck);
					}
				)				
			})				
		} );
	} );	
	
				
} )( jQuery );