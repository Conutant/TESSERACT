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

<?php // Additional body classes
$bodyClass = ( version_compare($wp_version, '4.0.0', '>') && is_customize_preview() ) ? 'backend' : 'frontend';
if ( (is_page()) && (has_post_thumbnail()) ) $bodyClass .= ' tesseract-featured';
if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) $bodyClass .= ' beaver-on';

$bckOpacity = get_theme_mod('tesseract_header_colors_bck_color_opacity');
if ( is_front_page() && $bckOpacity && ( $bckOpacity < 100 ) ) $bodyClass .= ' transparent-header'; ?>

<body <?php body_class( $bodyClass ); ?>>	

<?php $headright_content = get_theme_mod('tesseract_header_content_content');
$wooheader = ( get_theme_mod('tesseract_woocommerce_headercart') == 1 ) ? true : false;
if ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) {
	$rightclass = $wooheader ? $headright_content . ' is-right is-woo ' : $headright_content . ' is-right no-woo ';	
} else if ( ( $headright_content == 'nothing' ) && $wooheader ) {
	$rightclass = $wooheader ? $headright_content . ' no-right is-woo ' : $headright_content . ' no-right no-woo ';	
} ?>

<div id="page" class="hfeed site">
    
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
	<?php $logoImg = get_theme_mod('tesseract_header_logo_image'); 
    $blogname = get_bloginfo('blogname');
    $hmenusize = get_theme_mod('tesseract_header_width');
    
    $hmenusize_class = ( $hmenusize == 'fullwidth' ) ? 'fullwidth' : 'autowidth'; 
    
    if ( !$logoImg && $blogname ) $brand_content = 'blogname';
    if ( $logoImg ) $brand_content = 'logo';
    if ( !$logoImg && !$blogname ) $brand_content = 'no-brand'; 
    
    ?>
    
    <?php $bckOpacity = get_theme_mod('tesseract_header_colors_bck_color_opacity');
    $headpos = ( $bckOpacity && ( $bckOpacity !== 100 ) ) ? 'pos-absolute' : 'pos-relative';
    ?>

    <header id="masthead" class="site-header <?php echo $rightclass . $headpos . ' ' . 'menusize-' . $hmenusize_class . ' '; echo get_header_image() ? 'is-header-image' : 'no-header-image'; ?>" role="banner">
    
        <div id="site-banner" class="cf<?php echo ' ' . $headright_content . ' ' . $brand_content; ?>">
            
            <div id="site-banner-main" class="<?php echo ( ( $headright_content  ) && ( $headright_content !== 'nothing' ) ) ?  'is-right' : 'no-right'; ?>">
                
                <div id="mobile-menu-trigger-wrap" class="cf"><a class="<?php echo $rightclass; ?>menu-open dashicons dashicons-menu" href="" id="mobile-menu-trigger"></a></div>
                
                <?php if ( $logoImg || $blogname ) { ?>
                    <div class="site-branding">
                        <?php if ( $logoImg ) : ?>
                            <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
                        <?php else : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
                <?php } ?>
                
                <?php get_template_part( 'content', 'header-navigation' ); ?>
            
                <?php get_template_part( 'content', 'header-rightcontent' ); ?>
                
            </div>
    
        </div>
        
    </header><!-- #masthead -->
    
    
    <div id="content" class="cf site-content">