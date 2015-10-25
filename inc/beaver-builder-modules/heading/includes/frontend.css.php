.fl-node-<?php echo $id; ?> h2 {
	color: #<?php echo $settings->color; ?>;
	font-size: <?php echo $settings->size; ?>px;
	text-align: <?php echo $settings->alignment; ?>;
	<?php if ( ! empty( $settings->add_subheadline ) ): ?>
	margin-bottom: <?php echo $settings->vertical_spacing; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> h4 {
	color: #<?php echo $settings->sub_color; ?>;
	font-size: <?php echo $settings->sub_size; ?>px;
	text-align: <?php echo $settings->alignment; ?>;
}