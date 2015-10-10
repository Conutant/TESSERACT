function initMap( map, position, zoom ) {
	map.setCenter( position );
	map.setZoom( zoom );

	var marker = new google.maps.Marker({
		position: position,
		map: map
	});
}