.fl-node-<?php echo $id; ?> .fl-module-content .button {
    background-color: #<?php echo $settings->button_color; ?>;
	color: #<?php echo $settings->text_color; ?>;
	<?php if ( $settings->border !== 'none' ): ?>
	border: <?php echo $settings->border_width; ?>px <?php echo $settings->border; ?> #<?php echo $settings->border_color; ?>;
	border-radius: <?php echo $settings->border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->border_radius; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .button:hover {
    background-color: #<?php echo $settings->button_color_hover; ?>;
	color: #<?php echo $settings->text_color_hover; ?> !important;
}