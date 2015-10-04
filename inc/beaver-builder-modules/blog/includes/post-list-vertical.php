<div class="tesseract-post tesseract-post-vertical">
	<div class="post-header">
		<?php if ( $settings->show_author == 'yes' || $settings->show_date == 'yes' ): ?>
		<div class="author-and-date">
			<?php if ( $settings->show_author == 'yes' ): ?>
			<?php echo sprintf( __( 'Posted by %s', 'tesseract' ), get_the_author() ); ?>
			<?php endif; ?>
			<?php if ( $settings->show_date == 'yes' ): ?>
				<?php if ( $settings->show_author == 'yes' ): ?>
				<?php echo __( 'on', 'tesseract' ); ?>
				<?php endif; ?>
			<?php echo get_the_time( get_option( 'date_format' ) ); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<h2 class="title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php if ( $settings->show_featured == 'yes' ): ?>
			<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<div class="featured-image">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="entry">
		<div class="content">
			<?php
				$permalink = get_the_permalink();
				$more_text = $settings->excerpt_more;

				add_filter( 'excerpt_more', function () use ( $permalink, $more_text ) {
					return '<a class="moretag" href="' . $permalink . '"> ' . $more_text . '</a>';
				}, 99 );
			?>
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>