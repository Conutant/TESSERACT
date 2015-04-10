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
		
		$content = get_theme_mod('tesseract_tfo_footer_content_right_content');
		$content_default_button = get_theme_mod('tesseract_tfo_footer_content_right_if_button');
		
		$footerWidthClass = ( get_theme_mod('tesseract_tfo_footer_width') == 'fullwidth' ) ? ' footer-fullwidth' : ' footer-autowidth';
		
		if ( defined('TESSERACT_BRANDING_EXIST') ) {		
			if ( $content ) :
				$rightContentClass = ' mother-content-' . $content;
			elseif ( !$content && $content_default_button ) : 
				$rightContentClass = ' mother-content-notset mother-defbtn-isset';
			else:
				$rightContentClass = ' mother-content-notset mother-defbtn-isset';
			endif;
		} else {
			$rightContentClass = ' mother-branding';	
		} ?>
    
    	<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; echo $rightContentClass . $footerWidthClass; ?>">		               
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

                                    //Check if a menu is assigned to the location 'secondary'
                                    if ( has_nav_menu( 'secondary' ) ) :
                                        wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) );                        
                                    //If there isn't, then display the first menu in the list of menus thrown by the function get_terms( 'nav_menu' )
                                    else :
                                        $menu_id = $menu[0]->term_id;
                                        wp_nav_menu( array( 'menu_id' => $menu_id ) ); 
                                    endif;
                                                        
                                endif; ?>  
                                
                            <?php else : 
                            
                                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'depth' => 1 ) );
                           
                            endif; ?>   
                                                                  
                        </div>
                        
                    </section> 
               
                <?php endif; ?>                   
                                        
            </div><!-- EOF horizontal-menu-wrap -->                       
                  
            <?php tesseract_footer_branding(); ?>          
    
      	</div><!-- EOF footer-banner -->           
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
