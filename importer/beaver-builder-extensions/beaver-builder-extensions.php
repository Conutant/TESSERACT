<?php

if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

add_action( 'wp_footer', 'tesseract_add_button_to_page_builder' );

function tesseract_add_button_to_page_builder() {
	if ( ! FLBuilderModel::is_builder_active() ) {
		return;
	}

	?>
	<script type="text/javascript">
		jQuery( function ( $ ) {
			$( '.fl-builder-bar-actions .fl-builder-tools-button' ).after(
				'<span class="fl-builder-tesseract-blocks-button fl-builder-button">Content Blocks</span>'
			);

			var contentBlocksLightbox = new FLLightbox({
				className: 'fl-builder-tesseract-blocks-lightbox'
			});

			$( '.fl-builder-tesseract-blocks-button' ).on( 'click', function() {
				contentBlocksLightbox.open( '<h1> know what I mean, vern </h1>' );
			} );
		} );
	</script>
	<?php
}