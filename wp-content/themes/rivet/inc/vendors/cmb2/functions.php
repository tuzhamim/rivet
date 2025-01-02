<?php

/**
 * MetaBoxes for Rivet
 *
 * @since 1.0.0
 */
namespace Rivet;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Metaboxes Class
 *
 * @since 1.0.0
 */ 
class Metaboxes {

	public static function init() {
		add_filter( 'cmb2_admin_init', array( __CLASS__, 'page_metabox' ) );
	}

	public static function page_metabox() {
		global $wp_registered_sidebars;
        $sidebars = array();
        if ( ! empty( $wp_registered_sidebars ) ) :
            foreach ( $wp_registered_sidebars as $sidebar ) :
                $sidebars[$sidebar['id']] = $sidebar['name'];
            endforeach;
        endif;

		$headers = array_merge( array( 'global' => __( 'Global Setting', 'rivet' ) ), rivet_fetch_header_layouts(), array( 'none' => __( 'None', 'rivet' ) ) );
		$footers = array_merge( array( 'global' => __( 'Global Setting', 'rivet' ) ), rivet_fetch_footer_layouts(), array( 'none' => __( 'None', 'rivet' ) ) );
		$prefix = 'rivet_page_';

		$page_meta = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Display Settings', 'rivet' ),
			'object_types' => array( 'page' ), // Post type
			'context'      => 'normal', //  'normal', 'advanced', or 'side'
			'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
			'show_names'   => true // Show field names on the left
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'layout_type',
			'type'        => 'select',
			'name'        => __( 'Layout Type', 'rivet' ),
			'default'     => 'boxed',
			'options'     => array(
				'boxed'      => __( 'Boxed', 'rivet' ),
				'full-width' => __( 'Full Width', 'rivet' )
			)
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'content_type',
			'type'        => 'select',
			'name'        => __( 'Content Type', 'rivet' ),
			'default'     => 'full-width',
			'options'     => array(
				'no-sidebar'    => __( 'Only Content( No Sidebar )', 'rivet' ),
				'left-sidebar'  => __( 'Left Sidebar', 'rivet' ),
				'right-sidebar' => __( 'Right Sidebar', 'rivet' )
			),
			'description' => __( 'If you select <b>Full Width</b> Layout Type then this option won\'t work.', 'rivet' )
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'sidebar_name',
			'type'        => 'select',
			'name'        => __( 'Sidebar', 'rivet' ),
			'options'     => $sidebars,
			'description' => __( 'If you select <b>Full Width</b> from Layout Type or <b>Only Content( No Sidebar )</b> from Content Type then this selected sidebar won\'t display.', 'rivet' )
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'breadcrumb',
			'type'        => 'select',
			'name'        => __( 'Breadcrumb', 'rivet' ),
			'default'     => 'default',
			'options'     => array(
				'default' => __( 'Default', 'rivet' ),
				'enable'  => __( 'Enable', 'rivet' ),
				'disable' => __( 'Disable', 'rivet' )
			),
			'description' => __( 'This option won\'t work at the Front Page.', 'rivet' )
		) );

		$page_meta->add_field( array(
			'id'   => $prefix . 'breadcrumb_color',
			'type' => 'colorpicker',
			'name' => __( 'Breadcrumb Background Color', 'rivet' )
		) );

		$page_meta->add_field( array(
			'id'   => $prefix . 'breadcrumb_image',
			'type' => 'file',
			'name' => __( 'Breadcrumb Background Image', 'rivet' )
        ) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'header_type',
			'type'        => 'select',
			'name'        => __( 'Header Layout Type', 'rivet' ),
			'description' => __( 'Choose a header for your website.', 'rivet' ),
			'options'     => $headers,
			'default'     => 'global'
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'header_transparent',
			'type'        => 'select',
			'name'        => __( 'Header Transparent', 'rivet' ),
			'description' => __( 'Turn header into transparent. If page breadcrumb is disable then this option will work.', 'rivet' ),
			'default'     => 'default',
			'options'     => array(
				'default' => __( 'Default', 'rivet' ),
				'no'      => __( 'No', 'rivet' ),
				'yes'     => __( 'Yes', 'rivet' )
            )
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'footer_type',
			'type'        => 'select',
			'name'        => __( 'Footer Layout Type', 'rivet' ),
			'description' => __( 'Choose a footer for your website.', 'rivet' ),
			'options'     => $footers,
			'default'     => 'global'
		) );

		$page_meta->add_field( array(
			'id'          => $prefix . 'extra_class',
			'type'        => 'text',
			'name'        => __( 'Extra Class', 'rivet' ),
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'rivet' )
        ) );
	}

	public static function woo_product_metabox( array $metaboxes ) {
		$prefix = 'rivet_woo_product_';
		
		$metaboxes[ $prefix . 'info' ] = array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Author Details', 'rivet' ),
			'object_types' => array( 'product' ),
			'context'      => 'side',
			'priority'     => 'low',
			'show_names'   => true,
			'fields'       => self::woo_product_metaboxes()
		);
		
		return $metaboxes;
	}
}

Metaboxes::init();