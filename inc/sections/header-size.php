<?php
/*  
 * section HEADER MENU
 */					 			
	
$wp_customize->add_section( 'tesseract_tho_size' , array(
    	'title'      => __('Header Size', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_header_options'
	) );	
	
	$wp_customize->add_setting( 'tesseract_tho_header_size', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_size',
		'default' 			=> 'medium'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tho_header_size_control',
				array(
					'label'          => __( 'Choose the header height', 'tesseract' ),
					'section'        => 'tesseract_tho_size',
					'settings'       => 'tesseract_tho_header_size',
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
		
	