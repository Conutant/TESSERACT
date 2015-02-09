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

<noscript>
	<style>
	
		#sidebar-footer aside {
			border: none!important;
			}
	
	</style>
</noscript>

<?php wp_head(); ?>

<?php $header_bckRGB = get_theme_mod('tho_header_colors_bck_color');
$header_bckOpacity = get_theme_mod('tho_header_colors_bck_color_opacity');
$header_textColor = get_theme_mod('tho_header_colors_text_color');
$header_linkColor = get_theme_mod('tho_header_colors_link_color');
$header_linkHoverColor = get_theme_mod('tho_header_colors_link_hover_color');

$footer_bckColor = get_theme_mod('tfo_footer_colors_bck_color');
$footer_textColor = get_theme_mod('tfo_footer_colors_text_color');
$footer_headingColor = get_theme_mod('tfo_footer_colors_heading_color');
$footer_linkColor = get_theme_mod('tfo_footer_colors_link_color');
$footer_linkHoverColor = get_theme_mod('tfo_footer_colors_link_hover_color'); 

$hex = $header_bckRGB;
$header_bckOpacity = $header_bckOpacity / 100;

preg_match("/\s*(rgba\(\s*[0-9]+\s*,\s*[0-9]+\s*,\s*[0-9]+\s*,\d+\d*\.\d+\))/", $hex, $match);
$rgba = $match ? true : false; 

if ( !$rgba ) {
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$header_bckColor = "rgb($r, $g, $b)";
	$header_bckColor_home = "rgba($r, $g, $b, $header_bckOpacity)";
} else {
	sscanf($hex, 'rgb(%d,%d,%d,)', $r, $g, $b);
	$header_bckColor = "rgb($r, $g, $b)";
	$header_bckColor_home = "rgba($r, $g, $b, $header_bckOpacity)";
}

?>

<style>

.site-header,
.main-navigation ul ul a { background-color: <?php echo $header_bckColor; ?>; }

.home .site-header,
.home .main-navigation ul ul a { background-color: <?php echo $header_bckColor_home; ?>; }

.site-header,
.site-header h1, 
.site-header h2,
.site-header h3,
.site-header h4,
.site-header h5,
.site-header h6 { color: <?php echo $header_textColor; ?>; }

.site-header a,
.main-navigation ul ul a,
.menu-open,
.dashicons.menu-open,
.menu-close,
.dashicons.menu-close { color: <?php echo $header_linkColor; ?>; }

.site-header a:hover,
.main-navigation ul ul a:hover,
.menu-open:hover,
.dashicons.menu-open:hover,
.menu-close:hover,
.dashicons.menu-open:hover { color: <?php echo $header_linkHoverColor; ?>; }

#colophon { 
	background-color: <?php echo $footer_bckColor; ?>;
	color: <?php echo $footer_textColor; ?> 
}
#colophon h1, 
#colophon h2,
#colophon h3,
#colophon h4,
#colophon h5,
#colophon h6 { color: <?php echo $footer_headingColor; ?>; }

#colophon a { color: <?php echo $footer_linkColor; ?>; }

#colophon a:hover { color: <?php echo $footer_linkHoverColor; ?>; }	

<?php $add_content_borderColor_array = tesseract_hex2rgb( $footer_linkColor );
$add_content_borderColor = implode( ', ', $add_content_borderColor_array ); ?>

#horizontal-menu-before,
#horizontal-menu-after { border-color: rgba(<?php echo $add_content_borderColor; ?>, 0.25); }

#footer-banner.footbar-active { border-color: rgba(<?php echo $add_content_borderColor; ?>, 0.15); }

</style>

</head>

<body <?php body_class(); ?>>
<?php //var_dump( get_theme_mods() ); ?>
<?php if ( get_terms( 'nav_menu' ) ) $anyMenu = true;
if ( $anyMenu ) : ?>

	<nav id="mobile-navigation" class="top-navigation" role="navigation">                        
		
		<?php $menuSelect = get_theme_mod('tho_header_menu_select'); 
		if ( ( !$menuSelect ) || ( $menuSelect == 'none' ) ) : 
			wp_nav_menu( array( 'theme_location' => 'primary' ) );
		else :
			wp_nav_menu( array( 'menu' => $menuSelect, 'container_class' => 'header-menu' ) );
		endif;  ?>  
			
	</nav><!-- #site-navigation -->                

<?php endif; ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>
    
    <a class="menu-open dashicons dashicons-menu" href="#mobile-navigation"><?php _e( '', 'tesseract' ); ?></a>
    <a class="menu-close dashicons dashicons-no" href="#"><?php _e( '', 'tesseract' ); ?></a>            
    

	<header id="masthead" class="site-header" role="banner">
    
    <?php $logoImg = get_theme_mod('tesseract_logo_image'); 
	$blogname = get_bloginfo('blogname'); 
	$headright_content = get_theme_mod('tho_header_content_content');
	
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
                        <?php $menuSelect = get_theme_mod('tho_header_menu_select'); 
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

            <?php endif; ?>

        </div>            
        
	</header><!-- #masthead -->
        
    <?php if ( is_home() ) : ?>
	
        <div id="header-image" class="featured-widget-area" role="complementary" style="background: url('<?php echo get_header_image(); ?>') repeat-y center center; background-size: cover; height: 480px;"></div> 
	
	<?php endif; ?>
    
    <div id="content" class="cf site-content">