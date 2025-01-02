<?php
/**
 * Rivet Theme Customizer
 *
 * @package Rivet
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rivet_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'rivet_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'rivet_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'rivet_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function rivet_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function rivet_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rivet_customize_preview_js() {
	wp_enqueue_script( 'rivet-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), RIVET_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'rivet_customize_preview_js' );
