<?php if ( ! empty( $settings->lat ) ): ?>
var position = {
	lat: <?php echo $settings->lat; ?>,
	lng: <?php echo $settings->lng; ?>
};

initMap(
	new google.maps.Map( document.getElementById( 'map-module-<?php echo $module->node; ?>' ), {scrollwheel: false} ),
	position, <?php echo $settings->zoom; ?>
);
<?php endif; ?>