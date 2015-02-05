<?php
   	$wp_customize->add_section( 'tesseract_social_yt' , array(
    	'title'      => __('YouTube', 'tesseract'),
    	'priority'   => 5,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_yt_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_yt_url_control',
					array(
						'label'          => __( 'YouTube URL', 'tesseract' ),
						'section'        => 'tesseract_social_yt',
						'settings'       => 'tesseract_yt_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_yt_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_yt_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_yt',
						   'settings'   => 'tesseract_yt_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );