<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Tesseract
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || is_home () ) { /* Does not appear on frontpage */
	return;
}
?>

<div id="secondary" class="widget-area<?php if ( is_plugin_active('woocommerce/woocommerce.php') && is_woocommerce() && ( get_theme_mod('tesseract_woocommerce_loop_layout') == 'sidebar-right' ) ) echo ' woo-right-sidebar'; ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
