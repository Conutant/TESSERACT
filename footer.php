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
    
	<footer id="colophon" class="site-footer" role="contentinfo">      
	
		<?php $additional = get_theme_mod('tesseract_footer_additional_content') ? true : false;							

        $menuClass = 'only-menu';
        if ( $additional ) $menuClass = 'is-additional'; 
        
        $menuEnable = get_theme_mod('tesseract_footer_content_enable');
		$menuEnable = ( $menuEnable == 0 ) ? false : true;
		
        $addcontent_hml = get_theme_mod('tesseract_footer_additional_content');		
		$addcontent_hml = $addcontent_hml ? $addcontent_hml : 'notset';			
		
		$content = get_theme_mod('tesseract_footer_content_right_content');
		$content_default_button = get_theme_mod('tesseract_footer_content_right_if_button');
		
		$footerWidthClass = ( get_theme_mod('tesseract_footer_width') == 'fullwidth' ) ? ' footer-fullwidth' : ' footer-autowidth';
		
		if ( defined('TESSERACT_BRANDING_EXIST') ) {		
			if ( $content ) :
				$rightContentClass = ' mother-content-' . $content;
			elseif ( !$content && $content_default_button ) : 
				$rightContentClass = ' mother-content-notset mother-defbtn-isset';
			else:
				$rightContentClass = ' mother-content-notset mother-defbtn-isset';
			endif;
		} else {
			$rightContentClass = ' mother-branding';	
		} ?>
    
    	<div id="footer-banner" class="cf<?php echo ' menu-' . $menuClass; echo $rightContentClass . $footerWidthClass; ?>">		               
            <div id="horizontal-menu-wrap" class="<?php echo $menuClass . ' ' . $addcontent_hml; ?>">
            
                <?php // SHOUDLD some additional content added before the menu?
                if ( ( $addcontent_hml !== 'nothing' ) && ( $addcontent_hml !== 'notset' ) ) : ?>
                
                    <div id="horizontal-menu-before" class="switch thm-left-left<?php if ( $menuEnable == true ) echo ' is-menu'; ?>"><?php tesseract_horizontal_footer_menu_additional_content( $addcontent_hml ); ?></div>
                
                <?php endif; //EOF left menu - IS before content ?>
                
                <?php get_template_part( 'content', 'footer-navigation' ); ?>
                                                        
            </div><!-- EOF horizontal-menu-wrap -->                       
                  
            <?php tesseract_footer_branding(); ?>          
    
      	</div><!-- EOF footer-banner -->           
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
