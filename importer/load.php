<?php

class Tesseract_Importer_Options {
	const IMPORTED_PACKAGES = 'tesseract_imported_packages';
}

if ( ! defined( 'TESSERACT_PACKAGES_FILE' ) ) {
	define( 'TESSERACT_PACKAGES_FILE', dirname( __FILE__ ) . '/data/packages.json' );
}

require 'hooks.php';
require 'required-plugins.php';
require 'import-functions.php';
// require 'admin-page.php'; TODO: Remove admin-page.php when we don't need it anymore as well as templates
require 'url-helpers.php';
require 'scripts.php';
require 'utilities.php';

require 'beaver-builder-extensions/beaver-builder-extensions.php';