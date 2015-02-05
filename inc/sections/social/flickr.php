<?php
   	$wp_customize->add_section( 'tesseract_social_fr' , array(
    	'title'      => __('Flickr', 'tesseract'),
    	'priority'   => 8,
		'panel' 	 => 'tesseract_social'
	) );								
	
		$wp_customize->add_setting( 'tesseract_fr_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_fr_url_control',
					array(
						'label'          => __( 'Flickr URL', 'tesseract' ),
						'section'        => 'tesseract_social_fr',
						'settings'       => 'tesseract_fr_url',
						'type'           => 'text',
						'priority' 		 => 1					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_fr_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_fr_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_fr',
						   'settings'   => 'tesseract_fr_image',
						   'priority' 		 => 2				    
					   )
				   )
			   );