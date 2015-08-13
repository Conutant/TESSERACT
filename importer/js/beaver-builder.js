jQuery( function ( $ ) {
	// Create a "Content Blocks" button in the header of the Page Builder
	$( '.fl-builder-bar-actions .fl-builder-tools-button' ).after(
		'<span class="fl-builder-tesseract-blocks-button fl-builder-button">Content Blocks</span>'
	);

	// Set up the popup/modal using Beaver Builder's UI
	var contentBlocksLightbox = new FLLightbox({
		className: 'fl-builder-tesseract-blocks-lightbox'
	});

	// When the user clicks the "Content Blocks" button...
	$( '.fl-builder-tesseract-blocks-button' ).on( 'click', function() {
		// Open the modal
		contentBlocksLightbox.open( $( '#tesseract-content-blocks-wrapper' ).html() );

		// Hook the cancel button to close the modal
		$( '.fl-builder-tesseract-blocks-lightbox .fl-builder-cancel-button' ).on( 'click', function ( e ) {
			e.preventDefault();
			contentBlocksLightbox.close();
		} );

		// Hook the content appending buttons up
		$( '.fl-builder-tesseract-blocks-lightbox .append-content-button' ).on( 'click', function ( e ) {
			e.preventDefault();

			contentBlocksLightbox.close();
			FLBuilder._applyTemplate( $( this ).data( 'template-id' ), true, 'user' );
		} );
	} );
} );