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
	
	global $sidrMenu;
	
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

	$wp_customize->add_panel( 'tesseract_layout', array(
		'priority'       => 7,
		'capability'     => 'edit_theme_options',
		'title'          => 'Layout Options'
	) );

	$wp_customize->add_panel( 'tesseract_social', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'title'          => 'Social'
	) );	
	
	$wp_customize->get_section('title_tagline')->panel = 'tesseract_header_options';
	$wp_customize->get_section('title_tagline')->priority = 3;	
	
	$wp_customize->get_control('blogname')->section = 'tesseract_header_left_content';
	$wp_customize->get_control('blogname')->priority = 1;
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_control('display_header_text');
	
	if ( $wp_customize->get_section('static_front_page') ) {
		$wp_customize->get_section('static_front_page')->panel = 'tesseract_general_options';
		$wp_customize->get_section('static_front_page')->priority = 4;
	}
	
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
	require get_template_directory() . '/inc/sections/header-size.php';
	require get_template_directory() . '/inc/sections/header-left-content.php';
	require get_template_directory() . '/inc/sections/header-right-content.php';
	require get_template_directory() . '/inc/sections/mobile-menu.php';
	
	require get_template_directory() . '/inc/sections/social/account01.php';
	require get_template_directory() . '/inc/sections/social/account02.php';
	require get_template_directory() . '/inc/sections/social/account03.php';
	require get_template_directory() . '/inc/sections/social/account04.php';
	require get_template_directory() . '/inc/sections/social/account05.php';
	require get_template_directory() . '/inc/sections/social/account06.php';
	require get_template_directory() . '/inc/sections/social/account07.php';
	require get_template_directory() . '/inc/sections/social/account08.php';
	require get_template_directory() . '/inc/sections/social/account09.php';
	require get_template_directory() . '/inc/sections/social/account10.php';
	
	require get_template_directory() . '/inc/sections/blog.php';
	require get_template_directory() . '/inc/sections/search-results.php';	
	
	require get_template_directory() . '/inc/sections/footer-colors.php';
	require get_template_directory() . '/inc/sections/footer-size.php';		
	require get_template_directory() . '/inc/sections/footer-left-content.php';
	
	require get_template_directory() . '/inc/sections/woocommerce.php';																										
			
	//if ( $wp_customize->is_preview() && ! is_admin() )
		//add_action( 'wp_footer', 'tesseract_customize_preview', 21);									
	
}
add_action( 'customize_register', 'tesseract_customize_register', 10 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tesseract_customize_preview_js() {
	
	wp_register_script( 'tesseract_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );

	//We need to know which menu is used as main menu by the mobile menu script
	$leftMenu = get_theme_mod('tesseract_header_left_content_menu_select');
	$is_leftMenu = ( !is_string($leftMenu) || ( is_string($leftMenu) && ( $leftMenu !== 'none' ) ) );
	
	$rightMenu = get_theme_mod('tesseract_header_right_menu_select');
	$is_rightMenu = ( ( is_string($rightMenu) && ( $rightMenu !== 'none' ) ) && ( get_theme_mod('tesseract_header_right_content') == 'menu' ) );		
	
	$is_both = ( $is_leftMenu && $is_rightMenu ) ? TRUE : FALSE;
	
	$locSelected = get_theme_mod('tesseract_mobmenu_location_select');
	$is_loc = is_string( $locSelected ) ? TRUE : FALSE;
	
	if ( $is_both ) :
		$sidrMenu = ( is_string( $locSelected ) && ( $locSelected !== 'none' ) ) ? $locSelected : 'leftmenu-to-sidr'; 
	elseif ( $is_leftMenu && !$is_rightMenu ) : $sidrMenu = 'leftmenu-to-sidr';
	elseif ( !$is_leftMenu && $is_rightMenu ) : $sidrMenu = 'rightmenu-to-sidr';
	elseif ( ($leftMenu == 'none') && ( $locSelected == 'leftmenu-to-sidr' ) || ($rightMenu == 'none') && ( $locSelected == 'rightmenu-to-sidr' ) ) : $sidrMenu = 'sidr-conflict';
	else : $sidrMenu = FALSE; 
	endif; 
	//EOF $sidrMenu definiton

	// Localize script
    wp_localize_script( 'tesseract_customizer', 'tesseract_vars', array(  
 	    'mobmenu_link_hover_background_color_custom'   	=> get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom'),
		'mobmenu_shadow_color_custom'   				=> get_theme_mod('tesseract_mobmenu_shadow_color_custom'),
		'mobmenu_search_color'   						=> get_theme_mod('tesseract_mobmenu_search_color'),
		'mobmenu_buttons_background_color_custom' 		=> get_theme_mod('tesseract_mobmenu_buttons_background_color_custom'),
		'mobmenu_toDefault' 							=> get_theme_mod('tesseract_mobmenu_to_default'),
		'mobmenu_locToUse' 								=> $sidrMenu,
		'hpad' 					  						=> get_theme_mod('tesseract_header_height'),
		'fpad'   										=> get_theme_mod('tesseract_footer_height')			
 	) );	

	wp_enqueue_script( 'tesseract_customizer' );

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

