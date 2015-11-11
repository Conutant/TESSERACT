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

<?php if ( $settings->enable_responsive_font_sizes === 'yes' ): ?>
@media screen and (max-width: 1200px) {
	.fl-node-<?php echo $id; ?> h2 {
		font-size: <?php echo $settings->heading_md; ?>px;
	}

	.fl-node-<?php echo $id; ?> h4 {
		font-size: <?php echo $settings->sub_md; ?>px;
	}
}

@media screen and (max-width: 992px) {
	.fl-node-<?php echo $id; ?> h2 {
		font-size: <?php echo $settings->heading_sm; ?>px;
	}

	.fl-node-<?php echo $id; ?> h4 {
		font-size: <?php echo $settings->sub_sm; ?>px;
	}
}

@media screen and (max-width: 768px) {
	.fl-node-<?php echo $id; ?> h2 {
		font-size: <?php echo $settings->heading_xs; ?>px;
	}

	.fl-node-<?php echo $id; ?> h4 {
		font-size: <?php echo $settings->sub_xs; ?>px;
	}
}
<?php endif; ?>