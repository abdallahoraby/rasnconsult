<?php
/**
 * The template for displaying all pages
 *
 * @package RASN_Consult
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		// Output regular page content if it exists
		if ( get_the_content() ) {
			?>
			<div class="container py-4">
				<?php the_content(); ?>
			</div>
			<?php
		}

		// Check if the flexible content field has rows of data
		if ( have_rows('flexible_content') ) :

			// Loop through the rows of data
			while ( have_rows('flexible_content') ) : the_row();
				$layout = get_row_layout();
				get_template_part( 'template-parts/layouts/' . $layout );
			endwhile;

		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
