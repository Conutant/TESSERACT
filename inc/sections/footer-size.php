<?php
/*  
 * section FOOTER SIZE
 */					 			
	
$wp_customize->add_section( 'tesseract_tfo_size' , array(
    	'title'      => __('Footer Size', 'tesseract'),
    	'priority'   => 1,
		'panel'      => 'tesseract_footer_options'
	) );	

	$wp_customize->add_setting( 'tesseract_footer_height', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => '__return_false',
			'default' 			=> 40
	) );			
		
		$wp_customize->add_control( 'tesseract_footer_height_control', array(
			'type'        		=> 'range',
			'priority'    		=> 2,
			'section'     		=> 'tesseract_footer_logo',
			'settings'     		=> 'tesseract_footer_height',
			'label'       		=> 'Footer Height',
			'description' 		=> 'Use this range slider to set footer height',
			'input_attrs' 		=> array(
				'min'   => 30,
				'max'   => 130,
				'step'  => 5,
				'class' => 'tesseract-tfo-footer-height',
				'style' => 'color: #0a0',
			),
			'priority' 			=> 1
		) );
		
	$wp_customize->add_setting( 'tesseract_footer_width', array(
		'sanitize_callback' => 'tesseract_sanitize_select_footer_width',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_footer_width_control',
				array(
					'label'          => __( 'Select footer width', 'tesseract' ),
					'section'        => 'tesseract_tfo_size',
					'settings'       => 'tesseract_footer_width',
					'type'           => 'select',
					'choices'        => array(
						'default'	=> 'Default',
						'fullwidth'	=> 'Full Width'
					),
					'priority' 		 => 2								
				)
			)
		);	