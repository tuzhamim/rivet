<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rivet
 */

 get_header();

 $single_layout = apply_filters( 'rivet_single_sidebar_layout', rivet_set_value( 'blog_single_layout', 'right-sidebar' ) );
 echo '<div class="site-content-inner' . esc_attr( apply_filters( 'rivet_container_class', ' rivet-container' ) ) . '">';
	 do_action( 'rivet_before_content' );
 
	 echo '<div id="primary" class="content-area ' . esc_attr( apply_filters( 'rivet_content_area_class', 'rivet-col-lg-8' ) ) . '">';
		 echo '<main id="main" class="site-main rivet-postbox__wrap">';
			get_template_part( 'template-parts/single', 'post' );
		 echo '</main>';
	 echo '</div>';
	 if ( 'no-sidebar' !== $single_layout ) :
		 get_sidebar();
	 endif;
	 
	 do_action( 'rivet_after_content' );
 echo '</div>';
 
 get_footer();