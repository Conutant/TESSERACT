<?php
/**
 * @package Tesseract
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && 'post' == get_post_type() ) {
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tesseract-large' ); ?>
        <div class="entry-background" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>)">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->
        </div><!-- .entry-background -->
    
    <?php } else { ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    <?php } ?>

	<div class="entry-content">
        <div class="entry-meta">
	        <?php tesseract_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tesseract' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->