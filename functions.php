<?php
/**
 * Debug function
 */
function dd($obj)
{
  echo("<pre>");
  var_dump($obj);
  debug_print_backtrace();
  echo("</pre>");
  die;
}

/**
 * Tesseract functions and definitions
 *
 * @package Tesseract
 */

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
	// Fittext
	wp_enqueue_script( 'tesseract-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0.0', true );

	//Mobile menu
	wp_enqueue_script( 'tesseract-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array( 'tesseract-fittext' ), '1.0.0', true );


	// Modernizr for old browsers
	wp_enqueue_script( 'tesseract-modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array(), '1.0.0', false );

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

	// Localize script (only few lines in helpers.js)

		// First things first: let's get a lighter version of the user-defined search input color applied in the mobile menu - tricky
		// See @ http://stackoverflow.com/questions/11091695/how-to-find-the-hex-code-for-a-lighter-or-darker-version-of-a-hex-code-in-php
		$watermarkColor = get_theme_mod('tesseract_mobmenu_search_color');
		$col = Array(
			hexdec(substr($watermarkColor,1,2)),
			hexdec(substr($watermarkColor,3,2)),
			hexdec(substr($watermarkColor,5,2))
		);
		$lighter = Array(
			255-(255-$col[0])*0.8,
			255-(255-$col[1])*0.8,
			255-(255-$col[2])*0.8
		);
		$lighter = "#".sprintf("%02X%02X%02X", $lighter[0], $lighter[1], $lighter[2]);

    wp_localize_script( 'tesseract_helpers', 'tesseract_vars', array(
		'hpad' 					  						=> get_theme_mod('tesseract_header_height'),
		'fpad'   										=> get_theme_mod('tesseract_footer_height'),
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

	$header_linkHoverColor = get_theme_mod('tesseract_header_colors_link_hover_color') ? get_theme_mod('tesseract_header_colors_link_hover_color') : '#d1ecff';

	$footer_bckColor = get_theme_mod('tesseract_footer_colors_bck_color') ? get_theme_mod('tesseract_footer_colors_bck_color') : '#1e73be';

	$footer_textColor = get_theme_mod('tesseract_footer_colors_text_color') ? get_theme_mod('tesseract_footer_colors_text_color') : '#ffffff';

	$footer_headingColor = get_theme_mod('tesseract_footer_colors_heading_color') ? get_theme_mod('tesseract_footer_colors_heading_color') : '#ffffff';

	$footer_linkColor = get_theme_mod('tesseract_footer_colors_link_color') ? get_theme_mod('tesseract_footer_colors_link_color') : '#ffffff';

	$footer_linkHoverColor = get_theme_mod('tesseract_footer_colors_link_hover_color') ? get_theme_mod('tesseract_footer_colors_link_hover_color') : '#d1ecff';

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

	.sidr .sidr-class-menu-item a,
	.sidr .sidr-class-menu-item span { color: " . $mobmenu_linkColor . "; }


	.sidr .sidr-class-menu-item ul li a,
	.sidr .sidr-class-menu-item ul li span {
		color: " . $mob_rgb_linkColor_submenu . ";
	}

	.sidr .sidr-class-menu-item a:hover,
	.sidr .sidr-class-menu-item span:hover,
	.sidr .sidr-class-menu-item:first-child a:hover,
	.sidr .sidr-class-menu-item:first-child span:hover { color: " . $mobmenu_linkHoverColor . "; }

	.sidr .sidr-class-menu-item ul li a:hover,
	.sidr .sidr-class-menu-item ul li span:hover,
	.sidr .sidr-class-menu-item ul li:first-child a:hover,
	.sidr .sidr-class-menu-item ul li:first-child span:hover { color: " . $mob_rgb_linkHoverColor_submenu . "; }

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

	";

	wp_add_inline_style( 'tesseract-sidr-style', $dynamic_styles_mobmenu );

	// HEADER & HEADER LOGO HEIGHT, HEADER WIDTH PROPS

	$header_logoHeight = get_theme_mod('tesseract_header_logo_height') ? get_theme_mod('tesseract_header_logo_height') : 40;

	$headerHeightInit = get_theme_mod('tesseract_header_height');
	$headerHeight = is_numeric($headerHeightInit) ? $headerHeightInit : 10;

	$headerWidthProp = is_integer( get_theme_mod('tesseract_header_blocks_width_prop') ) ? get_theme_mod('tesseract_header_blocks_width_prop') : 60;

	$dynamic_styles_header = ".site-header,
	.main-navigation ul ul a,
	#header-right-menu ul ul a,
	.site-header .cart-content-details { background-color: " . $header_bckColor . "; }
	.site-header .cart-content-details:after { border-bottom-color: " . $header_bckColor . "; }

	.home .site-header,
	.home .main-navigation ul ul a,
	.home #header-right ul ul a,
	.home .site-header .cart-content-details { background-color: " . $header_bckColor_home . "; }
	.home .site-header .cart-content-details:after { border-bottom-color: " . $header_bckColor_home . "; }

	.site-header,
	.site-header h1,
	.site-header h2,
	.site-header h3,
	.site-header h4,
	.site-header h5,
	.site-header h6 { color: " . $header_textColor . "!important; }

	#masthead .search-field { color: " . $header_textColor . "; }
	#masthead .search-field.watermark { color: #ccc; }

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

	$footer_logoHeight = get_theme_mod('tesseract_footer_logo_height') ? get_theme_mod('tesseract_footer_logo_height') : 40;

	$footerHeightInit = get_theme_mod('tesseract_footer_height');
	$footerHeight = is_numeric($footerHeightInit) ? $footerHeightInit : 10;

	$dynamic_styles_footer = "#colophon {
		background-color: " . $footer_bckColor . ";
		color: " . $footer_textColor . "
	}

	#colophon .search-field { color: " . $footer_textColor . "; }
	#colophon .search-field.watermark { color: #ccc; }

	#colophon h1,
	#colophon h2,
	#colophon h3,
	#colophon h4,
	#colophon h5,
	#colophon h6 { color: " . $footer_headingColor . "; }

	#colophon a { color: " . $footer_linkColor . "; }

	#colophon a:hover { color: " . $footer_linkHoverColor . "; }

	#horizontal-menu-before,
	#horizontal-menu-after { border-color: rgba(" . $add_content_borderColor . ", 0.25); }

	#footer-banner.footbar-active { border-color: rgba(" . $add_content_borderColor . ", 0.15); }

	#footer-banner .site-logo img { height: " . $footer_logoHeight . "px; }

	#colophon {
		padding-top: " . $footerHeight . "px;
		padding-bottom: " . $footerHeight . "px;
		}

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

function tesseract_output_menu( $cont, $contClass, $location, $depth ) {

	switch( $location ) :

		case 'primary': $hblox = 'header'; break;
		case 'primary_right': $hblox = 'header_right'; break;
		case 'secondary': $hblox = 'footer'; break;
		case 'secondary_right': $hblox = 'footer_right'; break;

	endswitch;

    $locs = get_theme_mod('nav_menu_locations');

	$menu = get_theme_mod('tesseract_' . $hblox . '_menu_select');

    $isMenu = get_terms( 'nav_menu' ) ? TRUE : FALSE;
    $locReserved = ( $locs[$location] ) ? TRUE : FALSE;
	$menuSelected = ( is_string($menu) ) ? TRUE : FALSE;

    // IF the location set as parameter has an associated menu, it's returned as a key-value pair in the $locs array - where the key is the location and the value is the menu ID. We need this latter to get the menu slug required later -in some cases- in the wp_nav_menu params array.
    if ( $locReserved ) {
        $menu_id = $locs[$location]; // $value = $array[$key]
        $menuObject = wp_get_nav_menu_object( $menu_id );
        $menu_slug = $menuObject->slug;
    };
	$custSet = ( $menuSelected && ( $menu !== 'none' ) );

    if ( empty( $isMenu ) ) : //Case 1 - IF THERE'S NO MENU CREATED -> easy scenario: no location setting, no customizer setting ( this latter only appears if there IS at least one menu created by the theme user ) => display basic menu

        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class' => 'nav-menu',
			'container_class' => '',
            'container' => FALSE,
            'depth' => $depth
            )
        );

    elseif ( !empty( $isMenu ) ) : //Case 2 - THERE'S AT LEAST ONE MENU CREATED

        if ( !$custSet && $locReserved ) { //no setting in customizer OR dropdown is set to blank value, location SET in Menus section => display menu associated with this location in Appearance ->
            wp_nav_menu( array(
                'menu' => $menuSlug,
                'theme_location' => $location,
                'menu_class' => 'nav-menu',
				'container_class' => $contClass,
                'container' => $cont,
                'depth' => $depth
                )
            );

        } else if ( !$custSet && !$locReserved ) { //no setting in customizer OR dropdown is set to blank value, location NOT SET in Menus section => display basic menu

			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class' => 'nav-menu',
				'container_class' => '',
				'container' => FALSE,
				'depth' => $depth
				)
			);

        } else if ( $custSet ) { //menu set in customizer AND dropdown is NOT set to blank value, location SET OR NOT SET in Menus section => display menu set in customizer ( setting a menu to the given location in customizer will update any existing location-menu association in Appearance -> Menus, see function tesseract_set_menu_location() in functions.php )

            wp_nav_menu( array(
                'menu' => $menu,
                'theme_location' => $location,
                'menu_class' => 'nav-menu',
				'container_class' => $contClass,
                'container' => $cont,
                'depth' => $depth
                )
            );

        }

    endif;

}

