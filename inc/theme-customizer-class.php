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
		//1. Define a new section (if desired) to the Theme Customizer
		/* $wp_customize->add_section( 'mytheme_options',
				array(
						'title' => __( 'XXXX Options', 'tesseract' ), //Visible title of section
						'priority' => 95, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize some example settings for Tesseract.', 'tesseract'), //Descriptive tooltip
				)
		);

		//2. Register new settings to the WP database...
		$wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#2BA6CB', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'mytheme_link_textcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Linkxxxx Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );
 */
		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

		//here we add individual sections and settings...
		self::register_navigation_section($wp_customize);
		self::register_featured_text_section($wp_customize);
		self::register_featured_subheadline_section($wp_customize);
	}

	//navigation options
	public static function register_navigation_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_navigation_options',
				array(
						'title' => __( 'Navigation Menu', 'tesseract' ), //Visible title of section
						'priority' => 105, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize navigation menu for Tesseract.', 'tesseract'), //Descriptive tooltip
				)
		);

		//2. Register new settings to the WP database...
		//menu text color
		$wp_customize->add_setting( 'menu_link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '#2BA6CB', //Default setting/value to save
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
						'default' => '#303647', //Default setting/value to save
						'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
						'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
						'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
		);

		//menu background opacity
		$wp_customize->add_setting( 'menu_link_bgopacity', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
						'default' => '7', //Default setting/value to save
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
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
				$wp_customize, //Pass the $wp_customize object (required)
				'tesseract_menu_link_bgcolor', //Set a unique ID for the control
				array(
						'label' => __( 'Menu Background Color', 'tesseract' ), //Admin-visible name of the control
						'section' => 'tesseract_navigation_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
						'settings' => 'menu_link_bgcolor', //Which setting to load and manipulate (serialized is okay)
						'priority' => 10, //Determines the order this control appears in for the specified section
				)
		) );

		//menu background opacity
		$wp_customize->add_control( 'tesseract_menu_link_bgopacity',
				 array(
					'label'   =>  __('Menu Background Opacity', 'tesseract'),
					'section' => 'tesseract_navigation_options',
				 	'settings'=> 'menu_link_bgopacity',
					'type'    => 'select',
					'choices' => array("10%", "20%", "30%", "40%", "50%", "60%", "70%", "80%", "90%", "100%"),
					'priority' => 10
		) );
	}

	//Featured text options
	public static function register_featured_text_section( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'tesseract_featured_text_options',
				array(
						'title' => __( 'Featured Headline Options', 'tesseract' ), //Visible title of section
						'priority' => 96, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize featured text for Tesseract.', 'tesseract'), //Descriptive tooltip
				)
		);

		//2. Register new settings to the WP database...
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
						'default' => '12', //Default setting/value to save
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
		$wp_customize->add_control( 'tesseract_featured_text_fontsize',
				array(
						'label'   =>  __('Featured Text Fontsize', 'tesseract'),
						'section' => 'tesseract_featured_text_options',
						'settings'=> 'featured_text_fontsize',
						'type'    => 'select',
						'choices' => array(8,10,12,14,16,24,36,40,48,62,72),
						'priority' => 10
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
						'title' => __( 'Featured Sub Headline Options', 'tesseract' ), //Visible title of section
						'priority' => 97, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Allows you to customize featured sub headline text for Tesseract.', 'tesseract'), //Descriptive tooltip
				)
		);

		//2. Register new settings to the WP database...
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
						'default' => '0', //Default setting/value to save
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
		$wp_customize->add_control( 'tesseract_featured_subheadline_fontsize',
				array(
						'label'   =>  __('Featured Text Fontsize', 'tesseract'),
						'section' => 'tesseract_featured_subheadline_options',
						'settings'=> 'featured_subheadline_fontsize',
						'type'    => 'select',
						'choices' => array(8,10,12),
						'priority' => 11
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
           <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?>
           <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?>
           <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
      </style>
      <!--/Customizer CSS-->
      <?php
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
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );
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
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}