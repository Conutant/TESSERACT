/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	$(window).load(function() {	
		
		tesseract_watermark = function(){
	
			isHeaderMenu = tesseract_vars.mobmenu_locToUse ? 'true' : 'false';
	
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
		
		isHeaderMenu = tesseract_vars.mobmenu_locToUse ? 'true' : 'false';
		
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
			
		if ( ( isHeaderMenu == 'true' ) && ( $('#site-navigation').hasClass('showit') || $('#header-right-menu').hasClass('showit') ) ) {		
			$.sidr('open', 'sidr-main');
		}
		
	})
	
	$(window).resize(function(){

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
	
	wp.customize( 'tesseract_header_colors_bck_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .main-navigation ul ul a, #header-right-menu ul ul a' ).css('background-color', to);
		} );
	} );
	
	wp.customize('tesseract_header_colors_bck_color_opacity', function(value){ 									
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
					
				var result = 'rgba(' + colorsOnly[0] + ', ' + colorsOnly[1] + ', ' + colorsOnly[2] + ', ' + to/100 + ')';				
			}
			$('.site-header, .main-navigation ul ul a, #header-right-menu ul ul a').css( 'background-color', result);
			
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
	
	wp.customize( 'tesseract_header_colors_text_color', function( value ) {
		value.bind( function( to ) {				
		
			$( '.site-header, .site-header h1, .site-header h2, .site-header h3, .site-header h4, .site-header h5, .site-header h6' ).css('color', to);				
		
			$( '#masthead .search-field' ).focus(function() {
				var color = $(this).hasClass('watermark') ? '#ccc' : to; 
				$(this).css('color', color);
			})
			$( '#masthead .search-field' ).blur(function() {
				var color = $(this).hasClass('watermark') ? '#ccc' : to; 
				$(this).css('color', color);
			})		
		
		} );
	} );	
	
	wp.customize( 'tesseract_header_colors_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header a, .main-navigation ul ul a, #header-right-menu ul ul a' ).not('a.button').css('color', to);		
		} );
	} );
	
	wp.customize( 'tesseract_header_colors_link_hover_color', function( value ) {
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
	
	wp.customize( 'tesseract_header_content_if_button', function( value ) {
		value.bind( function( to ) {
			$( '#header-button-container' ).html(to);		
		} );
	} );		
			
	wp.customize( 'tesseract_footer_colors_bck_color', function( value ) {
		value.bind( function( to ) {
			$( '#colophon' ).css('background-color', to);
		} );
	} );
	
	wp.customize( 'tesseract_footer_colors_text_color', function( value ) {
		value.bind( function( to ) {				
			$( '#colophon' ).css('color', to);
			$( '#colophon .search-field' ).focus(function() {
				var color = $(this).hasClass('watermark') ? '#ccc' : to; 
				$(this).css('color', color);
			})
			$( '#colophon .search-field' ).blur(function() {
				var color = $(this).hasClass('watermark') ? '#ccc' : to; 
				$(this).css('color', color);
			})			
						
		} );
	} );
	
	wp.customize( 'tesseract_footer_colors_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '#colophon h1, #colophon h2, #colophon h3, #colophon h4, #colophon h5, #colophon h6' ).css('color', to);
		} );
	} );		
	
	wp.customize( 'tesseract_footer_colors_link_color', function( value ) {
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
	
	wp.customize( 'tesseract_footer_colors_link_hover_color', function( value ) {
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
	
	wp.customize( 'tesseract_mobmenu_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr' ).css('background-color', to);
		} );
	} );
	
	wp.customize( 'tesseract_mobmenu_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css('color', to);
		} );
	} );
	
	wp.customize( 'tesseract_mobmenu_link_hover_color', function( value ) {
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
	
	wp.customize( 'tesseract_mobmenu_link_hover_background_color', function( value ) {
		value.bind( function( to ) {
			switch(to) {
				case 'dark':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', 'rgba(0, 0, 0, .2)' ); break;
				case 'light':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', 'rgba(255, 255, 255, .1)' ); break;
				case 'custom':
					$( '.sidr .sidr-class-menu li a, .sidr .sidr-class-menu li span' ).css( 'background', tesseract_vars.mobmenu_link_hover_background_color_custom ); break;			
			}
		} );
	} );	
	
	wp.customize( 'tesseract_mobmenu_link_hover_background_color_custom', function( value ) {
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
	
	wp.customize( 'tesseract_mobmenu_shadow_color_custom', function( value ) {
		value.bind( function( to ) {
			
			var shad_r = hexToRgb(to).r,
			shad_g = hexToRgb(to).g,
			shad_b = hexToRgb(to).b,
			shad_rgbArray = shad_r + ', ' + shad_g + ', ' + shad_b;			
			
			$( '.sidr ul li > a, .sidr ul li > span, #sidr-id-header-button-container-inner > *' ).css({
				'-webkit-box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ' , 0.2)',
				'-moz-box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ' , 0.2)',
				'box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ' , 0.2)'			
			})		
			
			$('.sidr > div > ul > li:first-child > a, .sidr > div > ul > li:first-child > span').css({
				'-webkit-box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ', 0.2), inset 0 1px rgba( ' + shad_rgbArray + ', 0.2)',
				'-moz-box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ', 0.2), inset 0 1px rgba( ' + shad_rgbArray + ', 0.2)',
				'box-shadow': 'inset 0 -1px rgba( ' + shad_rgbArray + ', 0.2), inset 0 1px rgba( ' + shad_rgbArray + ',  0.2)'					
			});	
			
			$('.sidr ul.sidr-class-hr-social li a, .sidr ul.sidr-class-hr-social li a:first-child').css({
				'-webkit-box-shadow': '0 1px 0 0 rgba( ' + shad_rgbArray + ' , 0.25)',
				'-moz-box-shadow': '0 1px 0 0 rgba( ' + shad_rgbArray + ', 0.25)',
				'box-shadow': '0 1px 0 0 rgba( ' + shad_rgbArray + ', 0.25)'				
			});	
					
		} );
	} );
	
	wp.customize( 'tesseract_mobmenu_search_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidr-class-search-field, .sidr .search-form input[type="search"]' ).css( 'color', to );
			$( '.sidr-class-search-field.watermark, .sidr .search-form input[type="search"].watermark' ).css( 'color', mobmenu_search_color_lighter );			
		} );
	} );
	
	wp.customize( 'tesseract_mobmenu_search_background_color', function( value ) {
		value.bind( function( to ) {
			var mobmenu_searchBckColor = ( to == 'dark' ) ? 'rgba(0, 0, 0, .15)': 'rgba(255, 255, 255, 0.15)';
			$( '.sidr-class-search-field, .sidr-class-search-form input[type="search"]' ).css('background-color', mobmenu_searchBckColor);
		} );
	} );	

	wp.customize( 'tesseract_mobmenu_buttons_background_color', function( value ) {
		value.bind( function( to ) {
			switch(to) {
				case 'dark':
					$( '#sidr-id-header-button-container-inner' ).css( 'background', 'rgba(0, 0, 0, .2)' ); break;
				case 'light':
					$( '#sidr-id-header-button-container-inner' ).css( 'background', 'rgba(255, 255, 255, .1)' ); break;
				case 'custom':
					$( '#sidr-id-header-button-container-inner' ).css( 'background', tesseract_vars.mobmenu_buttons_background_color_custom ); break;			
			}
		} );
	} );	
	
	wp.customize( 'tesseract_mobmenu_buttons_background_color_custom', function( value ) {
		value.bind( function( to ) {
			$( '#sidr-id-header-button-container-inner' ).css( 'background', to );
		} );					
	} );
	
	wp.customize( 'tesseract_mobmenu_buttons_text_color', function( value ) {
		value.bind( function( to ) {
			$( '#sidr-id-header-button-container-inner, #sidr-id-header-button-container-inner > h1, #sidr-id-header-button-container-inner > h2, #sidr-id-header-button-container-inner > h3, #sidr-id-header-button-container-inner > h4, #sidr-id-header-button-container-inner > h5, #sidr-id-header-button-container-inner > h6' ).css( 'color', to );
		} );					
	} );		
	
	wp.customize( 'tesseract_mobmenu_buttons_link_color', function( value ) {
		value.bind( function( to ) {
			$( '#sidr-id-header-button-container-inner a, #sidr-id-header-button-container-inner button' ).css( 'color', to );
		} );					
	} );			
	
	
	wp.customize( 'tesseract_mobmenu_buttons_link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( '#sidr-id-header-button-container-inner a, #sidr-id-header-button-container-inner button' ).each(function() {
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
	
	wp.customize( 'tesseract_mobmenu_maxbtn_sep_color', function( value ) {
		value.bind( function( to ) {
			
			var max_r = hexToRgb(to).r,
			max_g = hexToRgb(to).g,
			max_b = hexToRgb(to).b,
			max_rgbArray = 'inset 0 -1px rgba( ' + max_r + ', ' + max_g + ', ' + max_b + ', 0.2)';			
			
			$( '.sidr ul li > a, .sidr ul li > span, #sidr-id-header-button-container-inner > *, #sidr-id-header-button-container-inner button' ).css({
				'-webkit-box-shadow': max_rgbArray,
				'-moz-box-shadow': max_rgbArray,
				'box-shadow': max_rgbArray			
			})		
					
		} );
	} );	
	
	wp.customize( 'tesseract_mobmenu_maxbtn_sep_color', function( value ) {
		value.bind( function( to ) {
			var mobmenu_maxbtnSepColor = ( to == 'dark' ) ? 'inset 0 -1px rgba(0, 0, 0, .1)': 'inset 0 -1px rgba(255, 255, 255, 0.1)';
			$( '.sidr ul li > a, .sidr ul li > span, #sidr-id-header-button-container-inner > *, #sidr-id-header-button-container-inner button' ).css({
				'-webkit-box-shadow': mobmenu_maxbtnSepColor,
				'-moz-box-shadow': mobmenu_maxbtnSepColor,
				'box-shadow': mobmenu_maxbtnSepColor					
			});
		} );
	} );
	
	wp.customize( 'tesseract_header_left_content_logo_height', function( value ) {
		value.bind( function( to ) {
			$('#site-banner .site-logo img').animate({ 
				'height': to 
			}, 50);
		} );
	} );	
	
	wp.customize( 'tesseract_header_height', function( value ) {
		value.bind( function( to ) {
			$('#masthead').animate({ 
				'padding-top': to,
				'padding-bottom': to 
			}, 50);
		} );
	} );
	
	wp.customize( 'tesseract_header_blocks_width_prop', function( value ) {
		value.bind( function( to ) {
			var parentWidth = $('#site-banner-main').width(),
			toLeft = (to/100)*parentWidth,
			toRight = parentWidth - ((to/100)*parentWidth);
			$('#site-banner-left').animate({ 
				'width': toLeft 
			}, 150);
			$('#site-banner-right').animate({ 
				'width': toRight 
			}, 150);						
		} );
	} );	
	
	wp.customize( 'tesseract_header_right_search_color', function( value )  {
		value.bind( function( to ) {
			$('#masthead .search-field').css( 'color', to );		
		} )
	} )
	
	wp.customize( 'tesseract_header_right_search_background_color', function( value )  {
		value.bind( function( to ) {
			$('#masthead .search-field').css( 'background-color', to );
		} )
	} )	
	
	wp.customize( 'tesseract_footer_left_content_logo_height', function( value ) {
		value.bind( function( to ) {
			$('#footer-banner .site-logo img').animate({ 
				'height': to 
			}, 50);
		} );
	} );	
	
	wp.customize( 'tesseract_footer_height', function( value ) {
		value.bind( function( to ) {
			$('#colophon').animate({ 
				'padding-top': to,
				'padding-bottom': to 
			}, 50);
		} );
	} );
	
	wp.customize( 'tesseract_footer_blocks_width_prop', function( value ) {
		value.bind( function( to ) {
			var parentWidth = $('#footer-banner').width(),
			toLeft = (to/100)*parentWidth,
			toRight = parentWidth - ((to/100)*parentWidth);
			$('#horizontal-menu-wrap').animate({ 
				'width': toLeft 
			}, 150);
			$('#footer-banner-right').animate({ 
				'width': toRight 
			}, 150);						
		} );
	} );
	
	wp.customize( 'tesseract_footer_left_search_color', function( value )  {
		value.bind( function( to ) {
			$('#colophon .search-field').css( 'color', to );		
		} )
	} )
	
	wp.customize( 'tesseract_footer_left_search_background_color', function( value )  {
		value.bind( function( to ) {
			$('#colophon .search-field').css( 'background-color', to );
		} )
	} )								
				
} )( jQuery );