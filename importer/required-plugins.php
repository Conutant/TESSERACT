<?php

require_once dirname( __FILE__ ) . '/vendor/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

function tesseract_register_required_plugins() {
	// When the user attempts to import a package, the required plugins for that package are
	// stored in the 'tesseract_required_plugins' option, so we can nag the user to install.
	$tesseract_required_plugins = get_option( 'tesseract_required_plugins' );

	if ( ! empty( $tesseract_required_plugins ) && is_array( $tesseract_required_plugins ) ) {
		$return_url = get_option( 'tesseract_plugin_install_return_url' );

		if ( empty( $return_url ) ) {
			$return_url = tesseract_get_import_home_url();
		}

		$config = array(
			'has_notices'  => false,					// Show admin notices or not.
			'dismissable'  => false,					// If false, a user cannot dismiss the nag message.
			'is_automatic' => true,				   // Automatically activate plugins after installation or not.
			'strings'	   => array(
				'notice_can_install_required'	  => _n_noop( 'This package requires the following plugin: %1$s.', 'This package requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'  => _n_noop( 'This package recommends the following plugin: %1$s.', 'This package recommends the following plugins: %1$s.' ),
				'complete'						  => __( 'All plugins installed and activated successfully. <a href="' . esc_url( $return_url ) . '">Return to the content importer</a>.', 'tgmpa' ),
				'tesseract_return' => "<a href='" . esc_url( $return_url ) . "'>Continue importing your package</a>"
			)
		);


		tgmpa( $tesseract_required_plugins, $config );
	}
}

add_action( 'tgmpa_register', 'tesseract_register_required_plugins' );