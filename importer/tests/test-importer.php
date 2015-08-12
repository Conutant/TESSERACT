<?php

class ImporterTest extends WP_UnitTestCase {
	// function testCleanPackageInstall() {
	// 	$prev_packages = tesseract_get_previously_imported_packages();
	//
	// 	$this->assertEmpty( $prev_packages );
	//
	// 	$packages = tesseract_get_packages();
	// 	tesseract_import_packages( $packages );
	//
	// 	$prev_packages = tesseract_get_previously_imported_packages();
	//
	// 	$this->assertNotEmpty( $prev_packages );
	// }

	function testPackageDeletion() {
		// Run importer with 2 packages
		$packages = tesseract_get_packages( dirname( __FILE__ ) . '/data/test-2-packages.json' );
		tesseract_import_packages( $packages );

		// Assert the number of imported packages is 2
		$prev_packages = tesseract_get_previously_imported_packages();
		$this->assertEquals( 2, count( $prev_packages ) );

		// Grab the slug for the second package for later use
		$second_package_slug = $packages[1]['details']['slug'];

		// Assert a post from the 2nd package is present
		$posts = tesseract_get_tracked_posts_from_package_slug( $second_package_slug );
		$this->assertNotEmpty( $posts );

		// Run importer with 1 package only
		unset( $packages[1] );
		tesseract_import_packages( $packages );

		// Assert number of imported packages is 1
		$prev_packages = tesseract_get_previously_imported_packages();
		$this->assertEquals( 1, count( $prev_packages ) );

		// Assert that same post has been deleted
		$posts = tesseract_get_tracked_posts_from_package_slug( $second_package_slug );
		$this->assertEmpty( $posts );
	}
}