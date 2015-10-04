<?php
	if ( ! defined( 'GOOGLE_MAPS_API_KEY' ) )
		define( 'GOOGLE_MAPS_API_KEY', 'AIzaSyD0QR0m_hwuRygluxvK13STDnmwyNFIdCk' );

	if ( ! defined( 'GOOGLE_MAPS_STATIC_API_KEY' ) )
		define( 'GOOGLE_MAPS_STATIC_API_KEY', 'AIzaSyBnar7IcYUBu--NbsfEbnV-sQpwcb0YSKs' );

	$wrapper_class = 'map-wrapper';

	if ( $settings->fullwidth == 'yes' && $settings->map_type === 'interactive' ) {
		$wrapper_class .= '-full';
	}
?>

<?php if ( $settings->map_type === 'static' ): ?>
	<div class="<?php echo $wrapper_class; ?>">
		<?php
			$map_src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . urlencode( $settings->query );
			$map_src .= '&zoom=' . $settings->zoom;
			$map_src .= '&markers=' . urlencode( $settings->query );
			$map_src .= '&size=640x640&scale=2&key=' . GOOGLE_MAPS_STATIC_API_KEY;
		?>
		<img src="<?php echo $map_src; ?>" />
	</div>
<?php else: ?>
	<?php
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
<?php endif; ?>