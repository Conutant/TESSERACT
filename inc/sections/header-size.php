<?php
/*  
 * section HEADER MENU
 */					 			
	
$wp_customize->add_section( 'tesseract_tho_size' , array(
    	'title'      => __('Header Size', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_header_options'
	) );	
	
	$wp_customize->add_setting( 'tesseract_tho_header_height', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_height',
		'default' 			=> 'medium'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tho_header_height_control',
				array(
					'label'          => __( 'Choose the header height', 'tesseract' ),
					'section'        => 'tesseract_tho_size',
					'settings'       => 'tesseract_tho_header_height',
					'type'           => 'select',
					'choices'        => array(
						'small'	=> 'Small',
						'medium'=> 'Medium',
						'large'	=> 'Large'	
					),
					'priority' 		 => 1										
				)
			)
		);
		
	$wp_customize->add_setting( 'tesseract_tho_header_width', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_width',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tho_header_width_control',
				array(
					'label'          => __( 'Select header width', 'tesseract' ),
					'section'        => 'tesseract_tho_size',
					'settings'       => 'tesseract_tho_header_width',
					'type'           => 'select',
					'choices'        => array(
						'default'	=> 'Default',
						'fullwidth'	=> 'Full Width'
					),
					'priority' 		 => 2								
				)
			)
		);	