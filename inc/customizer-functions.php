<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/

// Add simple heading option to the theme customizer
if ( class_exists( 'WP_Customize_Control' ) ) :

    class Tesseract_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  
        
            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            ); ?>       
			
			<h4><?php echo wp_kses( $this->label, $allowed_html ); ?></h4>
			
<?php
        }
    }
	
	class Tesseract_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() { 
        
            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            ); ?>         
			
			<span class="description"><?php echo wp_kses( $this->label, $allowed_html ); ?></span>
			
<?php
        }
    }
	
	class Tesseract_Customize_Text_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="textfield"><?php echo esc_html( $this->label ); ?></span>
			
<?php
        }
    }
	
	class Tesseract_Customize_Button_Control extends WP_Customize_Control {
		
		public function render_content() {  ?>
			
            <span><?php echo esc_html( $this->label ); ?></span>
		
<?php
		
		}
	}	
	
	class Tesseract_Customize_Font_Control extends WP_Customize_Control {
	
		private $fonts = false;
		
		public function __construct($manager, $id, $args = array(), $options = array()) {
		
			$this->fonts = array(
				'Arial' => 'Arial',
				'Alef' => 'Alef',
				'Carme' => 'Carme',
				'Droid Sans' => 'Droid Sans',
				'Francois One' => 'Francois One',
				'Josefin Slab' => 'Josefin Slab',
				'Lobster' => 'Lobster',
				'Luckiest Guy' => 'Luckiest Guy',
				'Jockey One' => 'Jockey One',
				'Maven Pro' => 'Maven Pro',
				'Modern Antiqua' => 'Modern Antiqua',
				'Nobile' => 'Nobile',
				'Oswald' => 'Oswald',
				'Permanent Marker' => 'Permanent Marker',
				'Roboto' => 'Roboto',
				'Share' => 'Share',
				'Tahoma' => 'Tahoma',
				'Ubuntu' => 'Ubuntu',
				'Verdana' => 'Verdana');
			parent::__construct( $manager, $id, $args );
			
		}
		
		public function render_content() {
		
			if( !empty($this->fonts) ) :
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<div class="customize-font-select-control">
						<select <?php $this->link(); ?>>
							<?php
								foreach ( $this->fonts as $k => $v )
								{
									printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v);
								}
							?>
						</select>
					</div>
				</label>
                
            <?php
			endif;
		}
		
	}	

endif;

/*========================== CUSTOMIZER SANITIZE FUNCTIONS ==========================*/

function tesseract_sanitize_textarea_html( $value ) {

	$allowed = array(
		//container and button
		'p' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'div'     => array(),
		'input'    	=> array(
			'height'	=> array(),
			'name'		=> array(),
			'size' 		=> array(),
			'type' 		=> array(),
			'value'		=> array(),
			'width' 	=> array(),									
			'class' 	=> array(),
			'id'		=> array(),
			'style' 	=> array()		
		),
		'button'   	=> array(
			'name' 		=> array(),
			'type'		=> array(),
			'value' 	=> array(),
			'class' 	=> array(),
			'id'		=> array(),
			'style' 	=> array()		
		),
	
		//links
		'a'     => array(
			'href' 	=> array(),
			'target'=> array(),
			'name' 	=> array(),
			'class' => array(),
			'id'	=> array(),
			'style' => array()
		)	
	);
	
	$allowed_prot = array('http', 'https', 'mailto', 'news', 'irc', 'feed', 'tel');
		

	return wp_kses($value, $allowed, $allowed_prot);
	
	}

function tesseract_sanitize_checkbox( $value ) {

	if ( $value == 1) :
        return 1;
	else:
		return 0;
	endif;
}

function tesseract_sanitize_radio( $value ) {

	if ( $value == 1) :
        return 1;
	else:
		return '';
	endif;
}

function tesseract_blog_sanitize_content( $value ) {
	
	if ( ! in_array( $value, array( 'excerpt', 'content' ) ) ):
		$value = 'excerpt';
	endif;
	
	return $value;
	
	}

