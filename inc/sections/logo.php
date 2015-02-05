<?php
   	$wp_customize->add_section( 'tesseract_logo' , array(
    	'title'      => __('Logo', 'tesseract'),
    	'priority'   => 3,
		'panel'		 => 'tesseract_general_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_logo_image', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_logo_image_control',
					   array(
						   'label'      => __( 'Upload a logo', 'tesseract' ),
						   'section'    => 'tesseract_logo',
						   'settings'   => 'tesseract_logo_image'
					   )
				   )
			   );
			   
			   