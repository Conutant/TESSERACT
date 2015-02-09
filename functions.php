<?php
/**
 * Tesseract functions and definitions
 *
 * @package Tesseract
 */

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
		'primary' => __( 'Primary Menu', 'tesseract' ),
		'secondary' => __( 'Secondary Menu', 'tesseract' )
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

	// Localize script (only few lines in helpers.js)
    wp_localize_script( 'tesseract-helpers', 'tesseract-vars', array(  
 	    'author'   => __( 'Your Name', 'tesseract' ), 
 	    'email'    => __( 'E-mail', 'tesseract' ),
		'url'      => __( 'Website', 'tesseract' ),
		'comment'  => __( 'Your Comment', 'tesseract' ) 
 	) );	
	
	// Enqueue default style
	wp_enqueue_style( 'tesseract-style', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Google fonts
	wp_enqueue_style( 'tesseract-fonts', tesseract_fonts_url(), array(), '1.0.0' );
	
    // Social icons style	
	wp_enqueue_style( 'tesseract-icons', get_template_directory_uri() . '/css/typicons.css', array(), '1.0.0' );
	
    // Horizontal menu style	
	wp_enqueue_style( 'tesseract-footer-banner', get_template_directory_uri() . '/css/footer-banner.css', array('tesseract-style'), '1.0.0' );
	wp_enqueue_style( 'tesseract-site-banner', get_template_directory_uri() . '/css/site-banner.css', array('tesseract-style'), '1.0.0' );	
	wp_enqueue_style( 'dashicons' );	
	
	// Fittext
	wp_enqueue_script( 'tesseract-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.0.0', true );
	
    // JS helpers (This is also the place where we call the jQuery in array)
	wp_enqueue_script( 'tesseract-helpers', get_template_directory_uri() . '/js/helpers.js', array( 'jquery', 'tesseract-fittext' ), '1.0.0', true );
	
	// Skip link fix
	wp_enqueue_script( 'tesseract-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tesseract_scripts' );


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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function new_excerpt_more($more) {
       global $post;
	return ' ' . '<a class="moretag" href="'. get_permalink($post->ID) . '">  Read More ...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

