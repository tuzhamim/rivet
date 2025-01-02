<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin Menu Page
 * 
 * @since 1.0.0
 */
add_action( 'admin_menu', 'rivet_add_admin_menu' );

if ( ! function_exists( 'rivet_add_admin_menu' ) ) :
    function rivet_add_admin_menu() {
        
        add_menu_page( 'Rivet',  __( 'Rivet', 'rivet-core' ), 'manage_options', 'rivet_settings', 'rivet_admin_welcome_text', plugins_url( 'rivet-core/assets/images/dashboard-icon.png' ), 5 );

        add_submenu_page( 'rivet_settings', __( 'Welcome', 'rivet-core' ), __( 'Welcome', 'rivet-core' ), 'manage_options', 'rivet_settings' );

        add_submenu_page( 'rivet_settings', __( 'Headers', 'rivet-core' ), __( 'Headers', 'rivet-core' ), 'manage_options', 'edit.php?post_type=rivet_header' );

        add_submenu_page( 'rivet_settings', __( 'Footers', 'rivet-core' ), __( 'Footers', 'rivet-core' ), 'manage_options', 'edit.php?post_type=rivet_footer' );

        add_submenu_page( 'rivet_settings', __( 'Events', 'rivet-core' ), __( 'Events', 'rivet-core' ), 'manage_options', 'edit.php?post_type=simple_event' );

        if ( class_exists( 'OCDI_Plugin' ) ) :
            add_submenu_page( 'rivet_settings', __( 'Import Demo Data', 'rivet-core' ), __( 'Import Demo Data', 'rivet-core' ), 'manage_options', 'themes.php?page=one-click-demo-import' );
        endif;
        
        if ( class_exists( 'Redux_Framework_Plugin' ) ) :
            add_submenu_page( 'rivet_settings', __( 'Theme Options', 'rivet-core' ), __( 'Theme Options', 'rivet-core' ), 'manage_options', 'admin.php?page=rivet_options' );
        endif;
    }
endif;

if ( ! function_exists( 'rivet_admin_welcome_text' ) ) :
    function rivet_admin_welcome_text(){
        echo '<h2>'. __( 'Welcome to Rivet', 'rivet-core' ) . '</h2>';
        echo '<p>' . __( 'Rivet is a complete WordPress LMS( Learning Management System ) theme developed by DevsVibe. DevsVibe is a very young team of developers and designers. Our goal is ensuring product quality and customer satisfaction, so we\'ve gathered people who are driven by the passion to create an excellent product and be a helpful hand to their customers. Please let us know if you\'ve any query. Our support Engineer will reply to you within 10 minutes to 8 hours( maximum ). If you need any development related task then please feel free to let us know. We\'re ready to get hired and would love to help you out. If you are interested in Premium WordPress Theme, React and HTML Template then one of our products may please you. We love what we do and your review would be a great inspiration for our product development and enriching feature for you. Thanks...', 'rivet-core' ) . '</p>';
    }
endif;


/**
 * Author additional fields
 */
if ( ! function_exists( 'rivet_additional_user_fields' ) ) :
    function rivet_additional_user_fields( $contactmethods ) {
        $contactmethods['rivet_job']   = __( 'Instructor Job', 'rivet' );
        $contactmethods['rivet_facebook']  = __( 'Facebook', 'rivet' );
        $contactmethods['rivet_twitter']   = __( 'Twitter', 'rivet' );
        $contactmethods['rivet_pinterest']  = __( 'Pinterest', 'rivet' );
        $contactmethods['rivet_linkedin']   = __( 'LinkedIn', 'rivet' );
    
        return $contactmethods;
    }
endif;
add_filter( 'user_contactmethods', 'rivet_additional_user_fields', 10, 1 );