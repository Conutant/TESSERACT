<?php

if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

add_action( 'wp_footer', 'tesseract_add_button_to_page_builder' );

/**
 * Adds HTML to the bottom of the Beaver Builder Page Builder interface, which is used in a
 * modal to allow content blocks to be added to the page.
 */
function tesseract_add_button_to_page_builder() {
	if ( ! FLBuilderModel::is_builder_active() ) {
		return;
	}

	$templates_query = new WP_Query( array(
		'post_type' => 'fl-builder-template',
		'meta_key' => Tesseract_Importer_Constants::$CONTENT_BLOCK_META_KEY,
		'meta_value' => 1,
		'posts_per_page' => 999
	) );
	?>
		<div id="tesseract-content-blocks-wrapper">
			<div class="cancel-wrapper">
				<span class="fl-builder-cancel-button fl-builder-button fl-builder-button-primary fl-builder-button-large">Cancel</span>
			</div>
			<?php while ( $templates_query->have_posts() ) : $templates_query->the_post(); ?>
				<?php $template_id = get_the_ID(); ?>
				<?php
					global $post;
					$slug = $post->post_name;
				?>
				<div class="content-block slug-<?php echo esc_attr( $slug ); ?>"
					style="background-image: url('<?php echo(esc_attr(get_stylesheet_directory_uri()))?>/images/content-blocks/<?php echo(esc_attr($slug))?>.jpg')">
					<a href="#" class="append-content-button" data-template-id="<?php echo esc_attr( $template_id ); ?>">
						<?php the_title(); ?>
					</a>
				</div>
			<?php endwhile; ?>
			<div class="cancel-wrapper">
				<span class="fl-builder-cancel-button fl-builder-button fl-builder-button-primary fl-builder-button-large">Cancel</span>
			</div>
		</div>
	<?php
}

function tesseract_enqueue_beaver_builder_scripts() {
	if ( FLBuilderModel::is_builder_active() ) {
		wp_enqueue_script( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/js/beaver-builder.js', array( 'jquery' ) );
		wp_enqueue_style( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/css/beaver-builder.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'tesseract_enqueue_beaver_builder_scripts' );