function tesseract_set_menu_location_menuupdate() {

	$selectorLocs = array(
		'tesseract_header_menu_select' => 'primary',
		'tesseract_footer_menu_select' => 'secondary',
		'tesseract_header_right_menu_select' => 'primary_right'
		);

	//Location 'secondary_right' is available ONLY if the branding removal plugin is installed
	if ( is_plugin_active('tesseract-remove-branding/tesseract-remove-branding.php') ) {
		$selectorLocs = array_merge($selectorLocs, array('tesseract_footer_right_menu_select' => 'secondary_right'));
	}

	//Returns the array of locations reserved
	$locs = get_theme_mod('nav_menu_locations');

	foreach( $selectorLocs as $selector => $loc ) :

		$selection = get_theme_mod( $selector ); // = menu slug
		//Let's see if there's a menu associated with current location (if any)
		$locReserved = $locs[$loc] ? TRUE : FALSE;

		switch ( $loc ) :
			case 'primary_right': 	$hiderSect = 'tesseract_header_right_content'; break;
			case 'secondary_right': $hiderSect = 'tesseract_footer_right_content'; break;
		endswitch;

		if ( $locReserved ) :

			$menu_id = $locs[$loc]; // $value = $array[$key]
			$menuObject = wp_get_nav_menu_object( $menu_id );
			$menu_slug = $menuObject->slug;
			//Update customizer setting
			set_theme_mod( $selector, $menu_slug );

		elseif ( !$locReserved && is_string( $selection ) ) : // if no location set at Appearance -> Menus AND WE'RE NOT IN INSTALL PHASE ( when there's no $selection value )

			if ( $selection !== 'none' ) set_theme_mod( $selector, 'none' );

			//Update visibility
			switch ( $loc ) :
				case 'primary_right': 	if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
				case 'secondary_right': if ( get_theme_mod( $hiderSect ) == 'menu' ) set_theme_mod( $hiderSect, 'nothing' ); break;
			endswitch;

		endif;

	endforeach;

}

