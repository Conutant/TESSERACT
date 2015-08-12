<?php

$_tests_dir = getenv('WP_TESTS_DIR');
if ( !$_tests_dir ) $_tests_dir = '/tmp/wordpress-tests-lib';

require_once $_tests_dir . '/includes/functions.php';

define( 'TESSERACT_PACKAGES_FILE', dirname( __FILE__ ) . '/data/test-packages.json');

function _manually_load_importer() {
	require dirname( __FILE__ ) . '/../load.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_importer' );

require $_tests_dir . '/includes/bootstrap.php';

