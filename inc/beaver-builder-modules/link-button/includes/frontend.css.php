<?php
	/* convert background hex color to rgb to apply cross browser opacity */
	$hex = preg_replace( '/[^0-9A-Fa-f]/', '', $settings->button_color );
	$rgb_array = array();
	$hex_hover = preg_replace( '/[^0-9A-Fa-f]/', '', $settings->button_color_hover );
	$rgb_array_hover = array();

	if ( strlen( $hex ) == 6 ) {
		$color = hexdec( $hex );
		$rgb_array[] = 0xFF & ( $color >> 0x10 );
		$rgb_array[] = 0xFF & ( $color >> 0x8 );
		$rgb_array[] = 0xFF & $color;
	}
	elseif ( strlen( $hex ) == 3 ) {
		$rgb_array[] = hexdec( str_repeat( substr( $hex, 0, 1 ), 2 ) );
		$rgb_array[] = hexdec( str_repeat( substr( $hex, 1, 1 ), 2 ) );
		$rgb_array[] = hexdec( str_repeat( substr( $hex, 2, 1 ), 2 ) );
	}

	if ( strlen( $hex_hover ) == 6 ) {
		$color = hexdec( $hex_hover );
		$rgb_array_hover[] = 0xFF & ( $color >> 0x10 );
		$rgb_array_hover[] = 0xFF & ( $color >> 0x8 );
		$rgb_array_hover[] = 0xFF & $color;
	}
	elseif ( strlen( $hex_hover ) == 3 ) {
		$rgb_array_hover[] = hexdec( str_repeat( substr( $hex_hover, 0, 1 ), 2 ) );
		$rgb_array_hover[] = hexdec( str_repeat( substr( $hex_hover, 1, 1 ), 2 ) );
		$rgb_array_hover[] = hexdec( str_repeat( substr( $hex_hover, 2, 1 ), 2 ) );
	}
?>
.fl-module-link-button-module {
	display: inline-block;
}

.fl-node-<?php echo $id; ?> .fl-module-content .button {
	<?php if ( empty( $rgb_array ) ): ?>
    background-color: #<?php echo $settings->button_color; ?>;
	<?php else: ?>
	background-color: rgba( <?php echo implode( ', ', $rgb_array ); ?>, <?php echo ( $settings->opacity / 100 ); ?> );
	<?php endif; ?>
	color: #<?php echo $settings->text_color; ?>;
	font-size: <?php echo $settings->font_size; ?>px;
	<?php if ( $settings->border !== 'none' ): ?>
	border: <?php echo $settings->border_width; ?>px <?php echo $settings->border; ?> #<?php echo $settings->border_color; ?>;
	border-radius: <?php echo $settings->border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->border_radius; ?>px;
	<?php endif; ?>
	padding: <?php echo "{$settings->padding_top}px {$settings->padding_right}px {$settings->padding_bottom}px {$settings->padding_left}px;";  ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .button:hover {
	<?php if ( empty( $rgb_array_hover ) ): ?>
    background-color: #<?php echo $settings->button_color_hover; ?>;
	<?php else: ?>
	background-color: rgba( <?php echo implode( ', ', $rgb_array_hover ); ?>, <?php echo ( $settings->opacity_hover / 100 ); ?> );
	<?php endif; ?>
	color: #<?php echo $settings->text_color_hover; ?> !important;
}

.fl-node-<?php echo $id; ?> .fl-node-content {
	text-align: <?php echo $settings->align; ?>;
}