<?php
/**
 * @package Tesseract
 */
?>
<?php if ( has_post_thumbnail() && 'post' == get_post_type() ) {
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tesseract-large' ); ?>
	<div class="img">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<img src="<?php echo esc_url( $thumbnail[0] ); ?>" width="500">
	</div><!-- .entry-background -->

<?php } else { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
        <div class="entry-meta">
	        <?php tesseract_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tesseract' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php tesseract_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
