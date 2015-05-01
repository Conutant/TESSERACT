<?php if ( tesseract_has_success_messages() ) : ?>
	<ul class="tm-messages success">
		<?php $success_messages = tesseract_get_messages( 'success' ); ?>
		<?php foreach ( $success_messages as $message ) : ?>
			<li><?php echo esc_html( $message ); ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<?php if ( tesseract_has_error_messages() ) : ?>
	<ul class="tm-messages error">
		<?php $error_messages = tesseract_get_messages( 'error' ); ?>
		<?php foreach ( $error_messages as $message ) : ?>
			<li><?php echo esc_html( $message ); ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>