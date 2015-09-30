<div class="tesseract-post tesseract-post-compact">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>">
		<?php if ( $settings->show_featured == 'yes' ): ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image">
					<?php the_post_thumbnail( 'medium' ); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( $settings->show_date == 'yes' ): ?>
			<div class="date">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</div>
		<?php endif; ?>
		</a>
		<?php if ( $settings->show_author == 'yes' ): ?>
		<div class="author">
			<?php the_author(); ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="entry">
		<h2 class="title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
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