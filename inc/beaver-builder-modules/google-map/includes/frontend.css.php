.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper-full iframe {
	width: 100%;
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper iframe {
	max-width: 100%;
}

.fl-node-<?php echo $id; ?> {
	<?php if ( $settings->map_type === 'static' ): ?>
	width: <?php echo $settings->width; ?>px;
	<?php endif; ?>
	max-width: 100%;
	<?php if ( $settings->fullwidth === 'no' || $settings->map_type === 'static' ): ?>
	float: <?php echo $settings->float; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .map-wrapper img {
	width: 100%;
	max-width: 100%;
}
