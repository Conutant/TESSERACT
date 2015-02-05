<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tesseract
 */
?>

	</div><!-- #content -->
    
    <?php $footer_wrap_background_color = get_theme_mod('tesseract_footer_options_background_color'); ?>
    
	<footer id="colophon" class="site-footer" role="contentinfo">      

		<?php if ( get_theme_mod('tfo_footer_additional_content') ) $additional = true;							

        $menuClass = 'only-menu';
        if ( $additional ) $menuClass = 'is-additional'; 
        
        $menuEnable = get_theme_mod('tfo_footer_content_enable');
        $menuSelect = get_theme_mod('tfo_footer_content_select');
        $addcontent_hml = get_theme_mod('tfo_footer_additional_content');	
		?>
    
    	<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; if ( $footbarActive ) echo ' footbar-active'; ?>">		
			
			<?php // Let's start the map. Step 1 -> IF the user chooses to display a horizontal menu in the footer; 
            if ( $menuEnable ) : ?>                 
                    
                    <div id="horizontal-menu-wrap" class="<?php echo $menuClass . ' ' . $addcontent_hml; ?>">
                    
                        <?php // SHOUDLD some additional content added before the menu?
                        if ( $addcontent_hml !== 'nothing' ) : ?>
                        
                        	<div id="horizontal-menu-before" class="switch thm-left-left<?php if ( $menuSelect && ( $menuSelect !== 'none' ) ) echo ' is-menu'; ?>"><?php tesseract_horizontal_footer_menu_additional_content( $addcontent_hml ); ?></div>
                        
                        <?php endif; //EOF left menu - IS before content ?>
                        
                        <?php if ( $menuSelect !== 'none' ) : ?>
                            <section id="footer-horizontal-menu"<?php if ( $addcontent_hml !== 'nothing' ) echo ' class="is-before"'; ?>>
                                
                                <div>
                                        
                                    <?php wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'footer-menu', 'depth' => 1 ) ); ?>
                                    
                                </div>
                            
                            </section>   
                       	<?php endif; ?>                   
                                                
           			</div><!-- EOF horizontal-menu-wrap -->                       
                                
            <?php endif; //EOF IS menu ?>  
            
            <div id="designer">
                <?php printf( __( '%1$s by %2$s', 'tesseract' ), 'Theme', '<a href="http://tyler.com/">Tyler Moore</a>' ); ?>
            </div>            
            
      	</div>                  
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
