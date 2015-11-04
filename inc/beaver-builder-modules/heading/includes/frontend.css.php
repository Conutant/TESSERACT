.fl-node-<?php echo $id; ?> h2 {
	color: #<?php echo $settings->color; ?> !important;
	font-size: <?php echo $settings->size; ?>px;
	font-weight: <?php echo $settings->weight; ?>;
	text-align: <?php echo $settings->alignment; ?>;
	<?php if ( ! empty( $settings->add_subheadline ) ): ?>
	margin-bottom: <?php echo $settings->vertical_spacing; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> h4 {
	color: #<?php echo $settings->sub_color; ?> !important;
	font-size: <?php echo $settings->sub_size; ?>px;
	font-weight: <?php echo $settings->sub_weight; ?>;
	text-align: <?php echo $settings->alignment; ?>;
}