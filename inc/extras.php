<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Tesseract
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function tesseract_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tesseract_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tesseract_body_classes( $classes ) {
	// Adds a .group-blog class to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Adds a .full-width-page class to posts without sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	    $classes[] = 'full-width-page';
	}
	
	// Adds a .tesseract-featured class to posts with featured image.
	if ( is_single() && has_post_thumbnail() && 'post' == get_post_type() ) {
		$classes[] = 'tesseract-featured';
	}

	return $classes;
}
add_filter( 'body_class', 'tesseract_body_classes' );

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function tesseract_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'tesseract' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'tesseract_wp_title', 10, 2 );
endif;

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function tesseract_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'tesseract_setup_author' );