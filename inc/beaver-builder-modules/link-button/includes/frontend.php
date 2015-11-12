<?php
	$icon = '';
	$icon_style = '';

	if ( ! empty( $settings->icon ) ) {
		if ( $settings->icon === 'fa' ) {
			$icon = "fa {$settings->fa_icon}";
			if ( ! empty( $settings->fa_icon_size ) ) {
				$icon .= " fa-{$settings->fa_icon_size}";
			}
		}
		else {
			$icon = "typcn {$settings->typ_icon}";
			if ( $settings->typ_icon_size != 100 ) {
				$icon_style = 'style="font-size: ' . $settings->typ_icon_size . '%;"';
			}
		}
	}
?>
<a class="button" href="<?php echo $settings->href; ?>" target="<?php echo $settings->target; ?>">
	<?php if ( ! empty( $icon ) && $settings->icon_position === 'left' ): ?>
	<span class="<?php echo $icon; ?>" <?php echo $icon_style; ?>></span>
	<?php endif; ?>
    <?php echo $settings->text; ?>
	<?php if ( ! empty( $icon ) && $settings->icon_position === 'right' ): ?>
	<span class="<?php echo $icon; ?>" <?php echo $icon_style; ?>></span>
	<?php endif; ?>
</a>