<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 */
$blog_layout                = apply_filters( 'rivet_archive_sidebar_layout', rivet_set_value( 'blog_archive_layout', 'right-sidebar' ) );
		
get_header();

echo '<div class="site-content-inner' . esc_attr( apply_filters( 'rivet_container_class', ' rivet-container' ) ) . '">';
	do_action( 'rivet_before_content' );

	echo '<div id="primary" class="rivet-' . get_post_type() . '-archive-wrapper content-area ' . esc_attr( apply_filters( 'rivet_content_area_class', 'rivet-col-lg-8' ) ) . '">';
		echo '<main id="main" class="site-main">';

			get_template_part( 'template-parts/content', 'blog' );

		echo '</main>';
	echo '</div>';

	if ( 'no-sidebar' !== $blog_layout ) :
		get_sidebar();
	endif;
	
	do_action( 'rivet_after_content' );
echo '</div>';

get_footer();