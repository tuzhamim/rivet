<?php
/**
 * Template part for displaying post single( details ) content in single.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 * @since   1.0.0
 */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', get_post_type() );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.