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
	require get_template_directory() . '/inc/sections/header-logo.php';
	require get_template_directory() . '/inc/sections/header-size.php';
	require get_template_directory() . '/inc/sections/header-menu.php';
	require get_template_directory() . '/inc/sections/header-content.php';
	require get_template_directory() . '/inc/sections/mobile-menu.php';

	require get_template_directory() . '/inc/sections/social-accounts.php';

	require get_template_directory() . '/inc/sections/blog.php';
	require get_template_directory() . '/inc/sections/search-results.php';

	require get_template_directory() . '/inc/sections/footer-colors.php';
	require get_template_directory() . '/inc/sections/footer-size.php';
	require get_template_directory() . '/inc/sections/footer-logo.php';
	require get_template_directory() . '/inc/sections/footer-content.php';

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

		// Let's get a lighter version of the user-definedsearch iput color applied in the mobile menu - tricky
		// See @ http://stackoverflow.com/questions/11091695/how-to-find-the-hex-code-for-a-lighter-or-darker-version-of-a-hex-code-in-php
		$watermarkColor = get_theme_mod('tesseract_mobmenu_search_color');
		$col = Array(
			hexdec(substr($watermarkColor,1,2)),
			hexdec(substr($watermarkColor,3,2)),
			hexdec(substr($watermarkColor,5,2))
		);
		$lighter = Array(
			255-(255-$col[0])*0.8,
			255-(255-$col[1])*0.8,
			255-(255-$col[2])*0.8
		);
		$lighter = "#".sprintf("%02X%02X%02X", $lighter[0], $lighter[1], $lighter[2]);

	// Localize script
    wp_localize_script( 'tesseract_customizer', 'tesseract_vars', array(
 	    'mobmenu_link_hover_background_color_custom'   	=> get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom'),
		'mobmenu_shadow_color_custom'   				=> get_theme_mod('tesseract_mobmenu_shadow_color_custom'),
		'mobmenu_search_color'   						=> get_theme_mod('tesseract_mobmenu_search_color'),
		'mobmenu_buttons_background_color_custom' 		=> get_theme_mod('tesseract_mobmenu_buttons_background_color_custom'),
		'mobmenu_search_color_lighter'   				=> $lighter,
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

/**
 * The opacity control should only appear on the homepage
 */
function tesseract_show_header_opacity_control() {
	return is_front_page();
}
