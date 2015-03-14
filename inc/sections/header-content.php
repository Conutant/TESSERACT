<?php
/*  
 * section HEADER RIGHT CONTENT
 */					 			
			
   	$wp_customize->add_section( 'tesseract_tho_header_content' , array(
    	'title'      => __('Header Right Block Content', 'tesseract'),
    	'priority'   => 6,
		'panel'      => 'tesseract_header_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_tho_header_content_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_tho_header_content_header_control', 
				array(
					'label' =>  __('Choose the content to be displayed in the right block of the header area', 'tesseract' ),
					'section' => 'tesseract_tho_header_content',
					'settings' => 'tesseract_tho_header_content_header',
					'priority' => 	1
					)
				)
			);						
			
		$wp_customize->add_setting( 'tesseract_tho_header_content_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_header',
				'default'			=> 'buttons'				
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_header_content_content_control',
					array(
						'section'        => 'tesseract_tho_header_content',
						'settings'       => 'tesseract_tho_header_content_content',
						'type'           => 'radio',
						'choices' 		 => array( 
							'nothing' 	 => 'Nothing',
							'buttons' 	 => 'Buttons',
							'social'     => 'Social Icons',
							'search' 	 => 'Search Bar'						
						),
						'priority' 		 => 2
					)
				)
			);	
		
		$defaultBtns = '<a href="/" class="button primary-button">Primary Button</a><a href="/" class="button secondary-button">Secondary Button</a>';
			
		$wp_customize->add_setting( 'tesseract_tho_header_content_if_button', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'transport'			=> 'postMessage',
			'default' 			=> $defaultBtns
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_header_content_if_button_control',
					array(
						'label'          => __( 'Button code', 'tesseract' ),
						'section'        => 'tesseract_tho_header_content',
						'settings'       => 'tesseract_tho_header_content_if_button',
						'type'           => 'textarea',
						'priority' 		 => 4,
						'active_callback' 	=> 'tesseract_header_button_textarea_enable'										
					)
				)
			);												