<?php
/**
 * Navigation Widget Area
 *
 * @package Tesseract
 */
?>
<?php if ( ! dynamic_sidebar( 'nav-sidebar' ) ) : ?>
        <div class="textwidget">
		    <p><?php _e( 'Create a website and build your business.', 'tesseract' ); ?></p>
		    <div id="action_buttons">
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button primary-button"><?php _e( 'Watch the Video', 'tesseract' ); ?></a>
            <a href="<?php echo esc_url( __( '/', 'tesseract' ) ); ?>" class="button secondary-button"><?php _e( 'Start', 'tesseract' ); ?></a>
            </div>
        </div>
<?php endif; //end of nav-sidebar ?>

