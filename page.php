<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Tesseract
 */

get_header(); 

if ( is_plugin_active('woocommerce/woocommerce.php') ) :
	
	$layout_default = get_theme_mod('tesseract_woocommerce_default_layout');
	
	if ( ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) {
		$primclass = 'with-sidebar';
		if ( $layout_default == 'sidebar-left' ) $primclass .= ' sidebar-left';
		if ( $layout_default == 'sidebar-right' ) $primclass .= ' sidebar-right';
	} else if ( ( $layout_default == 'fullwidth' ) || ( !$layout_default ) ) {
		$primclass = 'no-sidebar';
	} else {
		$primclass = 'sidebar-default';	
}

endif;
?>

	<div id="primary" class="content-area <?php echo $primclass; ?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( !is_plugin_active('woocommerce/woocommerce.php') || ( is_plugin_active('woocommerce/woocommerce.php') && ( ( $layout_default == 'sidebar-left' ) || ( $layout_default == 'sidebar-right' ) ) ) ) get_sidebar(); ?>
    
<?php get_footer(); ?>
