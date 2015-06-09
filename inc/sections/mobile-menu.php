<?php
/*
 * section HEADER COLORS
 */

   	$wp_customize->add_section( 'tesseract_mobmenu' , array(
    	'title'      => __('Mobile Menu', 'tesseract'),
    	'priority'   => 7,
		'panel'      => 'tesseract_header_options'
	) );

		$wp_customize->add_setting( 'tesseract_mobmenu_opener', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default' 			=> 0
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_mobmenu_opener_control',
					array(
						'label'          => __( 'Check this to open mobile menu (this way you can see how it will look with your new mobile menu settings)', 'tesseract' ),
						'section'        => 'tesseract_mobmenu',
						'settings'       => 'tesseract_mobmenu_opener',
						'type'           => 'checkbox',
						'priority' 		 => 1
					)
				)
			);

		//Register setting with the custom ALPHA enabled colorpicker
		// See full blog post here
		// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/

		$wp_customize->add_setting( 'tesseract_mobmenu_background_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'tesseract_sanitize_rgba',
				'default' 			=> '#336ca6'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_background_color_control',
				array(
					'label'      => __( 'Menu Background Color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_background_color',
					'priority'   => 2
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_link_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_link_color_control',
				array(
					'label'      => __( 'Menu Link Color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_link_color',
					'priority' 	 => 3
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_link_hover_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_link_hover_color_control',
				array(
					'label'      => __( 'Menu Link Hover Color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_link_hover_color',
					'priority' 	 => 4
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_link_hover_background_color_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_link_hover_background_color_header_control',
				array(
					'label' =>  __('Menu Link Hover Background Color', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_link_hover_background_color_header',
					'priority' => 	5
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_link_hover_background_color', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_mob_link_hover_background_color',
				'default'			=> 'dark'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_mobmenu_link_hover_background_color_control',
					array(
						'section'        => 'tesseract_mobmenu',
						'settings'       => 'tesseract_mobmenu_link_hover_background_color',
						'type'           => 'radio',
						'choices' 		 => array(
							'dark' 	 	=> __( 'Dark Opaque', 'tesseract'),
							'light' 	=> __( 'Light Opaque', 'tesseract'),
							'custom'	=> __( 'Custom Color', 'tesseract')
						),
						'priority' 		 => 6
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_link_hover_background_color_custom', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#285684'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_link_hover_background_color_custom_control',
				array(
					'label'      => __( 'Choose custom color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_link_hover_background_color_custom',
					'priority' 	 => 7,
					'active_callback' 	=> 'tesseract_mobmenu_link_hover_background_color_custom_enable'
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_shadow_color_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_shadow_color_header_control',
				array(
					'label' =>  __('Menu Item Shadows and Separators Color', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_shadow_color_header',
					'priority' => 	8
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_shadow_color', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_mob_shadow_color',
				'default'			=> 'dark'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_mobmenu_shadow_color_control',
					array(
						'section'        => 'tesseract_mobmenu',
						'settings'       => 'tesseract_mobmenu_shadow_color',
						'type'           => 'radio',
						'choices' 		 => array(
							'dark' 	 	=> __( 'Dark', 'tesseract'),
							'light' 	=> __( 'Light', 'tesseract'),
							'custom'	=> __( 'Custom Color', 'tesseract')
						),
						'priority' 		 => 9
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_shadow_color_custom', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#000000'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_shadow_color_custom_control',
				array(
					'label'      => __( 'Choose custom color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_shadow_color_custom',
					'priority' 	 => 10,
					'active_callback' 	=> 'tesseract_mobmenu_shadow_color_custom_enable'
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_additionals_search_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_additionals_search_header_control',
				array(
					'label' =>  __( 'Header \'Search\' Block Color Settings', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_additionals_search_header',
					'priority' => 	11,
					'active_callback' => 'tesseract_mobmenu_additionals_search_header_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_search_background_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_search_background_header_control',
				array(
					'label' =>  __( 'Search Field Background Color', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_search_background_header',
					'priority' => 	12,
					'active_callback'=> 'tesseract_mobmenu_search_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_search_background_color', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_mob_search_background_color',
				'default'			=> 'dark'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_mobmenu_search_background_color_control',
					array(
						'section'        => 'tesseract_mobmenu',
						'settings'       => 'tesseract_mobmenu_search_background_color',
						'type'           => 'radio',
						'choices' 		 => array(
							'dark' 	 	=> __( 'Dark', 'tesseract'),
							'light' 	=> __( 'Light', 'tesseract')
						),
						'priority' 		 => 13,
						'active_callback'=> 'tesseract_mobmenu_search_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_search_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
				'default' 			=> '#ffffff'
		) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
				$wp_customize,
				'tesseract_mobmenu_search_color_control',
				array(
					'label'      => __( 'Search Input Text Color', 'tesseract' ),
					'section'    => 'tesseract_mobmenu',
					'settings'   => 'tesseract_mobmenu_search_color',
					'priority' 	 => 14,
					'active_callback'=> 'tesseract_mobmenu_search_enable'
				) )
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_additionals_social_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_additionals_social_header_control',
				array(
					'label' =>  __( 'Header \'Social\' Block Color Settings', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_additionals_social_header',
					'priority' => 	11,
					'active_callback' => 'tesseract_mobmenu_additionals_social_header_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_social_background_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_social_background_header_control',
				array(
					'label' =>  __( 'Social Icons Background Color', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_social_background_header',
					'priority' => 	15,
					'active_callback'=> 'tesseract_mobmenu_social_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_social_background_color', array(
				'sanitize_callback' => 'tesseract_sanitize_radio_mob_social_background_color',
				'default'			=> 'dark'
		) );

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_mobmenu_social_background_color_control',
					array(
						'section'        => 'tesseract_mobmenu',
						'settings'       => 'tesseract_mobmenu_social_background_color',
						'type'           => 'radio',
						'choices' 		 => array(
							'dark' 	 	=> __( 'Dark', 'tesseract'),
							'light' 	=> __( 'Light', 'tesseract')
						),
						'priority' 		 => 16,
						'active_callback'=> 'tesseract_mobmenu_social_enable'
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_mobmenu_additionals_buttons_header', array(
			'default'           => '',
			'type'           	=> 'option',
			'sanitize_callback' => '__return_false'
			)
		);

			$wp_customize->add_control(
				new Tesseract_Customize_Header_Control(
				$wp_customize,
				'tesseract_mobmenu_additionals_buttons_header_control',
				array(
					'label' =>  __( 'Header \'Buttons\' Block Color Settings', 'tesseract' ),
					'section' => 'tesseract_mobmenu',
					'settings' => 'tesseract_mobmenu_additionals_buttons_header',
					'priority' => 	11,
					'active_callback' => 'tesseract_mobmenu_additionals_buttons_header_enable'
					)
				)
			);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_background_header', array(
				'default'           => '',
				'type'           	=> 'option',
				'sanitize_callback' => '__return_false'
				)
			);

				$wp_customize->add_control(
					new Tesseract_Customize_Header_Control(
					$wp_customize,
					'tesseract_mobmenu_social_background_header_control',
					array(
						'label' =>  __( 'Buttons Block Background Color', 'tesseract' ),
						'section' => 'tesseract_mobmenu',
						'settings' => 'tesseract_mobmenu_buttons_background_header',
						'priority' => 	17,
						'active_callback'=> 'tesseract_mobmenu_buttons_enable'
						)
					)
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_background_color', array(
					'sanitize_callback' => 'tesseract_sanitize_radio_mob_buttons_background_color',
					'default'			=> 'dark'
			) );

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_mobmenu_buttons_background_color_control',
						array(
							'section'        => 'tesseract_mobmenu',
							'settings'       => 'tesseract_mobmenu_buttons_background_color',
							'type'           => 'radio',
							'choices' 		 => array(
								'dark' 	 	=> __( 'Dark Opaque', 'tesseract'),
								'light' 	=> __( 'Light Opaque', 'tesseract'),
								'custom'	=> __( 'Custom Color', 'tesseract')
							),
							'priority' 		 => 18,
							'active_callback'=> 'tesseract_mobmenu_buttons_enable'
						)
					)
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_background_color_custom', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#285684'
			) );

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
					$wp_customize,
					'tesseract_mobmenu_buttons_background_color_custom_control',
					array(
						'label'      => __( 'Choose custom color', 'tesseract' ),
						'section'    => 'tesseract_mobmenu',
						'settings'   => 'tesseract_mobmenu_buttons_background_color_custom',
						'priority' 	 => 18,
						'active_callback'=> 'tesseract_mobmenu_buttons_background_color_custom_enable'
					) )
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_text_color', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#cccccc'
			) );

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
					$wp_customize,
					'tesseract_mobmenu_buttons_text_color_control',
					array(
						'label'      => __( 'Buttons Block Text Color', 'tesseract' ),
						'section'    => 'tesseract_mobmenu',
						'settings'   => 'tesseract_mobmenu_buttons_text_color',
						'priority' 	 => 19,
						'active_callback'=> 'tesseract_mobmenu_buttons_enable'
					) )
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_link_color', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#ffffff'
			) );

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
					$wp_customize,
					'tesseract_mobmenu_buttons_link_color_control',
					array(
						'label'      => __( 'Buttons Block Link Color', 'tesseract' ),
						'section'    => 'tesseract_mobmenu',
						'settings'   => 'tesseract_mobmenu_buttons_link_color',
						'priority' 	 => 20,
						'active_callback'=> 'tesseract_mobmenu_buttons_enable'
					) )
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_buttons_link_hover_color', array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
					'default' 			=> '#ffffff'
			) );

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
					$wp_customize,
					'tesseract_mobmenu_buttons_link_hover_color_control',
					array(
						'label'      => __( 'Buttons Block Link Hover Color', 'tesseract' ),
						'section'    => 'tesseract_mobmenu',
						'settings'   => 'tesseract_mobmenu_buttons_link_hover_color',
						'priority' 	 => 21,
						'active_callback'=> 'tesseract_mobmenu_buttons_enable'
					) )
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_maxbtn_sep_color_header', array(
				'default'           => '',
				'type'           	=> 'option',
				'sanitize_callback' => '__return_false'
				)
			);

				$wp_customize->add_control(
					new Tesseract_Customize_Header_Control(
					$wp_customize,
					'tesseract_mobmenu_maxbtn_sep_color_header_control',
					array(
						'label' 			=>  __('Maxbutton Separator Color', 'tesseract' ),
						'section' 			=> 'tesseract_mobmenu',
						'settings' 			=> 'tesseract_mobmenu_maxbtn_sep_color_header',
						'priority' 			=> 	22,
						'active_callback' 	=> 'tesseract_mobmenu_maxbtn_sep_enable'
						)
					)
				);

			$wp_customize->add_setting( 'tesseract_mobmenu_maxbtn_sep_color', array(
					'sanitize_callback' => 'tesseract_sanitize_radio_mob_maxbtn_sep_color',
					'default'			=> 'dark'
			) );

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'tesseract_mobmenu_maxbtn_sep_color_control',
						array(
							'section'        => 'tesseract_mobmenu',
							'settings'       => 'tesseract_mobmenu_maxbtn_sep_color',
							'type'           => 'radio',
							'choices' 		 => array(
								'dark' 	 	=> __( 'Dark', 'tesseract'),
								'light' 	=> __( 'Light', 'tesseract')
							),
							'priority' 		 => 23,
						'active_callback' 	=> 'tesseract_mobmenu_maxbtn_sep_enable'
						)
					)
				);

