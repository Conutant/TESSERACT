<?php

if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

add_action( 'wp_footer', 'tesseract_add_button_to_page_builder' );

function tesseract_add_button_to_page_builder() {
	if ( ! FLBuilderModel::is_builder_active() ) {
		return;
	}

	$templates_query = new WP_Query( array(
		'post_type' => 'fl-builder-template',
		'meta_key' => '_imported_content_block',
		'meta_value' => 1,
		'posts_per_page' => 999
	) );
	?>
		<div id="tesseract-content-blocks-wrapper">
			<?php while ( $templates_query->have_posts() ) : $templates_query->the_post(); ?>
				<?php $template_id = get_the_ID(); ?>
				<div class="content-block">
					<a href="#" class="append-content-button" data-template-id="<?php echo esc_attr( $template_id ); ?>">
						<?php the_title(); ?>
					</a>
				</div>
			<?php endwhile; ?>
		</div>
	<?php
}

add_action( 'wp_enqueue_scripts', 'tesseract_enqueue_beaver_builder_scripts' );

function tesseract_enqueue_beaver_builder_scripts() {
	if ( FLBuilderModel::is_builder_active() ) {
		wp_enqueue_script( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/js/beaver-builder.js', array( 'jquery' ) );
		wp_enqueue_style( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/css/beaver-builder.css' );
	}
}