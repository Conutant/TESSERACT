<?php
/*
 * section WOOCOMMERCE
 */

	//Rename WooCommerce section to 'WooCommert Color Options' IF woocommerce-colors plugin is installed
	if ( is_plugin_active( 'woocommerce-colors/woocommerce-colors.php' ) ) {
	 	$wp_customize->get_section('woocommerce_colors')->title = __( 'WooCommerce Color Options', 'tesseract' );
	}

   	$wp_customize->add_section( 'tesseract_woocommerce' , array(
    	'title'      => __('WooCommerce Layout Options', 'tesseract'),
    	'priority'   => 61
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
					'label' =>  __('Product Listings', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_loop_layout_header',
					'priority' => 	1
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_woocommerce_loop_layout', array(
				'sanitize_callback' => 'tesseract_sanitize_select_woocommerce_layout_types',
				'default' 			=> 'fullwidth'
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
				'default' 			=> 'fullwidth'
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

		$wp_customize->add_setting( 'tesseract_woocommerce_default_layout_header', array(
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_woocommerce_default_layout_header_control',
				array(
					'label' =>  __('Checkout, Account and Cart pages ', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_default_layout_header',
					'priority' => 5
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_woocommerce_default_layout', array(
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_woocommerce_default_layout_control',
				array(
					'label' =>  __('You can set the layout type for the Checkout, Account and Cart pages by using the default page template dropdown on the appropriate page\'s edit screen.', 'tesseract' ),
					'section' => 'tesseract_woocommerce',
					'settings' => 'tesseract_woocommerce_default_layout',
					'priority' => 5
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
					'priority' => 	7
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
					'priority' 		 => 8
				)
			)
		);

		$wp_customize->add_setting( 'tesseract_woocommerce_cartcolor', array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#fff'
		) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'tesseract_woocommerce_cartcolor_control',
			array(
				'label'      => __( 'Shopping Cart Color', 'tesseract' ),
				'section'    => 'tesseract_woocommerce',
				'settings'   => 'tesseract_woocommerce_cartcolor',
			) )
		);