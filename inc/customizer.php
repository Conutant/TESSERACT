<?php
/**
 * Tesseract Theme Customizer
 *
 * @package Tesseract
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tesseract_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	

	$wp_customize->add_panel( 'tesseract_general_options', array(
		'priority'       => 3,
		'capability'     => 'edit_theme_options',
		'title'          => 'General',
		//'description'  => ''
	) );

	$wp_customize->add_panel( 'tesseract_header_options', array(
		'priority'       => 4,
		'capability'     => 'edit_theme_options',
		'title'          => 'Header Options',
		//'description'  => ''
	) );
	
	$wp_customize->add_panel( 'tesseract_footer_options', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'title'          => 'Footer Options',
		//'description'  => ''
	) );	

	$wp_customize->add_panel( 'tesseract_social', array(
		'priority'       => 9999,
		'capability'     => 'edit_theme_options',
		'title'          => 'Social'
	) );
	
	$wp_customize->get_section('title_tagline')->panel = 'tesseract_header_options';
	$wp_customize->get_section('title_tagline')->priority = 3;	
	
	$wp_customize->get_section('static_front_page')->panel = 'tesseract_general_options';
	$wp_customize->get_section('static_front_page')->priority = 4;
	
	$wp_customize->get_section('background_image')->panel = 'tesseract_general_options';
	$wp_customize->get_section('background_image')->priority = 2;

	$wp_customize->get_section('colors')->panel = 'tesseract_general_options';	
	$wp_customize->get_section('colors')->title = __( 'Background Color', 'tesseract' );
	$wp_customize->get_section('colors')->priority = 1;
	$wp_customize->get_control('background_color')->label = __( 'Choose a background color', 'tesseract' );
	$wp_customize->get_control('background_color')->description = __( '(This is only for the site\'s generic background color. You can define header and footer background colors in the Header Options and Footer Options respectively.)', 'tesseract' );

	$wp_customize->remove_section('header_image');		
	$wp_customize->remove_section('nav');	
	$wp_customize->remove_control('header_textcolor');	

	require get_template_directory() . '/inc/sections/header-colors.php';	
	require get_template_directory() . '/inc/sections/logo.php';
	require get_template_directory() . '/inc/sections/header-menu.php';
	require get_template_directory() . '/inc/sections/header-content.php';
	
	require get_template_directory() . '/inc/sections/social/facebook.php';
	require get_template_directory() . '/inc/sections/social/twitter.php';
	require get_template_directory() . '/inc/sections/social/googleplus.php';
	require get_template_directory() . '/inc/sections/social/linkedin.php';
	require get_template_directory() . '/inc/sections/social/youtube.php';
	require get_template_directory() . '/inc/sections/social/vimeo.php';
	require get_template_directory() . '/inc/sections/social/tumblr.php';
	require get_template_directory() . '/inc/sections/social/flickr.php';
	require get_template_directory() . '/inc/sections/social/pinterest.php';
	require get_template_directory() . '/inc/sections/social/dribbble.php';	
	
	require get_template_directory() . '/inc/sections/footer-colors.php';		
	require get_template_directory() . '/inc/sections/footer-content.php';																										
			
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'tesseract_customize_preview', 21);									
	
}
add_action( 'customize_register', 'tesseract_customize_register' );

function tesseract_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
		
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
			
	} )( jQuery )
    </script>
    <?php 
} 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tesseract_customize_preview_js() {
	wp_enqueue_script( 'tesseract_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}

function tesseract_customize_controls_script() {
	wp_enqueue_script( 'tesseract_customize_controls_script', get_template_directory_uri() . '/js/customize-controls.js', array( 'jquery' ) );	
}

function tesseract_customize_controls_style() {
	wp_enqueue_style( 'tesseract_customize_controls_style', get_template_directory_uri() . '/css/customize-controls.css' );
}

add_action( 'customize_preview_init', 'tesseract_customize_preview_js' );
add_action( 'customize_controls_print_footer_scripts', 'tesseract_customize_controls_script' );
add_action( 'customize_controls_print_styles', 'tesseract_customize_controls_style' );

