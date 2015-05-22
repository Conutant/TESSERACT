<?php
/*  
 * section SOCIAL/Instagram
 */	
 
   	$wp_customize->add_section( 'tesseract_social_ig' , array(
    	'title'      => __('Instagram', 'tesseract'),
    	'priority'   => 8,
		'panel' 	 => 'tesseract_social'
	) );								
	
		$wp_customize->add_setting( 'tesseract_ig_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_ig_url_control',
					array(
						'label'          => __( 'Instagram URL', 'tesseract' ),
						'section'        => 'tesseract_social_ig',
						'settings'       => 'tesseract_ig_url',
						'type'           => 'text',
						'priority' 		 => 1					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_ig_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_ig_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_ig',
						   'settings'   => 'tesseract_ig_image',
						   'priority' 		 => 2				    
					   )
				   )
			   );