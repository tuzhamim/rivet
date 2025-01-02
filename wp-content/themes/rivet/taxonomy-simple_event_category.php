<?php
defined( 'ABSPATH' ) || exit();

/**
 * The template for displaying event archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rivet
 */

get_header();

if ( ! isset( $block_data ) ) :
    $block_data = array();
endif;

if ( ! isset( $style ) ) :
    $style = rivet_set_value( 'simple_event_style', 1 );
endif;

if ( isset( $_GET['event_preset'] ) ) :
	$style = in_array( $_GET['event_preset'], array( 1, 2, 3 ) ) ? $_GET['event_preset'] : 1;
endif;

$default_data = array(
	'style' => $style
);

$args = wp_parse_args( $block_data, $default_data );

$row = '';
if ( 1 == $style || 3 == $style ) :
	$row = ' rivet-row';
endif;

if ( have_posts() ) :
	echo '<div class="rivet-events-wrapper' . esc_attr( $row ) . '">';
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/events/custom/blocks', '', $args );
		endwhile;
		wp_reset_postdata();
	echo '</div>';
	rivet_numeric_pagination();
else :
	get_template_part( 'template-parts/content', 'none' );
endif;
get_footer();