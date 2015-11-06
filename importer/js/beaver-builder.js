jQuery(function ( $ ) {
	// Create a "Content Blocks" button in the header of the Page Builder
	$( '.fl-builder-bar-actions .fl-builder-tools-button' ).after(
		'<span class="fl-builder-tesseract-blocks-button fl-builder-button">Content Blocks</span>'
	);

	// Set up the popup/modal using Beaver Builder's UI
	var contentBlocksLightbox = new FLLightbox({
		className: 'fl-builder-tesseract-blocks-lightbox'
	});

	// When the user clicks the "Content Blocks" button...
	$( document ).on( 'click', '.fl-builder-tesseract-blocks-button', function() {
		// Open the modal
		contentBlocksLightbox.open( $( '#tesseract-content-blocks-wrapper' ).html() );

		// Hook the cancel button to close the modal
		$( document ).on( 'click', '.fl-builder-tesseract-blocks-lightbox .fl-builder-cancel-button', function ( e ) {
			e.preventDefault();
			contentBlocksLightbox.close();
		} );

		// Hook the content appending buttons up
		$( document ).on( 'click', '.fl-builder-tesseract-blocks-lightbox .append-content-button', function ( e ) {
			e.preventDefault();

			contentBlocksLightbox.close();
			FLBuilder._applyTemplate( $( this ).data( 'template-id' ), true, 'user' );
		} );
	} );

	// check for content blocks updates
	$( document ).on( 'click', '.fl-builder-blocks-update', function() {
		var $icon = $( this ).find( '.fa.fa-refresh' );
		var data = {
			action: 'tesseract_content_blocks_update'
		};

		$icon.addClass( 'fa-spin' ).css( 'animation-duration', '1s' );

		$.post( ajaxurl, data, function() {
			$icon.removeClass( 'fa-spin' );

			$.post( ajaxurl, {action: 'tesseract_add_button_to_page_builder'}, function( blocksHtml ) {
				$( '.fl-lightbox-content' ).html( $( blocksHtml ).html() );
			});
		});
	});
});