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
			<?php printf( __( 'Tesseract %1$s by %2$s', 'tesseract' ), 'Theme', '<a href="http://tyler.com/" rel="designer">Tyler Moore</a>' ); ?>
			<span class="sep"> / </span>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'tesseract' ) ); ?>"><?php printf( __( 'Runs on %s', 'tesseract' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
