<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Code_Tambay
 */

get_header();
?>
<section class="container">
	<div class="row">
	<div id="primary" class="content-area col-lg-8">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// orig
			//get_template_part( 'template-parts/content', get_post_type() );

			get_template_part( 'template-parts/content', 'blogsingle' );

			//the_post_navigation();
			codetambay_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div class="content-aside col-lg-4">
			<?php
			/* <!-- <aside> --> */
			get_sidebar();
			?>
		</div>
	</div><!-- row -->
</section><!-- container -->
<?php

get_footer();
