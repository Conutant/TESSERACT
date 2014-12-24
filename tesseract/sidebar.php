<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Tesseract
 */

if ( ! is_active_sidebar || is_home ( 'sidebar-1' ) ) { /* Does not appear on frontpage */
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
