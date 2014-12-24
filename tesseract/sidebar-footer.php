<?php
/**
 * Footer widget area.
 *
 * @package Tesseract
 */

if ( ! is_active_sidebar( 'sidebar-5' )  
  && ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}
?>

<div id="footer-widgets" class="footer-widget-area" role="complementary">
    <div class="footer-widget-content">
        <div class="col-50">
	        <?php dynamic_sidebar( 'sidebar-5' ); ?>
        </div><!-- col-50 -->
        <div class="col-50">
	        <?php dynamic_sidebar( 'sidebar-6' ); ?>
        </div><!-- col-50 -->
    </div><!-- .footer-widget-content -->
</div><!-- #footer-widgets -->
