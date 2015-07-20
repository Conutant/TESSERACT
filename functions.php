<?php
/**
 * Tesseract functions and definitions
 *
 * @package Tesseract
 */
 
 // Defines
define( 'TESSERACT_THEME_VERSION', '2.1' );
define( 'TESSERACT_THEME_NAME', 'TESSERACT-dev_gabor' );

define( 'TESSERACT_THEME_DIR', get_template_directory() );
define( 'TESSERACT_THEME_URL', get_template_directory_uri() );

require_once 'admin/class-tesseract-theme-update.php';

// Theme Updates
add_action( 'init','Tesseract_Theme_Update::init' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( ! function_exists( 'tesseract_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tesseract_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tesseract, use a find and replace
	 * to change 'tesseract' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tesseract', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Add tyles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', tesseract_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Add Woocommerce support
	 */	
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	// Set default size.
	set_post_thumbnail_size( 1580, 480, true );
	
	// Add default size for single pages.
	add_image_size( 'tesseract-large', '1580', '480', true );

	// Add default size for homepage.
	add_image_size( 'tesseract-thumbnail', '210', '150', true );
		
	// Add default logo size for Jetpack.
	add_image_size( 'tesseract-site-logo', '300', '9999', false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Header', 'tesseract' ),
		'primary_right' => __( 'Header Right', 'tesseract' ),		
		'secondary' => __( 'Footer', 'tesseract' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tesseract_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
}
endif; // tesseract_setup
add_action( 'after_setup_theme', 'tesseract_setup' );

/* Backwards compatibility 
 * @ https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 * To enable support in existing themes without breaking backwards compatibility, 
 * theme authors can check if the callback function exists, and add a shiv in case 
 * it does not:
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
endif;	

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tesseract_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'tesseract' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on the left.', 'tesseract' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
}
add_action( 'widgets_init', 'tesseract_widgets_init' );

/**
 * ----------------------------------------------------------------------------------------Includes
 */
 
/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function tesseract_admin_fonts() {
	wp_enqueue_style( 'tesseract-font', tesseract_fonts_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'tesseract_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Tesseract naviagetion related functions.
 */
require get_template_directory() . '/inc/navigation-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-functions.php';
require get_template_directory() . '/inc/customizer-frontend-functions.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */ 
if ( is_plugin_active('woocommerce/woocommerce.php') ) 
	require get_template_directory() . '/woocommerce/woocommerce-functions.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Content Importer
 */

require get_template_directory() . '/importer/load.php';

/**
 * ------------------------------------------------------------------------------------EOF Includes
 */

/**
 * Enqueue scripts and styles.
 */
function tesseract_scripts() {
	
	// Enqueue default style
	wp_enqueue_style( 'tesseract-style', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Google fonts
	wp_enqueue_style( 'tesseract-fonts', tesseract_fonts_url(), array(), '1.0.0' );
	
    // Social icons style	
	wp_enqueue_style( 'tesseract-icons', get_template_directory_uri() . '/css/typicons.css', array(), '1.0.0' );
	
    // Horizontal menu style	
	wp_enqueue_style( 'tesseract-site-banner', get_template_directory_uri() . '/css/site-banner.css', array('tesseract-style'), '1.0.0' );		
	wp_enqueue_style( 'tesseract-footer-banner', get_template_directory_uri() . '/css/footer-banner.css', array('tesseract-style'), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'tesseract-sidr-style', get_template_directory_uri() . '/css/jquery.sidr.css', array('tesseract-style'), '1.0.0' );
	wp_enqueue_style( 'tesseract-googlefonts', '//fonts.googleapis.com/css?family=Lato:300', array('tesseract-style'), '1.0.0' );
	
	// Fittext
	wp_enqueue_script( 'tesseract-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0.0', true );
	
	//Mobile menu
	wp_enqueue_script( 'tesseract-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array( 'tesseract-fittext' ), '1.0.0', true );
	
    // JS helpers (This is also the place where we call the jQuery in array)
	wp_enqueue_script( 'tesseract-helpers-functions', get_template_directory_uri() . '/js/helpers-functions.js', array( 'tesseract-sidr' ), '1.0.0', true );
	wp_enqueue_script( 'tesseract-helpers', get_template_directory_uri() . '/js/helpers.js', array( 'tesseract-helpers-functions' ), '1.0.0', true );	
	
	if ( is_plugin_active('beaver-builder-lite-version/fl-builder.php') || is_plugin_active('beaver-builder/fl-builder.php') ) {
		wp_enqueue_script( 'tesseract-helpers-beaver', get_template_directory_uri() . '/js/helpers-beaver.js', array( 'tesseract-helpers' ), '1.0.0', true );	
	}
	
	// Skip link fix
	wp_enqueue_script( 'tesseract-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Register the script
	wp_register_script( 'tesseract_helpers', get_template_directory_uri() . '/js/helpers.js' );

	// Localize script
	
	//We need to know which menu is used as main menu by the mobile menu script
	$leftMenu = get_theme_mod('tesseract_header_left_content_menu_select');
	$is_leftMenu = ( !is_string($leftMenu) || ( is_string($leftMenu) && ( $leftMenu !== 'none' ) ) );
	
	$rightMenu = get_theme_mod('tesseract_header_right_menu_select');
	$is_rightMenu = ( ( is_string($rightMenu) && ( $rightMenu !== 'none' ) ) && ( get_theme_mod('tesseract_header_right_content') == 'menu' ) );		
	
	$is_both = ( $is_leftMenu && $is_rightMenu ) ? TRUE : FALSE;
	
	$locSelected = get_theme_mod('tesseract_mobmenu_location_select');
	$is_loc = is_string( $locSelected ) ? TRUE : FALSE;
	
	if ( $is_both ) :
		$sidrMenu = ( is_string( $locSelected ) && ( $locSelected !== 'none' ) ) ? $locSelected : 'leftmenu-to-sidr'; 
	elseif ( $is_leftMenu && !$is_rightMenu ) : $sidrMenu = 'leftmenu-to-sidr';
	elseif ( !$is_leftMenu && $is_rightMenu ) : $sidrMenu = 'rightmenu-to-sidr';
	elseif ( ($leftMenu == 'none') && ( $locSelected == 'leftmenu-to-sidr' ) || ($rightMenu == 'none') && ( $locSelected == 'rightmenu-to-sidr' ) ) : $sidrMenu = 'sidr-conflict';
	else : $sidrMenu = FALSE; 
	endif; 
	//EOF $sidrMenu definiton	
	
	//Localize mmobile menu breakpoint setting -> mobile menu only under 768px or by default ( no screen width dependency )	
	$mobmenu_breakpoint = ( get_theme_mod('tesseract_mobmenu_to_default') == 0 ) ? 'brkpt-768' : 'no-brkpt';
		
    wp_localize_script( 'tesseract_helpers', 'tesseract_vars', array(  
		'hpad' 					  						=> get_theme_mod('tesseract_header_height'),
		'fpad'   										=> get_theme_mod('tesseract_footer_height'),		  		
		'mobmenu_locToUse' 								=> $sidrMenu,
		'mobmenu_breakpoint'							=> $mobmenu_breakpoint,
		'mobmenu_toDefault' 							=> get_theme_mod('tesseract_mobmenu_to_default') 
	) );	
	
	wp_enqueue_script( 'tesseract_helpers' );	

	$header_bckRGB = get_theme_mod('tesseract_header_colors_bck_color') ? get_theme_mod('tesseract_header_colors_bck_color') : '#59bcd9';
	
	$opValue = get_theme_mod('tesseract_header_colors_bck_color_opacity');	
	$header_bckOpacity = is_numeric($opValue) ? $opValue : 100;	
	
	$hex = $header_bckRGB;
	$header_bckOpacity = $header_bckOpacity / 100;
	
	preg_match("/\s*(rgba\(\s*[0-9]+\s*,\s*[0-9]+\s*,\s*[0-9]+\s*,\d+\d*\.\d+\))/", $hex, $match);
	$rgba = $match ? true : false; 
	
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$header_bckColor = "rgb($r, $g, $b)";
	$header_bckColor_home = "rgba($r, $g, $b, $header_bckOpacity)";	
	
	//HEADER and FOOTER
	$header_textColor = get_theme_mod('tesseract_header_colors_text_color') ? get_theme_mod('tesseract_header_colors_text_color') : '#ffffff';
	
	$header_linkColor = get_theme_mod('tesseract_header_colors_link_color') ? get_theme_mod('tesseract_header_colors_link_color') : '#ffffff';
	list($hl_r, $hl_g, $hl_b) = sscanf($header_linkColor, "#%02x%02x%02x");
	$header_linkColor_rgba = "rgba($hl_r, $hl_g, $hl_b, 0.2)";	
	
	$header_linkHoverColor = get_theme_mod('tesseract_header_colors_link_hover_color') ? get_theme_mod('tesseract_header_colors_link_hover_color') : '#d1ecff';
	
	$header_right_searchColor = get_theme_mod('tesseract_header_right_search_color') ? get_theme_mod('tesseract_header_right_search_color') : '#cccccc';
	$header_right_searchBackgroundColor = get_theme_mod('tesseract_header_right_search_background_color') ? get_theme_mod('tesseract_header_right_search_background_color') : '#ffffff';	
	
	$footer_bckColor = get_theme_mod('tesseract_footer_colors_bck_color') ? get_theme_mod('tesseract_footer_colors_bck_color') : '#1e73be';
	
	$footer_textColor = get_theme_mod('tesseract_footer_colors_text_color') ? get_theme_mod('tesseract_footer_colors_text_color') : '#ffffff';
	
	$footer_headingColor = get_theme_mod('tesseract_footer_colors_heading_color') ? get_theme_mod('tesseract_footer_colors_heading_color') : '#ffffff';
	
	$footer_linkColor = get_theme_mod('tesseract_footer_colors_link_color') ? get_theme_mod('tesseract_footer_colors_link_color') : '#ffffff';
	
	$footer_linkHoverColor = get_theme_mod('tesseract_footer_colors_link_hover_color') ? get_theme_mod('tesseract_footer_colors_link_hover_color') : '#d1ecff'; 
	
	$footer_left_searchColor = get_theme_mod('tesseract_footer_left_search_color') ? get_theme_mod('tesseract_footer_left_search_color') : '#cccccc';
	$footer_left_searchBackgroundColor = get_theme_mod('tesseract_footer_left_search_background_color') ? get_theme_mod('tesseract_footer_left_search_background_color') : '#ffffff';
	
	$add_content_borderColor_array = tesseract_hex2rgb( $footer_linkColor );
	$add_content_borderColor = implode( ', ', $add_content_borderColor_array );	
	
	//MOBMENU
	$mobmenu_bckColor = get_theme_mod('tesseract_mobmenu_background_color') ? get_theme_mod('tesseract_mobmenu_background_color') : '#336ca6';
	$mobmenu_linkColor = get_theme_mod('tesseract_mobmenu_link_color') ? get_theme_mod('tesseract_mobmenu_link_color') : '#fff';
	$mobmenu_linkHoverColor = get_theme_mod('tesseract_mobmenu_link_hover_color') ? get_theme_mod('tesseract_mobmenu_link_hover_color') : '#fff';
	
	list($lc_r, $lc_g, $lc_b) = sscanf($mobmenu_linkColor, "#%02x%02x%02x");
	$mob_rgb_linkColor_submenu = "rgba($lc_r, $lc_g, $lc_b, 0.8)";

	list($lhc_r, $lhc_g, $lhc_b) = sscanf($mobmenu_linkHoverColor, "#%02x%02x%02x");
	$mob_rgb_linkHoverColor_submenu = "rgba($lhc_r, $lhc_g, $lhc_b, 0.8)";
	
	$mobmenu_linkHoverBckColor_option = get_theme_mod('tesseract_mobmenu_link_hover_background_color') ? get_theme_mod('tesseract_mobmenu_link_hover_background_color') : 'dark';	
	$mobmenu_linkHoverBckColor_option_custom = get_theme_mod('tesseract_mobmenu_link_hover_background_color_custom');		
	switch ( $mobmenu_linkHoverBckColor_option ) {
		
		case 'custom':
			$mobmenu_linkHoverBckColor = $mobmenu_linkHoverBckColor_option_custom;
			break;
		case 'light':
			$mobmenu_linkHoverBckColor = 'rgba(255, 255, 255, 0.1)';
			break;
		default:
			$mobmenu_linkHoverBckColor = 'rgba(0, 0, 0, 0.2)';	
	}
	
	$mobmenu_shadowColor_option = get_theme_mod('tesseract_mobmenu_shadow_color') ? get_theme_mod('tesseract_mobmenu_shadow_color') : 'dark';
	$mobmenu_shadowColor_option_custom = get_theme_mod('tesseract_mobmenu_shadow_color_custom') ? get_theme_mod('tesseract_mobmenu_shadow_color_custom') : 'dark';
	switch ( $mobmenu_shadowColor_option ) {
		
		case 'custom':
			list($shad_r, $shad_g, $shad_b) = sscanf($mobmenu_shadowColor_option_custom, "#%02x%02x%02x");					
			break;
		case 'light':
			$shad_r = 255; 
			$shad_g = 255; 
			$shad_b = 255;
			break;
		default:
			$shad_r = 0; 
			$shad_g = 0; 
			$shad_b = 0;		
	}
	
	$mobmenu_searchColor = get_theme_mod('tesseract_mobmenu_search_color');
	list($sc_r, $sc_g, $sc_b) = sscanf($mobmenu_searchColor, "#%02x%02x%02x");
	$mobmenu_searchColorRgb = "rgba($sc_r, $sc_g, $sc_b, 0.6)";	
	
	$mobmenu_searchBckColor = get_theme_mod('tesseract_mobmenu_search_background_color');
	$mobmenu_searchBckColor = ( $mobmenu_searchBckColor == 'dark' ) ? 'rgba(0, 0, 0, .15)': 'rgba(255, 255, 255, 0.15)';
	
	$mobmenu_socialBckColor = get_theme_mod('tesseract_mobmenu_social_background_color');
	$mobmenu_socialBckColor = ( $mobmenu_socialBckColor == 'dark' ) ? 'rgba(0, 0, 0, .15)': 'rgba(255, 255, 255, 0.15)';
	
	$mobmenu_buttonsBckColor_option = get_theme_mod('tesseract_mobmenu_buttons_background_color') ? get_theme_mod('tesseract_mobmenu_buttons_background_color') : 'dark';	
	$mobmenu_buttonsBckColor_option_custom = get_theme_mod('tesseract_mobmenu_buttons_background_color_custom');		
	switch ( $mobmenu_buttonsBckColor_option ) {
		
		case 'custom':
			$mobmenu_buttonsBckColor = $mobmenu_buttonsBckColor_option_custom;
			break;
		case 'light':
			$mobmenu_buttonsBckColor = 'rgba(255, 255, 255, 0.1)';
			break;
		default:
			$mobmenu_buttonsBckColor = 'rgba(0, 0, 0, 0.2)';	
	}	
	
	$mobmenu_buttons_textColor = get_theme_mod('tesseract_mobmenu_buttons_text_color');
	$mobmenu_buttons_linkColor = get_theme_mod('tesseract_mobmenu_buttons_link_color');
	$mobmenu_buttons_linkHoverColor = get_theme_mod('tesseract_mobmenu_buttons_link_hover_color');		
	
	$mobmenu_buttons_maxbtnSepColor = get_theme_mod('tesseract_mobmenu_maxbtn_sep_color');	
	$mobmenu_buttons_maxbtnSepColor = ( $mobmenu_buttons_maxbtnSepColor == 'dark' ) ? 'inset 0 -1px rgba(0, 0, 0, .1)': 'inset 0 -1px rgba(255, 255, 255, 0.1)';	
	
	$dynamic_styles_mobmenu = ".sidr {
		background-color: " . $mobmenu_bckColor . ";
		}
		
	.sidr .sidr-class-menu li a,
	.sidr .sidr-class-menu li span { color: " . $mobmenu_linkColor . "; }


	.sidr .sidr-class-menu ul li a,
	.sidr .sidr-class-menu ul li span {
		color: " . $mob_rgb_linkColor_submenu . ";		
	}
	
	.sidr .sidr-class-menu li a:hover,
	.sidr .sidr-class-menu li span:hover,
	.sidr .sidr-class-menu li:first-child a:hover,
	.sidr .sidr-class-menu li:first-child span:hover { color: " . $mobmenu_linkHoverColor . "; }
	
	.sidr .sidr-class-menu ul li a:hover,
	.sidr .sidr-class-menu ul li span:hover,
	.sidr .sidr-class-menu ul li:first-child a:hover,
	.sidr .sidr-class-menu ul li:first-child span:hover { color: " . $mob_rgb_linkHoverColor_submenu . "; }	
	
	.sidr ul li > a:hover, 
	.sidr ul li > span:hover, 
	.sidr > div > ul > li:first-child > a:hover, 
	.sidr > div > ul > li:first-child > span:hover, 
	.sidr ul li ul li:hover > a, 
	.sidr ul li ul li:hover > span { 
		background: " . $mobmenu_linkHoverBckColor . "; 
		
		}	
	
	/* Shadows and Separators */
	
	.sidr ul li > a,
	.sidr ul li > span,
	#sidr-id-header-button-container-inner > * {
		-webkit-box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);
		-moz-box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);
		box-shadow: inset 0 -1px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . " , 0.2);		
	}
	
	.sidr > div > ul > li:last-of-type > a, 
	.sidr > div > ul > li:last-of-type > span, 
	#sidr-id-header-button-container-inner > *:last-of-type {
		box-shadow: none;
		}	
	
	.sidr ul.sidr-class-hr-social li a,
	.sidr ul.sidr-class-hr-social li a:first-child {
		-webkit-box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);  
		-moz-box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);  
		box-shadow: 0 1px 0 0px rgba( " . $shad_r . " ," . $shad_g . " ," . $shad_b . ", .25);			
	}
	
	/* Header Right side content */

	.sidr-class-search-field,
	.sidr-class-search-form input[type='search'] {
		background: " . $mobmenu_searchBckColor . "; 
		color: " . $mobmenu_searchColor . ";	
	}
	
	.sidr-class-hr-social {
		background: " . $mobmenu_socialBckColor . ";		
	}
	
	#sidr-id-header-button-container-inner,
	#sidr-id-header-button-container-inner > h1,
	#sidr-id-header-button-container-inner > h2,
	#sidr-id-header-button-container-inner > h3,
	#sidr-id-header-button-container-inner > h4,
	#sidr-id-header-button-container-inner > h5,
	#sidr-id-header-button-container-inner > h6 {
		background: " . $mobmenu_buttonsBckColor . ";
		color: " . $mobmenu_buttons_textColor . ";	
	}		
	
	#sidr-id-header-button-container-inner a,
	#sidr-id-header-button-container-inner button {
		color: " . $mobmenu_buttons_linkColor . ";		
	}
	
	#sidr-id-header-button-container-inner a:hover,
	#sidr-id-header-button-container-inner button:hover {
		color: " . $mobmenu_buttons_linkHoverColor . ";		
	}	

	.sidr ul li > a,
	.sidr ul li > span,
	#sidr-id-header-button-container-inner > *,
	#sidr-id-header-button-container-inner button {
		-webkit-box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
		-moz-box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
		box-shadow: " . $mobmenu_buttons_maxbtnSepColor . ";
	}

	.sidr-class-search-field.watermark, 
	.sidr-class-search-form input[type='search'].watermark {
		color: " . $lighter . ";
		}

	";
	
	if ( get_theme_mod('tesseract_mobmenu_to_default') == 1 ) {
		
		$dynamic_styles_mobmenu .= '#site-banner-main > #mobile-menu-trigger-right-wrap {
			display: table-cell;	
		}';
			
	}
	
	wp_add_inline_style( 'tesseract-sidr-style', $dynamic_styles_mobmenu );

	// HEADER & HEADER LOGO HEIGHT, HEADER WIDTH PROPS
	
	$header_logoHeight = get_theme_mod('tesseract_header_left_content_logo_height') ? get_theme_mod('tesseract_header_left_content_logo_height') : 40;

	$headerHeightInit = get_theme_mod('tesseract_header_height');
	$headerHeight = is_numeric($headerHeightInit) ? $headerHeightInit : 10;	
	
	$headerWidthProp = is_integer( get_theme_mod('tesseract_header_blocks_width_prop') ) ? get_theme_mod('tesseract_header_blocks_width_prop') : 60;

	$dynamic_styles_header = ".site-header,
	.main-navigation ul ul a,
	#header-right-menu ul ul a { background-color: " . $header_bckColor . "; }
	
	.home .site-header,
	.home .main-navigation ul ul a,
	.home #header-right ul ul a { background-color: " . $header_bckColor_home . "; }
	
	.site-header,
	.site-header h1, 
	.site-header h2,
	.site-header h3,
	.site-header h4,
	.site-header h5,
	.site-header h6 { color: " . $header_textColor . "!important; }
	
	#masthead .search-field { 
		color: " . $header_right_searchColor . "; 
		background: " . $header_right_searchBackgroundColor . ";
		}
		
	.site-header a,
	.main-navigation ul ul a,
	#header-right-menu ul ul a,
	.menu-open,
	.dashicons.menu-open,
	.menu-close,
	.dashicons.menu-close { color: " . $header_linkColor . "; }
	
	.site-header a:hover,
	.main-navigation ul ul a:hover,
	#header-right-menu ul ul a:hover,
	.menu-open:hover,
	.dashicons.menu-open:hover,
	.menu-close:hover,
	.dashicons.menu-open:hover { color: " . $header_linkHoverColor . "; }
	
	/* Header logo height */
	
	#site-banner .site-logo img {
		height: " . $header_logoHeight . "px;
		}
		
	#masthead {
		padding-top: " . $headerHeight . "px;
		padding-bottom: " . $headerHeight . "px;
		}	
		
	/* Header width props */
	
	#site-banner-left {
		width: " . $headerWidthProp . "%;
		}
		
	#site-banner-right {
		width: " . ( 100 - $headerWidthProp ) . "%;
		}	
	
	";
	$hcContent = get_theme_mod('tesseract_header_right_content');
	$wooCart = get_theme_mod('tesseract_woocommerce_headercart');
	$displayWooCart = ( is_plugin_active('woocommerce/woocommerce.php') && ( $wooCart == 1 ) );
	$hcContent = ( !$displayWooCart && ( $hcContent == 'nothing' ) );	
		
	if ( true == $hcContent ):		
		$dynamic_styles_header .= "#site-banner-left {
				width: 100%;	
			}
			
			#site-banner-right { 
				display: none; 
				padding: 0;
				margin: 0;
			}
		";
	elseif ( get_theme_mod('tesseract_mobmenu_to_default') == 1 ) :
		$dynamic_styles_header .= '#site-navigation, #header-right-menu { display: none; *display: none; }
		.mobmenu-todefault.leftmenu-to-sidr #header-right-menu { display: inline-block; *display: inline; }
		';
	endif;	
		
	//Horizontal - fullwidth header
	if ( get_theme_mod('tesseract_header_width') == 'fullwidth' ) {
		
        $dynamic_styles_header .= "#site-banner {
			max-width: 100%;
			padding-left: 0; 
			padding-right: 0;
		}
		
		";
	
	}
	
	wp_add_inline_style( 'tesseract-site-banner', $dynamic_styles_header );		
		
	// FOOTER & FOOTER LOGO HEIGHT, FOOTER WIDTH PROPS
	
	$footerWidthProp = get_theme_mod('tesseract_footer_blocks_width_prop') ? get_theme_mod('tesseract_footer_blocks_width_prop') : 60;
	
	$footer_logoHeight = get_theme_mod('tesseract_footer_left_content_logo_height') ? get_theme_mod('tesseract_footer_left_content_logo_height') : 40;
	
	$footerHeightInit = get_theme_mod('tesseract_footer_height');
	$footerHeight = is_numeric($footerHeightInit) ? $footerHeightInit : 10;	

	$dynamic_styles_footer = "#colophon { 
		background-color: " . $footer_bckColor . ";
		color: " . $footer_textColor . " 
	}

	#colophon { 
		padding-top: " . $footerHeight . "px; 
		padding-bottom: " . $footerHeight . "px; 		
		}
	
	#colophon h1, 
	#colophon h2,
	#colophon h3,
	#colophon h4,
	#colophon h5,
	#colophon h6 { color: " . $footer_headingColor . "; }
	
	#colophon a { color: " . $footer_linkColor . "; }
	
	#colophon a:hover { color: " . $footer_linkHoverColor . "; }
	
	#colophon .search-field { 
		color: " . $footer_left_searchColor . "; 
		background: " . $footer_left_searchBackgroundColor . ";
		}		
	
	#horizontal-menu-before,
	#horizontal-menu-after { border-color: rgba(" . $add_content_borderColor . ", 0.25); }
	
	#footer-banner.footbar-active { border-color: rgba(" . $add_content_borderColor . ", 0.15); }
	
	#footer-banner .site-logo img { height: " . $footer_logoHeight . "px; }
		
	#horizontal-menu-wrap {
		width: " . $footerWidthProp . "%;
		}
		
	#footer-banner-right	{
		width: " . ( 100 - intval($footerWidthProp) ) . "%;
		}
	
	";	
	
	//Horizontal - fullwidth footer
	if ( get_theme_mod('tesseract_footer_width') == 'fullwidth' ) {
		
        $dynamic_styles_footer .= "#footer-banner {
			max-width: 100%;
			padding: 0 20px;
		}";
	
	}	

	wp_add_inline_style( 'tesseract-footer-banner', $dynamic_styles_footer );	
	
}

