.fl-node-<?php echo $id; ?> {
	max-width: 100%;
	<?php if ( $settings->fullwidth === 'no' ): ?>
	float: <?php echo $settings->float; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper-full iframe {
	width: 100%;
}