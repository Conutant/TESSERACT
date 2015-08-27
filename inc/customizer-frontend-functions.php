<?php 

function tesseract_header_right_content( $content ) {
	
	switch( $content ) {

		// Step 1 -> nothing
		default:						
			break;						
		
		// Step 2 -> logo
		case 'buttons': 
			
			$code = get_theme_mod('tesseract_header_content_if_button');
			if ( ( get_theme_mod('tesseract_header_right_content') == 'buttons' ) && ( !$code || !isset($code) ) ) {
				echo '<div id="header-button-container"><div id="header-button-container-inner"><a href="/" class="button primary-button">Primary Button</a><a href="/" class="button secondary-button">Secondary Button</a></div></div>';	
			} else {
				echo '<div id="header-button-container"><div id="header-button-container-inner">' . do_shortcode( $code ) . '</div></div>';
			}
			
			break; 
			
		// Step 3 -> social
		case 'social': ?>
			
            <div class="social-wrapper cf">	
				<ul class="hr-social">
                	<?php $sn = array(
						'fb' => __( 'Facebook', 'tesseract' ),
						'tw' => __( 'Twitter', 'tesseract' ),
						'gplus' => __( 'Google Plus', 'tesseract' ),
						'li' => __( 'LinkedIn', 'tesseract' ),
						'yt' => __( 'YouTube', 'tesseract' ),
						'vim' => __( 'Vimeo', 'tesseract' ),
						'tumb' => __( 'Tumblr', 'tesseract' ),
						'fr' => __( 'FlickR', 'tesseract' ),
						'pin' => __( 'Pinterest', 'tesseract' ),
						'dr' => __( 'Dribbble', 'tesseract' )
					);
					
					foreach ( $sn as $sn_short => $sn_full ) {
						
						$sn_img = get_theme_mod('tesseract_' . $sn_short . '_image');
						$sn_url = get_theme_mod('tesseract_' . $sn_short . '_url');						
						
						if ( $sn_img && $sn_url ):
							echo '<li><a title="' . __( 'Follow Us on ', 'tesseract' ) . $sn_full . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_full . ' icon" /></a></li>';
						endif;
						
					} ?>

				</ul>
			</div>
            
		<?php break;
			
		// Step 5 -> search
		case 'search':
		
			get_search_form();
		
			break;	
			
		// Step 6 -> menu	
		case 'menu'; ?>
		
          	<nav id="header-right-menu" role="navigation">
				<?php tesseract_output_menu( FALSE, FALSE, 'primary_right', 0 ); ?>
			</nav>						
		
	<?php }
	
}


function tesseract_horizontal_footer_menu_additional_content( $content ) {
	
	$headerLogo = get_theme_mod('tesseract_header_logo_image');
	$footerLogo = get_theme_mod('tesseract_footer_logo_image');
	$footerLogoEnable = ( get_theme_mod('tesseract_footer_logo_enable') == 1 ) ? true : false;
	
	switch( $content ) {

		// Step 1 -> nothing
		default:						
			break;						
		
		// Step 2 -> logo
		case 'logo': 
			
			$logoImg = ( $footerLogoEnable && $footerLogo ) ? $footerLogo : $headerLogo;
			
			if ( $logoImg ) : ?>
			
				<div class="site-branding">								
					<h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logoImg; ?>" alt="logo" /></a></h1>
				</div>
				
			<?php else : ?>
			
				<div class="site-branding">								
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo('blogname'); ?></a></h1>
				</div>            
            
			<?php endif; 						
			break; 
			
		// Step 3 -> social
		case 'social': ?>
		
				<ul class="hm-social">
                	<?php $sn = array(
						'fb' => __( 'Facebook', 'tesseract' ),
						'tw' => __( 'Twitter', 'tesseract' ),
						'gplus' => __( 'Google Plus', 'tesseract' ),
						'li' => __( 'LinkedIn', 'tesseract' ),
						'yt' => __( 'YouTube', 'tesseract' ),
						'vim' => __( 'Vimeo', 'tesseract' ),
						'tumb' => __( 'Tumblr', 'tesseract' ),
						'fr' => __( 'FlickR', 'tesseract' ),
						'pin' => __( 'Pinterest', 'tesseract' ),
						'dr' => __( 'Dribbble', 'tesseract' )
					);
					
					foreach ( $sn as $sn_short => $sn_full ) {
						
						$sn_img = get_theme_mod('tesseract_' . $sn_short . '_image');
						$sn_url = get_theme_mod('tesseract_' . $sn_short . '_url');						
						
						if ( $sn_img && $sn_url ):
							echo '<li><a title="Follow Us on ' . $sn_full . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_full . ' icon" /></a></li>';
						endif;
						
					} ?>

				</ul>
		
			<?php break;
			
		// Step 5 -> search
		case 'search':
		
			get_search_form();
		
			break;						
		
	}
	
}

/**
 * Let's turn hex value into RGB
 * source at http://css-tricks.com/snippets/php/convert-hex-to-rgb/
 *
 */
   
function tesseract_hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}