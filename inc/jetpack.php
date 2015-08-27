<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Tesseract
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function tesseract_jetpack_setup() {
    add_theme_support( 'infinite-scroll', array(
        'container'      => 'main',
		'footer'         => 'colophon',
		'wrapper'        => false,
		'posts_per_page' => 9,
	) );
	
    /**
     * Add theme support for site logos
     */
     add_theme_support( 'site-logo', array( 'size' => 'tesseract-site-logo' ) );
	 
    /**
     * Add theme support for responsive videos.
     */
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'tesseract_jetpack_setup' );
