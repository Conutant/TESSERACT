<?php
/**
 * Contains methods for customizing the theme customization screen.
*
* @link http://codex.wordpress.org/Theme_Customization_API
* @since MyTheme 1.0
*/

class Tesseract_Customize {
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * @see add_action('customize_register',$func)
	 * @param \WP_Customize_Manager $wp_customize
	 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since MyTheme 1.0
	 */
	public static function register ( $wp_customize ) {
		//require customized csutome controller classes...
		require_once('customizer-controls/custom-controllers.php');
		//for default sections we set transport postMessage
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

		//here we add individual sections and settings...
		//logo section
		self::register_logo_section($wp_customize);
		//navigation section
		self::register_navigation_section($wp_customize);
		//navigation menu action buttons
		self::register_navigation_action_buttons($wp_customize);
		//footer menu navigation
		self::register_footer_navigation_action_buttons($wp_customize);
		//featured section
		self::register_featured_section($wp_customize);
		self::register_featured_header_image_section($wp_customize);
		self::register_featured_headline_section($wp_customize);
		self::register_featured_subheadline_section($wp_customize);
		self::register_feature_action_buttons($wp_customize);



	}

	//navigation options
	public static function register_navigation_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_navigation_options',
				array(
						'title' => __( 'Navigation Menu', 'tesseract' ), //Visible title of section
						'priority' => 110, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize navigation menu for Tesseract.', 'tesseract'), //Descriptive tooltip
				)
		);

		//2. Register new settings to the WP database...
		//menu text color
		$wp_customize->add_setting( 'menu_link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#ffffff', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);
		//menu hover color
		$wp_customize->add_setting( 'menu_link_hovercolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#ffffff', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);
		//menu background color
		$wp_customize->add_setting( 'menu_link_bgcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => 'rgba(66, 66, 66, 0.74)', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);
		//menu action buttons
		$wp_customize->add_setting( 'navigation-widget', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '<a>test</a>',
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		//menu text color control
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_menu_link_textcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Menu Text Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'menu_link_textcolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//menu text hover color control
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_menu_link_hovercolor', //Set a unique ID for the control
				array(
						'label' => __( 'Menu Hover Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'menu_link_hovercolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );
	 	//menu background color

		$wp_customize->add_control( new Tesseract_Customize_Alpha_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_menu_link_bgcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Menu Background Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'menu_link_bgcolor', //Which setting to load and manipulate (serialized is okay)
						'palette' => true,
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//menu action buttons control
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_navigation_action_button', //Set a unique ID for the control
				array(
						'label' => __( 'Menu Action Button', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'navigation-widget', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
						'type'		=> 'textarea'
				)
		) );

	}

	//logo options
	public static function register_logo_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_logo',
				array(
						'title' => __( 'Logo', 'tesseract' ), //Visible title of section
						'priority' => 105, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize logo', 'tesseract'), //Descriptive tooltip
				)
		);
		$wp_customize->add_setting( 'theme_logo', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' =>'', /* get_bloginfo('template_directory').'/images/logo.png',  *///Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		//menu text color control
		$wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_theme_logo', //Set a unique ID for the control
				array(
						'label' => __( 'Logo', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_logo', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'theme_logo', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );


	}
	//Navigation buttons
	public static function register_navigation_action_buttons( $wp_customize ) {

		//2. Define a new setting (if desired) to the Theme Customizer
		$wp_customize->add_setting( 'navigation-widget', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => 'jjj',
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define th control itself (which links a setting to a section and renders the HTML controls)...
		//menu text color control
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_navigation_action_button', //Set a unique ID for the control
				array(
						'label' => __( 'Navigation Action Button', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'navigation-widget', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
						'type'		=> 'textarea'
				)
		) );


	}
	//Footer Navigation buttons
	public static function register_footer_navigation_action_buttons( $wp_customize ) {

		//2. Define a new setting (if desired) to the Theme Customizer
		$wp_customize->add_setting( 'footer-navigation-widget', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => 'jjj',
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define th control itself (which links a setting to a section and renders the HTML controls)...
		//menu text color control
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_footer_navigation_action_button', //Set a unique ID for the control
				array(
						'label' => __( 'Footer Navigation Action Button', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'footer-navigation-widget', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
						'type'		=> 'textarea'
				)
		) );


	}

	//featured buttons
	public static function register_feature_action_buttons ( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'featured_button_options',
				array(
						'title' => __( 'Buttons', 'tesseract' ), //Visible title of section
						'priority' => 90, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize action buttons', 'tesseract'), //Descriptive tooltip,
						/* 'panel'				=>'feature_panel' */
				)
		);
		//2. Define a new setting (if desired) to the Theme Customizer
		$wp_customize->add_setting( 'feactured_action_button', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '<a href="/" class="button primary-button">Watch the Video</a><a href="/" class="button secondary-button">Start</a>',
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define th control itself (which links a setting to a section and renders the HTML controls)...
		//menu text color control
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_featured_action_button', //Set a unique ID for the control
				array(
						'label' => __( 'Featured Action Button', 'tesseract' ), //Admin-visible name of the control
						'section' => 'featured_button_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'feactured_action_button', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
						 'type'		=> 'textarea'
				)
		) );


	}
	//Featured  options
	public static function register_featured_section( $wp_customize ) {
		//First we create panel to subgroup all featured components
		$wp_customize->add_panel('feature_panel',array(
				'priority'			=> 10,
				'capability'		=>'edit_theme_options',
				'theme_supports'	=>'',
				'title'				=>'Feature Options',
				'description'		=>'You can customize all featured part here'
		));
	}
	//Header Image
	public static function register_featured_header_image_section( $wp_customize ) {
		//First we create panel to subgroup all featured components
		$wp_customize->add_section('header_image',array(
			'title'				=> __('Featured Image'),
			'theme_supports'	=>'custom-header',
			'panel'				=>'feature_panel',
			'priority'			=> 90,
		));
	}
	public static function register_featured_headline_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_featured_text_options',
				array(
						'title' => __( 'Featured Headline', 'tesseract' ), //Visible title of section
						'priority' => 90, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize featured text for Tesseract.', 'tesseract'), //Descriptive tooltip
						'panel'		=>'feature_panel'
				)
		);

		//2. Register new settings to the WP database...
		//featured text color
		$wp_customize->add_setting( 'featured_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => 'HEADLINE', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);
		//featured text color
		$wp_customize->add_setting( 'featured_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#ffffff', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//featured text fontsize
		$wp_customize->add_setting( 'featured_text_fontsize', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '80', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//featured text dropshadow
		$wp_customize->add_setting( 'featured_text_hasshadow', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '0', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		//featured text content
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_featured_text', //Set a unique ID for the control
				array(
						'label' => __( 'Featured Text', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_text_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_text', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//menu text color control
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_featured_textcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Featured Text Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_text_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_textcolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );



		//featured text fontsize
		$wp_customize->add_control(new Tesseract_Customize_Size_Control(
			$wp_customize,
			'tesseract_featured_text_fontsize',
				array(
						'label' => __( 'Featured Text Fontsize', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_text_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_text_fontsize', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//featured text shadow
		$wp_customize->add_control( 'tesseract_featured_text_hasshadow',
				array(
						'label'   =>  __('Featured Text Shadow', 'tesseract'),
						'section' => 'tesseract_featured_text_options',
						'settings'=> 'featured_text_hasshadow',
						'type'    => 'radio',
						'choices' => array('No','Yes'),
						'priority' => 10
				) );

	}

	//Featured text sub options
	public static function register_featured_subheadline_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_featured_subheadline_options',
				array(
						'title' => __( 'Featured Sub Headline', 'tesseract' ), //Visible title of section
						'priority' => 90, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize featured sub headline text for Tesseract.', 'tesseract'), //Descriptive tooltip
						'panel'		=> 'feature_panel'
				)
		);

		//2. Register new settings to the WP database...
		//featured text color
		$wp_customize->add_setting( 'featured_subheadline_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => 'Create a website and build your business.', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);
		//featured _subheadline_ color
		$wp_customize->add_setting( 'featured_subheadline_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#ffffff', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//featured _subheadline_ fontsize
		$wp_customize->add_setting( 'featured_subheadline_fontsize', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '12', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//featured _subheadline_ dropshadow
		$wp_customize->add_setting( 'featured_subheadline_hasshadow', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '0', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);


		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...

		//featured subheadline text content
		$wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_featured_subheadline_text', //Set a unique ID for the control
				array(
						'label' => __( 'Sub Headline Text', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_subheadline_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_subheadline_text', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//menu text color control
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_featured_subheadline_textcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Featured Text Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_subheadline_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_subheadline_textcolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 11, //Determines the order this control appears in for the specified section
				)
		) );



		//featured text fontsize

		$wp_customize->add_control(new Tesseract_Customize_Size_Control(
				$wp_customize,
				'tesseract_featured_subheadline_fontsize',
				array(
						'label' => __( 'Sub Headline Fontsize', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_featured_subheadline_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'featured_subheadline_fontsize', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//featured text shadow
		$wp_customize->add_control( 'tesseract_featured_subheadline_hasshadow',
				array(
						'label'   =>  __('Featured Text Shadow', 'tesseract'),
						'section' => 'tesseract_featured_subheadline_options',
						'settings'=> 'featured_subheadline_hasshadow',
						'type'    => 'radio',
						'choices' => array('No','Yes'),
						'priority' => 11
				) );
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 * @since MyTheme 1.0
	 */
	public static function header_output() {
		?>
      <!--Customizer CSS-->
      <style type="text/css">
		   <?php ob_start(); ?>
           <?php // self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?>
           <?php // self::generate_css('body', 'background-color', 'background_color', '#'); ?>
           <?php // self::generate_css('a', 'color', 'link_textcolor'); ?>
           /* Featured Headline  */
			<?php
				//self::generate_css('.featured-widget h1', 'color','featured_textcolor','','',true,'@media screen and (min-width: 980px)');
				self::generate_css('.featured-widget h1', 'color','featured_textcolor');
				self::generate_css('.featured-widget h1', 'font-size','featured_text_fontsize','','px');
			?>
			<?php

				if(get_theme_mod('featured_text_hasshadow'))
					self::generate_css('.featured-widget h1', 'text-shadow','','rgba(81, 81, 81, 0.8) 1px 1px 1px');
			 ?>
           	/* Featured Sub Headline */
			<?php self::generate_css('.featured-widget .textwidget p', 'color','featured_subheadline_textcolor'); ?>
			<?php self::generate_css('.featured-widget .textwidget p', 'font-size','featured_subheadline_fontsize','','px'); ?>
			<?php
				if(get_theme_mod('featured_subheadline_hasshadow'))
					self::generate_css('.featured-widget .textwidget p', 'text-shadow','','rgba(81, 81, 81, 0.8) 1px 1px 1px');
				?>
           /* Navigation Menu */
           <?php self::generate_css('.main-navigation a', 'color', 'menu_link_textcolor');?>
           <?php self::generate_css('.main-navigation a:hover', 'color', 'menu_link_hovercolor');?>
           <?php self::generate_css('span#navigation-widget', 'float','','right');?>
			/* Navigation bgcolor : rgba(81,29,130,0.74) */

           <?php
           	  if(is_home())
           	 	self::generate_css('.site-banner', 'background-color', 'menu_link_bgcolor','','',true,'@media screen and (min-width: 980px)');
           	  else
           	  {
           	  	$rgba = get_theme_mod('menu_link_bgcolor');
           	  	//rgba(x,y,z,b)
           	  	$values = explode(',',$rgba);
           	  	if(count($values)==4)
           	  		unset($values[3]);
           	  	$rgb = str_replace('rgba','rgb',implode(',',$values)).')';

           	  	self::generate_css('.site-banner', 'background-color', '',$rgb);
           	  }
           	 ?>
           <?php echo ob_get_clean();?>
      </style>
      <!--/Customizer CSS-->
      <?php
   }
   public static function header_outputtest() {
   		wp_add_inline_style('testboom','h1 { color: #ff0000 !important;}');
      }

   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    *
    * Used by hook: 'customize_preview_init'
    *
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {


      wp_enqueue_script(
           'tesseract-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );

   }
   /**
    * customizer css load
    */
   public static function tesseract_enqueue_customizer_controls_styles() {

   	wp_register_style( 'tesseract-customizer-controls', get_template_directory_uri() . '/css/admin/customizer-controls.css', NULL, NULL, 'all' );
   	wp_enqueue_style( 'tesseract-customizer-controls' );

   }
   public static function tesseract_enqueue_customizer_admin_scripts() {

   	wp_register_script( 'customizer-admin-js', get_template_directory_uri() . '/js/custom-controllers.js', array( 'jquery' ), NULL, true );
   	wp_enqueue_script( 'customizer-admin-js' );

   }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true, $media_query ='' ) {
      $return = '';

      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );

      }else if(empty($mod)){
		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix.$postfix
		);
	 }
	 //media query
     if(!empty($media_query))
     	$return  = sprintf('%s { %s }', $media_query, $return);
	 if ( $echo ) {
	 	echo $return;
	 }else
	 {
      return $return;
	 }

    }
}