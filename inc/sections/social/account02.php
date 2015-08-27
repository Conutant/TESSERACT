<?php
/*  
 * section SOCIAL/ACCOUNT02
 */	
 	
	$is_used = is_string( get_theme_mod('tesseract_social_account02_name') );
	
	$sectionName = ( $is_used ) ? get_theme_mod('tesseract_social_account02_name') . ' Account ' . __('Settings', 'tesseract') : __('Social Account 02 Settings', 'tesseract');
	$sectionPriority = ( $is_used ) ? 2 : 12;
	$networkName = ( $is_used ) ? get_theme_mod('tesseract_social_account02_name') : __( 'Social Network Name', 'tesseract' );
	$accountUrl = ( $is_used ) ? get_theme_mod('tesseract_social_account02_name') . ' Account ' . __( 'URL', 'tesseract' ) : __( 'Social Network URL', 'tesseract' );
		
   	$wp_customize->add_section( 'tesseract_social_account02' , array(
    	'title'      => $sectionName,
    	'priority'   => $sectionPriority,
		'panel' 	 => 'tesseract_social'
	) );							

		$wp_customize->add_setting( 'tesseract_social_account02_name', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html'
		) );
				
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account02_name_control',
					array(
						'label'          => $networkName,
						'section'        => 'tesseract_social_account02',
						'settings'       => 'tesseract_social_account02_name',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);
	
		$wp_customize->add_setting( 'tesseract_social_account02_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );
						
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account02_url_control',
					array(
						'label'          => $accountUrl,
						'section'        => 'tesseract_social_account02',
						'settings'       => 'tesseract_social_account02_url',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_social_account02_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_social_account02_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_account02',
						   'settings'   => 'tesseract_social_account02_image',
						   'priority' 		 => 3				    
					   )
				   )
			   );