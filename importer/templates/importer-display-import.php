<div class="wrap">
	<h2>Importing Package</h2>

	<?php include( locate_template( 'importer/templates/partials/_messages.php' ) ); ?>

	<?php global $tesseract_import_result; ?>

	<?php if ( isset( $tesseract_import_result ) ) : ?>
		<?php if ( ! empty( $tesseract_import_result['post_ids'] ) ) : ?>
			<h3>The following content was added:</h3>
			<table class="added-content">
				<?php foreach ( $tesseract_import_result['post_ids'] as $post_id ) : ?>
					<tr>
						<td>
							<strong><?php echo esc_html( get_the_title( $post_id ) ); ?></strong>
						</td>
						<td><a href="<?php echo get_permalink( $post_id ); ?>">View</a></td>
						<td><?php edit_post_link( 'Edit', '', '', $post_id ); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<?php if ( ! empty( $tesseract_import_result['options'] ) ) : ?>
			<h3>Your settings were also updated.</h3>
		<?php endif; ?>
	<?php endif; ?>
</div>