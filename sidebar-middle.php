<?php
/**
 * Middle widget area.
 *
 * @package Tesseract
 */

if ( ! is_active_sidebar( 'sidebar-3' )  
  && ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<div id="middle-widgets" class="middle-widget-area" role="complementary">
    <div class="middle-widget-content">
        <div class="col-50">
	        <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </div><!-- col-50 -->
        <div class="col-50">
	        <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </div><!-- col-50 -->
    </div><!-- .middle-widget-content -->
</div><!-- #middle-widgets -->
