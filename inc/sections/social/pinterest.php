<?php
   	$wp_customize->add_section( 'tesseract_social_pin' , array(
    	'title'      => __('Pinterest', 'tesseract'),
    	'priority'   => 9,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_pin_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_pin_url_control',
					array(
						'label'          => __( 'Pinterest URL', 'tesseract' ),
						'section'        => 'tesseract_social_pin',
						'settings'       => 'tesseract_pin_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_pin_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_pin_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_pin',
						   'settings'   => 'tesseract_pin_image',
						   'priority' 		 => 2				    
					   )
				   )
			   );