<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ENQUEUE // Enqueueing Frontend stylesheet and scripts.
add_action( 'elementor/editor/after_enqueue_scripts', 'rivet_elementor_icons_css' );
// FRONTEND // After Elementor registers all styles.
add_action( 'elementor/frontend/after_register_styles', 'rivet_elementor_icons_css' );
// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'rivet_elementor_icons_css' );
	
/**
 * Enqueueing icons
 */
if ( ! function_exists( 'rivet_elementor_icons_css' ) ) :
	function rivet_elementor_icons_css() {
		$box_icon_enable = false;
   		wp_enqueue_style( 'remixicon' );
		if ( $box_icon_enable ) :
			wp_enqueue_style( 'boxicons' );
		endif;
	}
endif;


// add_filter( 'elementor/icons_manager/additional_tabs', 'rivet_elementor_custom_icons_tab' );
if ( ! function_exists( 'rivet_elementor_custom_icons_tab' ) ) :
	function rivet_elementor_custom_icons_tab( $tabs = array() ) {

		/*
		 * Rivet Custom Icons
		 */
		$rivet_custom_icons   = [];
		$custom_icons_pack = include RIVET_PLUGIN_DIR . '/icons/rivet-custom-icons/rivet-custom-icons.php';

		foreach ( $custom_icons_pack as $education_icon ) :
		    $rivet_custom_icons[] = $education_icon;
		endforeach;

		$tabs['rivet-custom-icons'] = array(
			'name'          => 'rivet-custom-icons',
			'label'         => __( 'Rivet Icons', 'rivet-core' ),
			'labelIcon'     => 'rivet icon-Schoolbag',
			'prefix'        => 'icon-',
			'displayPrefix' => 'rivet',
			'url'           => get_template_directory_uri() . '/assets/css/rivet-custom-icons.css',
			'icons'         => $rivet_custom_icons,
			'ver'           => '1.0.0'
		);

		/*
		 * Remix Icons
		 */
		$rm_icons   = [];
		$remix_icons = include RIVET_PLUGIN_DIR . '/icons/remix-icons/remix-icons.php';

		foreach ( $remix_icons as $remix_icon ) :
		    $rm_icons[] = $remix_icon;
		endforeach;

		$tabs['remix-icons'] = array(
			'name'          => 'remix-icons',
			'label'         => __( 'Remix Icons', 'rivet-core' ),
			'labelIcon'     => 'ri-remixicon-line',
			'prefix'        => 'ri-',
			'displayPrefix' => 'ri',
			'url'           => get_template_directory_uri() . '/assets/css/remixicon.css',
			'icons'         => $rm_icons,
			'ver'           => '1.0.0'
		);

		/*
		 * Box Icons
		 */
		$box_icon_enable = false;
		if ( $box_icon_enable ) :
			$bx_icons  = [];
			$box_icons = include RIVET_PLUGIN_DIR . '/icons/box-icons/box-icons.php';
			
			foreach ( $box_icons as $box_icon ) :
				$bx_icons[] = $box_icon;
			endforeach;

			$tabs['box-icons'] = array(
				'name'          => 'box-icons',
				'label'         => __( 'Box Icons', 'elementor-icons' ),
				'labelIcon'     => 'bx bxl-bootstrap',
				'prefix'        => '',
				'displayPrefix' => 'bx',
				'url'           => get_template_directory_uri() . '/assets/css/boxicons.min.css',
				'icons'         => $bx_icons,
				'ver'           => '1.0.0'
			);
		endif;

		return $tabs;
	}
endif;