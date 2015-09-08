<?php

define( 'TESSERACT_BB_MODULE_DIR', get_template_directory() . '/inc/beaver-builder-modules/' );
define( 'TESSERACT_BB_MODULE_URL', get_template_directory_uri() . '/inc/beaver-builder-modules/' );

/**
 * Load our custom modules
 */
function tesseract_load_bb_modules() {
	if ( class_exists( 'FLBuilder' ) ) {
	    require_once 'blog/blog-module.php';
	}
}

add_action( 'init', 'tesseract_load_bb_modules' );