add_action( 'wp_enqueue_scripts', 'tesseract_scripts' );

function tesseract_noscript() {

	echo '<noscript><style>#sidebar-footer aside {border: none!important;}</style></noscript>';
	
	}
	
add_action('wp_head', 'tesseract_noscript');	

function tesseract_footer_branding() {
	do_action( 'tesseract_footer_branding' );
	}

function tesseract_footer_branding_output() {
	echo '<div id="footer-banner-right" class="designer"><div class="table"><div class="table-cell">';
    printf( __( 'Theme by %s', 'tesseract' ), '<a href="http://tyler.com">Tyler Moore</a>' );
	echo '</div></div></div>';
}

add_action('tesseract_footer_branding','tesseract_footer_branding_output', 10);

/**
 * Output featured image on blog and archive pages.
 */

function tesseract_output_featimg_blog() {
	
	global $post;
		
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$featImg_display = get_theme_mod('tesseract_blog_display_featimg'); 
	$featImg_pos = get_theme_mod('tesseract_blog_featimg_pos'); 
	
	$w = $thumbnail[1];
	$h = $thumbnail[2];
	$bw = 720;
	$wr = $w/$bw;
	$hr = $h/$wr;
	
	$origRatio = $hr;
	
	$ratio = get_theme_mod( 'tesseract_blog_featimg_size' );
	$ratio = ( isset($ratio) ) ? $ratio : 'default';
	switch ( $ratio ) :
		
		case 'tv': $featImg_height = ( $origRatio >= 540 ) ? 540 : $origRatio; break;
		case 'hdtv': $featImg_height = ( $origRatio >= 405 ) ? 405 : $origRatio; break;
		case 'theater1': $featImg_height = ( $origRatio >= 390 ) ? 390 : $origRatio; break;
		case 'theater2': $featImg_height = ( $origRatio >= 306 ) ? 306 : $origRatio; break;
		case 'default';
		case 'pixel';			
		default: $featImg_height = $origRatio; break;
		
	endswitch;
	
	$pxratio = get_theme_mod( 'tesseract_blog_featimg_px_size' );
	$featImg_height = ( isset($pxratio) && ( $ratio == 'pixel' ) ) ? $pxratio : $featImg_height;
	
	if ( isset($featImg_display) && ( $featImg_display == 1 ) ) { ?>
	
    	<a class="entry-post-thumbnail <?php echo ($featImg_pos == 'below') ? 'below-title' : 'above-title'; ?>" href="<?php the_permalink(); ?>" style="background: transparent url('<?php echo esc_url( $thumbnail[0] ); ?>') no-repeat center center; width: 100%; height: <?php echo $featImg_height; ?>px; display: block; background-size: cover;"></a><!-- .entry-background -->
	
	<?php }

}

