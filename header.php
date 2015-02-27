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
<?php //var_dump( get_theme_mods() ); ?>
<?php if ( get_terms( 'nav_menu' ) ) $anyMenu = true;
if ( $anyMenu ) : ?>

	<nav id="mobile-navigation" class="top-navigation" role="navigation">                        
		
		<?php $menuSelect = get_theme_mod('tesseract_tho_header_menu_select'); 
		if ( ( !$menuSelect ) || ( $menuSelect == 'none' ) ) : 
			wp_nav_menu( array( 'theme_location' => 'primary' ) );
		else :
			wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );
		endif;  ?>  
			
	</nav><!-- #site-navigation -->                

<?php endif; ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
    <a class="menu-open dashicons dashicons-menu" href="#mobile-navigation"><?php _e( 'Open Menu', 'tesseract' ); ?></a>
    <a class="menu-close dashicons dashicons-no" href="#"><?php _e( 'Close Menu', 'tesseract' ); ?></a>            
    

	<header id="masthead" class="site-header <?php echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    
    <?php $logoImg = get_theme_mod('tesseract_logo_image'); 
	$blogname = get_bloginfo('blogname'); 
	$headright_content = get_theme_mod('tesseract_tho_header_content_content');
	
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

                <?php if ( get_terms( 'nav_menu' ) ) $anyMenu = true;
                if ( $anyMenu ) : ?>

                    <nav id="site-navigation" class="main-navigation top-navigation" role="navigation">                        
                        <?php $menuSelect = get_theme_mod('tesseract_tho_header_menu_select'); 
                        if ( ( !$menuSelect ) || ( $menuSelect == 'none' ) ) : 
                            wp_nav_menu( array( 'theme_location' => 'primary' ) );
                        else :
                            wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );
                        endif;  ?>  
                            
                    </nav><!-- #site-navigation -->                

                <?Php endif; ?>

            </div>

            <?php if ( ( $headright_content ) && ( $headright_content !== 'nothing' ) ) : ?>            

                <div id="site-banner-right"><?php tesseract_header_right_content($headright_content); ?></div>

            <?php else : ?>
			
				<div id="site-banner-right">
                
                	<a href="/" class="button primary-button">Watch the Video</a>
                    <a href="/" class="button secondary-button">Start</a>
                
                </div>				
			
			<?php endif; ?>

        </div>            
        
	</header><!-- #masthead -->
        
    <?php if ( is_front_page() && get_header_image() ) : ?>
	
        <div id="header-image" class="featured-widget-area" role="complementary" style="background: url('<?php echo get_header_image(); ?>') repeat-y center center; background-size: cover; height: 480px;"></div> 
	
	<?php endif; ?>
    
    <div id="content" class="cf site-content">