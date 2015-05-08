<?php
/*  
 * section FOOTER LOGO
 */	
 
   	$wp_customize->add_section( 'tesseract_footer_logo' , array(
    	'title'      => __('Footer Logo', 'tesseract'),
    	'priority'   => 3,
		'panel'		 => 'tesseract_footer_options'
	) );	

		$wp_customize->add_setting( 'tesseract_footer_logo_enable', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default' 			=> 0
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_footer_logo_enable_control',
					array(
						'label'          => __( 'Check this if you want to use a logo image different from the one used in the header.', 'tesseract' ),
						'section'        => 'tesseract_footer_logo',
						'settings'       => 'tesseract_footer_logo_enable',
						'type'           => 'checkbox',
						'priority' 		 => 1	
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_footer_logo_image', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_footer_logo_image_control',
					   array(
						   'label'      		=> __( 'Upload Footer Logo', 'tesseract' ),
						   'section'    		=> 'tesseract_footer_logo',
						   'settings'   		=> 'tesseract_footer_logo_image',
						   'priority' 			=> 2,
						   'active_callback' 	=> 'tesseract_footer_logo_enable'
					   )
				   )
			   );
			   
		$wp_customize->add_setting( 'tesseract_footer_logo_height', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
				'default' 			=> 40
		) );			
			
			$wp_customize->add_control( 'tesseract_footer_logo_height_control', array(
				'type'        		=> 'range',
				'section'     		=> 'tesseract_footer_logo',
				'settings'     		=> 'tesseract_footer_logo_height',
				'label'       		=> 'Footer Logo Height',
				'description' 		=> 'Use this range slider to set footer logo height',
				'input_attrs' 		=> array(
					'min'   => 30,
					'max'   => 130,
					'step'  => 5,
					'class' => 'tesseract-tfo-footer-logo-height',
					'style' => 'color: #0a0',
				),
				'active_callback' 	=> 'tesseract_footer_logo_height_enable',
				'priority' 			=> 3
			) );
			   
			   