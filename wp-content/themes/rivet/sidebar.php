<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rivet
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar = apply_filters( 'rivet_get_sidebar', 'sidebar-default' );

if ( ! is_active_sidebar( $sidebar ) || isset( $_GET['sidebar_disable'] ) ) :
	return;
endif;

echo '<aside id="secondary" class="widget-area ' . esc_attr( apply_filters( 'rivet_widget_area_class', 'rivet-col-lg-4' ) ) . '">';
	echo '<div class="rivet-sidebar__left">';
		do_action( 'rivet_sidebar_before' );
		dynamic_sidebar( $sidebar );
		do_action( 'rivet_sidebar_after' );
	echo '</div>';
echo '</aside>';
