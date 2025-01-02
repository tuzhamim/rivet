<?php
/**
 * Event for Rivet
 *
 * @since 1.0.0
 */

namespace RivetCore\Post_Types;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Event {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_action( 'init', array( __CLASS__, 'taxonomy' ) );
		add_filter( 'enter_title_here', array( __CLASS__, 'change_title_placeholder' ) );
	}

	public static function definition() {
		
		$labels = array(
			'name'                  => __( 'Events', 'rivet-core' ),
			'singular_name'         => __( 'Event', 'rivet-core' ),
			'add_new'               => __( 'Add New Event', 'rivet-core' ),
			'add_new_item'          => __( 'Add New Event', 'rivet-core' ),
			'edit_item'             => __( 'Edit Event', 'rivet-core' ),
			'new_item'              => __( 'New Event', 'rivet-core' ),
			'all_items'             => __( 'All Events', 'rivet-core' ),
			'view_item'             => __( 'View Event', 'rivet-core' ),
			'search_items'          => __( 'Search Event', 'rivet-core' ),
			'not_found'             => __( 'No Events found', 'rivet-core' ),
			'not_found_in_trash'    => __( 'No Events found in Trash', 'rivet-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Events', 'rivet-core' )
		);

		$labels    = apply_filters( 'rivet_postype_event_labels' , $labels );

		register_post_type( apply_filters( 'rivet_posttype_event' , 'simple_event' ),
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'public'            => true,
				'has_archive'       => true,
				'rewrite'           => array( 'slug' => apply_filters( 'rivet_simple_event_slug', 'simple-event' ) ),
				'show_in_menu'      => true,
				'menu_position'     => 6,
				'categories'        => array()
			)
		);
	}

	public static function taxonomy() {

	  	$labels = array(
			'name'              => __( 'Event Categories', 'rivet-core' ),
			'singular_name'     => __( 'Event Category', 'rivet-core' ),
			'search_items'      => __( 'Search Event Categories', 'rivet-core' ),
			'edit_item'         => __( 'Edit Event Category', 'rivet-core' ),
			'update_item'       => __( 'Update Event Category', 'rivet-core' ),
			'add_new_item'      => __( 'Add New Event Category', 'rivet-core' ),
			'new_item_name'     => __( 'New Event Category', 'rivet-core' ),
			'menu_name'         => __( 'Event Categories', 'rivet-core' )
		);

		register_taxonomy( 'simple_event_category', apply_filters( 'rivet_posttype_event' , 'simple_event' ), array(
			'labels'            => apply_filters( 'rivet_simple_event_taxomony_category_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'simple-event-category',
			'rewrite'           => array( 'slug' => apply_filters( 'rivet_simple_event_category_slug', 'simple-event-category' ) ),
			'public'            => true,
			'show_ui'           => true
		) );
	}

	public static function change_title_placeholder( $title ){
	    $screen = get_current_screen();
	    if  ( 'simple_event' == $screen->post_type ) :
          	$title = 'Enter Event Name';
	    endif;	  
	    return $title;
	}
}

Event::init();