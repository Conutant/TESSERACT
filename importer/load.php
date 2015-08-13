<?php

class Tesseract_Importer_Constants {
	public static $IMPORTED_PACKAGES_OPTION_NAME = 'tesseract_imported_packages';
	public static $IMPORTED_BY_PACKAGE_META_KEY = '_imported_by_tesseract_package';
	public static $TRACKED_POST_TYPES = array( 'fl-builder-template' );
	public static $CONTENT_BLOCK_META_KEY = '_imported_content_block';
}

if ( ! defined( 'TESSERACT_PACKAGES_FILE' ) ) {
	define( 'TESSERACT_PACKAGES_FILE', dirname( __FILE__ ) . '/data/packages.json' );
}

require 'required-plugins.php';
require 'import-functions.php';
require 'utilities.php';

require 'beaver-builder-extensions/beaver-builder-extensions.php';