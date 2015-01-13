<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tesseract
 */
?>

	</div><!-- #content -->
    
    <?php get_sidebar( 'footer' ); ?>
    
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-menu' ) ); ?>
			<div id="designer">
				<?php printf( __( '%1$s by %2$s', 'tesseract' ), 'Theme', '<a href="http://tyler.com/" rel="designer">Tyler Moore</a>' ); ?>
		    </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