function tesseract_set_menu_location_customizerupdate() {

	$selectorLocs = array(
		'tesseract_header_menu_select' => 'primary',
		'tesseract_footer_menu_select' => 'secondary',
		'tesseract_header_right_menu_select' => 'primary_right'
		);

	//Location 'secondary_right' is available ONLY if the branding removal plugin is installed
	if ( is_plugin_active('tesseract-remove-branding/tesseract-remove-branding.php') ) {
		$selectorLocs = array_merge($selectorLocs, array('tesseract_footer_right_menu_select' => 'secondary_right'));
	}

	//Returns the array of locations reserved
	$locs = get_theme_mod('nav_menu_locations');

	foreach( $selectorLocs as $selector => $loc ) :

		$selection = get_theme_mod( $selector ); // = menu slug
		//Let's see if there's a menu set to the current location in customizer
		$custSet = is_string($selection) && ( $selection !== 'none' );

		//Let's see if there's a menu associated with current location (if any)
		$locReserved = ( $locs[$loc] ) ? TRUE : FALSE;

		if ( $locReserved ) :

			switch ( $selection ) :

				// IF the saved value is 'none', update the menu id on the Menus side to zero
				case 'none' :
					$locs[$loc] = FALSE; //Update the ID of the menu associated with the location
					set_theme_mod( 'nav_menu_locations', $locs ); //Update menu location mods
				break;

				// IN ANY OTHER CASES, update the menu id on the Menus side appropriately
				default:
					$selectedMenu = wp_get_nav_menu_object( $selection ); // = selected menu's ID
					$selectedMenuID = $selectedMenu->term_id;

					//let's update the association in Appearance -> Menus appropriately IF the two menu ids differ.
					$associatedMenuID = $locs[$loc]; // $locs[$loc] returns the menu ID.
					if ( $selectedMenu !== $associatedMenuID )
						$locs[$loc] = $selectedMenuID; //Update the ID of the menu associated with the location
						set_theme_mod( 'nav_menu_locations', $locs ); //Update menu location mods

			endswitch;

		else :

			// If there's no menu associated on the Menus side, AND the customizer setting is NOT NONE
			if ( $selection !== 'none' )
				$selectedMenu = wp_get_nav_menu_object( $selection ); // = selected menu's ID
				$selectedMenuID = $selectedMenu->term_id;

				//let's update the association in Appearance -> Menus appropriately.
				$associatedMenuID = $locs[$loc]; // $locs[$loc] returns the menu ID.
				$locs[$loc] = $selectedMenuID; //Update the ID of the menu associated with the location
				set_theme_mod( 'nav_menu_locations', $locs ); //Update menu location mods

		endif;

	endforeach;

}

