<?php

class ImporterTest extends WP_UnitTestCase {
	function testCleanPackageInstall() {
		$prev_packages = tesseract_get_previously_imported_packages();

		$this->assertEmpty( $prev_packages );

		tesseract_import_packages();

		$prev_packages = tesseract_get_previously_imported_packages();

		$this->assertNotEmpty( $prev_packages );
	}

}