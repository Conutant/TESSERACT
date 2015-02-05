<?php
   	$wp_customize->add_section( 'tesseract_social_fb' , array(
    	'title'      => __('Facebook', 'tesseract'),
    	'priority'   => 1,
		'panel' 	 => 'tesseract_social'
	) );								
	
		$wp_customize->add_setting( 'tesseract_fb_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_fb_url_control',
					array(
						'label'          => __( 'Facebook URL', 'tesseract' ),
						'section'        => 'tesseract_social_fb',
						'settings'       => 'tesseract_fb_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_fb_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_fb_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_fb',
						   'settings'   => 'tesseract_fb_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );