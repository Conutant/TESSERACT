jQuery( function( $ ) {
	$( '.package-form' ).on( 'submit', function( e ) {
		// var message =
		// 	"Heads up! Importing this package will create " +
		// 	$( this ).data( 'num-pages' ) +
		// 	" pages/posts and update some of your site's settings.\n\n" +
		// 	"You probably shouldn't do this import if your site is already visible to the public.\n\n" +
		// 	"Continue with the import?";

		var message = "Are you sure you want to import this package?";

		if ( ! confirm( message ) ) {
			e.preventDefault();
		}
	} );
	$( '.wrap' ).each( function() {
		var highestBox = 0;
		$( '.package', this ).each( function() {
			if ( $( this ).height() > highestBox ) {
				highestBox = $(this).height();
			}
		} );

		$( '.package', this ).height( highestBox );
	});
} );