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

<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

</head>

<?php 

/* ----------------------------------------------------------- */

//Header classes - left block related meta/class
$leftMenu = get_theme_mod('tesseract_header_left_content_menu_select');

if ( $leftMenu == 'none' ) $leftclass = 'leftmenu-none ';
if ( !is_string($leftMenu) ) $leftclass = 'leftmenu-unset ';
if ( is_string( $leftMenu ) && ( $leftMenu !== 'none' ) ) $leftclass = 'leftmenu-set '; 

//Header classes - right block related meta/class
$headright_content = get_theme_mod('tesseract_header_right_content');
$rightMenu = get_theme_mod('tesseract_header_right_menu_select');
$wooheader = ( get_theme_mod('tesseract_woocommerce_headercart') == 1 ) ? true : false;
$mobmenu_toDefault = ( get_theme_mod('tesseract_mobmenu_to_default') == 1 ) ? TRUE : FALSE;

if ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) $rightclass = 'is-right ';	
if ( $headright_content == 'nothing' ) $rightclass = 'no-right ';

$rightclass .= $wooheader ? 'is-woo ' : 'no-woo ';
$rightclass .= ( $rightMenu == 'none' ) ? 'rightmenu-none ' : 'rightmenu-set ';
$rightclass .= ( $mobmenu_toDefault ) ? 'mobmenu-todefault ' : 'mobmenu-breakpoint ';

//Let's see which menu is used as main menu by the mobile menu script
$is_leftMenu = ( !is_string($leftMenu) || ( is_string($leftMenu) && ( $leftMenu !== 'none' ) ) );
$is_rightMenu = ( ( is_string($rightMenu) && ( $rightMenu !== 'none' ) ) && ( get_theme_mod('tesseract_header_right_content') == 'menu' ) );		
$is_both = ( $is_leftMenu && $is_rightMenu ) ? TRUE : FALSE;
$locSelected = get_theme_mod('tesseract_mobmenu_location_select');

$is_loc = is_string( $locSelected ) ? TRUE : FALSE;

if ( $is_both ) :
	$sidrMenu = ( is_string( $locSelected ) && ( $locSelected !== 'none' ) ) ? $locSelected : 'leftmenu-to-sidr'; 
elseif ( $is_leftMenu && !$is_rightMenu ) : $sidrMenu = 'leftmenu-to-sidr';
elseif ( !$is_leftMenu && $is_rightMenu ) : $sidrMenu = 'rightmenu-to-sidr';
elseif ( ($leftMenu == 'none') && ( $locSelected == 'leftmenu-to-sidr' ) || ($rightMenu == 'none') && ( $locSelected == 'rightmenu-to-sidr' ) ) : $sidrMenu = 'sidr-conflict';
else : $sidrMenu = FALSE; 
endif; 
$headpos = ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) ? 'pos-absolute' : 'pos-relative';

/* ----------------------------------------------------------- */

// Additional body classes
$bodyClass = ( version_compare($wp_version, '4.0.0', '>') && is_customize_preview() ) ? 'backend' : 'frontend';
$slayout = get_theme_mod('tesseract_search_results_layout');

if ( (is_page()) && (has_post_thumbnail()) ) $bodyClass .= ' tesseract-featured';
if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) $bodyClass .= ' beaver-on';

$opValue = get_theme_mod('tesseract_header_colors_bck_color_opacity');	
$header_bckOpacity = is_numeric($opValue) ? TRUE : FALSE;	
if ( is_front_page() && ( $header_bckOpacity && ( intval($opValue) < 100 ) ) ) $bodyClass .= ' transparent-header';	

if ( is_search() ) {
	if ( $slayout == 'fullwidth' ) $bodyClass .= ' fullwidth';
	if ( $slayout == 'sidebar-right' ) $bodyClass .= ' sidebar-right'; 	
	}
?>

<body <?php body_class( $leftclass . $rightclass . $sidrMenu . ' ' . $headpos ); ?>>	

<div id="page" class="hfeed site">
    
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
	<?php $logoImg = get_theme_mod('tesseract_header_left_content_logo_image'); 
    $blogname = get_bloginfo('blogname');
    $hmenusize = get_theme_mod('tesseract_header_width');
	
	$mmdisplay = get_theme_mod( 'tesseract_mobmenu_opener' ); 
	$mmdClass = ( $mmdisplay == 1 ) ? 'showit' : 'hideit';	
    
    $hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth'; 
    
    if ( !$logoImg && $blogname ) $brand_content = 'blogname';
    if ( $logoImg ) $brand_content = 'logo';
    if ( !$logoImg && !$blogname ) $brand_content = 'no-brand'; 
    
    ?>

    <header id="masthead" class="site-header <?php echo $leftclass . $rightclass . $sidrMenu . ' ' . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    
        <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">
            
            <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
                
                <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="" id="mobile-menu-trigger"></a></div>
				
                <div id="site-banner-left">                
					<div id="site-banner-left-inner">	
                    					
						<?php if ( $logoImg || $blogname ) { ?>
                            <div class="site-branding">
                                <?php if ( $logoImg ) : ?>
                                    <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
                                <?php else : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php endif; ?>
                            </div><!-- .site-branding -->
                        <?php } ?>
                        
                        <?php $menuSelected = get_theme_mod('tesseract_header_left_content_menu_select');
							
							if ( $menuSelected !== 'none' ) : ?>

                                <nav id="site-navigation" class="<?php echo $mmdClass; ?> main-navigation top-navigation <?php echo $hmenusize_class; ?>" role="navigation">
                                    <?php tesseract_output_menu( FALSE, FALSE, 'primary', 0 ); ?>
                                </nav><!-- #site-navigation -->
            				
                      	<?php endif; ?>
            
            		</div>
            	</div>
            
                <?php get_template_part( 'content', 'header-rightcontent' ); ?>
                
                <?php if ( $mobmenu_toDefault ) : ?>
					<div id="mobile-menu-trigger-right-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="" id="mobile-menu-trigger-right"></a></div>
             	<?php endif; ?>
                
            </div>
    
        </div>
        
    </header><!-- #masthead -->
    
    
    <div id="content" class="cf site-content">