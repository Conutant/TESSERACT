<?php
/*  
 * section HEADER COLORS
 */		
	
   	$wp_customize->add_section( 'tesseract_tho_mobmenu' , array(
    	'title'      => __('Mobile Menu', 'tesseract'),
    	'priority'   => 7,
		'panel'      => 'tesseract_header_options'
	) );	
	
		//Register setting with the custom ALPHA enabled colorpicker
		// See full blog post here
		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/		
	
		$wp_customize->add_setting( 'tesseract_tho_mobmenu_opener', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default' 			=> 0
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_mobmenu_opener_control',
					array(
						'label'          => __( 'Check this to open mobile menu (this way you can see how it will look with your new mobile menu settings)', 'tesseract' ),
						'section'        => 'tesseract_tho_mobmenu',
						'settings'       => 'tesseract_tho_mobmenu_opener',
						'type'           => 'checkbox',
						'priority' 		 => 1	
					)
				)
			);	
			
		//Register setting with the custom ALPHA enabled colorpicker
		// See full blog post here
		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/		
	
		$wp_customize->add_setting( 'tesseract_tho_mobmenu_background_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#336ca6'
		) );

			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tho_mobmenu_background_color_control', 
				array(
					'label'      => __( 'Menu Background Color', 'tesseract' ),
					'section'    => 'tesseract_tho_mobmenu',
					'settings'   => 'tesseract_tho_mobmenu_background_color',
					'priority'   => 2
				) ) 						
			);		
			
			$wp_customize->add_setting( 'tesseract_tho_mobmenu_link_color', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#ffffff'
			) );
		
				$wp_customize->add_control( 
					new WP_Customize_Color_Control( 
					$wp_customize, 
					'tesseract_tho_mobmenu_link_color_control', 
					array(
						'label'      => __( 'Menu Link Color', 'tesseract' ),
						'section'    => 'tesseract_tho_mobmenu',
						'settings'   => 'tesseract_tho_mobmenu_link_color',
						'priority' 	 => 3
					) ) 						
				);	
				
			$wp_customize->add_setting( 'tesseract_tho_mobmenu_link_hover_color', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#ffffff'
			) );
		
				$wp_customize->add_control( 
					new WP_Customize_Color_Control( 
					$wp_customize, 
					'tesseract_tho_mobmenu_link_hover_color_control', 
					array(
						'label'      => __( 'Menu Link Hover Color', 'tesseract' ),
						'section'    => 'tesseract_tho_mobmenu',
						'settings'   => 'tesseract_tho_mobmenu_link_hover_color',
						'priority' 	 => 4
					) ) 						
				);	

			$wp_customize->add_setting( 'tesseract_tho_mobmenu_link_hover_background_color_header', array(
				'default'           => '',
				'type'           	=> 'option',
				'sanitize_callback' => '__return_false'
				)
			);
			
				$wp_customize->add_control( 
					new Tesseract_Customize_Header_Control(
					$wp_customize,
					'tesseract_tho_mobmenu_link_hover_background_color_header_control', 
					array(
						'label' =>  __('Menu Link Hover Background Color', 'tesseract' ),
						'section' => 'tesseract_tho_mobmenu',
						'settings' => 'tesseract_tho_mobmenu_link_hover_background_color_header',
						'priority' => 	5
						)
					)
				);	
				
			$wp_customize->add_setting( 'tesseract_tho_mobmenu_link_hover_background_color', array(
					'sanitize_callback' => 'tesseract_sanitize_radio_link_hover_background_color',
					'default'			=> 'dark'				
			) );
			
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_tho_mobmenu_link_hover_background_color_control',
						array(
							'section'        => 'tesseract_tho_mobmenu',
							'settings'       => 'tesseract_tho_mobmenu_link_hover_background_color',
							'type'           => 'radio',
							'choices' 		 => array( 
								'dark' 	 	=> __( 'Dark Opaque', 'tesseract'),
								'light' 	=> __( 'Light Opaque', 'tesseract'),
								'custom'	=> __( 'Custom Color', 'tesseract')						
							),
							'priority' 		 => 6
						)
					)
				);	
				
			$wp_customize->add_setting( 'tesseract_tho_mobmenu_link_hover_background_color_custom', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#285684'
			) );
		
				$wp_customize->add_control( 
					new WP_Customize_Color_Control( 
					$wp_customize, 
					'tesseract_tho_mobmenu_link_hover_background_color_custom_control', 
					array(
						'label'      => __( 'Choose custom color', 'tesseract' ),
						'section'    => 'tesseract_tho_mobmenu',
						'settings'   => 'tesseract_tho_mobmenu_link_hover_background_color_custom',
						'priority' 	 => 7,
						'active_callback' 	=> 'tesseract_tho_mobmenu_link_hover_background_color_custom_enable'
					) ) 						
				);					
				
														
