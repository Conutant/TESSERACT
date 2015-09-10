<?php

// Get the query data. NULL because we have query-related settings yet.
$query = FLBuilderLoop::query( NULL );

?>
<?php if( $query->have_posts() ) : ?>
	<div class="tesseract-post-list">
		<?php while( $query->have_posts() ) : $query->the_post(); ?>
			<?php include $module->dir . 'includes/post-list-' . $settings->post_display . '.php'; ?>
		<?php endwhile; ?>
	</div>
	<div class="tesseract-pagination">
		<?php FLBuilderLoop::pagination( $query ); ?>
	</div>
<?php endif; ?>
<?php if( ! $query->have_posts() && ( defined('DOING_AJAX') || isset($_REQUEST['fl_builder'] ) ) ) : ?>
	<div class="fl-post-grid-empty"><?php _e( 'No posts found.', 'fl-builder' ); ?></div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>