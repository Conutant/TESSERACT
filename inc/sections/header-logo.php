<?php
/*  
 * section HEADER LOGO
 */	
 
   	$wp_customize->add_section( 'tesseract_header_logo' , array(
    	'title'      => __('Header Logo', 'tesseract'),
    	'priority'   => 3,
		'panel'		 => 'tesseract_header_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_header_logo_image', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_header_logo_image_control',
					   array(
						   'label'      => __( 'Upload Header Logo', 'tesseract' ),
						   'section'    => 'tesseract_header_logo',
						   'settings'   => 'tesseract_header_logo_image',
						   'priority' 	=> 1
					   )
				   )
			   );
			   
		$wp_customize->add_setting( 'tesseract_header_logo_height', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
				'default' 			=> 40
		) );			
			
			$wp_customize->add_control( 'tesseract_header_logo_height_control', array(
				'type'        		=> 'range',
				'priority'    		=> 2,
				'section'     		=> 'tesseract_header_logo',
				'settings'     		=> 'tesseract_header_logo_height',
				'label'       		=> 'Header Logo Height',
				'description' 		=> 'Use this range slider to set header logo height',
				'input_attrs' 		=> array(
					'min'   => 30,
					'max'   => 130,
					'step'  => 5,
					'class' => 'tesseract-tho-header-logo-height',
					'style' => 'color: #0a0',
				),
				'active_callback' 	=> 'tesseract_header_logo_height_enable',
				'priority' 			=> 2
			) );
			   
			   