function tesseract_blog_sanitize_featimg_pos( $value ) {
	
	if ( ! in_array( $value, array( 'above', 'below' ) ) ):
		$value = 'above';
	endif;
	
	return $value;
	
	}

function tesseract_blog_sanitize_featimg_size( $value ) {

	if ( ! in_array( $value, array( 'default', 'tv', 'hdtv', 'theater1', 'theater2', 'pixel' ) ) ) :
        $value = 'default';
	endif;

    return $value;
	
	}

function tesseract_sanitize_radio_menuPos( $value ) {

	if ( ! in_array( $value, array( 'left', 'center' ) ) ) :
        $value = 'left';
	endif;

    return $value;
}

function tesseract_sanitize_radio_addcontentPos( $value ) {

	if ( ! in_array( $value, array( 'left', 'right' ) ) ) :
        $value = 'left';
	endif;

    return $value;
}

function tesseract_sanitize_radio_sepChar( $value ) {

	if ( ! in_array( $value, array( 'nothing', 'middot', 'line', 'circle', 'dash' ) ) ) :
        $value = 'nothing';
	endif;

    return $value;
}

function tesseract_sanitize_radio_nextToMenu_right( $value ) {

	if ( ! in_array( $value, array( 'nothing', 'buttons', 'social', 'contact', 'search', 'menu' ) ) ) :
        $value = 'buttons';
	endif;

    return $value;
}

function tesseract_sanitize_radio_nextToMenu_left( $value ) {

	if ( ! in_array( $value, array( 'nothing', 'logo', 'social', 'contact', 'search' ) ) ) :
        $value = 'search';
	endif;

    return $value;
}

function tesseract_sanitize_radio_mob_link_hover_background_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light', 'custom' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_radio_mob_shadow_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light', 'custom' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_radio_mob_search_background_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_radio_mob_social_background_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_radio_mob_buttons_background_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light', 'custom' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_radio_mob_maxbtn_sep_color( $value ) {
	
	if ( ! in_array( $value, array( 'dark', 'light' ) ) ) :
        $value = 'dark';
	endif;

    return $value;	
	
}

function tesseract_sanitize_select( $value ) {

	$tesseract_menu_selector_menus = get_terms( 'nav_menu' );	

	if ( $tesseract_menu_selector_menus ) :
		
		$tesseract_menu_selector_items = array();
		$item_keys = array( 'none' );
		foreach ( $tesseract_menu_selector_menus as $items )
			array_push( $item_keys, $items->slug);

	endif;		

	if ( in_array( $value, $item_keys ) ) :
        return $value;
	endif;
			
}

function tesseract_sanitize_select_header_height( $value ) {

	if ( in_array( $value, array( 'small', 'medium', 'large' ) ) ) :
        return $value;
	endif;
	
}

function tesseract_sanitize_select_header_width( $value ) {

	if ( in_array( $value, array( 'default', 'fullwidth' ) ) ) :
        return $value;
	endif;
	
}

function tesseract_sanitize_select_footer_width( $value ) {

	if ( in_array( $value, array( 'default', 'fullwidth' ) ) ) :
        return $value;
	endif;
	
}

function tesseract_sanitize_select_search_results_layout_types( $value ) {

	if ( ! in_array( $value, array( 'sidebar-left', 'sidebar-right', 'fullwidth' ) ) ) :
        $value = 'sidebar-left';
	endif;

    return $value;
			
}

function tesseract_sanitize_rgba( $value ) {
	
	//Check if string is rgba
	preg_match("/\s*(rgba\(\s*[0-9]+\s*,\s*[0-9]+\s*,\s*[0-9]+\s*,\d+\d*\.\d+\))/", $value, $match);
	$rgba = $match ? true : false; 
	
	preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", $value, $match);
	$hex = $match ? true : false;
	
	if ( $rgba || $hex )
		return $value;	

}

/*========================== ACTIVE CALLBACK FUNCTIONS ==========================*/

function tesseract_button_textarea_enable() {

	$textarea_enable = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $textarea_enable == 'buttons' ) ? true : false;
	
	return $bool;
	
}

