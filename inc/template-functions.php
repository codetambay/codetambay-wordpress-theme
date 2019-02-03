<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Code_Tambay
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function codetambay_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'codetambay_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function codetambay_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'codetambay_pingback_header' );






if ( ! function_exists( 'codetambay_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @return void
	 */
	function codetambay_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
	
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );
	
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
	
		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	
		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 2,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'codetambay' ),
			'next_text' => __( 'Next &rarr;', 'codetambay' ),
					'type'      => 'list',
		) );
	
		if ( $links ) :
	
		?>
			<nav class="navigation paging-navigation p-4 text-center" role="navigation">
				<h4 class="screen-reader-text"><?php _e( 'Posts navigation', 'codetambay' ); ?></h4>
					<?php echo $links; ?>
			</nav><!-- .navigation -->
		<?php
		endif;
	}
	endif;

	// filter html markup of prev and next page link | single post | single.php 
	// add classess into <a> tag only
	/*
	add_filter('next_post_link', 'post_link_attributes');
	add_filter('previous_post_link', 'post_link_attributes');
	
	function post_link_attributes($output) {
		$code = 'class="styled-button">';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
	*/

	function add_class_next_post_link($html){
	$html = str_replace('<a','<a class="next-post codetambay-post-nav-link"',$html);
	return $html;
	}
	add_filter('next_post_link','add_class_next_post_link',10,1);

	function add_class_previous_post_link($html){
	$html = str_replace('<a','<a class="prev-post codetambay-post-nav-link"',$html);
	return $html;
	}
	add_filter('previous_post_link','add_class_previous_post_link',10,1);
	


	if ( ! function_exists( 'codetambay_post_nav' ) ) :
		/**
		 * Display navigation to next/previous post when applicable.
		 *
		 * @return void
		 */
		function codetambay_post_nav() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );
		
			if ( ! $next && ! $previous ) {
				return;
			}
			?>
			<nav class="navigation post-navigation" role="navigation">
					<div class="post-nav-box clear">
						<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'codetambay' ); ?></h3>
						<div class="nav-links">
							<?php
								// previous_post_link( 
								// 	'<div class="nav-previous"><div class="nav-indicator screen-reader-text">' . __( 'Previous Post:', 'codetambay' ) . '</div><h2>%link</h2></div>', 
								// 	'%title' 
								// );
								previous_post_link('<div class="nav-previous">
											<div class="nav-indicator screen-reader-text">' . __( 'Previous Post:', 'codetambay' ) . 
											'</div>
											<h2>%link</h2>
										</div>', 
								'<span data-feather="chevrons-left">Previous post</span> %title'); 
								//next_post_link(     '<div class="nav-next"><div class="nav-indicator screen-reader-text">' . __( 'Next Post:', 'codetambay' ) . '</div><h2>%link</h2></div>', '%title' );
								next_post_link('<div class="nav-next">
											<div class="nav-indicator screen-reader-text">' . __( 'Next Post:', 'codetambay' ) . 
											'</div>
											<h2>%link</h2>
										</div>', 
								'%title <span data-feather="chevrons-right">Next post</span>');
							?>
						</div><!-- .nav-links -->
					</div><!-- .post-nav-box -->
			</nav><!-- .navigation -->
			<?php
		}
		endif;


//Custom WP_Query
if ( ! function_exists( 'codetambay_paging_nav_custom_query' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @return void
	 */
	function codetambay_paging_nav_custom_query($quotes) {
		// Don't print empty markup if there's only one page.
		if ( $quotes->max_num_pages < 2 ) {
			return;
		}
	
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array( );
		$url_parts    = explode( '?', $pagenum_link );
	
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
	
		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	
		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $quotes->max_num_pages,
			'current'  => $paged,
			'mid_size' => 2,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'codetambay' ),
			'next_text' => __( 'Next &rarr;', 'codetambay' ),
					'type'      => 'list',
		) );
	
		if ( $links ) :
	
		?>
			<nav class="navigation paging-navigation p-4 text-center" role="navigation">
				<h4 class="screen-reader-text"><?php _e( 'Posts navigation', 'codetambay' ); ?></h4>
					<?php echo $links; ?>
			</nav><!-- .navigation -->
		<?php
		endif;
	}
	endif;
