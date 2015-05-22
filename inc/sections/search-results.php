<?php
/*  
 * section SEARCH RESULTS
 */					 			
			
   	$wp_customize->add_section( 'tesseract_search_results' , array(
    	'title'      		=> __('Search Results Page Options', 'tesseract'),
    	'priority'   		=> 2,
		'panel' 			=> 'tesseract_layout'
	) );						

		$wp_customize->add_setting( 'tesseract_search_results_layout', array(
				'sanitize_callback' => 'tesseract_sanitize_select_search_results_layout_types',
				'default' 			=> 'sidebar-left'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_search_results_layout_control',
					array(
						'label'         => __( 'Choose a layout type for the Search Results page', 'tesseract' ),
						'section'       => 'tesseract_search_results',
						'settings'      => 'tesseract_search_results_layout',
						'type'          => 'select',
						'choices'		=> array(
							'sidebar-left'  	=> 	'Left Sidebar',
							'sidebar-right'  	=> 	'Right Sidebar',
							'fullwidth'			=>  'Full Width'
						),
						'priority' 		=> 1
					)
				)
			);	
			
		/*$wp_customize->add_setting( 'tesseract_blog_content', array(
				'sanitize_callback' => 'tesseract_blog_sanitize_content',
				'default'			=> 'excerpt'				
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_blog_content_control',
					array(
						'label'          => __( 'Choose the article content type', 'tesseract' ),
						'section'        => 'tesseract_blog',
						'settings'       => 'tesseract_blog_content',
						'type'           => 'radio',
						'choices'        => array(
							'excerpt'  	=> 'Excerpt',
							'content' 	=> 'Full Content'
						),
						'priority' 		 => 1										
					)
				)
			);

		$wp_customize->add_setting( 'tesseract_blog_display_featimg', array(
				'sanitize_callback' => 'tesseract_sanitize_checkbox',
				'default'			=> 0				
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_blog_display_featimg_control',
					array(
						'label'          => __( 'Display posts\' featured image on the blog page', 'tesseract' ),
						'section'        => 'tesseract_blog',
						'settings'       => 'tesseract_blog_display_featimg',
						'type'           => 'checkbox',
						'priority' 		 => 2	
					)
				)
			);	
			
		$wp_customize->add_setting( 'tesseract_blog_featimg_pos', array(
			'sanitize_callback' => 'tesseract_blog_sanitize_featimg_pos',
			'default' 			=> 'above'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_blog_featimg_pos_control',
					array(
						'label'          => __( 'Choose the featured image position', 'tesseract' ),
						'section'        => 'tesseract_blog',
						'settings'       => 'tesseract_blog_featimg_pos',
						'type'           => 'radio',
						'choices'        => array(
							'above'  	=> 'Above the post title',
							'below' 	=> 'Below the post title'
						),
						'priority' 		 => 3,
						'active_callback' 	=> 'tesseract_blog_featimg_sizes_enable'										
					)
				)
			);				
	
		$wp_customize->add_setting( 'tesseract_blog_featimg_size', array(
			'sanitize_callback' => 'tesseract_blog_sanitize_featimg_size',
			'default' 			=> 'default'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_blog_featimg_size_control',
					array(
						'label'          => __( 'Choose the featured image ratio', 'tesseract' ),
						'section'        => 'tesseract_blog',
						'settings'       => 'tesseract_blog_featimg_size',
						'type'           => 'radio',
						'choices'        => array(
							'default'  	=> '1:1 (Default width/height ratio)',
							'tv' 		=> '4:3',
							'hdtv' 		=> '16:9',
							'theater1' 	=> '1.85:1',
							'theater2' 	=> '2.35:1',
							'pixel' 	=> 'I use my own pixel value'
						),
						'priority' 		 => 4,
						'active_callback' 	=> 'tesseract_blog_featimg_sizes_enable'										
					)
				)
			);	
			
		$wp_customize->add_setting( 'tesseract_blog_featimg_px_size', array(
			'sanitize_callback' => 'absint'
		) );
		
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'tesseract_blog_featimg_px_size_control',
					array(
						'label'          => __( 'Featured image height in pixels', 'tesseract' ),
						'section'        => 'tesseract_blog',
						'settings'       => 'tesseract_blog_featimg_px_size',
						'type'           => 'text',
						'priority' 		 => 5,
						'active_callback' 	=> 'tesseract_blog_featimg_px_size_enable'										
					)
				)
			);*/						
				
