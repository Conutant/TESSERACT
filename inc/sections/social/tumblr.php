<?php
   	$wp_customize->add_section( 'tesseract_social_tumb' , array(
    	'title'      => __('Tumblr', 'tesseract'),
    	'priority'   => 7,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_tumb_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tumb_url_control',
					array(
						'label'          => __( 'Tumblr URL', 'tesseract' ),
						'section'        => 'tesseract_social_tumb',
						'settings'       => 'tesseract_tumb_url',
						'type'           => 'text',
						'priority' 		 => 1					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_tumb_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_tumb_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_tumb',
						   'settings'   => 'tesseract_tumb_image',
						   'priority' 		 => 2			    
					   )
				   )
			   );