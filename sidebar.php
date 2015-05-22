<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Tesseract
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || is_home () ) { /* Does not appear on frontpage */
	return;
}

if ( is_plugin_active('woocommerce/woocommerce.php') ) {
	
	$layout_loop = get_theme_mod('tesseract_woocommerce_loop_layout');
	$layout_product = get_theme_mod('tesseract_woocommerce_product_layout');
	$layout_default = get_theme_mod('tesseract_woocommerce_default_layout');	
	
	if ( ( is_shop() || is_product_category() || is_product_tag() ) && ( $layout_loop == 'sidebar-right' ) ) { 	
		$sidebarClass = 'woo-archive woo-right-sidebar'; 
	} else if ( is_product() && $layout_product == 'sidebar-right' ) {
		$sidebarClass = 'woo-product woo-right-sidebar';
	} else {
		$sidebarClass = 'sidebar-default';
	}
} ?>

<div id="secondary" class="widget-area <?php echo $sidebarClass; ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