function tesseract_new_excerpt_more($more) {
       global $post;
	return ' ' . '<a class="moretag" href="'. get_permalink($post->ID) . '">' . __( 'Read More ...', 'tesseract' ) . '</a>';
}
add_filter('excerpt_more', 'tesseract_new_excerpt_more');

/*
 * Beaver Builder - remove page title 
 */
function my_theme_show_page_header() {
    
	if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_enabled() ) {

        $global_settings = FLBuilderModel::get_global_settings();

        if ( ! $global_settings->show_default_heading ) {
            return false;
        }
    }

    return true;

}

/**
 * Register Google fonts.
 *
 */
function tesseract_fonts_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'tesseract' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Register Ajax action for the admin
 *
 */

if ( is_admin() ) {

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		require_once( get_template_directory()  . '/admin/ajax.php' );
		
	}
}

/**
 * Register style and script for the api notification
 *
 */

function tesseract_customadminassets(){

	$ajax_nonce = wp_create_nonce( "tesseract-apinotification-ajax" );
	
	   echo '<style type="text/css">         
	#tesseract-apinotification {
		border-color: #2CC3F2 !important;
	}
	#tesseract-apinotification span{
		font-family: "Open Sans",sans-serif; font-size:16px; color:#777777;
	}
	#tesseract-apinotification a.button-primary{
		font-size:16px;background-color: #2CC3F2;border-color: #21afdc;padding:0px 35px;height: 35px;line-height: 33px;box-shadow:0px 1px 0px #c9f1fe inset, 0px 1px 0px rgba(0, 0, 0, 0.08);
	}
	#tesseract-apinotification button.btn-default{
		font-size:16px;background-color: #F0EEEF;border-color: #c6c6c6;padding:0px 35px;height: 35px;line-height: 33px; color:#a8a8a8;
	}
	#tesseract-apinotification .notoppadding{
		padding-top:0px !important;
	}
	#tesseract-apinotification .nobottompadding{
		padding-top:0px !important;
	}
	#tesseract-apinotification .noleftpadding{
		padding-left:0px !important;
	}
	</style>
	<script type="text/javascript" >
	jQuery(document).ready(function() { 
		jQuery(".button-apinotification-dismiss").click(function(e){ 
		var ajaxurl = "'.admin_url('admin-ajax.php').'";
		var nonceval = "'.$ajax_nonce.'";
		jQuery.post(ajaxurl, {action:"tesseract_apinotification",nonceval:nonceval}, function(response) {
			jQuery("#tesseract-apinotification").hide(1000);
		});
			 
					
		});
		
	
				
	});
	</script>
	 ';
	 
}

add_action('admin_head', 'tesseract_customadminassets');


/**
 * Wraps for notifications center class.
 */
 
function load_tesseract_notifications() {
	
	require_once get_template_directory() . '/admin/class-tesseract-update-api.php';
	require_once get_template_directory() . '/admin/class-tesseract-notification-center.php';
	
	// Init Tesseract_Notification_Center class
	Tesseract_Notification_Center::get();
	
	$key_status = get_transient(Tesseract_Notification_Center::TRANSIENT_KEY_STATUS);

	if($key_status && $key_status=='dismiss'){
	
		return false;
		
	}
	
	//elseif($key_status && $key_status=='shown'){
	
		//return false;
		
	//}

	
	$transient_notifications = get_transient( Tesseract_Notification_Center::TRANSIENT_KEY );
	
	if ( false === $transient_notifications ) {
	
		$response = Tesseract_Update_Api::doaction(array('action'=>'notification','subaction'=>'retrieve'));
		
		if($response == false)	return false;
		
		if(empty($response['notification_id'])) return false;
		
		//$info_message = sprintf('<h1><a href="%s" target="_blank">%s</a></h1><p>%s</p><a class="button button-primary load-customize " href="%s">check it out</a>  <button type="button"  class="button btn-default ">May be later</button>',$response['actionurl'],$response['msg_heading'],$response['msg_body'],$response['actionurl']);
		
		$info_message = $response['msg_body'];
		
		$notification_options = array(
			'type' => 'notice-info',
			'id' => 'tesseract-apinotification',
			'nonce' => wp_create_nonce( 'tesseract-apinotification' ),
			'notification_id' => $response['notification_id']
		);
	
		Tesseract_Notification_Center::get()->add_notification( new Tesseract_Notification( $info_message, $notification_options ) );
		
		//set_transient( Tesseract_Notification_Center::TRANSIENT_KEY_STATUS, 'shown', ( HOUR_IN_SECONDS * 24 ) );
		
	}
	
}

add_action( 'admin_init', 'load_tesseract_notifications' );

/**
 * Wraps for upgrade theme class.
 */
 
function load_tesseract_theme_upgrade($transient) {

	if( empty( $transient->checked[TESSERACT_THEME_NAME] ) ) return $transient;
	
	require_once get_template_directory() . '/admin/class-tesseract-update-api.php';
	require_once get_template_directory() . '/admin/class-tesseract-theme-update.php';
	
	return Tesseract_Theme_Update::upgrade_info($transient);
	
}

add_filter('pre_set_site_transient_update_themes', 'load_tesseract_theme_upgrade');
