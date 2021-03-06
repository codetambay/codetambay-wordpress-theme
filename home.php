<?php
/**
 * The Blog template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code_Tambay
 */

get_header();

/* <!-- <section> --> */
	?>
<section class="container my-5">
	<div class="row">
		<div id="primary" class="content-area col-lg-8">
			<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					// ## Orig template part
					//get_template_part( 'template-parts/content', get_post_type() );
					/*
					 * My Custom home.php
					 * get this template custom for blog posts
					 * content-bloghome.php
					 */
					get_template_part( 'template-parts/content', 'bloghome' );

				endwhile;

				//the_posts_navigation();
				codetambay_paging_nav();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
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
/* <!-- <footer> --> */
get_footer();
