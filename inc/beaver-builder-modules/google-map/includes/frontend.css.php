.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper-full iframe {
	width: 100%;
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper iframe {
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> {
	max-width: 100%;
	<?php if ( $settings->fullwidth === 'no' ): ?>
	float: <?php echo $settings->float; ?>;
	<?php endif; ?>
}