<?php
   	$wp_customize->add_section( 'tesseract_social_li' , array(
    	'title'      => __('LinkedIn', 'tesseract'),
    	'priority'   => 4,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_li_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_li_url_control',
					array(
						'label'          => __( 'LinkedIn URL', 'tesseract' ),
						'section'        => 'tesseract_social_li',
						'settings'       => 'tesseract_li_url',
						'type'           => 'text',
						'priority' 		 => 1						
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_li_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_li_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_li',
						   'settings'   => 'tesseract_li_image',
						   'priority' 		 => 2					    
					   )
				   )
			   );