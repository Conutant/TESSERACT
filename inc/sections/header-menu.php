<?php
/*  
 * section HEADER MENU
 */					 			
			
   	$wp_customize->add_section( 'tho_header_menu' , array(
    	'title'      => __('Header Menu', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_header_options'
	) );		
		
		$tesseract_menu_selector_menus = get_terms( 'nav_menu' );	
	
		if ( $tesseract_menu_selector_menus ) :
			
			$tesseract_menu_selector_items = array();
			$item_keys = array( 'none' ); $item_values = array( '' );
			foreach ( $tesseract_menu_selector_menus as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}
	
		endif;
		
		$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );					
	
		$wp_customize->add_setting( 'tho_header_menu_select', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tho_header_content_select_control',
					array(
						'label'          => __( 'Choose the menu to be displayed in the header', 'tesseract' ),
						'section'        => 'tho_header_menu',
						'settings'       => 'tho_header_menu_select',
						'type'           => 'select',
						'choices'        => $tesseract_menu_selector_items,
						'priority' 		 => 1									
					)
				)
			);			
					
