<?php
   	$wp_customize->add_section( 'tesseract_social_dr' , array(
    	'title'      => __('Dribbble', 'tesseract'),
    	'priority'   => 10,
		'panel' 	 => 'tesseract_social'
	) );							
	
		$wp_customize->add_setting( 'tesseract_dr_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_dr_url_control',
					array(
						'label'          => __( 'Dribbble URL', 'tesseract' ),
						'section'        => 'tesseract_social_dr',
						'settings'       => 'tesseract_dr_url',
						'type'           => 'text',
						'priority' 		 => 1					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_dr_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_dr_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_dr',
						   'settings'   => 'tesseract_dr_image',
						   'priority' 		 => 2				    
					   )
				   )
			   );