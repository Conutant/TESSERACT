<?php
/*  
 * section FOOTER CONTENT
 */					 			
			
   	$wp_customize->add_section( 'tesseract_footer_left_content' , array(
    	'title'      => __('Footer Left Block Content', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_footer_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_footer_left_content_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_footer_left_content_header_control', 
				array(
					'label' =>  __('Choose the content to be displayed in the footer', 'tesseract' ),
					'section' => 'tesseract_footer_left_content',
					'settings' => 'tesseract_footer_left_content_header',
					'priority' => 	1
					)
				)
			);						
			
		$wp_customize->add_setting( 'tesseract_footer_additional_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_left',
				'default'			=> 'nothing'				
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_footer_additional_content_control',
					array(
						'section'        => 'tesseract_footer_left_content',
						'settings'       => 'tesseract_footer_additional_content',
						'type'           => 'radio',
						'choices' 		 => array( 
							'nothing' 	 => 'Nothing',
							'logo' 		 => 'Logo',
							'social'     => 'Social Icons',
							'search' 	 => 'Search Bar'						
						),
						'priority' 		 => 2,
						''
					)
				)
			);	
			
		$wp_customize->add_setting( 'tesseract_footer_left_search_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#cccccc'
		) );

			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_footer_left_search_color_control', 
				array(
					'label'      		=> __( 'Search Field Text Color', 'tesseract' ),
					'section'    		=> 'tesseract_footer_left_content',
					'settings'   		=> 'tesseract_footer_left_search_color',
					'priority'   		=> 3,
					'active_callback' 	=> 'tesseract_footer_left_search_color_options_enable'
				) ) 						
			);			
			
		$wp_customize->add_setting( 'tesseract_footer_left_search_background_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#ffffff'
		) );

			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_footer_left_search_background_color_control', 
				array(
					'label'      		=> __( 'Search Field Background Color', 'tesseract' ),
					'section'    		=> 'tesseract_footer_left_content',
					'settings'   		=> 'tesseract_footer_left_search_background_color',
					'priority'   		=> 4,
					'active_callback'	=> 'tesseract_footer_left_search_color_options_enable'
				) ) 						
			);				

		$wp_customize->add_setting( 'tesseract_footer_left_content_logo_image', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_footer_left_content_logo_image_control',
					   array(
						   'label'      		=> __( 'Upload Footer Logo', 'tesseract' ),
						   'section'    		=> 'tesseract_footer_left_content',
						   'settings'   		=> 'tesseract_footer_left_content_logo_image',
						   'priority' 			=> 5,
						   'active_callback' 	=> 'tesseract_footer_left_content_logo_image_enable'
					   )
				   )
			   );
			   
		$wp_customize->add_setting( 'tesseract_footer_left_content_logo_height', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
				'default' 			=> 40
		) );			
			
			$wp_customize->add_control( 'tesseract_footer_left_content_logo_height_control', array(
				'type'        		=> 'range',
				'section'     		=> 'tesseract_footer_left_content',
				'settings'     		=> 'tesseract_footer_left_content_logo_height',
				'label'       		=> 'Footer Logo Height',
				'description' 		=> 'Use this range slider to set footer logo height',
				'input_attrs' 		=> array(
					'min'   => 30,
					'max'   => 130,
					'step'  => 5,
					'class' => 'tesseract-tfo-footer-logo-height',
					'style' => 'color: #0a0',
				),
				'active_callback' 	=> 'tesseract_footer_left_content_logo_height_enable',
				'priority' 			=> 5
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
		
			$wp_customize->add_setting( 'tesseract_footer_menu_select', array(
				'sanitize_callback' => 'tesseract_sanitize_select'
			) );
			
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_footer_menu_select_control',
						array(
							'label'          => __( 'Select Footer Left Menu', 'tesseract' ),
							'section'        => 'tesseract_footer_left_content',
							'settings'       => 'tesseract_footer_menu_select',
							'type'           => 'select',
							'choices'        => $tesseract_menu_selector_items,
							'priority' 		 => 7									
						)
					)
				);	
		endif;			