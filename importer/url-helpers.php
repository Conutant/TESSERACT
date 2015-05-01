<?php

function tesseract_get_import_home_url() {
	return admin_url( 'admin.php?page=tesseract-importer' );
}

function tesseract_get_import_package_url() {
	return admin_url( 'admin.php?page=tesseract-importer&import_package=1' );
}

function tesseract_get_plugin_install_url( $package_id ) {
	return admin_url( 'admin.php?page=tesseract-importer&importer_plugin_install=1&package=' . intval( $package_id ) );
}

function tesseract_get_refresh_packages_url() {
	return admin_url( 'admin.php?page=tesseract-importer&refresh-packages=1' );
}

function tesseract_is_an_import_admin_page() {
	return is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'tesseract-importer';
}

function tesseract_is_import_package_page() {
	return isset( $_GET['page'] ) && $_GET['page'] == 'tesseract-importer' && isset( $_REQUEST['import_package'] );
}

function tesseract_is_plugin_install_page() {
	return isset( $_GET['page'] ) && $_GET['page'] == 'tesseract-importer' && isset( $_REQUEST['importer_plugin_install'] );
}

function tesseract_is_valid_package_import() {
	return isset( $_REQUEST['import_package'] ) && isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'tesseract_import_package' ) && $_POST['package'];
}