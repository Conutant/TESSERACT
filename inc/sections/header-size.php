<?php
/*  
 * section HEADER SIZE
 */					 			
	
$wp_customize->add_section( 'tesseract_header_size' , array(
    	'title'      => __('Header Size', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_header_options'
	) );	

	$wp_customize->add_setting( 'tesseract_header_height', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
			'default' 			=> 40
	) );			
		
		$wp_customize->add_control( 'tesseract_header_height_control', array(
			'type'        		=> 'range',
			'priority'    		=> 2,
			'section'     		=> 'tesseract_header_size',
			'settings'     		=> 'tesseract_header_height',
			'label'       		=> 'Header Height',
			'description' 		=> 'Use this range slider to set header height',
			'input_attrs' 		=> array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 5,
				'class' => 'tesseract-header-height',
				'style' => 'color: #0a0',
			),
			'priority' 			=> 1
		) );
		
	$wp_customize->add_setting( 'tesseract_header_width', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_width',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_header_width_control',
				array(
					'label'          => __( 'Select header width', 'tesseract' ),
					'section'        => 'tesseract_header_size',
					'settings'       => 'tesseract_header_width',
					'type'           => 'select',
					'choices'        => array(
						'default'	=> 'Default',
						'fullwidth'	=> 'Full Width'
					),
					'priority' 		 => 2							
				)
			)
		);	