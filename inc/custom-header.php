<?php
/**
 * Implement a custom header for Twenty Thirteen
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Tesseract
 * @since Twenty Thirteen 1.0
 */

/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses tesseract_header_style() to style front-end.
 * @uses tesseract_admin_header_style() to style wp-admin form.
 * @uses tesseract_admin_header_image() to add custom markup to wp-admin form.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since Twenty Thirteen 1.0
 */
function tesseract_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '220e10',

		// Set height and width, with a maximum value for the width.
		'height'                 => 480,
		'width'                  => 1580,

		// Callbacks for styling the header and the admin preview.
		//'wp-head-callback'       => 'tesseract_header_style',
		'admin-head-callback'    => 'tesseract_admin_header_style',
		'admin-preview-callback' => 'tesseract_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'circle' => array(
			'url'           => '%s/images/default-header.jpg',
			'thumbnail_url' => '%s/images/default-header-thumbnail.jpg',
			'description'   => _x( 'Default', '', 'tesseract' )
		)
	) );
}
add_action( 'after_setup_theme', 'tesseract_custom_header_setup', 11 );

/**
 * Load our special font CSS files.
 *
 * @since Twenty Thirteen 1.0
 */
function tesseract_custom_header_fonts() {
	// Add Source Sans Pro and Bitter fonts.
	wp_enqueue_style( 'tesseract-fonts', tesseract_fonts_url(), array(), null );

	// Add Genericons font.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'tesseract_custom_header_fonts' );



/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * @since Twenty Thirteen 1.0
 */
function tesseract_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css" id="tesseract-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') no-repeat scroll top; background-size: 1600px auto;';
		} ?>
		padding: 0 20px;
	}
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) || display_header_text() ) {
			echo 'min-height: 230px;';
		} ?>
		width: 100%;
	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>
	#headimg h1 {
		font: bold 60px/1 Bitter, Georgia, serif;
		margin: 0;
		padding: 58px 0 10px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		text-decoration: underline;
	}
	#headimg h2 {
		font: 200 italic 24px "Source Sans Pro", Helvetica, sans-serif;
		margin: 0;
		text-shadow: none;
	}
	.default-header img {
		max-width: 230px;
		width: auto;
	}
	</style>
<?php
}

/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 *
 * This callback overrides the default markup displayed there.
 *
 * @since Twenty Thirteen 1.0
 */
function tesseract_admin_header_image() {
	?>
	<div id="headimg" style="background: url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto;">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="home-link">
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="#" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }
