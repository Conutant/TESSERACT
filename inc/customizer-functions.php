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

function tesseract_sanitize_radio_nextToMenu_header( $value ) {

	if ( ! in_array( $value, array( 'nothing', 'buttons', 'social', 'contact', 'search' ) ) ) :
        $value = 'search';
	endif;

    return $value;
}

function tesseract_sanitize_radio_nextToMenu_footer( $value ) {

	if ( ! in_array( $value, array( 'nothing', 'logo', 'social', 'contact', 'search' ) ) ) :
        $value = 'search';
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

function tesseract_footer_content_enable_enable() {

	$tesseract_menu_selector_menus = get_terms( 'nav_menu' );
	$bool = $tesseract_menu_selector_menus ? true : false;
	
	return $bool;
	
}

function tesseract_footer_menu_options_enable() {
	
	$menu_enable = get_theme_mod( 'tesseract_tfo_footer_content_enable' );
	$bool = ( $menu_enable == 1 ) ? true : false;
	
	return $bool;

}

function tesseract_header_button_textarea_enable() {

	$textarea_enable = get_theme_mod( 'tesseract_tho_header_content_content' );
	$bool = ( $textarea_enable == 'buttons' ) ? true : false;
	
	return $bool;
	
}
