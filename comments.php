<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code_Tambay
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title codetambay-comments-title mb-5">
			<?php
			$codetambay_comment_count = get_comments_number();
			if ( '1' === $codetambay_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'codetambay' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s %2$s comments %3$s', '%1$s %2$s comments %3$s', $codetambay_comment_count, 'comments title', 'codetambay' ) ),
					'<span class="comment-text-wrap"><span data-feather="book-open" class="mr-2">comment icon</span>',
					number_format_i18n( $codetambay_comment_count ),
					'<span class="screen-reader-text">on ' . get_the_title() . '</span></span><!-- comment-text-wrap -->'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'codetambay' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	
	?>
		<?php 
			$args = array(
				'class_form' => 'needs-validation',
				'fields' => apply_filters(
					'comment_form_default_fields', array(
						'author' =>
							'<p class="comment-form-author">' . 
							'<input id="author" placeholder="Your Name (No Keywords)" name="author" type="text" value="' .
							esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
							'<label for="author">' . __( 'Your Name', 'codetambay' ) . '</label> ' .
							( $req ? '<span class="required">*</span>' : '' )  .
							'</p>'
							,
						'email'  => '<p class="comment-form-email">' . '<input id="email" placeholder="your-real-email@example.com" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'" size="30"' . $aria_req . ' />'  .
							'<label for="email">' . __( 'Your Email', 'codetambay' ) . '</label> ' .
							( $req ? '<span class="required">*</span>' : '' ) 
							.
							'</p>',
						'url'    => '<p class="comment-form-url">' .
						'<input id="url" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
						'<label for="url">' . __( 'Website', 'codetambay' ) . '</label>' .
						'</p>'
					)
				),
				'comment_field' => 
					'<div class="comment-form-comment">' .
					'<label for="comment">' . __( 'Enter comments:' ) . '</label>' .
					'<textarea class="form-control" id="comment" name="comment" placeholder="Enter an awesome comment here..." cols="45" rows="8" aria-required="true" required></textarea>' .
					'<div class="invalid-feedback">Please enter comments.</div>' .
					'</div>',
				'comment_notes_after' => '',
				'title_reply' => '<span class="codetambay-text"><span>Your Comments</span></span>'
			);

			//comment_form(); 
		?>
		
		<?php
			comment_form($args, $post_id);
		?>

</div><!-- #comments -->
