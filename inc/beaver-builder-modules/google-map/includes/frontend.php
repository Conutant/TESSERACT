<?php
	if ( ! defined( 'GOOGLE_MAPS_API_KEY' ) )
		define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyD0QR0m_hwuRygluxvK13STDnmwyNFIdCk' );

	$wrapper_class = 'map-wrapper';

	if ( $settings->fullwidth == 'yes' ) {
		$wrapper_class .= '-full';
	}

	$map_src = 'https://www.google.com/maps/embed/v1/place?q=' . urlencode( $settings->query );
	$map_src .= '&zoom=' . $settings->zoom;
	$map_src .= '&key=' . GOOGLE_MAPS_API_KEY;
?>
<div class="<?php echo $wrapper_class; ?>">
	<iframe
		<?php if ( $settings->fullwidth == 'no' ): ?>
		width="<?php echo $settings->width; ?>"
		<?php endif; ?>
		height="<?php echo $settings->height; ?>"
		frameborder="0" style="border:0"
		src="<?php echo $map_src; ?>" allowfullscreen>
	</iframe>
</div>