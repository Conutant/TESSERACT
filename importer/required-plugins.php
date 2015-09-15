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
?>
		<style>
			#unbranding-plugin-notice {
				overflow: hidden;
				padding: 10px;
				border-left: 4px solid #31cbfd;
			}
			#unbranding-plugin-notice img {
				float: left;
				width: 100px;
				height: auto;
				margin: 10px;
			}
			#unbranding-plugin-notice p {
				font-size: 20px;
				color: #a1a1a1;
			}
			#unbranding-plugin-notice p a {
				font-size: 16px;
				padding: 10px 40px 10px 40px;
				margin-right: 10px;
				-webkit-border-radius: 4;
				-moz-border-radius: 4;
				border-radius: 4px;
				-webkit-box-shadow: 0px 1px 3px #666666;
				-moz-box-shadow: 0px 1px 3px #666666;
				box-shadow: 0px 1px 3px #666666;
				text-decoration: none;
			}
			#get-unbranding {
				background: #34c5f2;
				background-image: -webkit-linear-gradient(top, #34c5f2, #2bc1f3);
				background-image: -moz-linear-gradient(top, #34c5f2, #2bc1f3);
				background-image: -ms-linear-gradient(top, #34c5f2, #2bc1f3);
				background-image: -o-linear-gradient(top, #34c5f2, #2bc1f3);
				background-image: linear-gradient(to bottom, #34c5f2, #2bc1f3);
				color: #ffffff;
			}
			#get-unbranding:hover {
				background: #3cb0fd;
				background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
				background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
				background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
				background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
				background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
				text-decoration: none;
			}
			#dismiss-unbranding {
				background: #f5f5f5;
				background-image: -webkit-linear-gradient(top, #f5f5f5, #fafafa);
				background-image: -moz-linear-gradient(top, #f5f5f5, #fafafa);
				background-image: -ms-linear-gradient(top, #f5f5f5, #fafafa);
				background-image: -o-linear-gradient(top, #f5f5f5, #fafafa);
				background-image: linear-gradient(to bottom, #f5f5f5, #fafafa);
				color: #d1cfd0;
			}
			#dismiss-unbranding:hover {
				background: #f1eff0;
				background-image: -webkit-linear-gradient(top, #f1eff0, #f0eeef);
				background-image: -moz-linear-gradient(top, #f1eff0, #f0eeef);
				background-image: -ms-linear-gradient(top, #f1eff0, #f0eeef);
				background-image: -o-linear-gradient(top, #f1eff0, #f0eeef);
				background-image: linear-gradient(to bottom, #f1eff0, #f0eeef);
				text-decoration: none;
			}
		</style>
		<div id="unbranding-plugin-notice" class="updated notice">
			<img src="https://s3-us-west-2.amazonaws.com/updates.tyler.com/tyler-pic.png" />
			<p>Hey, to remove the "Tyler Moore" at the bottom of your website you can get the unbranding plugin.</p>
			<p>
				<a id="get-unbranding" href="javascript:void(0);">check it out</a>
				<a id="dismiss-unbranding" href="javascript:void(0);">maybe later</a>
			</p>
		</div>
<?php
	}
}
add_action( 'admin_notices', 'display_notice' );