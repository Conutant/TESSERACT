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
	    <h1 class="widget-title"><?php _e( get_theme_mod('featured_text'), 'tesseract' ); ?></h1>
        <div class="textwidget">
		    <p><?php _e( 'Create a website and build your business.', 'tesseract' ); ?></p>
		    <div id="action_buttons">
		    <?php
		    $featured_action_button =get_theme_mod('featured_action_button');
		     if(isset($featured_action_button)):
		    	echo $featured_action_button;
		    else:
		    ?>
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button primary-button"><?php _e( 'Watch the Video', 'tesseract' ); ?></a>
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button secondary-button"><?php _e( 'Start', 'tesseract' ); ?></a>
            <?php  endif;?>
            </div>
        </div>
    </aside><!-- .featured-widget -->

<?php endif; //end of sidebar-2 ?>

</div><!-- #featured-widget -->
