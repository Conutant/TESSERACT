<div class="wrap">
	<?php include( locate_template( 'importer/templates/partials/_messages.php' ) ); ?>

	<?php
		$plugin_table = new TGMPA_List_Table;
		$plugin_table->prepare_items();

		$plugins_needing_install = array();
		$plugins_needing_activation = array();

		$installed_plugins = get_plugins();

		foreach ( $plugin_table->items as $item ) {
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$plugins_needing_install[] = $item;
			} elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				$plugins_needing_activation[] = $item;
			}
		}

		$packages = tesseract_get_packages();
		$package_id = intval( $_GET['package'] );
		$package = $packages[$package_id];
	?>

	<?php if ( ! tesseract_needs_plugins_installed() ) : ?>
		<h2>Awesome! You've installed all required plugins. Continue with the import?</h2>

		<form action="<?php echo esc_url( tesseract_get_import_package_url() ); ?>" method="post" class="package-form" data-num-pages="<?php echo esc_attr( count( $package['posts'] ) ); ?>">
			<input type="submit" class="submit-button button button-primary" value="Yep, continue with the import!">
			<?php wp_nonce_field( 'tesseract_import_package' ); ?>
			<input type="hidden" name="package" value="<?php echo esc_attr( $package['id'] ); ?>">
		</form>
		<p>
			<a href="<?php echo esc_url( tesseract_get_import_home_url() ); ?>" class="button button-secondary">
				Actually, no. Take me back to the importer home page.
			</a>
		</p>
	<?php else : ?>

		<h2>Before You Can Import This Package, You Must Install &amp; Activate Some Plugins:</h2>

		<?php if ( ! empty( $plugins_needing_install ) ) : ?>
			<h3>These plugins need to be installed:</h3>
			<form id="tgmpa-plugins" action="<?php echo get_site_url(); ?>/wp-admin/themes.php?page=tgmpa-install-plugins" method="post">
				<ol class="required-plugin-list">
					<?php foreach ( $plugins_needing_install as $item ) : ?>
						<li>
							<?php echo esc_html( $item['sanitized_plugin'] ); ?>
							<?php
								$value = $item['file_path'] . ',' . $item['url'] . ',' . $item['sanitized_plugin'];
								echo sprintf( '<input type="hidden" name="%1$s[]" value="%2$s" id="%3$s" />', 'plugin', $value, $item['sanitized_plugin'] );
							?>
						</li>
					<?php endforeach; ?>
				</ol>
				<input type="hidden" name="action" value="tgmpa-bulk-install">
				<?php wp_nonce_field( 'bulk-plugins' ); ?>
				<input type="submit" value="Install These Plugins" class="button button-primary">
			</form>
		<?php endif; ?>

		<?php if ( ! empty( $plugins_needing_activation ) ) : ?>
			<h3>These plugins need to be activated:</h3>
			<form id="tgmpa-plugins" action="<?php echo get_site_url(); ?>/wp-admin/themes.php?page=tgmpa-install-plugins" method="post">
				<ol class="required-plugin-list">
					<?php foreach ( $plugins_needing_activation as $item ) : ?>
						<li>
							<?php echo esc_html( $item['sanitized_plugin'] ); ?>
							<?php
								$value = $item['file_path'] . ',' . $item['url'] . ',' . $item['sanitized_plugin'];
								echo sprintf( '<input type="hidden" name="%1$s[]" value="%2$s" id="%3$s" />', 'plugin', $value, $item['sanitized_plugin'] );
							?>
						</li>
					<?php endforeach; ?>
				</ol>
				<input type="hidden" name="action" value="tgmpa-bulk-activate">
				<?php wp_nonce_field( 'bulk-plugins' ); ?>
				<input type="submit" value="Activate These Plugins" class="button button-primary">
			</form>
		<?php endif; ?>
	<?php endif; ?>
</div>