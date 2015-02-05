<?php
   	$wp_customize->add_section( 'tesseract_social_gplus' , array(
    	'title'      => __('Google Plus', 'tesseract'),
    	'priority'   => 3,
		'panel' 	 => 'tesseract_social'
	) );								
	
		$wp_customize->add_setting( 'tesseract_gplus_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_gplus_url_control',
					array(
						'label'          => __( 'Google Plus URL', 'tesseract' ),
						'section'        => 'tesseract_social_gplus',
						'settings'       => 'tesseract_gplus_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_gplus_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_gplus_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_gplus',
						   'settings'   => 'tesseract_gplus_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );