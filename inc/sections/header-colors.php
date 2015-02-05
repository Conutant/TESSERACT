<?php
/*  
 * section COLORS
 */		
	
   	$wp_customize->add_section( 'tho_header_colors' , array(
    	'title'      => __('Header Colors', 'tesseract'),
    	'priority'   => 1,
		'panel'      => 'tesseract_header_options'
	) );	

		//Register setting with the custom ALPHA enabled colorpicker
		// See full blog post here
		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/		
	
		$wp_customize->add_setting( 'tho_header_colors_bck_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> 'rgb(255,255,255)'
		) );

			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tho_header_colors_bck_color_control', 
				array(
					'label'      => __( 'Header Background Color', 'tesseract' ),
					'section'    => 'tho_header_colors',
					'settings'   => 'tho_header_colors_bck_color',
					'priority'   => 1
				) ) 						
			);	
			
		$wp_customize->add_setting( 'tho_header_colors_bck_color_opacity', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html',
				'default' 			=> 100
		) );			
			
			$wp_customize->add_control( 'tho_header_colors_bck_color_opacity', array(
				'type'        => 'range',
				'priority'    => 2,
				'section'     => 'tho_header_colors',
				'label'       => 'Header Background Color Opacity',
				'description' => 'Use this range slider to set background opacity',
				'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 5,
					'class' => 'tho-header-colors-bck-opacity',
					'style' => 'color: #0a0',
				),
			) );			
			
		$wp_customize->add_setting( 'tho_header_colors_text_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#afafaf'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tho_header_colors_text_color_control', 
				array(
					'label'      => __( 'Header Text Color', 'tesseract' ),
					'section'    => 'tho_header_colors',
					'settings'   => 'tho_header_colors_text_color',
					'priority'   => 2
				) ) 						
			);	
			
		$wp_customize->add_setting( 'tho_header_colors_link_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#afafaf'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tho_header_colors_link_color_control', 
				array(
					'label'      => __( 'Header Link Color', 'tesseract' ),
					'section'    => 'tho_header_colors',
					'settings'   => 'tho_header_colors_link_color',
					'priority' 	 => 3
				) ) 						
			);
			
		$wp_customize->add_setting( 'tho_header_colors_link_hover_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#acacac'
		) );
	
			$wp_customize->add_control( 
				new WP_Customize_Color_Control( 
				$wp_customize, 
				'tho_header_colors_tho_link_hover_color_control', 
				array(
					'label'      => __( 'Header Hovered Link Color', 'tesseract' ),
					'section'    => 'tho_header_colors',
					'settings'   => 'tho_header_colors_link_hover_color',
					'priority'   => 4
				) ) 						
			);