function tesseract_header_content_menu_select_enable() {
	
	$select_enable = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $select_enable == 'menu' ) ? true : false;
	
	return $bool;

}

function tesseract_header_right_menu_select_enable() {
	
	$select_enable = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $select_enable == 'menu' ) ? true : false;
	
	return $bool;

}

function tesseract_mobmenu_link_hover_background_color_custom_enable() {

	$color_option = get_theme_mod( 'tesseract_mobmenu_link_hover_background_color' );
	$bool = ( $color_option == 'custom' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_shadow_color_custom_enable() {

	$color_option = get_theme_mod( 'tesseract_mobmenu_shadow_color' );
	$bool = ( $color_option == 'custom' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_search_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'search' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_buttons_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'buttons' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_social_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'social' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_additionals_buttons_header_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'buttons' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_additionals_social_header_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'social' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_additionals_search_header_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( $content_option == 'search' ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_buttons_background_color_custom_enable() {

	$color_option = get_theme_mod( 'tesseract_mobmenu_buttons_background_color' );
	$bool = ( ( $color_option == 'custom' ) && ( get_theme_mod( 'tesseract_header_right_content' ) == 'buttons' ) ) ? true : false;
	
	return $bool;	
	
}

function tesseract_mobmenu_maxbtn_sep_enable() {

	$content_option = get_theme_mod( 'tesseract_header_right_content' );
	$bool = ( ( $content_option == 'buttons' ) && is_plugin_active('maxbuttons/maxbuttons.php' ) ) ? true : false;
	
	return $bool;	
	
}

function tesseract_header_logo_height_enable() {

	$logo_url = get_theme_mod( 'tesseract_header_logo_image' );
	$bool = $logo_url ? true : false;
	
	return $bool;
	
}

function tesseract_header_widthProp_enable() {
	
	$hcContent = get_theme_mod('tesseract_header_right_content');
	$wooCart = get_theme_mod('tesseract_woocommerce_headercart');
	$displayWooCart = ( is_plugin_active('woocommerce/woocommerce.php') && ( $wooCart == 1 ) );
	$hcContent = ( !$displayWooCart && ( !$hcContent || !isset($hcContent) || ( $hcContent == 'nothing' ) ) );
	$bool = ( false == $hcContent ) ? true : false;
	
	return $bool;	
	
}

function tesseract_header_menu_options_enable() {
	
	$tesseract_menu_selector_menus = get_terms( 'nav_menu' );
	$bool = $tesseract_menu_selector_menus ? true : false;
	
	return $bool;

}

function tesseract_blog_featimg_sizes_enable() {

	$sizes_enable = get_theme_mod( 'tesseract_blog_display_featimg' );
	$bool = ( $sizes_enable == 1 ) ? true : false;
	
	return $bool;
	
}

function tesseract_blog_featimg_px_size_enable() {

	$size_enable = get_theme_mod( 'tesseract_blog_featimg_size' );
	$bool = ( $size_enable == 'pixel' ) ? true : false;
	
	return $bool;
	
}

function tesseract_footer_logo_enable() {

	$logo_enable = get_theme_mod( 'tesseract_footer_logo_enable' );
	$bool = ( $logo_enable == 1 ) ? true : false;
	
	return $bool;
	
}

function tesseract_footer_logo_height_enable() {

	$hlogo_url = get_theme_mod( 'tesseract_header_logo_image' );
	$flogo_url = get_theme_mod( 'tesseract_footer_logo_image' );
	$enable = ( get_theme_mod('tesseract_footer_logo_enable') == 1 ) ? true : false;
	$bool = ( ( $hlogo_url || $flogo_url ) && $enable ) ? true : false;
	
	return $bool;
	
}

function tesseract_footer_widthProp_enable() {

	$fcContent = get_theme_mod('tesseract_footer_right_content');
	$fcContent = ( is_string($fcContent) && ( $fcContent !== 'nothing' ) );
	$bool = ( $fcContent ) ? TRUE : FALSE;
	
	return $bool;
	
}