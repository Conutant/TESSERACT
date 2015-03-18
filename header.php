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

<body <?php body_class(); ?>>

<nav id="mobile-navigation" class="top-navigation" role="navigation">

	<?php $anyMenu = get_terms( 'nav_menu' ) ? true : false;
    	  $menuSelect = get_theme_mod('tesseract_tho_header_menu_select');
                    
		if ( $anyMenu && ( ( $menuSelect ) && ( $menuSelect !== 'none' ) ) ) : 	
			wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );               		
		elseif ( $anyMenu && ( !$menuSelect || ( $menuSelect == 'none' ) ) ) :
			$menu = get_terms( 'nav_menu' ); 
			$menu_id = $menu[0]->term_id;						
			wp_nav_menu( array( 'menu_id' => $menu_id ) );
		elseif ( !$anyMenu ) :
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );                        
		endif; ?>

</nav><!-- #site-navigation -->  	

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
    <a class="menu-open dashicons dashicons-menu" href="#mobile-navigation"></a>
    <a class="menu-close dashicons dashicons-no" href="#"></a>            
    

	<header id="masthead" class="site-header <?php echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    
    <?php $logoImg = get_theme_mod('tesseract_logo_image'); 
	$blogname = get_bloginfo('blogname'); 
	$headright_content = get_theme_mod('tesseract_tho_header_content_content');
	$headright_content_default_button = get_theme_mod('tesseract_tho_header_content_if_button');
	
	if ( !$logoImg && $blogname ) $brand_content = 'blogname';
	if ( $logoImg ) $brand_content = 'logo';
	if ( !$logoImg && !$blogname ) $brand_content = 'no-brand'; 

	?>
    
        <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  ' is-right' : ' no-right'; ?>">               
            
            <div id="site-banner-left" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
				
                <?php if ( $logoImg || $blogname ) { ?>
                    <div class="site-branding">
                        <?php if ( $logoImg ) : ?>
                            <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
                        <?php else : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
              	<?php } ?>
				
                <nav id="site-navigation" class="main-navigation top-navigation" role="navigation">
                	
					<?php $anyMenu = get_terms( 'nav_menu' ) ? true : false;
                          $menuSelect = get_theme_mod('tesseract_tho_header_menu_select');
                    
						if ( $anyMenu && ( ( $menuSelect ) && ( $menuSelect !== 'none' ) ) ) : 	
							wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );               		
						elseif ( $anyMenu && ( !$menuSelect || ( $menuSelect == 'none' ) ) ) :
							$menu = get_terms( 'nav_menu' ); 
							$menu_id = $menu[0]->term_id;						
							wp_nav_menu( array( 'menu_id' => $menu_id ) );
						elseif ( !$anyMenu ) :
							wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );                        
						endif; ?>

				</nav><!-- #site-navigation --> 
                
            </div>

            <?php if ( $headright_content ) : ?>            

               	<div id="site-banner-right">
			
					<?php tesseract_header_right_content($headright_content); ?>                  
                   
             	</div>
         	
			<?php elseif ( !$headright_content && $headright_content_default_button ) : ?>            

            	<div id="site-banner-right">
                
                    <div id="header-button-container">
                        <div id="header-button-container-inner">
                            <?php echo $headright_content_default_button; ?>
                        </div>
                    </div> 
                   
               </div>

            <?php else : ?>
			
				<div id="site-banner-right">
                
                	<div id="header-button-container">
                    	<div id="header-button-container-inner">
                        	<a href="/" class="button primary-button">Primary Button</a>
                    		<a href="/" class="button secondary-button">Secondary Button</a>
                		</div>
                   	</div>
                </div>				
			
			<?php endif; ?>

        </div>            
        
	</header><!-- #masthead -->
    
    <div id="content" class="cf site-content">
