<?php
	$wrapper_styles = "height: {$settings->height}px;";
	$wrapper_styles .= ( $settings->fullwidth == 'yes' ) ? ' width: 100%;' : " width: {$settings->width}px;";
?>
<div id="map-module-<?php echo $module->node; ?>" style="<?php echo $wrapper_styles; ?>"></div>