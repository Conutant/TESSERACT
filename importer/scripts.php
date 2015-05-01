<?php

function tesseract_enqueue_importer_scripts() {
	global $pagenow;

	if ( 'admin.php' == $pagenow && isset( $_GET['page'] ) && 'tesseract-importer' == $_GET['page'] ) {
		wp_enqueue_script( 'tesseract-importer-admin', get_template_directory_uri() . '/importer/js/importer-admin.js', array( 'jquery' ) );
		wp_enqueue_style( 'tesseract-importer-admin', get_template_directory_uri() . '/importer/css/admin.css' );
	}
}

add_action( 'admin_enqueue_scripts', 'tesseract_enqueue_importer_scripts' );