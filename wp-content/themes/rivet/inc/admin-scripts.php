<?php
defined( 'ABSPATH' ) || exit;

// return if it's not an admin page.
if ( ! is_admin() ) :
	return;
endif;

/**
 * Enqueue Admin scripts and styles.
 */
function rivet_admin_scripts() {
	wp_enqueue_style( 'rivet-admin', get_template_directory_uri() . '/assets/css/admin-main.css', array(), RIVET_THEME_VERSION );

	wp_add_inline_style( 'rivet-admin', html_entity_decode( rivet_root_css_variables(), ENT_QUOTES ) );
}

add_action( 'admin_enqueue_scripts', 'rivet_admin_scripts' );

function rivet_admin_classes( $classes ) {
    $classes .= ' rivet-admin-wrapper ';
    return $classes;
}

add_filter( 'admin_body_class', 'rivet_admin_classes' );