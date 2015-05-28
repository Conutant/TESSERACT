<?php
/*  
 * section SOCIAL/ACCOUNT08
 */	
 	
	$is_used = is_string( get_theme_mod('tesseract_social_account08_name') );
	
	$sectionName = ( $is_used ) ? get_theme_mod('tesseract_social_account08_name') . ' Account ' . __('Settings', 'tesseract') : __('Social Account 08 Settings', 'tesseract');
	$sectionPriority = ( $is_used ) ? 8 : 18;
	$networkName = ( $is_used ) ? get_theme_mod('tesseract_social_account08_name') : __( 'Social Network Name', 'tesseract' );
	$accountUrl = ( $is_used ) ? get_theme_mod('tesseract_social_account08_name') . ' Account ' . __( 'URL', 'tesseract' ) : __( 'Social Network URL', 'tesseract' );
		
   	$wp_customize->add_section( 'tesseract_social_account08' , array(
    	'title'      => $sectionName,
    	'priority'   => $sectionPriority,
		'panel' 	 => 'tesseract_social'
	) );							

		$wp_customize->add_setting( 'tesseract_social_account08_name', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html'
		) );
				
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account08_name_control',
					array(
						'label'          => $networkName,
						'section'        => 'tesseract_social_account08',
						'settings'       => 'tesseract_social_account08_name',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);
	
		$wp_customize->add_setting( 'tesseract_social_account08_url', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );
						
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_social_account08_url_control',
					array(
						'label'          => $accountUrl,
						'section'        => 'tesseract_social_account08',
						'settings'       => 'tesseract_social_account08_url',
						'type'           => 'text',
						'priority' 		 => 2					
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_social_account08_image', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		) );

			$wp_customize->add_control(
				   new WP_Customize_Image_Control(
					   $wp_customize,
					   'tesseract_social_account08_image_control',
					   array(
						   'label'      => __( 'Upload an icon', 'tesseract' ),
						   'section'    => 'tesseract_social_account08',
						   'settings'   => 'tesseract_social_account08_image',
						   'priority' 		 => 3				    
					   )
				   )
			   );