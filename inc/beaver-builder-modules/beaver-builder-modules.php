<?php

define( 'TESSERACT_BB_MODULE_DIR', get_template_directory() . '/inc/beaver-builder-modules/' );
define( 'TESSERACT_BB_MODULE_URL', get_template_directory_uri() . '/inc/beaver-builder-modules/' );

/**
 * Load our custom modules
 */
function tesseract_load_bb_modules() {
	if ( class_exists( 'FLBuilder' ) ) {
		$ignore_dirs = array( '.', '..', 'woocommerce' );

		if ( $fh = opendir( TESSERACT_BB_MODULE_DIR ) ) {
			while ( false !== ( $module = readdir( $fh ) ) ) {
				if ( ! in_array( $module, $ignore_dirs ) ) {
					if ( is_dir( TESSERACT_BB_MODULE_DIR . $module ) ) {
						require_once "{$module}/{$module}-module.php";
					}
				}
			}
			closedir( $fh );
		}
	}
}
add_action( 'init', 'tesseract_load_bb_modules' );

/* register new field types */
function fl_number_field( $name, $value, $field ) {
	$size = isset( $field['size'] ) ? ' size="' . $field['size'] . '"' : '';
	$maxlength = isset( $field['maxlength'] ) ? ' maxlength="' . $field['maxlength'] . '"' : '';
	$placeholder = isset( $field['placeholder'] ) ? ' placeholder="' . $field['placeholder'] . '"' : '';
	$class = isset( $field['class'] ) ? " {$field['class']}" : '';

	if ( empty ( $size ) ) {
		$class .= ' text-full';
	}

	echo '<input type="number" class="text' . $class . '" name="' . $name . '" value="' . htmlspecialchars( $value ) . '" '
		. $size . $maxlength . $placeholder . ' style="width: 56px;" />';
}
add_action( 'fl_builder_control_number', 'fl_number_field', 1, 3 );

function fl_email_field( $name, $value, $field ) {
	echo '<input type="email" class="text text-full" name="' . $name . '" value="' . $value . '" />';
}
add_action( 'fl_builder_control_email', 'fl_email_field', 1, 3 );

function fl_checkbox_field( $name, $value, $field ) {
	echo '<input type="checkbox" name="' . $name . '" value="' . $value . '" />';
}
add_action( 'fl_builder_control_checkbox', 'fl_checkbox_field', 1, 3 );