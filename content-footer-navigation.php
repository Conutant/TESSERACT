<?php
/**
 * The template used for displaying footer navigation in footer.php
 *
 * @package Tesseract
 */
?>

<?php 
$menuSelect = get_theme_mod('tesseract_footer_content_select');

$menuEnable = get_theme_mod('tesseract_footer_content_enable');
$menuEnable = ( $menuEnable == 0 ) ? false : true;

$addcontent_hml = get_theme_mod('tesseract_footer_additional_content');		
$addcontent_hml = $addcontent_hml ? $addcontent_hml : 'notset';	

$anyMenu = get_terms( 'nav_menu' ) ? true : false;
?>

<section id="footer-horizontal-menu"<?php if ( $addcontent_hml && ( $addcontent_hml !== 'nothing' ) && ( $addcontent_hml !== 'notset' ) ) echo ' class="is-before"'; ?>>
    <div class="cf">
  		
        <?php if ( $menuEnable == true ) :
        
			if ( $anyMenu ) :
			
				if ( $menuSelect !== 'none' ) :  
					wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'footer-menu', 'depth' => 1 ) );
				elseif ( ( $menuSelect == 'none' ) || ( !$menuSelect  || !isset($menuSelect) ) ) :
					$menu = get_terms( 'nav_menu' ); 
	
					//Check if a menu is assigned to the location 'secondary'
					if ( has_nav_menu( 'secondary' ) ) :
						wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'depth' => 1 ) );                        
					//If there isn't, then display the first menu in the list of menus thrown by the function get_terms( 'nav_menu' )
					else : 
						$menu_id = $menu[0]->term_id;
						wp_nav_menu( array( 'menu_id' => $menu_id, 'depth' => 1 ) ); 
					endif;
										
				endif; ?>  
				
			<?php else : 
			
				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'depth' => 1 ) );
		   
			endif;  
            
		else:

			$menu = get_terms( 'nav_menu' ); 
		
			//Check if a menu is assigned to the location 'secondary'
			if ( has_nav_menu( 'secondary' ) ) :
				wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'depth' => 1 ) );                        
			//If there isn't, then display the first menu in the list of menus thrown by the function get_terms( 'nav_menu' )
			else : 
				$menu_id = $menu[0]->term_id;
				wp_nav_menu( array( 'menu_id' => $menu_id, 'depth' => 1 ) ); 

			endif;
               
		endif; ?>
    
    </div>
    
</section>            
                                           