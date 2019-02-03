<?php
/**
 * The template for displaying all single posts
 * Template Name: Page Quote
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
page-quote.php
			<?php

			//get the correct paged figure on a static page - see related note (a)
			// if ( get_query_var('paged') ) {
			// 	$paged = get_query_var('paged');
			// }
			// elseif ( get_query_var('page') ) {
			// 	$paged = get_query_var('page');
			// }
			// else {
			// 	$paged = 1;
			// }
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type'      => 'quote',
				'posts_per_page' => 5,
				'paged' => $paged,
				//'meta_key'       => 'workshop_data_event_date',
				//'orderby'        => 'meta_value',
				'order'          => 'DESC'
			);

			$quotes = new WP_Query( $args );

			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( $quotes->have_posts() ) :
					$quotes->the_post();

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
					get_template_part( 'template-parts/content', 'quote' );

				endwhile;

				//the_posts_navigation();
				//codetambay_paging_nav();
				codetambay_paging_nav_custom_query($quotes);
				//codetambay_paging_nav_custom($quotes->max_num_pages);

				?>
				<nav>
					<ul>
						<li><?php previous_posts_link( '&laquo; PREV', $quotes->max_num_pages) ?></li> 
						<li><?php next_posts_link( 'NEXT &raquo;', $quotes->max_num_pages) ?></li>
					</ul>
				</nav>
				<?php

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
