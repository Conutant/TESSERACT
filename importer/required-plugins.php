<?php

require_once dirname( __FILE__ ) . '/vendor/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

function is_plugin_installed( $slug ) {
	$plugins = get_plugins();

	foreach ( $plugins as $plugin_key => $plugin_info ) {
		if ( preg_match( "/^{$slug}\//", $plugin_key ) ) {
			return true;
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
			//'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip',
			'force_activation'   => true,
			'force_deactivation' => true,
			'external_url'       => 'http://andrux.net',
		),
/*		array(
			'name'      => 'Unbranding Plugin',
			'slug'      => 'tesseract-unbranding',
			'required'  => false,
			'force_activation'   => true,
			'force_deactivation' => true,
			//'source'             => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip',
			//'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),
*/	);

	$config = array(
		'id' => 'tesseract_tgmpa',
		'has_notices'  => true, 				// Show admin notices or not.
		'dismissable'  => false,				// If false, a user cannot dismiss the nag message.
		'is_automatic' => true,				// Automatically activate plugins after installation or not.
	);

	tgmpa( $tesseract_required_plugins, $config );
}

add_action( 'tgmpa_register', 'tesseract_register_required_plugins' );


function tesserect_unbranded_plugin($action_links) {
  if(!isset($action_links['install'])) return $action_links; // Can't be the Unbranded plugin
  $action_links['install'] = preg_replace('/\s+href\s?=\s?".+?"/', ' href="http://tyler.com/unbranded"', $action_links['install']);

  return $action_links;
}
add_filter('tgmpa_plugin_action_links', 'tesserect_unbranded_plugin');


require(dirname(__FILE__).'/../dismissible_notice/src/init.php');

function display_notice() {
	if ( ! is_plugin_installed( 'TESSERACT-Unbranded' ) ) {
		if ( false === ( $dismissed = get_transient( 'dismiss_unbranding' ) ) ) {
?>
		<div id="unbranding-plugin-notice" class="updated notice">
			<img src="https://s3-us-west-2.amazonaws.com/updates.tyler.com/tyler-pic.png" />
			<p>Hey, to remove the "Tyler Moore" at the bottom of your website you can get the unbranding plugin.</p>
			<p>
				<a id="get-unbranding" href="http://tyler.com/unbranding-plugin/" target="_blank">check it out</a>
				<a id="dismiss-unbranding" href="javascript:void(0);">maybe later</a>
			</p>
		</div>
<?php
		}
	}
}
add_action( 'admin_notices', 'display_notice' );

function dismiss_unbranding() {
	set_transient( 'dismiss_unbranding', true, 3 * DAY_IN_SECONDS ); // dismissed for 3 days

	die();
}
add_action( 'wp_ajax_dismiss_unbranding', 'dismiss_unbranding' );