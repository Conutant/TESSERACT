<?php
/**
 * Featured widget area.
 *
 * @package Tesseract
 */
?>

<div id="featured-widget" class="featured-widget-area" role="complementary">

<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

    <aside class="featured-widget">
	    <h1 class="widget-title"><?php _e( 'Headline', 'tesseract' ); ?></h1>
        <div class="textwidget">
		    <p><?php _e( 'Create a website and build your business.', 'tesseract' ); ?></p>
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button primary-button"><?php _e( 'Watch the Video', 'tesseract' ); ?></a>
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button secondary-button"><?php _e( 'Start', 'tesseract' ); ?></a>	
        </div>
    </aside><!-- .featured-widget -->

<?php endif; //end of sidebar-2 ?>

</div><!-- #featured-widget -->
