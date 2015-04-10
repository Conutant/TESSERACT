<?php
/*  
 * section HEADER MENU
 */					 			
	
$wp_customize->add_section( 'tesseract_tfo_size' , array(
    	'title'      => __('Footer Size', 'tesseract'),
    	'priority'   => 1,
		'panel'      => 'tesseract_footer_options'
	) );	
		
	$wp_customize->add_setting( 'tesseract_tfo_footer_width', array(
		'sanitize_callback' => 'tesseract_sanitize_select_footer_width',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tfo_footer_width_control',
				array(
					'label'          => __( 'Select footer width', 'tesseract' ),
					'section'        => 'tesseract_tfo_size',
					'settings'       => 'tesseract_tfo_footer_width',
					'type'           => 'select',
					'choices'        => array(
						'default'	=> 'Default',
						'fullwidth'	=> 'Full Width'
					),
					'priority' 		 => 1								
				)
			)
		);	