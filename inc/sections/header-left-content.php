<?php
/*  
 * section HEADER LOGO
 */	
 
   	$wp_customize->add_section( 'tesseract_header_left_content' , array(
    	'title'      => __('Header Left Block Content', 'tesseract'),
    	'priority'   => 3,
		'panel'		 => 'tesseract_header_options'
	) );	

		$wp_customize->add_setting( 'tesseract_header_left_content_logo_image', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_header_left_content_logo_image_control',
					   array(
						   'label'      => __( 'Upload Header Logo', 'tesseract' ),
						   'section'    => 'tesseract_header_left_content',
						   'settings'   => 'tesseract_header_left_content_logo_image',
						   'priority' 	=> 2
					   )
				   )
			   );
			   
		$wp_customize->add_setting( 'tesseract_header_left_content_logo_height', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
				'default' 			=> 40
		) );			
			
			$wp_customize->add_control( 'tesseract_header_left_content_logo_height_control', array(
				'type'        		=> 'range',
				'priority'    		=> 2,
				'section'     		=> 'tesseract_header_left_content',
				'settings'     		=> 'tesseract_header_left_content_logo_height',
				'label'       		=> 'Header Logo Height',
				'description' 		=> 'Use this range slider to set header logo height',
				'input_attrs' 		=> array(
					'min'   => 30,
					'max'   => 130,
					'step'  => 5,
					'class' => 'tesseract-tho-header-logo-height',
					'style' => 'color: #0a0',
				),
				'active_callback' 	=> 'tesseract_header_left_content_logo_height_enable',
				'priority' 			=> 3
			) );
			
		$tesseract_menu_selector_menus = get_terms( 'nav_menu' );		
		
		if ( $tesseract_menu_selector_menus ) :
				
			$tesseract_menu_selector_items = array();
			$item_keys = array( 'none' ); $item_values = array( 'None' );
			foreach ( $tesseract_menu_selector_menus as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}
			
			$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );
			 
			$wp_customize->add_setting( 'tesseract_header_left_content_menu_select', array(
				'sanitize_callback' => 'tesseract_sanitize_select',
				'default' 			=> FALSE
			) );
			
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_header_left_content_menu_select_control',
						array(
							'label'          => __( 'Select Header Left Menu', 'tesseract' ),
							'section'        => 'tesseract_header_left_content',
							'settings'       => 'tesseract_header_left_content_menu_select',
							'type'           => 'select',
							'choices'        => $tesseract_menu_selector_items,
							'priority' 		 => 4							
						)
					)
				);			
						
		endif;
						
			   
			   