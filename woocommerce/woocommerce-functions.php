<?php 

global $layout;
global $isloop;
$layout = get_theme_mod('tesseract_woocommerce_loop_layout');
$isloop = ( is_shop() || is_product_category() || is_product_tag() ) ? true : false;

// Basic integration config
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'tesseract_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'tesseract_woocommerce_wrapper_end', 10);

function tesseract_woocommerce_wrapper_start() {
	
	$layout = get_theme_mod('tesseract_woocommerce_loop_layout');

	if ( ( $layout == 'sidebar-left' ) || ( $layout == 'sidebar-right' ) || ( !$layout ) ) {
		$primclass = 'with-sidebar';
		if ( $layout == 'sidebar-left' ) $primclass .= ' sidebar-left';
		if ( $layout == 'sidebar-right' ) $primclass .= ' sidebar-right';
	} else if ( $layout == 'fullwidth' ) {
		$primclass = 'no-sidebar';
	}
  
  echo '<div id="primary" class="content-area ' . $primclass . '">';

}

function tesseract_woocommerce_wrapper_end() {
  echo '</div>';
}

if ( ( !function_exists('loop_shop_columns') ) && 
   ( ( $layout == 'sidebar-left' ) || ( $layout == 'sidebar-right' ) || ( !$layout ) ) ) {
	
		// Change number or products per row to 2
		add_filter('loop_shop_columns', 'tesseract_loop_columns'); 
		   
		function tesseract_loop_columns() {
			return 2; // 3 products per row
		}
	
}


// Ensure cart contents update when products are added to the cart via AJAX
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

// Output shopping cart in header
function tesseract_wc_output_cart() {
	ob_start(); ?>
                           
	<div class="woocart-header">                        	
		<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
	</div>
    
    <?php $output = ob_get_contents();
    ob_end_clean();
    
    echo $output;
}

