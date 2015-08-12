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
require 'utilities.php';

require 'beaver-builder-extensions/beaver-builder-extensions.php';