<?php
   	$wp_customize->add_section( 'tesseract_social_vim' , array(
    	'title'      => __('Vimeo', 'tesseract'),
    	'priority'   => 6,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_vim_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_vim_url_control',
					array(
						'label'          => __( 'Vimeo URL', 'tesseract' ),
						'section'        => 'tesseract_social_vim',
						'settings'       => 'tesseract_vim_url',
						'type'           => 'text',
						'priority' 		 => 1					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_vim_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_vim_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_vim',
						   'settings'   => 'tesseract_vim_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );