<div class="tesseract-post tesseract-post-compact">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image">
					<?php the_post_thumbnail( 'medium' ); ?>
				</div>
			<?php endif; ?>
			<div class="date">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</div>
		</a>
		<div class="author">
			<?php the_author(); ?>
		</div>
	</div>
	<div class="entry">
		<h2 class="title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>