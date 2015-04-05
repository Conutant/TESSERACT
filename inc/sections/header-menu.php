<?php
/*  
 * section HEADER MENU
 */					 			
		
$wp_customize->add_section( 'tesseract_tho_header_menu' , array(
	'title'      => __('Header Menu', 'tesseract'),
	'priority'   => 4,
	'panel'      => 'tesseract_header_options'
) );			

	$tesseract_menu_selector_menus = get_terms( 'nav_menu' );		

	if ( $tesseract_menu_selector_menus ) :
			
		$tesseract_menu_selector_items = array();
		$item_keys = array( 'none' ); $item_values = array( '' );
		foreach ( $tesseract_menu_selector_menus as $items ) {
			array_push( $item_keys, $items->slug);
			array_push( $item_values, $items->name);
		}
		
		$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );					
		
		$wp_customize->add_setting( 'tesseract_tho_header_menu_select', array(
			'sanitize_callback' => 'tesseract_sanitize_select',
			'default' 			=> 'none'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tho_header_menu_select_control',
					array(
						'label'          => __( 'Choose the menu to be displayed in the header', 'tesseract' ),
						'section'        => 'tesseract_tho_header_menu',
						'settings'       => 'tesseract_tho_header_menu_select',
						'type'           => 'select',
						'choices'        => $tesseract_menu_selector_items,
						'priority' 		 => 1								
					)
				)
			);			
					
	endif;

	$wp_customize->add_setting( 'tesseract_tho_header_menu_size', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_menu_size',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tho_header_menu_size_control',
				array(
					'label'          => __( 'Choose the menu width', 'tesseract' ),
					'section'        => 'tesseract_tho_header_menu',
					'settings'       => 'tesseract_tho_header_menu_size',
					'type'           => 'select',
					'choices'        => array(
						'default'	=> 'Default',
						'fullwidth'	=> 'Full Width'
					),
					'priority' 		 => 2								
				)
			)
		);
		
	$wp_customize->add_setting( 'tesseract_tho_header_menu_sep', array(
		'sanitize_callback' => 'tesseract_sanitize_select_header_menu_sep',
		'default' 			=> 'default'
	) );
	
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tesseract_tho_header_menu_sep_control',
				array(
					'label'          => __( 'Choose menu separator type', 'tesseract' ),
					'section'        => 'tesseract_tho_header_menu',
					'settings'       => 'tesseract_tho_header_menu_sep',
					'type'           => 'select',
					'choices'        => array(
						'none'		=> 'None',
						'dark'		=> 'Dark',
						'light' 	=> 'Light'
					),
					'priority' 		 => 3,
					'active_callback'=> 'tesseract_tho_header_menu_sep_enable'						
				)
			)
		);			