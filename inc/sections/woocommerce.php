<?php
/*  
 * section FOOTER HORIZONTAL MENU
 */					 			
			
   	$wp_customize->add_section( 'tesseract_woocommerce' , array(
    	'title'      => __('WooCommerce', 'tesseract'),
    	'priority'   => 9999
	) );	

		$wp_customize->add_setting( 'tesseract_woocommerce_loop_layout_header', array(
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_woocommerce_loop_layout_header_control', 
				array(
					'label' =>  __('Product listings', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_loop_layout_header',
					'priority' => 	1
					)
				)
			);	
												
		$wp_customize->add_setting( 'tesseract_woocommerce_loop_layout', array(
				'sanitize_callback' => 'tesseract_sanitize_select_woocommerce_layout_types',
				'default' 			=> 'sidebar-left'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_woocommerce_loop_layout_control',
					array(
						'label'         => __( 'Choose a layout type for product listings ( main shop and product category/tag archive pages )', 'tesseract' ),
						'section'       => 'tesseract_woocommerce',
						'settings'      => 'tesseract_woocommerce_loop_layout',
						'type'          => 'select',
						'choices'		=> array(
							'sidebar-left'  	=> 	'Left Sidebar',
							'sidebar-right'  	=> 	'Right Sidebar',
							'fullwidth'			=>  'Full Width'
						),
						'priority' 		=> 2
					)
				)
			);
			
		$wp_customize->add_setting( 'tesseract_woocommerce_product_layout_header', array(
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_woocommerce_product_layout_header_control', 
				array(
					'label' =>  __('Single Product Pages', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_product_layout_header',
					'priority' => 3
					)
				)
			);	
												
		$wp_customize->add_setting( 'tesseract_woocommerce_product_layout', array(
				'sanitize_callback' => 'tesseract_sanitize_select_woocommerce_layout_types',
				'default' 			=> 'sidebar-left'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_woocommerce_product_layout_control',
					array(
						'label'         => __( 'Choose a layout type for single product pages', 'tesseract' ),
						'section'       => 'tesseract_woocommerce',
						'settings'      => 'tesseract_woocommerce_product_layout',
						'type'          => 'select',
						'choices'		=> array(
							'sidebar-left'  	=> 	'Left Sidebar',
							'sidebar-right'  	=> 	'Right Sidebar',
							'fullwidth'			=>  'Full Width'
						),
						'priority' 		=> 4
					)
				)
			);			
			
		$wp_customize->add_setting( 'tesseract_woocommerce_headercart_header', array(
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_woocommerce_headercart_header_control', 
				array(
					'label' =>  __('Header Cart', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_headercart_header',
					'priority' => 	5
					)
				)
			);				
			
		$wp_customize->add_setting( 'tesseract_woocommerce_headercart', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default' 			=> 0
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_woocommerce_headercart_control',
					array(
						'label'          => __( 'Display Cart in header', 'tesseract' ),
						'section'        => 'tesseract_woocommerce',
						'settings'       => 'tesseract_woocommerce_headercart',
						'type'           => 'checkbox',
						'priority' 		 => 6
					)
				)
			);				
			
		
