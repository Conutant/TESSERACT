<?php
   	$wp_customize->add_section( 'tesseract_social_tw' , array(
    	'title'      => __('Twitter', 'tesseract'),
    	'priority'   => 2,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_tw_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tw_url_control',
					array(
						'label'          => __( 'Twitter URL', 'tesseract' ),
						'section'        => 'tesseract_social_tw',
						'settings'       => 'tesseract_tw_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_tw_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_tw_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_tw',
						   'settings'   => 'tesseract_tw_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );