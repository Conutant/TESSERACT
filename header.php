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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tesseract' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
    <div class="site-banner">
		<div class="site-branding">
			<!--  ignore sit -->

			<?php if(!get_theme_mod('theme_logo')): ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else:?>
			<h1 class="site-title">
			<img width="45" height="45" src="<?php echo get_theme_mod('theme_logo');?>"/>
			</h1>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( '', 'tesseract' ); ?></button>
			<?php
				 wp_nav_menu( array( 'theme_location' => 'primary' ) );

			?>
		</nav><!-- #site-navigation -->
    </div><!-- .site-banner -->
	</header><!-- #masthead -->

	<?php if ( get_header_image() && is_home() ) : ?>
		<div class="site-header-image" style="background-image: url('<?php header_image(); ?>')"></div>
	<?php endif; // End header image check. ?>

    <?php if ( is_home() )
	    get_sidebar( 'featured' ) || get_sidebar( 'middle' );
	?>
    <div id="content" class="site-content">