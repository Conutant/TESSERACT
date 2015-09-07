<?php
/*
 * section HEADER CONTENT
 */

   	$wp_customize->add_section( 'tesseract_header_content' , array(
    	'title'      => __('Header Right Block Content', 'tesseract'),
    	'priority'   => 6,
		'panel'      => 'tesseract_header_options'
	) );

		$wp_customize->add_setting( 'tesseract_header_content_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_header_content_header_control',
				array(
					'label' =>  __('Choose the content to be displayed in the right block of the header area', 'tesseract' ),
					'section' => 'tesseract_header_content',
					'settings' => 'tesseract_header_content_header',
					'priority' => 	1
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_header_right_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_right',
				'default'			=> 'nothing'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_header_right_content_control',
					array(
						'section'        => 'tesseract_header_content',
						'settings'       => 'tesseract_header_right_content',
						'type'           => 'radio',
						'choices' 		 => array(
							'nothing' 	 => __( 'Nothing', 'tesseract'),
							'buttons' 	 => __( 'Buttons', 'tesseract'),
							'social'     => __( 'Social Icons', 'tesseract'),
							'search' 	 => __( 'Search Bar', 'tesseract'),
							'menu' 	 	 => __( 'Menu', 'tesseract')
						),
						'priority' 		 => 2
					)
				)
			);

		$defaultBtns = '<a href="/" class="button primary-button">Primary Button</a><a href="/" class="button secondary-button">Secondary Button</a>';

		$wp_customize->add_setting( 'tesseract_header_content_if_button', array(
			'sanitize_callback' => 'tesseract_sanitize_textarea_html',
			'default' 			=> $defaultBtns
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_header_content_if_button_control',
					array(
						'label'          => __( 'Button code', 'tesseract' ),
						'section'        => 'tesseract_header_content',
						'settings'       => 'tesseract_header_content_if_button',
						'type'           => 'textarea',
						'priority' 		 => 3,
						'active_callback' 	=> 'tesseract_button_textarea_enable'
					)
				)
			);

		$header_content_menu_selector_menus = get_terms( 'nav_menu' );

		if ( $header_content_menu_selector_menus ) :

			$header_content_menu_selector_items = array();
			$item_keys = array( 'none' ); $item_values = array( '' );
			foreach ( $header_content_menu_selector_menus as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}

			$header_content_menu_selector_items = array_combine( $item_keys, $item_values );

			$wp_customize->add_setting( 'tesseract_header_right_menu_select', array(
				'sanitize_callback' => 'tesseract_sanitize_select',
				'default' 			=> 'none'
			) );

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_header_right_menu_select_control',
						array(
							'label'          => __( 'Select menu', 'tesseract' ),
							'section'        => 'tesseract_header_content',
							'settings'       => 'tesseract_header_right_menu_select',
							'type'           => 'select',
							'choices'        => $header_content_menu_selector_items,
							'priority' 		 => 4,
							'active_callback' 	=> 'tesseract_header_right_menu_select_enable'
						)
					)
				);

		endif;