//Let's call this on both side's init action
add_action('customize_save_after', 'tesseract_set_menu_location_customizerupdate', 77);
add_action('init', 'tesseract_set_menu_location_menuupdate', 77);

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
		$font_url = add_query_arg( 'family', urlencode( 'Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,cyrillic,latin-ext' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

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
require get_template_directory() . '/inc/beaver-builder-modules/beaver-builder-modules.php';


/*
 * Auto-check theme udpates
 */
//Initialize the update checker.
require 'theme-update-checker.php';
$update_checker = new ThemeUpdateChecker(
  'TESSERACT', // This theme folder name (must match)
  'https://s3-us-west-2.amazonaws.com/updates.tyler.com/TESSERACT/version.json'
);
if(false)
{
  $update_checker->checkForUpdates();
}

/* check if a plugin exists in the plugins directory and if it's already active */
function is_plugin_installed( $slug ) {
	$plugins = get_plugins();

	foreach ( $plugins as $plugin_key => $plugin_info ) {
		if ( preg_match( "/^{$slug}\//", $plugin_key ) ) {
			return is_plugin_active( $plugin_key );
		}
	}

	return false;
}

function display_notice() {
	if ( ! class_exists( 'Tesseract_Remove_Branding' ) ) {
		if ( false === ( $dismissed = get_transient( 'dismiss_unbranding' ) ) ) {
?>
		<div id="unbranding-plugin-notice" class="updated notice">
			<img src="https://s3-us-west-2.amazonaws.com/updates.tyler.com/tyler-pic.png" />
			<p>Hey, to remove the "Tyler Moore" at the bottom of your website you can get the unbranding plugin.</p>
			<p>
				<a id="get-unbranding" href="http://tyler.com/unbranding-plugin/" target="_blank">check it out</a>
				<a id="dismiss-unbranding" href="javascript:void(0);">maybe later</a>
			</p>
		</div>
<?php
		}
	}
}
add_action( 'admin_notices', 'display_notice' );

function dismiss_unbranding() {
	set_transient( 'dismiss_unbranding', true, 3 * DAY_IN_SECONDS ); // dismissed for 3 days

	die();
}
add_action( 'wp_ajax_dismiss_unbranding', 'dismiss_unbranding' );

/* load custom admin scripts and styles */
function tesseract_enqueue_custom_scripts() {
	wp_enqueue_script( 'tesseract-custom', get_template_directory_uri() . '/importer/js/custom.js', array( 'jquery' ) );
	wp_enqueue_style( 'tesseract-custom', get_template_directory_uri() . '/importer/css/custom.css' );
}
add_action( 'admin_enqueue_scripts', 'tesseract_enqueue_custom_scripts' );

/* clear the dismiss unbranding transient when logging out */
function tesseract_clear_dismiss_transient() {
    delete_transient( 'dismiss_unbranding' );
}
add_action( 'wp_logout', 'tesseract_clear_dismiss_transient' );
add_action( 'wp_login', 'tesseract_clear_dismiss_transient', 10 );