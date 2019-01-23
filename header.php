<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Code_Tambay
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'codetambay' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-light bg-light" role="navigation">
			<div class="container">
				<div class="site-branding">			
					<h1>
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">								
							<?php
								if ( has_custom_logo() ) {

										$custom_logo_id = get_theme_mod( 'custom_logo' );
										$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );	

										//use this to repalce logo when scroll from top						
										//$stickyLogo = $logo[0];						
										//$stickyScrollLogo = substr( $stickyLogo, 0, -4 );//logo file name 'image-sticky.png' (remove chars '.png')		
										//$stickyScrollLogo = esc_url($stickyScrollLogo . '-scroll.png');//logo file name 'image-sticky-scroll.png' (remove chars '-scroll.png')	
										/*
											echo '<img class="img-fluid" src="'. esc_url( $logo[0] ) .'" 
											data-scroll-logo="' . $stickyScrollLogo . '">
											<span class="site-title">' . get_bloginfo( 'name' ) . '</span>';
										*/
										echo '<img class="img-fluid" src="'. esc_url( $logo[0] ) .'" >
												<span class="site-title screen-reader-text">' . get_bloginfo( 'name' ) . '</span>';
								} else {
										echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
								}

							?>						

						</a>
						
					</h1>					
					<?php
						$codetambay_description = get_bloginfo( 'description', 'display' );
						if ( $codetambay_description || is_customize_preview() ) :
					?>
						<p class="site-description screen-reader-text"><?php echo $codetambay_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->	
				<!-- navbar icon taggler -->
				<button class="navbar-toggler py-3" type="button" 
					data-toggle="collapse" 
					data-target="#bs-example-navbar-collapse-1" 
					aria-controls="bs-example-navbar-collapse-1" 
					aria-expanded="false" aria-label="Toggle navigation">
					<span><?php esc_html_e( 'Menu', 'codetambay' ); ?></span>
				</button>

				<?php

				wp_nav_menu( array(

					'menu'            => 'primary',
					'theme_location'  => 'menu-1',
					'menu_id'         => 'primary-menu',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'bs-example-navbar-collapse-1',
					'menu_class'      => 'navbar-nav mr-auto',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),

					
					
					
				));

				?>
			</div><!-- container -->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
