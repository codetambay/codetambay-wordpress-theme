<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Code_Tambay
 */

if ( ! function_exists( 'codetambay_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function codetambay_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on_text = '<span class="screen-reader-text">Posted on</span>';

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%1$s %2$s', 'post date', 'codetambay' ),
			$posted_on_text,
			'<a class="codetambay-content-btn" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span  data-feather="clock" class="mr-2">posted date</span>' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'codetambay_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function codetambay_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%1$s %2$s', 'post author', 'codetambay' ),
			'<span class="screen-reader-text">Written by</span>',
			'<span class="author vcard"><a class="url fn n codetambay-content-btn mx-1" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span class="mr-2" data-feather="meh">author icon</span><span class="written-by">Written by</span> <span class="author-name font-weight-bold text-capitalize">' . esc_html( get_the_author() ) . '</span></a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'codetambay_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function codetambay_entry_footer() {
		
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			
			/* translators: used between list items, there is a space after the comma */
			//# move to header 
			// $categories_list = codetambay_get_the_category_list( esc_html__( ' ', 'codetambay' ) );
			// if ( $categories_list ) {
			// 	$category_text = '<span class="screen-reader-text">Category</span>';
			// 	/* translators: 1: list of categories. */
			// 	printf( '<span class="cat-links">' . esc_html__( '%1$s %2$s', 'codetambay' ) . '</span>', $category_text, $categories_list ); // WPCS: XSS OK.
			// }

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'codetambay' ) );
			if ( $tags_list ) {
				$tagged_text = '<span class="screen-reader-text">Tagged</span>';
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( ' %1$s %2$s', 'codetambay' ) . '</span>', $tagged_text, $tags_list ); // WPCS: XSS OK.
			}
		}

	}
endif;

if ( ! function_exists( 'codetambay_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function codetambay_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

// Codetambay custom post content header

if ( ! function_exists( 'codetambay_entry_header_codetambay' ) ) :
	/**
	 * Prints HTML with meta information for the comments, and edit link.
	 */
	function codetambay_entry_header_codetambay() {

			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
	
				/* translators: used between list items, there is a space after the comma */
				$categories_list = codetambay_get_the_category_list( esc_html__( ' ', 'codetambay' ) );
				if ( $categories_list ) {
					$category_text = '<span class="screen-reader-text">Category</span>';
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( '%1$s %2$s', 'codetambay' ) . '</span>', $category_text, $categories_list ); // WPCS: XSS OK.
				}
			}
		

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link codetambay-btn-link mx-1">';
			//echo '<span data-feater="meh">Meh</span>';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '%1$s Leave a Comment<span class="screen-reader-text"> on %2$s</span>', 'codetambay' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					'<span data-feather="feather">feather</span>',
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( '%1$s Edit <span class="screen-reader-text">%2$s</span>', 'codetambay' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				'<span data-feather="edit">Edit</span>',
				get_the_title()
			),
			'<span class="edit-link codetambay-btn-link ml-3">',
			'</span>'
		);
	}
endif;
