<div class="wrap">
	<h2>Tesseract Content Importer <a href="<?php echo esc_url( tesseract_get_refresh_packages_url() ); ?>" class="button button-secondary">Refresh Packages</a></h2>
	<?php $packages = tesseract_get_packages(); ?>

	<?php include( locate_template( 'importer/templates/partials/_messages.php' ) ); ?>

	<?php foreach ( $packages as $package ) : ?>
		<?php include( locate_template( 'importer/templates/partials/_package-display.php' ) ); ?>
	<?php endforeach; ?>
</div>