<?php
/**
 * Code Tambay functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Code_Tambay
 */

 /**
 * Nav Walker
 */
//require get_template_directory() . '/inc/wp-navwalker.php';

if ( ! file_exists( get_template_directory() . '/inc/wp-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
	require_once get_template_directory() . '/inc/wp-navwalker.php';
}

if ( ! function_exists( 'codetambay_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function codetambay_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Code Tambay, use a find and replace
		 * to change 'codetambay' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'codetambay', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'codetambay' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'codetambay_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'codetambay_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codetambay_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'codetambay_content_width', 640 );
}
add_action( 'after_setup_theme', 'codetambay_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function codetambay_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'codetambay' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'codetambay' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'codetambay_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codetambay_scripts() {
	wp_enqueue_style( 'codetambay-style', get_stylesheet_uri() );

	wp_enqueue_script( 'codetambay-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'codetambay-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// ###### Stylesheet addon ######
	
	/* Bootstrap 4 CSS */
	wp_enqueue_style( 'codetambay-bootstrap-4', get_template_directory_uri() . '/module/bootstrap-4/css/bootstrap.css');
	
	// ###### JavaScript addon ######

	/* Bootstrap 4 JS */
	wp_enqueue_script( 'codetambay-bootstrap-4', get_template_directory_uri() . '/module/bootstrap-4/js/bootstrap.js', array('jquery'), '2010415', true ); 

	/* Feather Icons - SVG JS */
	wp_enqueue_script( 'codetambay-feather-icons', get_template_directory_uri() . '/js/addon/feather.min.js', array(), '2010415', true ); 
	/*
		<!-- example icon -->
		<i data-feather="circle"></i>

		<script>
			feather.replace()
		</script>
	*/
	wp_enqueue_script( 'codetambay-custom', get_template_directory_uri() . '/js/custom.js', array(), '2010415', true ); 
	


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//CodeTambay Custom Styles 
	wp_enqueue_style( 'codetambay-custom', get_template_directory_uri() . '/css/custom.css' );	
	
}
add_action( 'wp_enqueue_scripts', 'codetambay_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/*
 * Custo Tags link markup
 */
add_filter('the_tags', 'codetambay_get_the_tag_list');

function codetambay_get_the_tag_list($list) {
    $list = str_replace('rel="tag">', 'rel="tag2" class="codetambay-post-tag" ><span data-feather="tag" class="mr-2">tag</span>', $list);
    $list = str_replace('</a>', '</a>', $list);
    return $list;
}


function codetambay_get_the_category_list( $separator = '', $parents = '', $post_id = false ) {

	global $wp_rewrite;
  
	$categories = apply_filters( 'the_category_list', get_the_category( $post_id ), $post_id );
  
	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';
  
	$thelist = '';
  
	  $i = 0;
	  foreach ( $categories as $category ) {
		if ( 0 < $i )
		  $thelist .= $separator;
		  $thelist .= '<a href="' . get_category_link( $category->term_id ) . ' " class="codetambay-category codetambay-post-category '.$category->class. '" ' . $rel . '><span data-feather="folder-plus" class="mr-2">category</span> ' . $category->name.'</a>';
		++$i;
	  }
  
	return  $thelist;
  }


/**
 * Generate custom search form
 *
 * Add Bootstrap 4 Markup and style
 * 
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function codetambay_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform form-inline" action="' . home_url( '/' ) . '" >
	
	<div class="input-group col-10 col-lg-8 px-0">
		<label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    	<input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
	</div>
	<input type="submit" id="searchsubmit" class="col-2 col-lg-4 btn btn-primary btn-search" value="'. esc_attr__( 'Search' ) .'" />
	
	</form>';
 
    return $form;
}
add_filter( 'get_search_form', 'codetambay_search_form' );

/* 
 *
 * Comment Form and Comment layout html markup
 * 
 * paste this comment_form($args, $post_id) at comment.php
 * 
 */

// Modify comments header text in comments

add_filter( 'codetambay_title_comments', 'child_title_comments');
function child_title_comments() {
    return __(comments_number( '<h3>No Responses</h3>', '<h3>1 Response</h3>', '<h3>% Responses...</h3>' ), 'codetambay');
}
 
// Unset URL from comment form
function codetambay_comment_below( $fields ) { 
    $comment_field = $fields['comment']; 
    unset( $fields['comment'] ); 
    $fields['comment'] = $comment_field; 
    return $fields; 
} 
add_filter( 'comment_form_fields', 'codetambay_comment_below' ); 
 
// Add placeholder for Name and Email
function codetambay_comment_form_fields($fields){
	$fields['author'] = 
				'<div class="comment-form-author">' . 
				'<label class="col-12 col-form-label" for="author">' . __( 'Your Name <small><em>(Preferred nickname.)</em></small>', 'codetambay' ) . '</label> ' .
				'<div class="col-12">' .
				'<input class="form-control" id="author" placeholder="Name" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' required />'.
				'<div class="invalid-feedback">Please provide a name or nickname.</div>' .
				'</div>'.
                ( $req ? '<span class="required">*</span>' : '' )  .
                '</div>';
	$fields['email'] = 
				'<div class="comment-form-email">' . 
				'<label class="col-12 col-form-label" for="email">' . __( 'Your Email <small><em>(we don\'t send spam and this is <strong>not visible to public</strong>.)</em></small>', 'codetambay' ) . '</label> ' .
				'<div class="col-12">' .
				'<input class="form-control" id="email" placeholder="your@email.com" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' required />'  .
				'<div class="invalid-feedback">Please provide an email. <small>(we don\'t send spam and this is not visible to public.)</small></div>' .
				'</div>' .
                ( $req ? '<span class="required">*</span>' : '' ) 
                 .
                '</div>';
	$fields['url'] = 
				'<div class="comment-form-url">' .
				'<label class="col-12 col-form-label" for="url">' . __( 'What is your Purpose? <small><em>(Optional and this is <strong>not visible to public</strong>.)</em></small>', 'codetambay' ) . '</label>' .
				'<div class="col-12">' .
				'<input class="form-control" id="url" name="url" placeholder="ex: Love this blog (Optional)" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
				'<div>' .
				'</div>';
    
    return $fields;
}
add_filter('comment_form_default_fields','codetambay_comment_form_fields');

function change_submit_button($submit_field) {
	$changed_submit = str_replace (
		'name="submit" type="submit" id="submit"', 
		'name="submit" value="Submit comment" class="submit btn btn-branding-secondary mt-3" type="submit" id="submit" tabindex = "5"', 
		$submit_field
	);
		return $changed_submit;
	}
add_filter('comment_form_submit_field', 'change_submit_button');

// function validate_comment_form(){
//     ob_start();
//     comment_form();
//     echo str_replace('<form','<form attribute="value" ',ob_get_clean());
// }