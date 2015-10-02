<?php
/**
 * The template for displaying search results pages.
 *
 * @package Tesseract
 */

get_header(); ?>

	<?php
		$slayout = get_theme_mod('tesseract_search_results_layout');

		switch ( $slayout ) {
			case 'fullwidth':
				$primary_class = 'full-width-page no-sidebar';

				break;
			case 'sidebar-right':
				$primary_class = 'content-area sidebar-right';

				break;
			default:
				// sidebar-left
				$primary_class = 'content-area';
		}
	?>

	<section id="primary" class="<?php echo $primary_class; ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'tesseract' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php tesseract_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
		if ( !$slayout || ( $slayout == 'sidebar-left' ) || ( $slayout == 'sidebar-right' ) ) get_sidebar();
	?>

<?php get_footer(); ?>
