<?php
/*  
 * section COLORS
 */		
	
   	$wp_customize->add_section( 'tesseract_tfo_footer_colors' , array(
    	'title'      => __('Footer Colors', 'tesseract'),
    	'priority'   => 1,
		'panel'      => 'tesseract_footer_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_tfo_footer_colors_bck_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#1e73be'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tfo_footer_colors_bck_color_control', 
				array(
					'label'      => __( 'Footer Background Color', 'tesseract' ),
					'section'    => 'tesseract_tfo_footer_colors',
					'settings'   => 'tesseract_tfo_footer_colors_bck_color',
					'priority'   => 1
				) ) 						
			);
			
		$wp_customize->add_setting( 'tesseract_tfo_footer_colors_text_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tfo_footer_colors_text_color_control', 
				array(
					'label'      => __( 'Footer Text Color', 'tesseract' ),
					'section'    => 'tesseract_tfo_footer_colors',
					'settings'   => 'tesseract_tfo_footer_colors_text_color',
					'priority'   => 2
				) ) 						
			);
			
		$wp_customize->add_setting( 'tesseract_tfo_footer_colors_heading_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tfo_footer_colors_heading_color_control', 
				array(
					'label'      => __( 'Footer Heading Color', 'tesseract' ),
					'section'    => 'tesseract_tfo_footer_colors',
					'settings'   => 'tesseract_tfo_footer_colors_heading_color',
					'priority'   => 3
				) ) 						
			);			
			
		$wp_customize->add_setting( 'tesseract_tfo_footer_colors_link_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tfo_footer_colors_link_color_control', 
				array(
					'label'      => __( 'Footer Link Color', 'tesseract' ),
					'section'    => 'tesseract_tfo_footer_colors',
					'settings'   => 'tesseract_tfo_footer_colors_link_color',
					'priority' 	 => 4
				) ) 						
			);
			
		$wp_customize->add_setting( 'tesseract_tfo_footer_colors_link_hover_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#d1ecff'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tesseract_tfo_footer_colors_tfo_link_hover_color_control', 
				array(
					'label'      => __( 'Footer Hovered Link Color', 'tesseract' ),
					'section'    => 'tesseract_tfo_footer_colors',
					'settings'   => 'tesseract_tfo_footer_colors_link_hover_color',
					'priority'   => 5
				) ) 						
			);
