<?php
/*  
 * section FOOTER HORIZONTAL MENU
 */					 			
			
   	$wp_customize->add_section( 'tesseract_tfo_footer_content' , array(
    	'title'      => __('Footer Content', 'tesseract'),
    	'priority'   => 3,
		'panel'      => 'tesseract_footer_options'
	) );	
	
		$wp_customize->add_setting( 'tesseract_tfo_footer_content_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => '__return_false'
			)
		);
		
			$wp_customize->add_control( 
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_tfo_footer_content_header_control', 
				array(
					'label' =>  __('Choose the content to be displayed in the footer', 'tesseract' ),
					'section' => 'tesseract_tfo_footer_content',
					'settings' => 'tesseract_tfo_footer_content_header',
					'priority' => 	1
					)
				)
			);						
			
		$wp_customize->add_setting( 'tesseract_tfo_footer_additional_content', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_nextToMenu_footer',
				'default'			=> 'nothing'				
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tfo_footer_additional_content_control',
					array(
						'section'        => 'tesseract_tfo_footer_content',
						'settings'       => 'tesseract_tfo_footer_additional_content',
						'type'           => 'radio',
						'choices' 		 => array( 
							'nothing' 	 => 'Nothing',
							'logo' 		 => 'Logo',
							'social'     => 'Social Icons',
							'search' 	 => 'Search Bar'						
						),
						'priority' 		 => 2,
						''
					)
				)
			);	
												
		$wp_customize->add_setting( 'tesseract_tfo_footer_content_enable', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default' 			=> 1
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_tfo_footer_content_enable_control',
					array(
						'label'          => __( 'Display a horizontal footer menu', 'tesseract' ),
						'section'        => 'tesseract_tfo_footer_content',
						'settings'       => 'tesseract_tfo_footer_content_enable',
						'type'           => 'checkbox',
						'priority' 		 => 3,
						'active_callback'=> 'tesseract_footer_content_enable_enable'	
					)
				)
			);	
		
		$tesseract_menu_selector_menus = get_terms( 'nav_menu' );		
		if ( $tesseract_menu_selector_menus ) :
			
			$tesseract_menu_selector_items = array();
			$item_keys = array( 'none' ); $item_values = array( '' );
			foreach ( $tesseract_menu_selector_menus as $items ) {
				array_push( $item_keys, $items->slug);
				array_push( $item_values, $items->name);
			}	
			
			$tesseract_menu_selector_items = array_combine( $item_keys, $item_values );
		
			$menu_id = $tesseract_menu_selector_menus[0]->term_id;						
			$default_menu = $tesseract_menu_selector_menus ? wp_nav_menu( array( 'menu_id' => $menu_id, 'echo' => false ) ) : wp_nav_menu( array( 'echo' => false ) );			
		
			$wp_customize->add_setting( 'tesseract_tfo_footer_content_select', array(
				'sanitize_callback' => 'tesseract_sanitize_select',
				'default' 			=> $default_menu
			) );
			
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_tfo_footer_content_select_control',
						array(
							'label'          => __( 'Choose the menu to be displayed in the footer with a horizontal layout', 'tesseract' ),
							'section'        => 'tesseract_tfo_footer_content',
							'settings'       => 'tesseract_tfo_footer_content_select',
							'type'           => 'select',
							'choices'        => $tesseract_menu_selector_items,
							'priority' 		 => 4,
							'active_callback' 	=> 'tesseract_footer_menu_options_enable'										
						)
					)
				);	
		endif;		
					
