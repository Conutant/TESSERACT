<?php $headright_content = get_theme_mod('tesseract_header_content_content');
$headright_content_default_button = get_theme_mod('tesseract_header_content_if_button');
$wc_headercart = ( get_theme_mod('tesseract_woocommerce_headercart') == 1 ) ? true : false;
?>

            <?php if ( $headright_content ) : ?>            

                <div id="site-banner-right" class="banner-right">
				
					<?php tesseract_header_right_content($headright_content); ?>
                    
					<?php if ( is_plugin_active('woocommerce/woocommerce.php') && $wc_headercart ) tesseract_wc_output_cart(); ?>                     
                    
              	</div>
                
          	<?php elseif ( ( !isset($headright_content) || !$headright_content ) && $headright_content_default_button ) : ?>            

                <div id="site-banner-right" class="banner-right">
                 
                	<div id="header-button-container">
                    	<div id="header-button-container-inner">
                        	<?php echo $headright_content_default_button; ?>
                		</div>
                   	</div>
                    
                    <?php if ( is_plugin_active('woocommerce/woocommerce.php') && $wc_headercart ) tesseract_wc_output_cart(); ?> 
                    
                </div>

            <?php else : ?>
			
				<div id="site-banner-right" class="banner-right">      
                          
                	<div id="header-button-container">
                    	<div id="header-button-container-inner">
                        	<a href="/" class="button primary-button">Primary Button</a>
                    		<a href="/" class="button secondary-button">Secondary Button</a>
                		</div>
                   	</div>
                    
                    <?php if ( is_plugin_active('woocommerce/woocommerce.php') && $wc_headercart ) tesseract_wc_output_cart(); ?> 
                    
                </div>				
			
			<?php endif; ?>   
