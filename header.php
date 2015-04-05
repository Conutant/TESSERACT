<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Tesseract
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<?php $bodyclass = ( (is_page()) && (has_post_thumbnail()) ) ? 'tesseract-featured' : false; ?> 

<body <?php body_class( $bodyclass ); ?>>

<nav id="mobile-navigation" class="top-navigation" role="navigation">

	<?php $anyMenu = get_terms( 'nav_menu' ) ? true : false;
    	  $menuSelect = get_theme_mod('tesseract_tho_header_menu_select');
                    
        if ( $anyMenu && ( ( $menuSelect ) && ( $menuSelect !== 'none' ) ) ) : 	
            wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );             		
        elseif ( $anyMenu && ( !$menuSelect || ( $menuSelect == 'none' ) ) ) :
            $menu = get_terms( 'nav_menu' );  
            
            //Check if a menu is assigned to the location 'primary'
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );                        
            //If there isn't, then display the first menu in the list of menus thrown by the function get_terms( 'nav_menu' )
            else :
                $menu_id = $menu[0]->term_id;				
                wp_nav_menu( array( 'menu_id' => $menu_id ) ); 
            endif;
            
        elseif ( !$anyMenu ) :
            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );                        
        endif; ?>

</nav><!-- #site-navigation -->  	

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
    <a class="menu-open dashicons dashicons-menu" href="#mobile-navigation"></a>
    <a class="menu-close dashicons dashicons-no" href="#"></a>            
    

    <?php $logoImg = get_theme_mod('tesseract_logo_image'); 
	$blogname = get_bloginfo('blogname'); 
	$headersize = get_theme_mod('tesseract_tho_header_size');
	$headright_content = get_theme_mod('tesseract_tho_header_content_content');
	$hmenusize = get_theme_mod('tesseract_tho_header_menu_size');
	
	$hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth'; 
	
	if ( !$logoImg && $blogname ) $brand_content = 'blogname';
	if ( $logoImg ) $brand_content = 'logo';
	if ( !$logoImg && !$blogname ) $brand_content = 'no-brand'; 

	?>

	<?php $mastclass = ( $headersize == 'none' ) ? 'menu-default' : 'menu-' . $headersize; ?>
    
    <header id="masthead" class="site-header <?php echo $mastclass . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    
        <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  ' is-right' : ' no-right'; ?>">               
            
            <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
				
                <?php if ( $logoImg || $blogname ) { ?>
                    <div class="site-branding">
                        <?php if ( $logoImg ) : ?>
                            <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
                        <?php else : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
              	<?php } ?>
				
				<?php if ( !$hmenusize || ( $hmenusize == 'default' ) ) get_template_part( 'content', 'header-navigation' ); ?> 
            
				<?php get_template_part( 'content', 'header-rightcontent' ); ?>            
                
            </div>
                        
            <?php if ( $hmenusize == 'fullwidth' ) get_template_part( 'content', 'header-navigation' ); ?>    

        </div>            
        
	</header><!-- #masthead -->
    
    <div id="content" class="cf site-content">