<div class="tesseract-post tesseract-post-vertical">
	<div class="post-header">
		<div class="author-and-date">
			<?php echo sprintf( __( 'Posted by %s', 'tesseract' ), get_the_author() ); ?>
			<?php echo sprintf( __( 'on %s' ), get_the_time( get_option( 'date_format' ) ) ); ?>
		</div>
		<h2 class="title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<div class="featured-image">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			</a>
		<?php endif; ?>
	</div>
	<div class="entry">
		<div class="content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>