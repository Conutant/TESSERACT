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
}
add_action( 'customize_register', 'tesseract_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tesseract_customize_preview_js() {
	wp_enqueue_script( 'tesseract_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'tesseract_customize_preview_js' );

//load theme-customizer-class.php
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Tesseract_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Tesseract_Customize' , 'header_output' ) );
add_action('wp_enqueue_scripts',array( 'Tesseract_Customize' , 'header_outputtest' ));

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Tesseract_Customize' , 'live_preview' ) );

//Enqueue customizer custom control stylesheets
add_action( 'customize_controls_print_styles',array( 'Tesseract_Customize' , 'tesseract_enqueue_customizer_controls_styles') );
add_action( 'admin_enqueue_scripts', array( 'Tesseract_Customize' ,'tesseract_enqueue_customizer_admin_scripts') );