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
    
	<footer id="colophon" class="site-footer" role="contentinfo">      

		<?php $additional = get_theme_mod('tesseract_tfo_footer_additional_content') ? true : false;							

        $menuClass = 'only-menu';
        if ( $additional ) $menuClass = 'is-additional'; 
        
        $menuEnable = get_theme_mod('tesseract_tfo_footer_content_enable');
        $menuSelect = get_theme_mod('tesseract_tfo_footer_content_select');
        $addcontent_hml = get_theme_mod('tesseract_tfo_footer_additional_content');		
		$addcontent_hml = $addcontent_hml ? $addcontent_hml : 'notset';		
		?>
    
    	<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; ?>">		               
                    
                    <div id="horizontal-menu-wrap" class="<?php echo $menuClass . ' ' . $addcontent_hml; ?>">
                    
                        <?php // SHOUDLD some additional content added before the menu?
                        if ( ( $addcontent_hml !== 'nothing' ) && ( $addcontent_hml !== 'notset' ) ) : ?>
                        
                        	<div id="horizontal-menu-before" class="switch thm-left-left<?php if ( ( $menuEnable && ( $menuEnable == 1 ) ) || !$menuEnable ) echo ' is-menu'; ?>"><?php tesseract_horizontal_footer_menu_additional_content( $addcontent_hml ); ?></div>
                        
                        <?php endif; //EOF left menu - IS before content ?>
                        
                        <?php if ( ( $menuEnable && ( $menuEnable == 1 ) ) || !$menuEnable ) : ?>
                        
                            <section id="footer-horizontal-menu"<?php if ( $addcontent_hml && ( $addcontent_hml !== 'nothing' ) && ( $addcontent_hml !== 'notset' ) ) echo ' class="is-before"'; ?>>
                                <div>
                                    
                                    <?php $anyMenu = get_terms( 'nav_menu' ) ? true : false;
                                    
                                    if ( $anyMenu ) :
                                    
                                        if ( $menuSelect !== 'none' ) :  
                                            wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'footer-menu', 'depth' => 1 ) );
                                        elseif ( ( $menuSelect == 'none' ) || !$menuSelect || !$menuEnable ) :
                                            $menu = get_terms( 'nav_menu' ); 
                                            $menu_id = $menu[0]->term_id;						
                                            wp_nav_menu( array( 'menu_id' => $menu_id ) );																
                                        endif; ?>  
                                        
                                    <?php else : 
                                    
                                        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'depth' => 1 ) );
                                   
                                    endif; ?>   
                                                                          
                                </div>
                                
                            </section> 
                       
                       	<?php endif; ?>                   
                                                
           			</div><!-- EOF horizontal-menu-wrap -->                       
            
            <div id="designer">               
                <?php printf( __( 'Theme by %s', 'tesseract' ), '<a href="http://tyler.com">Tyler Moore</a>' ); ?>
            </div>            
            
      	</div>                  
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
