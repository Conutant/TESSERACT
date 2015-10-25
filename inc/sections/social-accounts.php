<?php
/*
 * section SOCIAL/ACCOUNTS
 */

	for ( $i = 1; $i <= 10; $i++ ) {
		$account_number = sprintf( '%02d', $i );
		$is_used = is_string( get_theme_mod( "tesseract_social_account{$account_number}_name" ) );

		$sectionName = ( $is_used ) ? get_theme_mod( "tesseract_social_account{$account_number}_name" ) . ' Account ' . __( 'Settings', 'tesseract' ) : __( "Social Account {$account_number} Settings", 'tesseract' );
		$sectionPriority = ( $is_used ) ? $i : $i + 10;
		$networkName = ( $is_used ) ? get_theme_mod( "tesseract_social_account{$account_number}_name" ) : __( 'Social Network Name', 'tesseract' );
		$accountUrl = ( $is_used ) ? get_theme_mod( "tesseract_social_account{$account_number}_name" ) . ' Account ' . __( 'URL', 'tesseract' ) : __( 'Social Network URL', 'tesseract' );

		$wp_customize->add_section( "tesseract_social_account{$account_number}", array(
			'title'      => $sectionName,
			'priority'   => $sectionPriority,
			'panel' 	 => 'tesseract_social'
		));

		$wp_customize->add_setting( "tesseract_social_account{$account_number}_name", array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_html'
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				"tesseract_social_account{$account_number}_name_control",
				array(
					'label'          => $networkName,
					'section'        => "tesseract_social_account{$account_number}",
					'settings'       => "tesseract_social_account{$account_number}_name",
					'type'           => 'text',
					'priority' 		 => 2
				)
			)
		);

		$wp_customize->add_setting( "tesseract_social_account{$account_number}_url", array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'esc_url'
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				"tesseract_social_account{$account_number}_url_control",
				array(
					'label'          => $accountUrl,
					'section'        => "tesseract_social_account{$account_number}",
					'settings'       => "tesseract_social_account{$account_number}_url",
					'type'           => 'text',
					'priority' 		 => 2
				)
			)
		);

		$wp_customize->add_setting( "tesseract_social_account{$account_number}_image", array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
		));

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				"tesseract_social_account{$account_number}_image_control",
				array(
					'label'      => __( 'Upload an icon', 'tesseract' ),
					'section'    => "tesseract_social_account{$account_number}",
					'settings'   => "tesseract_social_account{$account_number}_image",
					'priority' 	 => 3
				)
			)
		);
	}