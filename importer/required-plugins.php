<?php

require_once dirname( __FILE__ ) . '/vendor/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

function is_plugin_installed( $slug ) {
	$plugins = get_plugins();

	foreach ( $plugins as $plugin_key => $plugin_info ) {
		if ( preg_match( "/^{$slug}\//", $plugin_key ) ) {
			return is_plugin_active( $plugin_key );
		}
	}

	return false;
}

function tesseract_register_required_plugins() {
	$tesseract_required_plugins = array(
		array(
			'name'      => 'Beaver Builder',
			'slug'      => 'beaver-builder-lite-version',
			'required'  => true,
			'force_activation'   => true,
			'force_deactivation' => true,
		),
	);

	$config = array(
		'id' => 'tesseract_tgmpa',
		'has_notices'  => true, 				// Show admin notices or not.
		'dismissable'  => false,				// If false, a user cannot dismiss the nag message.
		'is_automatic' => true,				// Automatically activate plugins after installation or not.
	);

	tgmpa( $tesseract_required_plugins, $config );
}

add_action( 'tgmpa_register', 'tesseract_register_required_plugins' );

require(dirname(__FILE__).'/../dismissible_notice/src/init.php');