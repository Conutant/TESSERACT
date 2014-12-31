<?php
/**
 * Template Name: Blog Page
 *
 * @package Tesseract
 */

get_header(); ?>

	<div id="primary" class="full-width-page">
		<main id="main" class="site-main" role="main">
 		<?php $args = array(
			    'order'         => 'DESC',
			    'posts_per_page'        => '10',
			);
			$query = new WP_Query($args);

		?>
		<?php if ( $query->have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'blog' );
				?>

			<?php endwhile; ?>

			<?php tesseract_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
