<?php 
$is_headright_content = is_string( get_theme_mod('tesseract_header_right_content') );
$headright_content = ( $is_headright_content ) ? get_theme_mod('tesseract_header_right_content') : 'no-right-content';
$headright_content_default_button = get_theme_mod('tesseract_header_content_if_button');
$wc_headercart = ( get_theme_mod('tesseract_woocommerce_headercart') == 1 ) ? true : false;

?>

<div id="site-banner-right" class="banner-right <?php echo $headright_content; ?>">

<?php if ( $is_headright_content ) : ?>            

	<?php tesseract_header_right_content($headright_content); ?>                    
			
<?php elseif ( !$is_headright_content && $headright_content_default_button ) : ?>            

    <div id="header-button-container">
        <div id="header-button-container-inner">
            <?php echo $headright_content_default_button; ?>
        </div>
    </div>
		
<?php else : ?>
	  
    <div id="header-button-container">
        <div id="header-button-container-inner">
            <a href="/" class="button primary-button">Primary Button</a>
            <a href="/" class="button secondary-button">Secondary Button</a>
        </div>
    </div>
		
<?php endif; ?>   

	<?php if ( is_plugin_active('woocommerce/woocommerce.php') && $wc_headercart ) tesseract_wc_output_cart(); ?> 

</div>