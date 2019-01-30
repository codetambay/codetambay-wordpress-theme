<?php
/**
 * Template part for displaying posts
 * with Bootstrap 4 classes and layout
 * date: Tue 29 Jan 2019
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code_Tambay
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("mb-5"); ?>>

    <?php codetambay_post_thumbnail(); ?>
    
	<header class="entry-header white-bg py-4 px-5">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				codetambay_posted_on();
                codetambay_posted_by();
                codetambay_entry_header_codetambay();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->
    
	<div class="entry-content white-bg py-4 px-5 mt-0">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'codetambay' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codetambay' ),
			'after'  => '</div>',
		) );
        ?>

        <footer class="entry-footer mt-5">
            <?php codetambay_entry_footer(); ?>
        </footer><!-- .entry-footer -->        
    
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
