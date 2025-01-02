<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 */

get_header();

if ( ! isset( $rivet_blog_post_style ) ) :
    $rivet_blog_post_style = rivet_set_value( 'blog_post_style', 'standard' );
endif;

if ( isset( $_GET['post_preset'] ) ) :
	$rivet_blog_post_style = in_array( $_GET['post_preset'], array( 1, 2, 3, 'standard' ) ) ? $_GET['post_preset'] : $rivet_blog_post_style;
endif;

$blog_layout = rivet_set_value( 'blog_archive_layout', 'right-sidebar' );

echo '<div class="site-content-inner' . esc_attr( apply_filters( 'rivet_container_class', ' rivet-container' ) ) . '">';
	do_action( 'rivet_before_content' );

	echo '<div id="primary" class="content-area ' . esc_attr( apply_filters( 'rivet_content_area_class', 'rivet-col-lg-8' ) ) . '">';
		echo '<main id="main" class="site-main">';

			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;
				echo '<div class="rivet-row rivet-blog-post-archive-style-' . esc_attr( $rivet_blog_post_style ) . '">';
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/posts/post', $rivet_blog_post_style );
					endwhile;
					wp_reset_postdata();
				echo '</div>';

				if ( function_exists( 'rivet_numeric_pagination' ) ) :
					rivet_numeric_pagination();
				else :
					the_posts_navigation();
				endif;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;

		echo '</main>';
	echo '</div>';

	if ( 'no-sidebar' !== $blog_layout ) :
		get_sidebar();
	endif;

	do_action( 'rivet_after_content' );
echo '</div>';

get_footer();