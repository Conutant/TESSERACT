<?php
/**
 * @package Tesseract
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && 'post' == get_post_type() ) { ?>
        <div class="img">
            <header class="entry-header">
               <?php the_title( '<h1 class="entry-title"><a href="' . get_the_permalink() . '">', '</a></h1>' ); ?>
            </header><!-- .entry-header -->
            <?php the_post_thumbnail( 'tesseract-large' ); ?>
        </div><!-- .entry-background -->
    
    <?php } else { ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title"><a href="' . get_the_permalink() . '">', '</a></h1>' ); ?>
        </header><!-- .entry-header -->
    <?php } ?>

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

</article><!-- #post-## -->
