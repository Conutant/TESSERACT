<?php
/*  
 * section HEADER MENU
 */					 			
	
$tesseract_menu_selector_menus = get_terms( 'nav_menu' );		
if ( $tesseract_menu_selector_menus ) :
			
   	$wp_customize->add_section( 'tesseract_tho_header_menu' , array(
    	'title'      => __('Header Menu', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_header_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_tho_header_menu_size', array(
			'sanitize_callback' => 'tesseract_sanitize_select_header_menu_size',
			'default' 			=> 'medium'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_header_menu_size_control',
					array(
						'label'          => __( 'Choose the menu height', 'tesseract' ),
						'section'        => 'tesseract_tho_header_menu',
						'settings'       => 'tesseract_tho_header_menu_size',
						'type'           => 'select',
						'choices'        => array(
							'none'	=> '',
							'small'	=> 'Small',
							'medium'=> 'Medium',
							'large'	=> 'Large'	
						),
						'priority' 		 => 1										
					)
				)
			);			
			
		$tesseract_menu_selector_items = array();
		$item_keys = array( 'none' ); $item_values = array( '' );
		foreach ( $tesseract_menu_selector_menus as $items ) {
			array_push( $item_keys, $items->slug);
			array_push( $item_values, $items->name);
		}
		
		$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );					
	
		$menu_id = $tesseract_menu_selector_menus[0]->term_id;						
		$default_menu = $tesseract_menu_selector_menus ? wp_nav_menu( array( 'menu_id' => $menu_id, 'echo' => false ) ) : wp_nav_menu( array( 'echo' => false ) );		
	
		$wp_customize->add_setting( 'tesseract_tho_header_menu_select', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> $default_menu
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_header_content_select_control',
					array(
						'label'          => __( 'Choose the menu to be displayed in the header', 'tesseract' ),
						'section'        => 'tesseract_tho_header_menu',
						'settings'       => 'tesseract_tho_header_menu_select',
						'type'           => 'select',
						'choices'        => $tesseract_menu_selector_items,
						'priority' 		 => 2									
					)
				)
			);			
					
endif;