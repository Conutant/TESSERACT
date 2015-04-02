<?php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tesseract_register_required_plugins' );

function tesseract_register_required_plugins() {

    $plugins = array(
	
        array(
            'name'               => 'Beaver Builder Plugin (Lite Version)',
            'slug'               => 'beaver-builder-lite-version', 
            'source'             => '',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false, 
            'external_url'       => ''
        ),
        array(
            'name'               => 'Easy Google Fonts',
            'slug'               => 'easy-google-fonts', 
            'source'             => '',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false, 
            'external_url'       => ''
        ),
        array(
            'name'               => 'MaxButtons',
            'slug'               => 'maxbuttons', 
            'source'             => '',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false, 
            'external_url'       => ''
        )		
	
	);
	
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tesseract' ),
            'menu_title'                      => __( 'Install Plugins', 'tesseract' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tesseract' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tesseract' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tesseract' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tesseract' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tesseract' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );	
	
}
	
	