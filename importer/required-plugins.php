<?php

require_once dirname( __FILE__ ) . '/vendor/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

function is_plugin_installed($slug)
{
  $plugins = get_plugins();
  foreach($plugins as $plugin_key=>$plugin_info)
  {
    if(preg_match("/^{$slug}", $plugin_key)!==false) return true;
  }
  return false;
}

function tesseract_register_required_plugins() {
	$tesseract_required_plugins = array(
		array(
			'name'      => 'Beaver Builder',
			'slug'      => 'beaver-builder-lite-version',
			'required'  => true
		),
	);

	$config = array(
		'id' => 'tesseract_tgmpa',
		'has_notices'  => true, 				// Show admin notices or not.
		'dismissable'  => is_plugin_installed('beaver-builder-lite-version'),				// If false, a user cannot dismiss the nag message.
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

function display_notice()
{
  if(is_plugin_installed('TESSERACT-Unbranded')) return;
	$message = 'Use the <a href="http://tyler.com/unbranded">TESSERECT Unbranding plugin</a> to customize the footer of your web site.';
	echo caldera_warnings_dismissible_notice( $message, false, 'activate_plugins' );
}
add_action('admin_notices', 'display_notice');
