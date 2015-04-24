<?php
/**
 * The template used for displaying header navigation in header.php
 *
 * @package Tesseract
 */
?>

<?php $hmenusize = get_theme_mod('tesseract_tho_header_width'); 
$hmenusep = get_theme_mod('tesseract_tho_header_menu_sep'); 

$hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth'; 

if ( $hmenusize == 'fullwidth' ) :

	if ( !$hmenusep || ( $hmenusep == 'none' ) ) {
		$hmenusep_class = 'noborder';
	} else {
		$hmenusep_class = ( $hmenusep == 'dark' ) ? 'withborder borderdark' : 'withborder borderlight';	
	}

endif;
?>

<?php 	$mmdisplay = get_theme_mod( 'tesseract_tho_mobmenu_opener' ); 
		$mmdClass = ( $mmdisplay == 1 ) ? 'showit' : 'hideit';
?>

<nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; if ( $hmenusize == 'fullwidth' ) echo ' ' . $hmenusep_class; ?>" role="navigation">
    
    <?php $anyMenu = get_terms( 'nav_menu' ) ? true : false;
          $menuSelect = get_theme_mod('tesseract_tho_header_menu_select');
    
        if ( $anyMenu && ( ( $menuSelect ) && ( $menuSelect !== 'none' ) ) ) : 	
            wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu', 'container' => false ) );             		
        elseif ( $anyMenu && ( !$menuSelect || ( $menuSelect == 'none' ) ) ) :
            $menu = get_terms( 'nav_menu' );  
            
            //Check if a menu is assigned to the location 'primary'
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container' => false ) );                        
            //If there isn't, then display the first menu in the list of menus thrown by the function get_terms( 'nav_menu' )
            else :
                $menu_id = $menu[0]->term_id;				
                wp_nav_menu( array( 'menu_id' => $menu_id, 'container' => false ) ); 
            endif;
            
        elseif ( !$anyMenu ) :
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container' => false ) );                        
        endif; ?>

</nav><!-- #site-navigation -->