<?php
/**
 * The front page template file
 *
 * @package RASN_Consult
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php
	// Check if the flexible content field has rows of data
	if( have_rows('flexible_content') ):

		// Loop through the rows of data
		while ( have_rows('flexible_content') ) : the_row();
			$layout = get_row_layout();
			get_template_part( 'template-parts/layouts/' . $layout );
		endwhile;

	else :
		// No layouts found
		?>
		<section style="padding: 150px 20px; text-align: center;">
			<div class="container">
				<h2 style="color: white; font-weight: 300;">Welcome to RASN Consult</h2>
				<p style="color: #c5d8eb;">Please set up the front page and add flexible layouts on the editing screen.</p>
			</div>
		</section>
		<?php
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
