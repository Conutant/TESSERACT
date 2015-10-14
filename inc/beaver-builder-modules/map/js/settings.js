(function($) {
	var builderObj;

	/* keep latitude and longitude values updated every time the settings load */
	FLBuilder.registerModuleHelper( 'map-module', {
        init: function() {
			builderObj = this;

			var form = $( '.fl-builder-settings' ),
				zoom = form.find( 'select[name=zoom]' ),
				query = form.find( 'input[name=query]' );

			/* calculate coordinates only if we don't have a query field entered */
			if ( query.val().trim() === '' ) {
				var pos = this._calculatePosition( false );

				builderObj._updatePosition( pos );
			}

			/* add onchange events for previewing */
			zoom.on( 'change', builderObj._previewMap );
			query.on( 'change', builderObj._previewMap );
		},
		_calculatePosition: function( render ) {
			if ( navigator.geolocation ) {
				navigator.geolocation.getCurrentPosition( function( result ) {
					var pos = {
						lat: result.coords.latitude,
						lng: result.coords.longitude
					};

					if ( render ) {
						var form = $( '.fl-builder-settings' );
						var zoom = parseInt( form.find( 'select[name=zoom]' ).val() );
						var position = new google.maps.LatLng( pos.lat, pos.lng );
						var map = new google.maps.Map( document.getElementById( 'map-module-' + form.data( 'node' ) ), {scrollwheel: false} );

						initMap( map, position, zoom );
					}

					return pos;
				});
			}
			else {
				alert( 'Please use a browser that supports Geolocation in order for the map module to get coordinates for the address' );
			}
		},
		_previewMap: function() {
			var form = $( '.fl-builder-settings' ),
				zoom = parseInt( form.find( 'select[name=zoom]' ).val() ),
				query = form.find( 'input[name=query]' ).val();

			if ( query.trim() === '' ) {
				var pos = builderObj._calculatePosition( true );
				builderObj._updatePosition( pos );
			}
			else {
				var geocoder = new google.maps.Geocoder();

				geocoder.geocode({
					address: query
				}, function( results ) {
					var pos = {
						lat: results[0].geometry.location.lat(),
						lng: results[0].geometry.location.lng()
					};

					builderObj._updatePosition( pos );

					var position = new google.maps.LatLng( pos.lat, pos.lng );
					var map = new google.maps.Map( document.getElementById( 'map-module-' + form.data( 'node' ) ), {scrollwheel: false} );

					initMap( map, position, zoom );
				});
			}
		},
		_updatePosition: function( pos ) {
			var form = $( '.fl-builder-settings' );

			form.find( 'input[name=lat]' ).attr( 'value', pos.lat );
			form.find( 'input[name=lng]' ).attr( 'value', pos.lng );
		}
	});
})(jQuery);