<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Tesseract
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) {
		
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tesseract-large' ); ?>
        <div class="entry-background" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>)">
            <?php if ( my_theme_show_page_header() ) : ?>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
          	<?php endif; ?>
        </div><!-- .entry-background -->
    
	<?php } else { ?>
    
		<?php if ( my_theme_show_page_header() ) : ?>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->
        <?php endif; ?>
	
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tesseract' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
