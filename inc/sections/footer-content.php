<?php
/*
 * section FOOTER CONTENT
 */

   	$wp_customize->add_section( 'tesseract_footer_content' , array(
    	'title'      => __('Footer Content', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_footer_options'
	) );

		$wp_customize->add_setting( 'tesseract_footer_content_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_footer_content_header_control',
				array(
					'label' =>  __('Choose the content to be displayed in the footer', 'tesseract' ),
					'section' => 'tesseract_footer_content',
					'settings' => 'tesseract_footer_content_header',
					'priority' => 	1
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_footer_additional_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_left',
				'default'			=> 'nothing'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_footer_additional_content_control',
				array(
					'section'        => 'tesseract_footer_content',
					'settings'       => 'tesseract_footer_additional_content',
					'type'           => 'radio',
					'choices' 		 => array(
						'nothing' 	 => 'Nothing',
						'logo' 		 => 'Logo',
						'social'     => 'Social Icons',
						'search' 	 => 'Search Bar',
					),
					'priority' 		 => 2,
					''
				)
			)
		);

		$tesseract_menu_selector_menus = get_terms( 'nav_menu' );
		if ( $tesseract_menu_selector_menus ) :

			$tesseract_menu_selector_items = array();
			$item_keys = array( 'none' ); $item_values = array( 'None' );
			foreach ( $tesseract_menu_selector_menus as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}

			$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );

			$wp_customize->add_setting( 'tesseract_footer_menu_select', array(
				'sanitize_callback' => 'tesseract_sanitize_select'
			) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_footer_menu_select_control',
					array(
						'label'          => __( 'Select Menu', 'tesseract' ),
						'section'        => 'tesseract_footer_content',
						'settings'       => 'tesseract_footer_menu_select',
						'type'           => 'select',
						'choices'        => $tesseract_menu_selector_items,
						'priority' 		 => 3
					)
				)
			);
		endif;