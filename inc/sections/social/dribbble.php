<?php
/*  
 * section SOCIAL/DRIBBBLE
 */	
 
   	$wp_customize->add_section( 'tesseract_social_account01' , array(
    	'title'      => __('Social Account 01 Settings', 'tesseract'),
    	'priority'   => 1,
		'panel' 	 => 'tesseract_social'
	) );							

		$wp_customize->add_setting( 'tesseract_social_account01_name', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html'
		) );
			
			$name = is_string( get_theme_mod('tesseract_social_account01_name') ) ? get_theme_mod('tesseract_social_account01_name') : __( 'Social Network Name', 'tesseract' );
				
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account01_name_control',
					array(
						'label'          => $name,
						'section'        => 'tesseract_social_account01_name',
						'settings'       => 'tesseract_social_account01',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);
	
		$wp_customize->add_setting( 'tesseract_social_account01_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );
			
			$label = is_string( get_theme_mod('tesseract_social_account01_name') ) ? get_theme_mod('tesseract_social_account01_name') . __( 'URL', 'tesseract' ) : __( 'Social Network URL', 'tesseract' );
				
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account01_url_control',
					array(
						'label'          => $label,
						'section'        => 'tesseract_social_account01_url',
						'settings'       => 'tesseract_social_account01',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_social_account01_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_social_account01_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_account01',
						   'settings'   => 'tesseract_social_account01_image',
						   'priority' 		 => 3				    
					   )
				   )
			   );